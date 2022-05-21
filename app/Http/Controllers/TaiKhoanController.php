<?php

namespace App\Http\Controllers;

use App\Models\HoaDon;
use App\Models\KhuyenMai;
use App\Models\SanPham;
use App\Models\TaiKhoan;
use App\Models\LoaiTaiKhoan;
use App\Models\ChiTietHoaDon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

class TaiKhoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $lsttk = TaiKhoan::join('loai_tai_khoans', 'loai_tai_khoans.id', '=', 'tai_khoans.loai_tai_khoan_id')
        ->select('tai_khoans.id', 'tai_khoans.email', 'tai_khoans.dia_chi', 'tai_khoans.ngay_sinh', 'tai_khoans.sdt', 'tai_khoans.ho_ten', 'loai_tai_khoans.ten_loai_tai_khoan', 'tai_khoans.created_at', 'tai_khoans.updated_at', 'tai_khoans.trang_thai')
        ->get();
        if ($request->has('view_deleted')) {
            $lsttk = TaiKhoan::onlyTrashed()->get();
        }
        return view('admin/pages.account', ['lsttk' => $lsttk]); 
    }

    public function checkout(Request $request)
    {
        $maxid = ChiTietHoaDon::max('hoa_don_id');

        $tttk = TaiKhoan::join('hoa_dons', 'hoa_dons.tai_khoan_id', '=', 'tai_khoans.id')
        // ->join('chi_tiet_hoa_dons', 'chi_tiet_hoa_dons.hoa_don_id', '=', 'hoa_dons.id')
        // ->join('san_phams', 'san_phams.id', '=', 'chi_tiet_hoa_dons.san_pham_id')
        ->select('tai_khoans.ho_ten', 'tai_khoans.dia_chi', 'tai_khoans.sdt', 'tai_khoans.email')
        ->where('tai_khoans.id', 1)
        ->where('hoa_dons.id', 1)
        ->get();

        $giohang = HoaDon::join('chi_tiet_hoa_dons', 'chi_tiet_hoa_dons.hoa_don_id', '=', 'hoa_dons.id')
        ->join('san_phams', 'san_phams.id', '=', 'chi_tiet_hoa_dons.san_pham_id')
        ->join('tai_khoans', 'tai_khoans.id', '=', 'hoa_dons.tai_khoan_id')
        ->where('tai_khoans.id', 1)
        ->where('hoa_dons.id', $maxid)
        ->select('san_phams.ten_san_pham', 'chi_tiet_hoa_dons.so_luong', 'san_phams.gia')
        ->get();

        $lstctdh = TaiKhoan::join('hoa_dons', 'hoa_dons.tai_khoan_id', '=', 'tai_khoans.id')
        ->join('chi_tiet_hoa_dons', 'chi_tiet_hoa_dons.hoa_don_id', '=', 'hoa_dons.id')
        ->join('san_phams', 'san_phams.id', '=', 'chi_tiet_hoa_dons.san_pham_id')
        ->select('san_phams.gia', 'chi_tiet_hoa_dons.so_luong')
        ->where('tai_khoans.id', 1)
        ->get();
        $tongtien = 0;
        foreach($lstctdh as $ctdh)
        {
            $tongtien += $ctdh->so_luong * $ctdh->gia;
        }

        $khuyenmai = KhuyenMai::join('san_phams', 'san_phams.khuyen_mai_id', '=', 'khuyen_mais.id')
        ->join('chi_tiet_hoa_dons', 'chi_tiet_hoa_dons.san_pham_id', '=', 'san_phams.id')
        ->join('hoa_dons','hoa_dons.id', '=', 'chi_tiet_hoa_dons.hoa_don_id')
        ->join('tai_khoans', 'tai_khoans.id', '=', 'hoa_dons.tai_khoan_id')
        ->select('san_phams.gia', 'chi_tiet_hoa_dons.so_luong', 'khuyen_mais.gia_tri')
        ->get();
        $giamgia = 0;
        foreach($khuyenmai as $km)
        {
            $giamgia += $km->gia * $km->gia_tri / 100;
        }

        return view('checkout', ['tttk'=>$tttk, 'giohang'=>$giohang, 'tongtien'=>$tongtien, 'giamgia'=>$giamgia]);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lstltk = LoaiTaiKhoan::all();
        return view('admin/add.add_account', ['lstltk' => $lstltk]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTaiKhoanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tonTai = TaiKhoan::where('email', $request['email'])->first();
        if (empty($tonTai)) {
            $taiKhoan = TaiKhoan::insert([
                'email' => $request->input('email'),
                'mat_khau' => bcrypt($request->input('password')),
                'ho_ten' => $request->input('hoten'),
                'ngay_sinh' => $request->input('ngaysinh'),
                'dia_chi' => $request->input('diachi'),
                'sdt' => $request->input('sdt'),
                'loai_tai_khoan_id' => $request->input('loaitk'),
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'updated_at' => null,
            ]);
            return Redirect::route('taiKhoan.index');
        }
        $alert = 'Email already in use';
        return redirect()->back()->with('alert', $alert);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TaiKhoan  $taiKhoan
     * @return \Illuminate\Http\Response
     */
    public function show(TaiKhoan $taiKhoan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TaiKhoan  $taiKhoan
     * @return \Illuminate\Http\Response
     */
    public function edit(TaiKhoan $taiKhoan)
    {
        $lstltk = LoaiTaiKhoan::all();
        return view('admin/edit.edit_account', ['taiKhoan' => $taiKhoan, 'lstltk' => $lstltk]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTaiKhoanRequest  $request
     * @param  \App\Models\TaiKhoan  $taiKhoan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TaiKhoan $taiKhoan)
    {
        if ($request->ngay_sinh == "")
        {
            $alert = "Ngày sinh không được để trống";
            return redirect()->back()->with('alert', $alert);
        }
            
        $taiKhoan->fill([
            'ho_ten' => $request->input('hoten'),
            'ngay_sinh' => $request->input('ngaysinh'),
            'dia_chi' => $request->input('diachi'),
            'sdt' => $request->input('sdt'),
            'loai_tai_khoan_id' => $request->input('loaitk'),
        ]);
        $taiKhoan->save();
        return Redirect::route('taiKhoan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TaiKhoan  $taiKhoan
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaiKhoan $taiKhoan)
    {
        $taiKhoan->fill([
            'trang_thai' => 0,
        ]);
        $taiKhoan->save();
        return Redirect::route('taiKhoan.index');
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $accounts = TaiKhoan::join('loai_tai_khoans', 'loai_tai_khoans.id', '=', 'tai_khoans.loai_tai_khoan_id')
            ->select('tai_khoans.id', 'tai_khoans.email', 'tai_khoans.dia_chi', 'tai_khoans.ngay_sinh', 'tai_khoans.sdt', 'tai_khoans.ho_ten', 'loai_tai_khoans.ten_loai_tai_khoan', 'tai_khoans.created_at', 'tai_khoans.updated_at', 'tai_khoans.trang_thai')
            ->where('email', 'LIKE', '%' . $request->search . '%')
            ->get();
            
            if ($accounts) {
                foreach ($accounts as $key => $tk) {
                    $output .= '<tr>
                    <td>' . $tk->id . '</td>
                    <td>' . $tk->email . '</td>
                    <td>' . $tk->ho_ten . '</td>
                    <td>' . $tk->ngay_sinh . '</td>
                    <td>' . $tk->dia_chi . '</td>
                    <td>' . $tk->sdt . '</td>
                    <td>' . $tk->ten_loai_tai_khoan . '</td>
                    <td>' . $tk->created_at . '</td>
                    <td>' . $tk->updated_at . '</td>
                    <td style=";width: 20px;">
                        <a href="'.route('taiKhoan.edit', ['taiKhoan' => $tk]).'">
                            <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fas fa-edit"></i></button>
                        </a>
                    </td>
                    <td style="width: 20px;">
                        <form method="post" action="'.route('taiKhoan.destroy', ['taiKhoan' => $tk]).'">
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

    public function searchTaiKhoanXoa(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $accounts = TaiKhoan::join('loai_tai_khoans', 'loai_tai_khoans.id', '=', 'tai_khoans.loai_tai_khoan_id')
            ->select('tai_khoans.id', 'tai_khoans.email', 'tai_khoans.hoten', 'tai_khoans.ngaysinh', 'tai_khoans.diachi', 'tai_khoans.sdt', 'loai_tai_khoans.ten_loai_tai_khoan', 'token', 'tai_khoans.created_at', 'tai_khoans.updated_at')
            ->where('email', 'LIKE', '%' . $request->search . '%')
            ->onlyTrashed()
            ->get();
            if ($accounts) {
                foreach ($accounts as $key => $tk) {
                    $output .= '<tr>
                    <td>' . $tk->id . '</td>
                    <td>' . $tk->email . '</td>
                    <td>' . $tk->hoten . '</td>
                    <td>' . $tk->ngaysinh . '</td>
                    <td>' . $tk->diachi . '</td>
                    <td>' . $tk->sdt . '</td>
                    <td>' . $tk->ten_loai_tai_khoan . '</td>
                    <td>' . $tk->created_at . '</td>
                    <td>' . $tk->updated_at . '</td>
                    <td style=";width: 20px;">
                     <a href="'.route('taiKhoan.restore', $tk->id).'">
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
