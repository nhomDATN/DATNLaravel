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
        ->select('chi_tiet_hoa_dons.id','san_phams.ten_san_pham', 'san_phams.gia', 'san_phams.mo_ta', 'san_phams.hinh','chi_tiet_hoa_dons.so_luong')
        ->where('hoa_dons.id', Session::get('cartId'))
        ->where('tai_khoans.id', 1)
        ->get();
        // dd($lstgiohang);
        return view('cart', ['lstgiohang'=>$lstgiohang]);
    }

    public function capNhatSoLuong (Request $request){
        if ($request->ajax()) {        
            DB::update('update chi_tiet_hoa_dons set so_luong = ? where id = ?', [$request->quantity, $request->id]);
        }
        // return Response();
    }

    public function addCart(Request $request)
    {
        // Session::forget('cartId');
        $product = $request->productId;
        $date =  CarBon::now('Asia/Ho_Chi_Minh');
        if(empty(Session::get('cartId')))
        {
            $idNew = DB::table('hoa_dons')->max('id');
            Session::put('cartId',$idNew + 1);
            DB::insert('insert into hoa_dons (tai_khoan_id,tong_tien,nhan_vien_id, trang_thai,created_at) values (?,?,?,?,?)', [Session::get('UserId'), 0, 1, -1, $date]);
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


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
