<?php

namespace App\Http\Controllers;

use App\Models\LoaiKhuyenMai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

class LoaiKhuyenMaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lstlkm = LoaiKhuyenMai::all();
        return view('admin/pages.promotion_type', ['lstlkm' => $lstlkm]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lstlkm = LoaiKhuyenMai::all();
        return view('admin/add.add_promotion_type', ['lstlkm' => $lstlkm]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLoaiKhuyenMaiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tonTai = LoaiKhuyenMai::where('ten_loai_khuyen_mai', $request['tenloaikhuyenmai'])->first();
        if (empty($tonTai)) {
            $loaiKhuyenMai = LoaiKhuyenMai::insert([
                'ten_loai_khuyen_mai' => $request->input('tenloaikhuyenmai'),
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'updated_at' => null,
            ]);
            return Redirect::route('loaiKhuyenMai.index');
        }
        $alert = 'Tên loại khuyến mãi đã tồn tại';
        return redirect()->back()->with('alert', $alert);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LoaiKhuyenMai  $loaiKhuyenMai
     * @return \Illuminate\Http\Response
     */
    public function show(LoaiKhuyenMai $loaiKhuyenMai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LoaiKhuyenMai  $loaiKhuyenMai
     * @return \Illuminate\Http\Response
     */
    public function edit(LoaiKhuyenMai $loaiKhuyenMai)
    {
        return view('admin/edit.edit_promotion_type', ['loaiKhuyenMai' => $loaiKhuyenMai]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLoaiKhuyenMaiRequest  $request
     * @param  \App\Models\LoaiKhuyenMai  $loaiKhuyenMai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LoaiKhuyenMai $loaiKhuyenMai)
    {
        $loaiKhuyenMai->fill([
            'ten_loai_khuyen_mai' => $request->input('tenloaikhuyenmai'),
        ]);
        $loaiKhuyenMai->save();
        #dd($request->all);
        return Redirect::route('loaiKhuyenMai.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LoaiKhuyenMai  $loaiKhuyenMai
     * @return \Illuminate\Http\Response
     */
    public function destroy(LoaiKhuyenMai $loaiKhuyenMai)
    {
        //
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $promotions_type = LoaiKhuyenMai::where('ten_loai_khuyen_mai', 'LIKE', '%' . $request->search . '%')
            ->get();
            
            if ($promotions_type) {
                foreach ($promotions_type as $key => $lkm) {
                    $output .= '<tr>
                        <td>' . $lkm->id . '</td>
                        <td>' . $lkm->ten_loai_khuyen_mai . '</td>
                        <td>' . $lkm->created_at . '</td>
                        <td>' . $lkm->updated_at . '</td>
                        <td style=";width: 20px;">
                        <a href="'.route('loaiKhuyenMai.edit', ['loaiKhuyenMai' => $lkm]).'">
                            <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fas fa-edit"></i></button>
                        </a>
                    </td>
                    </tr>';
                }
            }
            return Response($output);
        }
    }
}
