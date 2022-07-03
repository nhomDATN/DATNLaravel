<?php

namespace App\Http\Controllers;

use App\Models\NoiLamViec;
use App\Models\DonViTinh;
use App\Models\NguyenLieu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

class NguyenLieuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lstnguyenlieu = NguyenLieu::join('don_vi_tinhs', 'don_vi_tinhs.id', '=', 'nguyen_lieus.don_vi_tinh_id')
        ->join('noi_lam_viecs', 'noi_lam_viecs.id', '=', 'nguyen_lieus.kho_id')
        ->select('nguyen_lieus.id', 'nguyen_lieus.ten_nguyen_lieu', 'nguyen_lieus.don_gia', 'nguyen_lieus.so_luong', 'don_vi_tinhs.ten_don_vi_tinh', 'noi_lam_viecs.ma_noi_lam_viec', 'nguyen_lieus.trang_thai', 'nguyen_lieus.created_at', 'nguyen_lieus.updated_at')
        ->get();
        return view('admin/pages.material', ['lstnguyenlieu' => $lstnguyenlieu]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lstdvt = DonViTinh::all();
        $lstkho = NoiLamViec::all();
        return view('admin/add.add_material', ['lstdvt' => $lstdvt, 'lstkho' => $lstkho]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreNguyenLieuRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->input('tennguyenlieu') == null) {
            $alert = 'Tên nguyên liệu không được bỏ trống';
            return redirect()->back()->with('alert', $alert);
        }

        $tonTai = NguyenLieu::where('ten_nguyen_lieu', $request['tennguyenlieu'])->first();
        
        if (empty($tonTai)) {
            $nguyenLieu = NguyenLieu::insert([
                'ten_nguyen_lieu' => $request->input('tennguyenlieu'),
                'don_gia' => $request->input('dongia'),
                'so_luong' => $request->input('soluong'),
                'don_vi_tinh_id' => $request->input('donvitinh'),
                'kho_id' => $request->input('kho'),
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'updated_at' => null,
            ]);
            return Redirect::route('nguyenLieu.index');
        }
        $alert = 'Tên nguyên liệu đã tồn tại';
        return redirect()->back()->with('alert', $alert);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NguyenLieu  $nguyenLieu
     * @return \Illuminate\Http\Response
     */
    public function show(NguyenLieu $nguyenLieu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NguyenLieu  $nguyenLieu
     * @return \Illuminate\Http\Response
     */
    public function edit(NguyenLieu $nguyenLieu)
    {
        $lstdvt = DonViTinh::all();
        $lstkho = NoiLamViec::all();
        return view('admin/edit.edit_material', ['nguyenLieu' => $nguyenLieu, 'lstdvt' => $lstdvt, 'lstkho' => $lstkho]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNguyenLieuRequest  $request
     * @param  \App\Models\NguyenLieu  $nguyenLieu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NguyenLieu $nguyenLieu)
    {
        $nguyenlieuformat = trim( $request->input('tennguyenlieu')); 
        $tontai = NguyenLieu::where('ten_nguyen_lieu','like', $nguyenlieuformat)
        ->where('nguyen_lieus.id', '!=', $nguyenLieu->id)
        ->first();
        if(empty($tontai)){
            // $kt_nguyenlieu = str_replace(' ', '', $nguyenlieuformat);
            // $tontai = NguyenLieu::where('ten_nguyen_lieu','like', $kt_nguyenlieu)
            // ->where('id', '!=', $nguyenLieu->id)
            // ->first();
            // if(empty($tontai)){
                $nguyenLieu->fill([
                    'ten_nguyen_lieu' => $nguyenlieuformat,
                    'don_gia' => $request->input('dongia'),
                    'so_luong' => $request->input('soluong'),
                    'don_vi_tinh_id' => $request->input('donvitinh'),
                    'kho_id' => $request->input('kho'),
                    'trang_thai'  => $request->input('trangthai'),
                ]);
                $nguyenLieu->save();
                return Redirect::route('nguyenLieu.index');
            // }
        }
        $alert = 'Tên nguyên liệu đã tồn tại';
        return redirect()->back()->with('alert', $alert);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NguyenLieu  $nguyenLieu
     * @return \Illuminate\Http\Response
     */
    public function destroy(NguyenLieu $nguyenLieu)
    {
        $nguyenLieu->fill([
            'trang_thai' => 0,
        ]);
        $nguyenLieu->save();
        return Redirect::route('nguyenLieu.index');
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $materials = NguyenLieu::join('don_vi_tinhs', 'don_vi_tinhs.id', '=', 'nguyen_lieus.don_vi_tinh_id')
            ->join('noi_lam_viecs', 'noi_lam_viecs.id', '=', 'nguyen_lieus.kho_id')
            ->select('nguyen_lieus.id', 'nguyen_lieus.ten_nguyen_lieu', 'nguyen_lieus.don_gia', 'nguyen_lieus.so_luong', 'don_vi_tinhs.ten_don_vi_tinh', 'noi_lam_viecs.ma_noi_lam_viec', 'nguyen_lieus.trang_thai', 'nguyen_lieus.created_at', 'nguyen_lieus.updated_at')
            ->where('ten_nguyen_lieu', 'LIKE', '%' . $request->search . '%')
            ->get();
            
            $stt = 0;

            if ($materials) {
                foreach ($materials as $key => $nl) {
                    $output .= '<tr>
                        <td>' . ++$stt . '</td>
                        <td>' . $nl->ten_nguyen_lieu . '</td>
                        <td>' . $nl->don_gia . '</td>
                        <td>' . $nl->so_luong . '</td>
                        <td>' . $nl->ten_don_vi_tinh . '</td>
                        <td>' . $nl->ma_noi_lam_viec . '</td>';
                        if($nl->trang_thai == 1) {
                            $output .= '<td>Hoạt Động</td>';
                        }
                        else {
                            $output .= '<td>Ngưng Hoạt Động</td>';
                        } 
                        
                        $output .= '
                        <td>' . $nl->created_at . '</td>
                        <td>' . $nl->updated_at . '</td>
                        <td style=";width: 20px;">
                            <a href="'.route('nguyenLieu.edit', ['nguyenLieu' => $nl]).'">
                                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fas fa-edit"></i></button>
                            </a>
                        </td>
                        <td style="width: 20px;">
                            <form method="post" action="'.route('nguyenLieu.destroy', ['nguyenLieu' => $nl]).'">
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
}
