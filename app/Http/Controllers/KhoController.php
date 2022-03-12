<?php

namespace App\Http\Controllers;

use App\Models\Kho;
use App\Http\Requests\StoreKhoRequest;
use App\Http\Requests\UpdateKhoRequest;

class KhoController extends Controller
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
     * @param  \App\Http\Requests\StoreKhoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKhoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kho  $kho
     * @return \Illuminate\Http\Response
     */
    public function show(Kho $kho)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kho  $kho
     * @return \Illuminate\Http\Response
     */
    public function edit(Kho $kho)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateKhoRequest  $request
     * @param  \App\Models\Kho  $kho
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateKhoRequest $request, Kho $kho)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kho  $kho
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kho $kho)
    {
        //
    }
}
