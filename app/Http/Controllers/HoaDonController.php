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
        // dd($lstgiohang);
        return view('cart', ['lstgiohang'=>$lstgiohang]);
    }

    public function capNhatSoLuong (Request $request){       
            DB::update('update chi_tiet_hoa_dons set so_luong = ? where id = ?', [$request->quantity, $request->id]);
    }

    public function addCart(Request $request)
    {
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
    public function addCartFast(Request $request)
    {
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
        return redirect()->back();
    }
    public function deleteProductInCart($id){
       DB::delete('delete from chi_tiet_hoa_dons where id = ?', [$id]);
        return redirect()->back();
    }
    public function thanhtoan(Request $request)
    {
        if($request->optradio == "cast")
        {
            DB::update('update hoa_dons set voucher =?, nguoi_nhan_hang =?,
             dia_chi_nguoi_nhan_hang =?, sdt_nguoi_nhan_hang =?, tong_tien =?, 
             tai_khoan_id =?, nhan_vien_id = ?, trang_thai = ?, phuong_thuc_thanh_toan = ?
             where id = ?', [$request->voucher, $request->people, $request->address, $request->phone,$request->total,$request->userId,0,0,"Tiền mặt",$request->id]);
           Session::forget('cartId');
           return redirect()->route('homeuser',['success'=>true,'amount' => $request->total]);
        }
        else if($request->optradio == "VNPay")
        {
            return redirect()->route('vnpayment',['vnpay_payment' => 1,'id' => $request->id,'total' => $request->total,'people'=>$request->people,'address'=>$request->address,'phone'=>$request->phone,'voucher'=> $request->voucher]);
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
        $people = $_GET['people'];
        $phone = $_GET['phone'];
        $address = $_GET['address'];
        
        $voucher = "";
        if(!empty($_GET['voucher']))
        $voucher = $_GET['voucher'];
       // dd($voucher);
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
        DB::update('update hoa_dons set voucher =?, nguoi_nhan_hang =?,
        dia_chi_nguoi_nhan_hang =?, sdt_nguoi_nhan_hang =?, tong_tien =?, 
        tai_khoan_id =?, nhan_vien_id = ?, trang_thai = ?, phuong_thuc_thanh_toan = ?
        where id = ?', [$request->voucher, $request->people, $request->address, $request->phone,$request->vnp_Amount,Session::get('UserId'),0,0,"VNPay",$request->vnp_TxnRef]);
        Session::forget('cartId');
        return redirect()->route('homeuser',['success'=>true,'amount' => $request->vnp_Amount]);
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
    public function edit(HoaDon $hoaDon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHoaDonRequest  $request
     * @param  \App\Models\HoaDon  $hoaDon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HoaDon $hoaDon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HoaDon  $hoaDon
     * @return \Illuminate\Http\Response
     */
    public function destroy(HoaDon $hoaDon)
    {
        //
    }
}
