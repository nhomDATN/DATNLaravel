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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
        ->select('tai_khoans.id', 'tai_khoans.email', 'tai_khoans.dia_chi', 'tai_khoans.ngay_sinh', 'tai_khoans.sdt', 'tai_khoans.ho_ten', 'loai_tai_khoans.ten_loai_tai_khoan', 'tai_khoans.created_at', 'tai_khoans.updated_at', 'tai_khoans.trang_thai','tai_khoans.hinh_anh')
        ->get();
        if ($request->has('view_deleted')) {
            $lsttk = TaiKhoan::onlyTrashed()->get();
        }
        return view('admin/pages.account', ['lsttk' => $lsttk]); 
    }
    public function login(Request $request){
        $account = TaiKhoan::where('email', $request->Email)->where('loai_tai_khoan_id',2)->get();
        if(count($account) > 0){
          if($account[0]->trang_thai == 0)
          {
            return redirect()->back()->with('messageConfirm', 'Tài khoản chưa được kích hoạt, vui lòng vào email để kích hoạt tài khoản!');
          }
          else if(!password_verify($request->Password,$account[0]->mat_khau))
          {
            return redirect()->back()->with('errorPassword', 'Sai tài khoản hoặc mật khẩu!');
          }
          else
          {
            Session::put('UserId', $account[0]->id);
            Session::put('UserPicture', $account[0]->hinh_anh);
            Session::put('UserName', $account[0]->ho_ten);
            return redirect()->route('homeuser',['welcome' => Session::get('UserName')]);
          }
        }
        return redirect()->back()->with('message', 'Sai tài khoản hoặc mật khẩu!');
    }
    public function adminLogin(Request $request)
    {
        $account = TaiKhoan::where('email', $request->Email)->where('loai_tai_khoan_id',1)->get();
        if(count($account) > 0){
          if($account[0]->trang_thai == 0)
          {
            return redirect()->back()->with('messageConfirm', 'Tài khoản chưa được kích hoạt, vui lòng vào email để kích hoạt tài khoản!');
          }
          else if(!password_verify($request->Password,$account[0]->mat_khau))
          {
            return redirect()->back()->with('errorPassword', 'Sai tài khoản hoặc mật khẩu!');
          }
          else
          {
            Session::put('UserId', $account[0]->id);
            Session::put('UserPicture', $account[0]->hinh_anh);
            Session::put('UserName', $account[0]->ho_ten);
            return redirect()->route('homeuser',['welcome' => Session::get('UserName')]);
          }
        }
        return redirect()->back()->with('message', 'Sai tài khoản hoặc mật khẩu!');
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
        $feeShipping = 25000; 
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
            $tongtien += ($i->gia - ($i->gia * $i->chiet_khau) / 100) * $i->so_luong;
        }
        if($tongtien >= 500000)
            $feeShipping = 0;
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

        return view('checkout', ['tttk'=>$tttk,'feeShipping' => $feeShipping, 'giohang'=>$lstgiohang, 'tongtien'=>$tongtien, 'giamgia'=>$giamgia]);
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
                'trang_thai' => 1,
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'updated_at' => null,
            ]);
            return Redirect::route('taiKhoan.index');
        }
        $alert = 'Email đã tồn tại';
        return redirect()->back()->with('alert', $alert);
    }
    public function register(Request $request)
    {
        if($request->input('password') != $request->input('password_confirm'))
           {
            $alert = 'Mật khẩu nhập lại không đúng!';
            return redirect()->back()->with('alertPassword', $alert);
           }
        $tonTai = DB::table('tai_khoans')->where('email', $request['email'])->get();
        
        if (count($tonTai) == 0) {
            $taiKhoan = TaiKhoan::insert([
                'email' => $request->input('email'),
                'mat_khau' => bcrypt($request->input('password')),
                'ho_ten' => $request->input('fullname'),
                'ngay_sinh' => $request->input('datetime'),
                'dia_chi' => $request->input('address'),
                'sdt' => $request->input('phone'),
                'loai_tai_khoan_id' => 2,
                'verify_token'=> $request->_token,
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'updated_at' => null,
            ]);
            $select = DB::table('tai_khoans')
            ->where('email', '=', $request->input('email'))
            ->get();
            return Redirect::route('sendMailVerifyAccount',['id' => $select[0]->id,'EmailAddress'=>$request->input('email'),'_token' => $request->_token]);
        }
        else
        {
            $alert = 'Email đã tồn tại';
            return redirect()->back()->with('alert', $alert);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TaiKhoan  $taiKhoan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($id == Session::get('UserId'))
        {
            $user = DB::table('tai_khoans')->where('id',$id)->get();
            return view('info',['user' => $user]);
        }
        return redirect()->back();
    }

    public function updateInfo($id)
    {
        $user = DB::table('tai_khoans')->where('id',$id)->get();
        return view('update_info',['user' => $user]);
    }
    public function updateInfoUser(Request $request)
    {
       // dd($request->file('file'));
        $checkPhone = DB::table('tai_khoans')
        ->where('sdt',$request->sdt_new)
        ->where('id','<>',$request->id)
        ->get();
        //dd($checkPhone);
        if(count($checkPhone)>0){
            return redirect()->back()->with('alert','Số điện thoại đã được sử dụng!');
        }
        else
        {
                    if(!empty($request->file('file')))
                    {
                        $file = $request->file('file');
                        $file_name = $request->id.'.'.explode('.',$file->getClientOriginalName())[1];
                        $file->move('imageUsers',$file_name);
                        DB::update('update tai_khoans set hinh_anh = ? where id = ?', [$file_name,$request->id]);
                        //dd( $file);
                    }
                    if(!empty($request->ngay_sinh))
                    {
                        DB::update('update tai_khoans set ngay_sinh = ? where id = ?', [$request->ngay_sinh,$request->id]);
                    }
                    DB::update('update tai_khoans set ho_ten = ?, sdt = ?, dia_chi =? where id = ?', 
                    [$request->input('ho_ten'), $request->input('sdt_new'), $request->input('dia_chi'),$request->id]);
                   
        }
        return redirect()->route('user.info',['id'=>$request->id]);
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
    public function replace_password($id)
    {
        $id = DB::table('tai_khoans')->select('id')->where('id', '=', $id)->get();
        return view('replace_password',['id' => $id[0]->id]);        
    }
    public function replace(Request $request)
    {
        $checkPhone = DB::table('tai_khoans')->where('id', $request->id)->get();
        //dd($checkPhone);
        if(count($checkPhone)==0)
        {
            return redirect()->back()->with('alert','Số điện thoại không đúng, vui lòng nhập lại!');
        }
        else
        {
            if($request->password != $request->confirm_password)
            {
                return redirect()->back()->with('alert','Mật khẩu nhập lại không đúng!');
            }
            else
            {
                DB::update('update tai_khoans set mat_khau = ? where id = ?',[bcrypt($request->password),$request->id]);
                return redirect()->route('user.info',['id'=>$request->id]);
            }
        }
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
        $donvitinhformat = trim( $request->input('tendonvitinh')); 
        $tontai = TaiKhoan::where('email','like', $donvitinhformat)
        ->where('tai_khoans.id', '!=', $taiKhoan->id)
        ->first();

        if(empty($tontai)){
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
        $alert = 'Email đã tồn tại';
        return redirect()->back()->with('alert', $alert);
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
    public function adminLogout()
    {
        Session::forget('AdminId');
        return redirect()->route('loginadmin');
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $accounts = TaiKhoan::join('loai_tai_khoans', 'loai_tai_khoans.id', '=', 'tai_khoans.loai_tai_khoan_id')
            ->select('tai_khoans.id', 'tai_khoans.email', 'tai_khoans.dia_chi', 'tai_khoans.ngay_sinh', 'tai_khoans.sdt', 'tai_khoans.ho_ten', 'loai_tai_khoans.ten_loai_tai_khoan', 'tai_khoans.created_at', 'tai_khoans.updated_at', 'tai_khoans.trang_thai','tai_khoans.hinh_anh')
            ->where('tai_khoans.loai_tai_khoan_id', '!=', 1)
            ->where('email', 'LIKE', '%' . $request->search . '%')
            ->get();

            $stt = 0;

            if ($accounts) {
                foreach ($accounts as $key => $tk) {
                    $output .= '<tr>
                        <td>' . ++$stt . '</td>
                        <td>' . $tk->email . '</td>
                        <td><img src=" '.asset("/imageUsers/$tk->hinh_anh").'"
                        style="width: 100px;"></td>
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
