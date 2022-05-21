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
        $taiKhoan = TaiKhoan::where('token', $request->input('token'))->first();
        $validatedData = $request->validate([
            'password' => 'required|min:6',
        ]);
        if (!empty($taiKhoan)) {
            if ($request->input('password') == $request->input('confirmpassword')) {
                TaiKhoan::where('token', $request->input('token'))->update(['password'=>bcrypt($request->input('password')),'token'=>Str::random(60)]);
                return view('pages.success_recover');
            }
            else
            {
                session()->flash('fail', 'Password not join');
                return view('pages.recoverpassword',['token'=> $request->input('token')]);
            }
        }
        else
        {
            session()->flash('fail', 'This link was used');
            return view('pages.recoverpassword',['token'=> $request->input('token')]);
        }     
    }
}
