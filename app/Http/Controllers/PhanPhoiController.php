<?php

namespace App\Http\Controllers;

use App\Models\PhanPhoi;
use App\Http\Requests\StorePhanPhoiRequest;
use App\Http\Requests\UpdatePhanPhoiRequest;

class PhanPhoiController extends Controller
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
     * @param  \App\Http\Requests\StorePhanPhoiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePhanPhoiRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PhanPhoi  $phanPhoi
     * @return \Illuminate\Http\Response
     */
    public function show(PhanPhoi $phanPhoi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PhanPhoi  $phanPhoi
     * @return \Illuminate\Http\Response
     */
    public function edit(PhanPhoi $phanPhoi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePhanPhoiRequest  $request
     * @param  \App\Models\PhanPhoi  $phanPhoi
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePhanPhoiRequest $request, PhanPhoi $phanPhoi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PhanPhoi  $phanPhoi
     * @return \Illuminate\Http\Response
     */
    public function destroy(PhanPhoi $phanPhoi)
    {
        //
    }
}
