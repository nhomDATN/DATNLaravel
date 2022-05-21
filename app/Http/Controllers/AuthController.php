<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function showLogin(){
        return view('pages.login');
    }
    public function authenticate(Request $request)
    {
        if(Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password'),'loai_tai_khoan_id' => 1]))
        {
            $request->session()->regenerate();

            return redirect()->intended('home');
        }

        return back()->withErrors([
            'email' => 'Email or password incorrect',
        ]);
    }

    public function logout(){
        Auth::logout();
        return redirect('login');
    }
}
