<?php

namespace App\Http\Controllers;

use App\Models\NhanVien;
use App\Models\NoiLamViec;
use App\Models\ChucVu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

class NhanVienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lstnv = NhanVien::join('noi_lam_viecs', 'noi_lam_viecs.id', '=', 'nhan_viens.noi_lam_id')
        ->join('chuc_vus', 'chuc_vus.id', '=', 'nhan_viens.chuc_vu_id')
        ->select('nhan_viens.id', 'nhan_viens.ten_nhan_vien', 'nhan_viens.dia_chi', 'nhan_viens.ngay_sinh', 'nhan_viens.sdt', 'nhan_viens.CCCD', 'nhan_viens.luong', 'nhan_viens.thuong_thang', 'noi_lam_viecs.ma_noi_lam_viec', 'chuc_vus.ten_chuc_vu', 'nhan_viens.trang_thai', 'nhan_viens.created_at', 'nhan_viens.updated_at')
        ->get();
        return view('admin/pages.staff', ['lstnv' => $lstnv]); 

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lstnlv = NoiLamViec::all();
        $lstcv = ChucVu::all();
        return view('admin/add.add_staff', ['lstnlv' => $lstnlv, 'lstcv' => $lstcv]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreNhanVienRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->input('CCCD') == null) {
            $alert = 'CCCD không được bỏ trống';
            return redirect()->back()->with('alert', $alert);
        }

        $tonTai = NhanVien::where('CCCD', $request['CCCD'])->first();

        if (empty($tonTai)) {
            $nhanVien = NhanVien::insert([
                'ten_nhan_vien' => $request->input('tennhanvien'),
                'dia_chi' => $request->input('diachi'),
                'ngay_sinh' => $request->input('ngaysinh'),
                'sdt' => $request->input('sdt'),
                'CCCD' => $request->input('CCCD'),
                'luong' => $request->input('luong'),
                'thuong_thang' => $request->input('thuongthang'),
                'noi_lam_id' => $request->input('noilamviec'),
                'chuc_vu_id' => $request->input('chucvu'),
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'updated_at' => null,
            ]);
            return Redirect::route('nhanVien.index');
        }
        $alert = 'CCCD đã tồn tại';
        return redirect()->back()->with('alert', $alert);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NhanVien  $nhanVien
     * @return \Illuminate\Http\Response
     */
    public function show(NhanVien $nhanVien)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NhanVien  $nhanVien
     * @return \Illuminate\Http\Response
     */
    public function edit(NhanVien $nhanVien)
    {
        $lstnlv = NoiLamViec::all();
        $lstcv = ChucVu::all();
        return view('admin/edit.edit_staff', ['nhanVien' => $nhanVien, 'lstnlv' => $lstnlv, 'lstcv' => $lstcv]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNhanVienRequest  $request
     * @param  \App\Models\NhanVien  $nhanVien
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NhanVien $nhanVien)
    {
        $nhavienformat = trim( $request->input('CCCD')); 
        $tontai = NhanVien::where('CCCD','like', $nhavienformat)
        ->where('nhan_viens.id', '!=', $nhanVien->id)
        ->first();

        if(empty($tontai)){
            $nhanVien->fill([
                'ten_nhan_vien' => $request->input('tennhanvien'),
                'dia_chi' => $request->input('diachi'),
                'ngay_sinh' => $request->input('ngaysinh'),
                'sdt' => $request->input('sdt'),
                'ho_ten' => $request->input('hoten'),
                'CCCD' => $nhavienformat,
                'sdt' => $request->input('sdt'),
                'luong' => $request->input('luong'),
                'thuong_thang' => $request->input('thuongthang'),
                'noi_lam_id' => $request->input('noilamviec'),
                'chuc_vu_id' => $request->input('chucvu'),
                'trang_thai'  => $request->input('trangthai'),
            ]);
            $nhanVien->save();
            return Redirect::route('nhanVien.index');
            
        }
        $alert = 'Nhân Viên có CCCD này đã tồn tại';
        return redirect()->back()->with('alert', $alert);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NhanVien  $nhanVien
     * @return \Illuminate\Http\Response
     */
    public function destroy(NhanVien $nhanVien)
    {
        $nhanVien->fill([
            'trang_thai' => 0,
        ]);
        $nhanVien->save();
        return Redirect::route('nhanVien.index');
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $staffs = NhanVien::join('noi_lam_viecs', 'noi_lam_viecs.id', '=', 'nhan_viens.noi_lam_id')
            ->join('chuc_vus', 'chuc_vus.id', '=', 'nhan_viens.chuc_vu_id')
            ->select('nhan_viens.id', 'nhan_viens.ten_nhan_vien', 'nhan_viens.dia_chi', 'nhan_viens.ngay_sinh', 'nhan_viens.sdt', 'nhan_viens.CCCD', 'nhan_viens.luong', 'nhan_viens.thuong_thang', 'noi_lam_viecs.ma_noi_lam_viec', 'chuc_vus.ten_chuc_vu', 'nhan_viens.trang_thai', 'nhan_viens.created_at', 'nhan_viens.updated_at')
            ->where('CCCD', 'LIKE', '%' . $request->search . '%')
            ->get();
            
            $stt = 0;

            if ($staffs) {
                foreach ($staffs as $key => $nv) {
                    $output .= '<tr>
                        <td>' . ++$stt . '</td>
                        <td>' . $nv->ten_nhan_vien . '</td>
                        <td>' . $nv->dia_chi . '</td>
                        <td>' . $nv->ngay_sinh . '</td>
                        <td>' . $nv->sdt . '</td>
                        <td>' . $nv->CCCD . '</td>
                        <td>' . $nv->luong . '</td>
                        <td>' . $nv->thuong_thang . '</td>
                        <td>' . $nv->ma_noi_lam_viec . '</td>
                        <td>' . $nv->ten_chuc_vu . '</td>';
                        if($nv->trang_thai == 1) {
                            $output .= '<td>Hoạt Động</td>';
                        }
                        else {
                            $output .= '<td>Ngưng Hoạt Động</td>';
                        } 
                        
                        $output .= '
                        <td>' . $nv->created_at . '</td>
                        <td>' . $nv->updated_at . '</td>
                        <td style=";width: 20px;">
                            <a href="'.route('nhanVien.edit', ['nhanVien' => $nv]).'">
                                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fas fa-edit"></i></button>
                            </a>
                        </td>
                        <td style="width: 20px;">
                            <form method="post" action="'.route('nhanVien.destroy', ['nhanVien' => $nv]).'">
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
