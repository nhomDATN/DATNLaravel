<?php

namespace App\Http\Controllers;

use App\Models\HoaDon;
use App\Models\KhuyenMai;
use App\Models\SanPham;
use App\Models\TaiKhoan;
use Illuminate\Http\Request;

class TaiKhoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function checkout(Request $request)
    {
        $tttk = TaiKhoan::join('hoa_dons', 'hoa_dons.tai_khoan_id', '=', 'tai_khoans.id')
        // ->join('chi_tiet_hoa_dons', 'chi_tiet_hoa_dons.hoa_don_id', '=', 'hoa_dons.id')
        // ->join('san_phams', 'san_phams.id', '=', 'chi_tiet_hoa_dons.san_pham_id')
        ->select('tai_khoans.ho_ten', 'tai_khoans.dia_chi', 'tai_khoans.sdt', 'tai_khoans.email')
        ->where('tai_khoans.id', 1)
        ->get();

        $giohang = HoaDon::join('chi_tiet_hoa_dons', 'chi_tiet_hoa_dons.hoa_don_id', '=', 'hoa_dons.id')
        ->join('san_phams', 'san_phams.id', '=', 'chi_tiet_hoa_dons.san_pham_id')
        ->join('tai_khoans', 'tai_khoans.id', '=', 'hoa_dons.tai_khoan_id')
        ->where('tai_khoans.id', 1)
        ->select('san_phams.ten_san_pham', 'chi_tiet_hoa_dons.so_luong', 'san_phams.gia')
        ->get();

        $lstctdh = TaiKhoan::join('hoa_dons', 'hoa_dons.tai_khoan_id', '=', 'tai_khoans.id')
        ->join('chi_tiet_hoa_dons', 'chi_tiet_hoa_dons.hoa_don_id', '=', 'hoa_dons.id')
        ->join('san_phams', 'san_phams.id', '=', 'chi_tiet_hoa_dons.san_pham_id')
        ->select('san_phams.gia', 'chi_tiet_hoa_dons.so_luong')
        ->where('tai_khoans.id', 1)
        ->get();
        $tongtien = 0;
        foreach($lstctdh as $ctdh)
        {
            $tongtien += $ctdh->so_luong * $ctdh->gia;
        }

        $khuyenmai = KhuyenMai::join('san_phams', 'san_phams.khuyen_mai_id', '=', 'khuyen_mais.id')
        ->join('chi_tiet_hoa_dons', 'chi_tiet_hoa_dons.san_pham_id', '=', 'san_phams.id')
        ->join('hoa_dons','hoa_dons.id', '=', 'chi_tiet_hoa_dons.hoa_don_id')
        ->join('tai_khoans', 'tai_khoans.id', '=', 'hoa_dons.tai_khoan_id')
        ->select('san_phams.gia', 'chi_tiet_hoa_dons.so_luong', 'khuyen_mais.gia_tri')
        ->get();
        $giamgia = 0;
        foreach($khuyenmai as $km)
        {
            $giamgia += $km->gia * $km->gia_tri / 100;
        }

        return view('checkout', ['tttk'=>$tttk, 'giohang'=>$giohang, 'tongtien'=>$tongtien, 'giamgia'=>$giamgia]);
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
     * @param  \App\Http\Requests\StoreTaiKhoanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TaiKhoan  $taiKhoan
     * @return \Illuminate\Http\Response
     */
    public function show(TaiKhoan $taiKhoan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TaiKhoan  $taiKhoan
     * @return \Illuminate\Http\Response
     */
    public function edit(TaiKhoan $taiKhoan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTaiKhoanRequest  $request
     * @param  \App\Models\TaiKhoan  $taiKhoan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TaiKhoan $taiKhoan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TaiKhoan  $taiKhoan
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaiKhoan $taiKhoan)
    {
        //
    }
}
