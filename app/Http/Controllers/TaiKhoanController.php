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
use Illuminate\Support\Facades\Session;


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
        ->where('tai_khoans.loai_tai_khoan_id', '!=', 1)
        ->select('tai_khoans.id', 'tai_khoans.email', 'tai_khoans.dia_chi', 'tai_khoans.ngay_sinh', 'tai_khoans.sdt', 'tai_khoans.ho_ten', 'loai_tai_khoans.ten_loai_tai_khoan', 'tai_khoans.created_at', 'tai_khoans.updated_at', 'tai_khoans.trang_thai')
        ->get();
        if ($request->has('view_deleted')) {
            $lsttk = TaiKhoan::onlyTrashed()->get();
        }
        return view('admin/pages.account', ['lsttk' => $lsttk]); 
    }
    public function login(Request $request){
        $account = TaiKhoan::where('email', $request->Email)->where('mat_khau', $request->Password)->get();
        if(count($account) > 0){
            Session::put('UserId', $account[0]->id);
            Session::put('UserPicture', $account[0]->hinh_anh);
            Session::put('UserName', $account[0]->ho_ten);
            return redirect()->route('homeuser',['welcome' => Session::get('UserName')]);
        }
        else {
            return redirect()->back()->with('message', 'Sai tài khoản hoặc mật khẩu!');
        }
    }
    public function logout()
    {
        Session::forget('UserId');
        Session::forget('UserPicture');
        Session::forget('UserName');
        Session::forget('cartId');
        //Session::forget('dem');
        return redirect()->route('homeuser');
    }
    public function checkout(Request $request)
    {
        $maxid = ChiTietHoaDon::max('hoa_don_id');

        $tttk = TaiKhoan::where('tai_khoans.id', Session::get('UserId'))
        ->get();

        $lstgiohang = HoaDon::join('chi_tiet_hoa_dons', 'chi_tiet_hoa_dons.hoa_don_id','=', 'hoa_dons.id')
        ->join('san_phams','san_phams.id', '=', 'chi_tiet_hoa_dons.san_pham_id')
        ->join('tai_khoans', 'tai_khoans.id', '=', 'hoa_dons.tai_khoan_id')
        ->join('khuyen_mais','khuyen_mais.id', '=', 'san_phams.khuyen_mai_id')
        ->select('chi_tiet_hoa_dons.id','san_phams.ten_san_pham', 'san_phams.gia', 'san_phams.mo_ta', 'san_phams.hinh','chi_tiet_hoa_dons.so_luong','chi_tiet_hoa_dons.chiet_khau')
        ->where('hoa_dons.trang_thai', -1)
        ->where('tai_khoans.id', Session::get('UserId'))
        ->get();
        $tongtien = 0;
        foreach ($lstgiohang as $i)
        {
            $tongtien += ($i->gia - ($i->gia * $i->chiet_khau) / 100);
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

        return view('checkout', ['tttk'=>$tttk, 'giohang'=>$lstgiohang, 'tongtien'=>$tongtien, 'giamgia'=>$giamgia]);
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
        if ($request->input('password') == null) {
            $alert = 'Mật khẩu không được bỏ trống';
            return redirect()->back()->with('alert', $alert);
        }

        if ($request->input('hoten') == null) {
            $alert = 'Họ tên không được bỏ trống';
        return redirect()->back()->with('alert', $alert);
        }

        if ($request->input('sdt') == null) {
            $alert = 'Số điện thoại không được bỏ trống';
        return redirect()->back()->with('alert', $alert);
        }

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
        $alert = 'Email đã tồn tại';
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
        $taiKhoan->fill([
            'ho_ten' => $request->input('hoten'),
            'ngay_sinh' => $request->input('ngaysinh'),
            'dia_chi' => $request->input('diachi'),
            'sdt' => $request->input('sdt'),
            'loai_tai_khoan_id' => $request->input('loaitk'),
            'trang_thai'  => $request->input('trangthai'),
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

        // $taiKhoan->delete();
        // return Redirect::route('taiKhoan.index');
    }

    // public function restore($id)
    // {
    //     TaiKhoan::withTrashed()->find($id)->restore();

    //     return back();
    // }

    // public function restoreAll()
    // {
    //     TaiKhoan::onlyTrashed()->restore();

    //     return back();
    // }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $accounts = TaiKhoan::join('loai_tai_khoans', 'loai_tai_khoans.id', '=', 'tai_khoans.loai_tai_khoan_id')
            ->select('tai_khoans.id', 'tai_khoans.email', 'tai_khoans.dia_chi', 'tai_khoans.ngay_sinh', 'tai_khoans.sdt', 'tai_khoans.ho_ten', 'loai_tai_khoans.ten_loai_tai_khoan', 'tai_khoans.created_at', 'tai_khoans.updated_at', 'tai_khoans.trang_thai')
            ->where('tai_khoans.loai_tai_khoan_id', '!=', 1)
            ->where('email', 'LIKE', '%' . $request->search . '%')
            ->get();

            $stt = 0;

            if ($accounts) {
                foreach ($accounts as $key => $tk) {
                    $output .= '<tr>
                        <td>' . ++$stt . '</td>
                        <td>' . $tk->email . '</td>
                        <td>' . $tk->ho_ten . '</td>
                        <td>' . $tk->ngay_sinh . '</td>
                        <td>' . $tk->dia_chi . '</td>
                        <td>' . $tk->sdt . '</td>
                        <td>' . $tk->ten_loai_tai_khoan . '</td>';                            
                        if($tk->trang_thai == 1) {
                            $output .= '<td>Hoạt Động</td>';
                        }
                        else {
                            $output .= '<td>Ngưng Hoạt Động</td>';
                        } 
                        
                        $output .= '

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
}
