<?php

namespace App\Http\Controllers;

use App\Models\CuaHang;
use App\Http\Requests\StoreCuaHangRequest;
use App\Http\Requests\UpdateCuaHangRequest;

class CuaHangController extends Controller
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
     * @param  \App\Http\Requests\StoreCuaHangRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCuaHangRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CuaHang  $cuaHang
     * @return \Illuminate\Http\Response
     */
    public function show(CuaHang $cuaHang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CuaHang  $cuaHang
     * @return \Illuminate\Http\Response
     */
    public function edit(CuaHang $cuaHang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCuaHangRequest  $request
     * @param  \App\Models\CuaHang  $cuaHang
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCuaHangRequest $request, CuaHang $cuaHang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CuaHang  $cuaHang
     * @return \Illuminate\Http\Response
     */
    public function destroy(CuaHang $cuaHang)
    {
        //
    }
}
