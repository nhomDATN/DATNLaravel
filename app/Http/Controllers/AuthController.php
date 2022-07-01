<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TaiKhoanController;
use App\Models\TaiKhoan;
use Illuminate\Support\Facades\Session;
class AuthController extends Controller
{
    //
    public function showLogin(){
        return view('admin.pages.login');
    }
    public function authenticate(Request $request)
    { 
        $account = TaiKhoan::where('email', $request->email)->where('loai_tai_khoan_id',1)->get();
        //dd($request);
        if(count($account) > 0)
        {
            $request->session()->regenerate();
            if(!password_verify($request->password,$account[0]->mat_khau))
          {
            return back()->withErrors([
                'password' => 'Password không đúng!',
            ]);
          }
            Session::put('AdminId',$account[0]->id);
            return redirect()->route('homeadmin');
        }
         
         return back()->withErrors([
            'email' => 'Email không tồn tại',
        ]);
    }
    public function logout(){
        Auth::logout();
        Session::forget('AdminId');
        return redirect('login');
    }
}
