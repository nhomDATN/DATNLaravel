<?php

namespace App\Http\Controllers;

use App\Models\ChiTietSanPham;
use App\Models\HinhAnh;
use App\Models\SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class HinhAnhController extends Controller
{

    protected function fixImage(HinhAnh $hinhAnh)
    {
        if (Storage::disk('public')->exists($hinhAnh->hinh_anh)) {
            $hinhAnh->hinh_anh = Storage::url($hinhAnh->hinh_anh);
        } else {
            $hinhAnh->hinh_anh = '/img/default-150x150.png';
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $lsthinhAnh = HinhAnh::join('chi_tiet_san_phams', 'chi_tiet_san_phams.id', '=', 'hinh_anhs.chi_tiet_san_pham_id')
            ->join('san_phams', 'san_phams.id', '=', 'chi_tiet_san_phams.san_pham_id')
            ->select('hinh_anhs.id', 'hinh_anhs.hinh_dai_dien', 'hinh_anhs.hinh_anh', 'san_phams.ten_san_pham', 'hinh_anhs.created_at', 'hinh_anhs.updated_at')
            ->get();
        if ($request->has('view_deleted')) {
            $lsthinhAnh = HinhAnh::join('chi_tiet_san_phams', 'chi_tiet_san_phams.id', '=', 'hinh_anhs.chi_tiet_san_pham_id')
                ->join('san_phams', 'san_phams.id', '=', 'chi_tiet_san_phams.san_pham_id')
                ->select('hinh_anhs.id', 'hinh_anhs.hinh_dai_dien', 'hinh_anhs.hinh_anh', 'san_phams.ten_san_pham', 'hinh_anhs.created_at', 'hinh_anhs.updated_at', 'hinh_anhs.deleted_at')
                ->onlyTrashed()->get();
        }
        return view('pages.picture', ['lsthinhAnh' => $lsthinhAnh]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lstctsp = ChiTietSanPham::all();
        return view('add.add_picture', ['lstctsp' => $lstctsp]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreHinhAnhRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $hinhAnh = new HinhAnh;
        $hinhAnh->fill([
            'hinh_dai_dien' => $request->input('avatar'),
            'hinh_anh' => '',
            'chi_tiet_san_pham_id' => $request->input('ctsanpham'),
        ]);
        $hinhAnh->save();
        if ($request->hasFile('file')) {
            $hinhAnh->hinh_anh = $request->file('file')->store('image/' . $hinhAnh->id, 'public');
        }
        $hinhAnh->save();
        return Redirect::route('hinhAnh.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HinhAnh  $hinhAnh
     * @return \Illuminate\Http\Response
     */
    public function show(HinhAnh $hinhAnh)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HinhAnh  $hinhAnh
     * @return \Illuminate\Http\Response
     */
    public function edit(HinhAnh $hinhAnh)
    {
        $lstctsp = ChiTietSanPham::all();
        return view('edit.edit_picture', ['hinhAnh' => $hinhAnh, 'lstctsp' => $lstctsp]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHinhAnhRequest  $request
     * @param  \App\Models\HinhAnh  $hinhAnh
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HinhAnh $hinhAnh)
    {
        if ($request->hasFile('file')) {
            $hinhAnh->hinh_anh = $request->file('file')->store('image/' . $hinhAnh->id, 'public');
        }
        $hinhAnh->fill([
            'hinh_dai_dien' => $request->input('avatar'),
            'chi_tiet_san_pham_id' => $request->input('ctsanpham'),
        ]);
        $hinhAnh->save();

        // $hinhAnh->save();
        return Redirect::route('hinhAnh.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HinhAnh  $hinhAnh
     * @return \Illuminate\Http\Response
     */
    public function destroy(HinhAnh $hinhAnh)
    {
        $hinhAnh->delete();
        return Redirect::route('hinhAnh.index');
    }

    public function restore($id)
    {
        HinhAnh::withTrashed()->find($id)->restore();

        return back();
    }

    public function restoreAll()
    {
        HinhAnh::onlyTrashed()->restore();

        return back();
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $pictures = HinhAnh::join('chi_tiet_san_phams', 'chi_tiet_san_phams.id', '=', 'hinh_anhs.chi_tiet_san_pham_id')
                ->join('san_phams', 'san_phams.id', '=', 'chi_tiet_san_phams.san_pham_id')
                ->select('hinh_anhs.id', 'hinh_anhs.hinh_dai_dien', 'hinh_anhs.hinh_anh', 'san_phams.ten_san_pham', 'hinh_anhs.created_at', 'hinh_anhs.updated_at')
                ->where('san_phams.ten_san_pham', 'LIKE', '%' . $request->search . '%')
                ->get();
            if ($pictures) {
                foreach ($pictures as $key => $ha) {
                    $output .= '<tr>
                    <td>' . $ha->id . '</td>
                    <td>' . $ha->hinh_dai_dien . '</td>
                    <td><img src=" ' . asset("/storage/$ha->hinh_anh") . ' " style="width: 100px;"></td>
                    <td>' . $ha->ten_san_pham . '</td>
                    <td>' . $ha->created_at . '</td>
                    <td>' . $ha->updated_at . '</td>
                    <td style=";width: 20px;">
                        <a href="' . route('hinhAnh.edit', ['hinhAnh' => $ha]) . '">
                            <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fas fa-edit"></i></button>
                        </a>
                    </td>
                    <td style="width: 20px;">
                        <form method="post" action="' . route('hinhAnh.destroy', ['hinhAnh' => $ha]) . '">
                        ' . @csrf_field() . '
                        ' . @method_field("DELETE") . '
                            <button type="submit" class="btn btn-default btn-sm checkbox-toggle"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                    </tr>';
                }
            }

            return Response($output);
        }
    }

    public function searchHinhAnhXoa(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $pictures = HinhAnh::join('chi_tiet_san_phams', 'chi_tiet_san_phams.id', '=', 'hinh_anhs.chi_tiet_san_pham_id')
                ->join('san_phams', 'san_phams.id', '=', 'chi_tiet_san_phams.san_pham_id')
                ->select('hinh_anhs.id', 'hinh_anhs.hinh_dai_dien', 'hinh_anhs.hinh_anh', 'san_phams.ten_san_pham', 'hinh_anhs.created_at', 'hinh_anhs.updated_at')
                ->where('san_phams.ten_san_pham', 'LIKE', '%' . $request->search . '%')
                ->onlyTrashed()
                ->get();
            if ($pictures) {
                foreach ($pictures as $key => $ha) {
                    $output .= '<tr>
                    <td>' . $ha->id . '</td>
                    <td>' . $ha->hinh_dai_dien . '</td>
                    <td><img src=" ' . asset("/storage/$ha->hinh_anh") . ' " style="width: 100px;"></td>
                    <td>' . $ha->ten_san_pham . '</td>
                    <td>' . $ha->created_at . '</td>
                    <td>' . $ha->updated_at . '</td>
                    <td>' . $ha->deleted_at . '</td>
                    <td style=";width: 20px;">
                        <a href="' . route('hinhAnh.restore', $ha->id) . '">
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
