<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $lstbanner=Banner::all();
        if ($request->has('view_deleted')) {
            $lstbanner = Banner::onlyTrashed()->get();
        }
        return view('pages.banner',['lstbanner'=>$lstbanner]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('add.add_banner');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBannerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Banner= new Banner;
        $Banner->fill([
            'ten_banner'=>$request->input('tenbanner'),
            'hinh_anh_banner'=>'',
        ]);
        $Banner->save();
        if ($request->hasFile('file'))
        {
            $Banner->hinh_anh_banner = $request->file('file')->store('image/'.$Banner->id, 'public');
        }
        $Banner->save();
        return Redirect::route('banner.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banner  $Banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $Banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        return view('edit.edit_banner',['banner'=>$banner]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBannerRequest  $request
     * @param  \App\Models\Banner  $Banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
        if ($request->hasFile('file'))
        {
            $banner->hinh_anh_banner = $request->file('file')->store('image/'.$banner->id, 'public');
        }
        $banner->fill([
            'ten_banner'=>$request->input('tenbanner'),
        ]);
        $banner->save();

        // $hinhAnh->save();
        return Redirect::route('banner.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $Banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        $banner->delete();
        return Redirect::route('banner.index');
    }

    public function restore($id)
    {
        Banner::withTrashed()->find($id)->restore();

        return back();
    }

    public function restoreAll()
    {
        Banner::onlyTrashed()->restore();

        return back();
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $banners = Banner::where('ten_banner', 'LIKE', '%' . $request->search . '%')->get();
            if ($banners) {
                foreach ($banners as $key => $banner) {
                    $output .= '<tr>
                    <td>' . $banner->id . '</td>
                    <td>' . $banner->ten_banner . '</td>
                    <td><img src=" ' . asset("/storage/$banner->hinh_anh_banner") . ' " style="width: 100px;"></td>
                    <td>' . $banner->created_at . '</td>
                    <td>' . $banner->updated_at . '</td>
                    <td style=";width: 20px;">
                     <a href="'.route("banner.edit", ["banner" =>$banner]).'">
                     <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fas fa-edit"></i></button>
                     </a>
                     </td>
                     <td style="width: 20px;">
                     <form method="post" action="'.route("banner.destroy", ["banner" =>$banner]).'">
                     '.@csrf_field().'
                     '.@method_field("DELETE").'
                     <button type="submit" class="btn btn-default btn-sm checkbox-toggle"><i class="fas fa-trash"></i></button>
                     </form>
                     </td>
                    </tr>';
                }
            }

            return Response($output);
        }
    }

    public function searchBannerXoa(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $banners = Banner::where('ten_banner', 'LIKE', '%' . $request->search . '%')->onlyTrashed()->get();
            if ($banners) {
                foreach ($banners as $key => $banner) {
                    $output .= '<tr>
                    <td>' . $banner->id . '</td>
                    <td>' . $banner->ten_banner . '</td>
                    <td><img src=" ' . asset("/storage/$banner->hinh_anh_banner") . ' " style="width: 100px;"></td>
                    <td>' . $banner->created_at . '</td>
                    <td>' . $banner->updated_at . '</td>
                    <td>' . $banner->deleted_at . '</td>
                    <td style=";width: 20px;">
                     <a href="'.route('banner.restore', $banner->id).'">
                     <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fas fa-redo"></i></button>
                     </a>
                     </td>
                    </tr>';
                }
            }

            return Response($output);
        }
    }
}
