<?php

namespace App\Http\Controllers;

use App\Models\LoaiTaiKhoan;
use App\Models\TaiKhoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LoaiTaiKhoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lstltk = LoaiTaiKhoan::where('id', '!=', 1)->get();
        return view('admin/pages.account_type', ['lstltk' => $lstltk]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/add.add_account_type');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLoaiTaiKhoanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->input('tenloaitaikhoan') == null) {
            $alert = 'Tên loại tài khoản không được bỏ trống';
            return redirect()->back()->with('alert', $alert);
        }

        $loaitaikhoanformat=trim($request->input('tenloaitaikhoan')); 
        $tontai = LoaiTaiKhoan::where('ten_loai_tai_khoan','like', $loaitaikhoanformat)->first(); 
        
        if(empty($tontai)){
            $kt_loaitaikhoan=str_replace(' ', '', $loaitaikhoanformat);
            $tontai = LoaiTaiKhoan::where('ten_loai_tai_khoan','like', $kt_loaitaikhoan)->first();
            if(empty($tontai))
            {
                $loaiTaiKhoan = new LoaiTaiKhoan;
                $loaiTaiKhoan->fill([
                    'ten_loai_tai_khoan' => $loaitaikhoanformat,
                ]);
                $loaiTaiKhoan->save();
                return Redirect::route('loaiTaiKhoan.index');
            }
        }
        $alert = 'Tên loại tài khoản đã tồn tại';
        return redirect()->back()->with('alert', $alert);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LoaiTaiKhoan  $loaiTaiKhoan
     * @return \Illuminate\Http\Response
     */
    public function show(LoaiTaiKhoan $loaiTaiKhoan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LoaiTaiKhoan  $loaiTaiKhoan
     * @return \Illuminate\Http\Response
     */
    public function edit(LoaiTaiKhoan $loaiTaiKhoan)
    {
        return view('admin/edit.edit_account_type',['loaiTaiKhoan'=>$loaiTaiKhoan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLoaiTaiKhoanRequest  $request
     * @param  \App\Models\LoaiTaiKhoan  $loaiTaiKhoan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LoaiTaiKhoan $loaiTaiKhoan)
    {
        $loaitaikhoanformat = trim( $request->input('tenloaitaikhoan')); 
        $tontai = LoaiTaiKhoan::where('ten_loai_tai_khoan','like', $loaitaikhoanformat)
        ->where('loai_tai_khoans.id', '!=', $loaiTaiKhoan->id)
        ->first();
    
        if(empty($tontai)){
            $loaiTaiKhoan->fill([
                'ten_loai_tai_khoan' => $loaitaikhoanformat,
                'trang_thai' => $request->input('trangthai'),
            ]);
            $loaiTaiKhoan->save();
            return Redirect::route('loaiTaiKhoan.index');
        }
        $alert = 'Loại Tài Khoản đã tồn tại';
        return redirect()->back()->with('alert', $alert);
    }

   

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LoaiTaiKhoan  $loaiTaiKhoan
     * @return \Illuminate\Http\Response
     */
    public function destroy(LoaiTaiKhoan $loaiTaiKhoan)
    {
        //
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $accounttypes = LoaiTaiKhoan::where('id', '!=', 1)
            ->where('ten_loai_tai_khoan', 'LIKE', '%' . $request->search . '%')
            ->get();
            $stt = 0;
            if ($accounttypes) {
                foreach ($accounttypes as $key => $ltk) {
                    $output .= '<tr>
                        <td>' . ++$stt . '</td>
                        <td>' . $ltk->ten_loai_tai_khoan . '</td>';
                        if($ltk->trang_thai == 1) {
                            $output .= '<td>Hoạt Động</td>';
                        }
                        else {
                            $output .= '<td>Ngưng Hoạt Động</td>';
                        } 
                        
                        $output .= '

                        <td>' . $ltk->created_at . '</td>
                        <td>' . $ltk->updated_at . '</td>
                        <td style=";width: 20px;">
                            <a href="'.route('loaiTaiKhoan.edit', ['loaiTaiKhoan' => $ltk]).'">
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
