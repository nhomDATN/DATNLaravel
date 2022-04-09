<?php

namespace App\Http\Controllers;

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

    public function checkout()
    {
        $tttk = TaiKhoan::join('hoa_dons', 'hoa_dons.tai_khoan_id', '=', 'tai_khoans.id')
        ->join('chi_tiet_hoa_dons', 'chi_tiet_hoa_dons.hoa_don_id', '=', 'hoa_dons.id')
        ->join('san_phams', 'san_phams.id', '=', 'chi_tiet_hoa_dons.san_pham_id')
        ->select('tai_khoans.ho_ten', 'tai_khoans.dia_chi', 'hoa_dons.voucher')
        ->where('tai_khoans.id', 1)
        ->get();
        return view('checkout', ['tttk'=>$tttk]);
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
