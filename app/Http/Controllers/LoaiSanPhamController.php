<?php

namespace App\Http\Controllers;

use App\Models\LoaiSanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


class LoaiSanPhamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lstloaisp = LoaiSanPham::all();
        return view('admin/pages.product_type', ['lstloaisp' => $lstloaisp]);   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/add.add_product_type');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLoaiSanPhamRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $loaisanphamformat = trim($request->input('tenlsp'));
        $tontai = LoaiSanPham::where('ten_loai_san_pham', 'like', $loaisanphamformat)->first();
        if (empty($tontai)) {
            $kt_loaisp = str_replace(' ', '', $loaisanphamformat);
            $tontai = LoaiSanPham::where('ten_loai_san_pham', 'like', $kt_loaisp)->first();
            if (empty($tontai)) {
                $loaiSanPham = new LoaiSanPham;
                $loaiSanPham->fill([
                    'ten_loai_san_pham' => $loaisanphamformat,
                    'hinh_anh_loai_sp' => '',
                ]);
                $loaiSanPham->save();
                if ($request->hasFile('file')) {
                    $loaiSanPham->hinh_anh_loai_sp = $request->file('file')->store('image/' . $loaiSanPham->id, 'public');
                }
                return Redirect::route('loaiSanPham.index');
            }
        }
        $alert = 'Product type name already in use';
        return redirect()->back()->with('alert', $alert);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LoaiSanPham  $loaiSanPham
     * @return \Illuminate\Http\Response
     */
    public function show(LoaiSanPham $loaiSanPham)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LoaiSanPham  $loaiSanPham
     * @return \Illuminate\Http\Response
     */
    public function edit(LoaiSanPham $loaiSanPham)
    {
        return view('admin/edit.edit_product_type', ['loaiSanPham' => $loaiSanPham]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLoaiSanPhamRequest  $request
     * @param  \App\Models\LoaiSanPham  $loaiSanPham
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LoaiSanPham $loaiSanPham)
    {
        $loaisanpham = trim($request->input('tenlsp'));

        $hinh_anh = $request->file('file')->store('image/' . $loaiSanPham->id, 'public');

        if ($request->hasFile('file')) {
            $tontai = LoaiSanPham::where('ten_loai_san_pham', 'like', $loaisanpham)
            ->where('hinh_anh', $hinh_anh)
            ->first();
        }
        else {
            $tontai = LoaiSanPham::where('ten_loai_san_pham', 'like', $loaisanpham)->first();
        }

        if (empty($tontai)) {
            // $loaisanphamformat = str_replace(' ', '', $loaisanpham);
            $loaiSanPham->fill([
                'ten_loai_san_pham' => $loaisanpham,
                'hinh_anh' => $loaiSanPham->hinh_anh,
            ]);
            $loaiSanPham->save();   
            return Redirect::route('loaiSanPham.index');
        }
        $alert = 'Tên loại sản phẩm đã tồn tại';
        return redirect()->back()->with('alert', $alert);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LoaiSanPham  $loaiSanPham
     * @return \Illuminate\Http\Response
     */
    public function destroy(LoaiSanPham $loaiSanPham)
    {
        $loaiSanPham->fill([
            'trang_thai' => 0,
        ]);
        $loaiSanPham->save();
        return Redirect::route('loaiSanPham.index');
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $producttypes = LoaiSanPham::where('ten_loai_san_pham', 'LIKE', '%' . $request->search . '%')->get();
            if ($producttypes) {
                foreach ($producttypes as $key => $pdt) {
                    $output .= '<tr>
                        <td>' . $pdt->id . '</td>
                        <td>' . $pdt->ten_loai_san_pham . '</td>
                        <td><img src="{{ asset("/storage/' . $pdt->hinh_anh . '") }}" style="width: 100px;"></td>
                        <td>' . $pdt->trang_thai . '</td>
                        <td>' . $pdt->created_at . '</td>
                        <td>' . $pdt->updated_at . '</td>
                        <td style=";width: 20px;">
                            <a href="' . route("loaiSanPham.edit", ["loaiSanPham" => $pdt]) . '">
                            <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fas fa-edit"></i></button>
                            </a>
                        </td>
                        <td style="width: 20px;">
                        <form method="post" action="' . route("loaiSanPham.destroy", ["loaiSanPham" => $pdt]) . '">
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
}
