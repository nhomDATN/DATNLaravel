<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\TaiKhoan;

class RecoverPasswordController extends Controller
{
    //
    public function recoverPassword(Request $request)
    {
        $taiKhoan = TaiKhoan::where('verify_token', $request->input('token'))->first();
        $validatedData = $request->validate([
            'password' => 'required|min:6',
        ]);
        if (!empty($taiKhoan)) {
            if ($request->input('password') == $request->input('confirmpassword')) {
                TaiKhoan::where('verify_token', $request->input('token'))->update(['mat_khau'=>bcrypt($request->input('password')),'verify_token'=>'']);
                return view('admin.pages.success_recover');
            }
            else
            {
                session()->flash('fail', 'Mật khẩu không hợp lệ');
                return view('admin.pages.recoverpassword',['token'=> $request->input('token')]);
            }
        }
        else
        {
            session()->flash('fail', 'Đường dẫn đã được sử dụng');
            return view('admin.pages.recoverpassword',['token'=> $request->input('token')]);
        }     
    }
}
