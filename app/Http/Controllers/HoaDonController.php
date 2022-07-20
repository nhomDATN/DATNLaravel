<?php

namespace App\Http\Controllers;

use App\Models\ChiTietHoaDon;
use Carbon\Carbon;
use App\Models\HoaDon;
use App\Models\KhuyenMai;
use App\Models\SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use PDF;
class HoaDonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }
    public function cart(Request $request)
    {
        $lstgiohang = HoaDon::join('chi_tiet_hoa_dons', 'chi_tiet_hoa_dons.hoa_don_id','=', 'hoa_dons.id')
        ->join('san_phams','san_phams.id', '=', 'chi_tiet_hoa_dons.san_pham_id')
        ->join('tai_khoans', 'tai_khoans.id', '=', 'hoa_dons.tai_khoan_id')
        ->join('khuyen_mais','khuyen_mais.id', '=','san_phams.khuyen_mai_id')
        ->select('chi_tiet_hoa_dons.id','san_phams.ten_san_pham', 'san_phams.gia', 'san_phams.mo_ta', 'san_phams.hinh','chi_tiet_hoa_dons.so_luong','chi_tiet_hoa_dons.chiet_khau')
        ->where('hoa_dons.trang_thai', -1)
        ->where('tai_khoans.id', Session::get('UserId'))
        ->get();
         //dd($lstgiohang);
        return view('cart', ['lstgiohang'=>$lstgiohang]);
    }

    public function capNhatSoLuong (Request $request){       
            DB::update('update chi_tiet_hoa_dons set so_luong = ? where id = ?', [$request->quantity, $request->id]);
    }

    public function addCart(Request $request)
    {
        //dd(Session::get('cartId'));
        $product = $request->productId;
        $date =  CarBon::now('Asia/Ho_Chi_Minh');
        if(empty(Session::get('cartId')))
        {
            $idNew = DB::table('hoa_dons')->max('id');
            Session::put('cartId',$idNew + 1);
            DB::insert('insert into hoa_dons (tai_khoan_id,tong_tien,nhan_vien_id, trang_thai,created_at) values (?,?,?,?,?)', [Session::get('UserId'), 0, 1, -1, $date]);
            DB::insert('insert into chi_tiet_hoa_dons (so_luong,gia,chiet_khau,hoa_don_id, san_pham_id,created_at) values (?,?,?,?,?,?)', [$request->quantity,$request->price,$request->sales,Session::get('cartId'), $product,$date]);
    
        }
        else
        {
            $select = DB::table('chi_tiet_hoa_dons')->where('san_pham_id','=',$product)->where('hoa_don_id','=',Session::get('cartId'))->get();
            if(count($select)>0)
            {
                DB::update('update chi_tiet_hoa_dons set so_luong = so_luong + ?, updated_at = ? where san_pham_id = ? and hoa_don_id = ?', [$request->quantity,$date,$product,Session::get('cartId')]);
            }
            else
            {
                DB::insert('insert into chi_tiet_hoa_dons (so_luong,gia,chiet_khau,hoa_don_id, san_pham_id,created_at) values (?,?,?,?,?,?)', [$request->quantity,$request->price,$request->sales,Session::get('cartId'), $product,$date]);
            }
           
        }
        return redirect()->route('homeuser');
    }
    public function deleteProductInCart($id){
       DB::delete('delete from chi_tiet_hoa_dons where id = ?', [$id]);
        return redirect()->back();
    }
    public function thanhtoan(Request $request)
    {
        $ma_hoa_don = 'DH'.time().$request->id;
        DB::update('update hoa_dons set voucher =?,ma_hoa_don = ?, nguoi_nhan_hang =?,
             dia_chi_nguoi_nhan_hang =?, sdt_nguoi_nhan_hang =?, tong_tien =?, 
             tai_khoan_id = ?, nhan_vien_id = ?
             where id = ?', [$request->voucher,$ma_hoa_don, $request->people, $request->address, $request->phone,0,$request->userId,0,$request->id]);
        if($request->optradio == "cast")
        {
            DB::update('update hoa_dons set  tong_tien =?, 
             trang_thai = ?, phuong_thuc_thanh_toan = ?
             where id = ?', [$request->total,0,"Tiền mặt",$request->id]);
             $select = DB::table('hoa_dons')
             ->where('id','=',$request->id)
             ->get();
           Session::forget('cartId');
           return redirect()->route('homeuser',['success'=>true,'amount' => $request->total,'getter' => $select[0]->nguoi_nhan_hang,'phone'=> $select[0]->sdt_nguoi_nhan_hang,'address'=> $select[0]->dia_chi_nguoi_nhan_hang]);
        }
        else if($request->optradio == "VNPay")
        {
            return redirect()->route('vnpayment',['vnpay_payment' => 1,'id' => $ma_hoa_don,'total' => $request->total,'people'=>$request->people,'address'=>$request->address,'phone'=>$request->phone,'voucher'=> $request->voucher]);
        }
        else if($request->optradio == "momo")
        {
            return redirect()->route('momopayment',['momo_payment' => 1,'id' => $ma_hoa_don,'Amount' => $request->total]);
        }
        else
            return redirect()->back();
    }
    public function vnpay_payment()
    {
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:8000/checkout/vnpay_payment";
        $vnp_TmnCode = "5IQ5M8FV";//Mã website tại VNPAY 
        $vnp_HashSecret = "FNXFYPJNWADDQPLVHPMWAHDFBZZGAXZM";//Chuỗi bí mật
        $vnp_TxnRef = $_GET['id']; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'Thanh toán đơn hàng '.$_GET['id'];
        $vnp_OrderType = 'VNPAY payment';
        $vnp_Amount = $_GET['total'] * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        //Add Params of 2.0.1 Version
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
            , 'message' => 'success'
            , 'data' => $vnp_Url);
            if (isset($_GET['vnpay_payment'])) {
                header('Location: ' . $vnp_Url);
                die();
            } else {
                echo json_encode($returnData);
            }
            // vui lòng tham khảo thêm tại code demo
            }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function vnpay_payment_updateDB(Request $request)
    {
        DB::update('update hoa_dons set tong_tien =?, 
        trang_thai = ?, phuong_thuc_thanh_toan = ?
        where id = ?', [$request->vnp_Amount/100,0,"VNPay",Session::get('cartId')]);
        $select = DB::table('hoa_dons')
        ->where('id',Session::get('cartId'))
        ->get();
        Session::forget('cartId');
        return redirect()->route('homeuser',['success'=>true,'amount' => $request->vnp_Amount/100,'getter' => $select[0]->nguoi_nhan_hang,'phone'=> $select[0]->sdt_nguoi_nhan_hang,'address'=> $select[0]->dia_chi_nguoi_nhan_hang]);
    }
    public function momo_payment()
    {
        header('Content-type: text/html; charset=utf-8');
        function execPostRequest($url, $data)
        {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($data))
            );
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            //execute post
            $result = curl_exec($ch);
            //close connection
            curl_close($ch);
            return $result;
        }
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

        $orderInfo = "Thanh toán qua mã QR MoMo";
        $amount = $_GET['Amount'];
        $orderId = $_GET['id'];
        $redirectUrl = "http://127.0.0.1:8000/checkout/momo_payment";
        $ipnUrl = "http://127.0.0.1:8000/checkout/momo_payment";
        $extraData = "";
        $requestId = time() . "";
        $requestType = "captureWallet";
            //$extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
            //before sign HMAC SHA256 signature
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);

        $data = array('partnerCode' => $partnerCode,
                'partnerName' => "Test",
                "storeId" => "MomoTestStore",
                'requestId' => $requestId,
                'amount' => $amount,
                'orderId' => $orderId,
                'orderInfo' => $orderInfo,
                'redirectUrl' => $redirectUrl,
                'ipnUrl' => $ipnUrl,
                'lang' => 'vi',
                'extraData' => $extraData,
                'requestType' => $requestType,
                'signature' => $signature);

        $result = execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);  // decode json
        //dd($jsonResult['payUrl']);
            //Just a example, please check more in there
        
        //header('Location: '.$jsonResult['payUrl']);
        return redirect($jsonResult['payUrl']);
    }
    public function momoPay(Request $request)
    {
        //dd($request);
        DB::update('update hoa_dons set tong_tien =?, 
        trang_thai = ?, phuong_thuc_thanh_toan = ?
        where id = ?', [$request->amount,0,"Momo",Session::get('cartId')]);
        $select = DB::table('hoa_dons')
        ->where('id',Session::get('cartId'))
        ->get();
        Session::forget('cartId');
        return redirect()->route('homeuser',['success'=>true,'amount' => $request->amount,'getter' => $select[0]->nguoi_nhan_hang,'phone'=> $select[0]->sdt_nguoi_nhan_hang,'address'=> $select[0]->dia_chi_nguoi_nhan_hang]);
    }
    public function getVoucher(Request $request)
    {
        $message ='';
        if($request->voucher == '')
        {
                $data =[
                    'message' => $message,
                ];
                return response()->json($data);
        }
        $voucher = DB::table('khuyen_mais')
        ->where('ma_khuyen_mai',$request->voucher)
        ->where('loai_khuyen_mai_id',1)
        ->get();
        if(count($voucher)==0)
        {
            $message = 'Không tồn tại mã voucher này!';
            $data =[
                'message' => $message,
            ];
            return response()->json($data);
        }
        else if(count($voucher) > 0)
        {
            $select = DB::table('hoa_dons')->where('voucher',$request->voucher)->where('tai_khoan_id',Session::get('UserId'))->get();
            if($voucher[0]->trang_thai == 0)
            {
                $message = 'Voucher này đã hết hạn!';
                $data =[
                    'message' => $message,
                ];
                return response()->json($data);
            }
            else if(count($select)>0)
            {
                $message = 'Voucher này đã được sử dụng!';
                $data =[
                    'message' => $message,
                ];
                return response()->json($data);
            }
            else
            {
                $message = 'Giảm '.$voucher[0]->gia_tri.'% tối đa '.number_format($voucher[0]->maximum,0,',','.').' VNĐ';
                $data =[
                    'message' => $message,
                    'value' => $voucher[0]->gia_tri,
                    'maximum' => $voucher[0]->maximum
                ];
                return response()->json($data);
            }
        } 
    }
    public function invoiceAdminShow(){
        $invoice = DB::table('hoa_dons')->where('trang_thai','<>',-1)->get();
        return view('admin.pages.order',['invoice'=>$invoice]);
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreHoaDonRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HoaDon  $hoaDon
     * @return \Illuminate\Http\Response
     */
    public function show(HoaDon $hoaDon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HoaDon  $hoaDon
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoice = DB::table('hoa_dons')
        ->where('hoa_dons.id', $id)
        ->get();
        $invoice_detail = DB::table('chi_tiet_hoa_dons')
        ->join('san_phams', 'san_phams.id', '=','san_pham_id')
        ->select('chi_tiet_hoa_dons.*','san_phams.ten_san_pham','san_phams.hinh')
        ->where('hoa_don_id',$id)
        ->get();
        
        return view('admin.edit.edit_order',['invoice'=>$invoice,'invoice_detail'=>$invoice_detail]);
    }
    public function bill($id)
    {
        $invoice = DB::table('hoa_dons')
        ->where('hoa_dons.id', $id)
        ->get();
        $invoice_detail = DB::table('chi_tiet_hoa_dons')
        ->join('san_phams', 'san_phams.id', '=','san_pham_id')
        ->select('chi_tiet_hoa_dons.*','san_phams.ten_san_pham','san_phams.hinh')
        ->where('hoa_don_id',$id)
        ->get();
        $sale = 0;
        $amount = $invoice[0]->tong_tien;
        $voucher = 'Không';
        if(!empty($invoice[0]->voucher))
        {
            $voucher = $invoice[0]->voucher;
            $select = DB::table('khuyen_mais')->select('gia_tri','maximum')->where('ma_khuyen_mai','=',$invoice[0]->voucher)->get();
            $sale = $select[0]->gia_tri;
            $amount = $invoice[0]->tong_tien - ($invoice[0]->tong_tien * $sale)/100;
            if((($invoice[0]->tong_tien * $sale)/100) >= $select[0]->maximum)
            $amount = $invoice[0]->tong_tien - $select[0]->maximum;
        }
        
        $detail =[
            'voucher' => $voucher,
            'sale' => $sale,
            'amount' => $amount
        ];
         $pdf = PDF::loadView('admin.pages.bill',['detail'=>$detail,'invoice'=>$invoice,'invoice_detail'=>$invoice_detail]);
         $string = $invoice[0]->ma_hoa_don .'.pdf';
         return $pdf->download($string);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHoaDonRequest  $request
     * @param  \App\Models\HoaDon  $hoaDon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if($request->has('_token')){
            DB::update('update hoa_dons set nhan_vien_id = ?, trang_thai = ? where id = ?',[Session::get('AdminId'),$request->status,$request->id]);
        }
        return redirect()->back();
    }
    public function search(Request $request)
    {
        $output = '';
        $select = DB::table('hoa_dons')
        ->where('trang_thai','<>',-1)
        ->where('ma_hoa_don','like','%'.$request->keyword.'%')->get();
        if(count($select) > 0)
        {
            $stt = 0;
            foreach($select as $item)
            {
                $output .= '<tr>
                <td>'. ++$stt.' </td>
                <td> '.$item->ma_hoa_don .'</td>
                <td>'.$item->nguoi_nhan_hang .'</td>
                <td>'.$item->created_at .'</td>
                <td>';
                switch($item->trang_thai)
                {
                    case 0:
                    $output .= '<p style="color:gray"> Đang xét</p>';
                        break;
                    case 1:
                    $output .= '<p style="color:blue"> Đã xét</p>';           
                        break;
                    case 2:
                    $output .= '<p style="color:lime">  Đang vận chuyển</p>';        
                        break;
                    case 3:
                    $output .= '<p style="color:green">Đã giao</p>';
                        break;
                    default:
                    $output .= '<p style="color:red">Đã hủy</p>';
                }
                $output .='</td><td> '.number_format($item->tong_tien,0,',','.').'</td>
                <td><a href="'.route('invoice.edit',['id'=>$item->id]).'"  class="btn btn-block btn-default btn-sm">Duyệt</a></td>
            </tr>';
            }
            return response()->json($output);
        }
        else
        {   
            $output = '<p>Không có hóa đơn này</p>';
            return response()->json($output);
        }
        
    }
   public function historyOrder($id)
   {
        $invoice = DB::table('hoa_dons')
        ->join('tai_khoans', 'tai_khoans.id','=','hoa_dons.tai_khoan_id')
        ->select('tai_khoans.id','hoa_dons.*')
        ->where('hoa_dons.trang_thai','<>',-1)
        ->where('tai_khoan_id',$id)
        ->get();
       // dd($invoice);
        return view('history_order',['id' => $id,'invoice' => $invoice]);
   }
   public function historyOrderDetail($id,$dh)
   {
        $invoice_detail = DB::table('hoa_dons')
        ->join('chi_tiet_hoa_dons','chi_tiet_hoa_dons.hoa_don_id','=','hoa_dons.id')
        ->join('san_phams', 'san_phams.id','=','san_pham_id')
        ->where('ma_hoa_don',$dh)
        ->get();
        //dd($invoice_detail);
        return view('history_orderdetail',['id' => $id,'invoice' => $invoice_detail]);
   }
   public function cancel(Request $request)
   {
        DB::delete('delete from hoa_dons where id = ? and trang_thai = 0', [$request->id]);
        return redirect()->back();
        
   }
    public function destroy(HoaDon $hoaDon)
    {
        //
    }
}
