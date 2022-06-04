<?php

namespace App\Http\Controllers;

use App\Models\YeuThich;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class YeuThichController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function like($id)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreYeuThichRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\YeuThich  $yeuThich
     * @return \Illuminate\Http\Response
     */
    public function show(YeuThich $yeuThich)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\YeuThich  $yeuThich
     * @return \Illuminate\Http\Response
     */
    public function edit(YeuThich $yeuThich)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateYeuThichRequest  $request
     * @param  \App\Models\YeuThich  $yeuThich
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, YeuThich $yeuThich)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\YeuThich  $yeuThich
     * @return \Illuminate\Http\Response
     */
    public function destroy(YeuThich $yeuThich)
    {
        //
    }
}
