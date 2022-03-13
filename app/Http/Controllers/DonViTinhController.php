<?php

namespace App\Http\Controllers;

use App\Models\DonViTinh;
use App\Http\Requests\StoreDonViTinhRequest;
use App\Http\Requests\UpdateDonViTinhRequest;

class DonViTinhController extends Controller
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
     * @param  \App\Http\Requests\StoreDonViTinhRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDonViTinhRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DonViTinh  $DonViTinh
     * @return \Illuminate\Http\Response
     */
    public function show(DonViTinh $donViTinh)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DonViTinh  $donViTinh
     * @return \Illuminate\Http\Response
     */
    public function edit(DonViTinh $donViTinh)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDonViTinhRequest  $request
     * @param  \App\Models\DonViTinh  $donViTinh
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDonViTinhRequest $request, DonViTinh $donViTinh)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DonViTinh  $donViTinh
     * @return \Illuminate\Http\Response
     */
    public function destroy(DonViTinh $donViTinh)
    {
        //
    }
}
