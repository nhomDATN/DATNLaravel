<?php

namespace App\Http\Controllers;

use App\Models\LoaiTaiKhoan;
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
        $lstltk = LoaiTaiKhoan::all();
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
        $loaitaikhoanformat=trim( $request->input('tenltk')); 
        $tontai = LoaiTaiKhoan::where('ten_loai_tai_khoan','like', $loaitaikhoanformat)->first(); 
        if(empty($tontai)){
            $kt_loaitaikhoan=str_replace(' ', '', $loaitaikhoanformat);
            $tontai = LoaiTaiKhoan::where('ten_loai_tai_khoan','like',$kt_loaitaikhoan)->first();
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
        $alert = 'Account type name already in use';
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
        $loaitaikhoan = trim( $request->input('tenltk')); 
        $trangthai = $request->status;
        
        $tontai = LoaiTaiKhoan::where('ten_loai_tai_khoan','like', $loaitaikhoan)
        ->where('trang_thai', '=', $trangthai)
        ->first(); 
        if(empty($tontai)){
            $loaitaikhoanformat=str_replace(' ', '', $loaitaikhoan);
            $loaiTaiKhoan->fill([
                'ten_loai_tai_khoan' => $loaitaikhoanformat,
                'trang_thai' => $trangthai,
            ]);
            $loaiTaiKhoan->save();
            return Redirect::route('loaiTaiKhoan.index');
        }
        $alert = 'Tên loại tài khoản đã tồn tại';
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
            $accounttypes = LoaiTaiKhoan::where('ten_loai_tai_khoan', 'LIKE', '%' . $request->search . '%')
            ->get();
            if ($accounttypes) {
                foreach ($accounttypes as $key => $ltk) {
                    $output .= '<tr>
                    <td>' . $ltk->id . '</td>
                    <td>' . $ltk->ten_loai_tai_khoan . '</td>
                    <td>' . $ltk->trang_thai . '</td>
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
