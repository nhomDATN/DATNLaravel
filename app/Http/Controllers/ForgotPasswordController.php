<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MyMail;
use App\Models\TaiKhoan;

class ForgotPasswordController extends Controller
{
    //
    public function sendMailRecover(Request $request)
    {
       
        $kiemtra = TaiKhoan::where('email',$request->input('email'))->first();
        if(!empty($kiemtra))
        {
            $details = [
                'title' => 'Password Recovery Mail from 3TFashion',
                'body' => 'Click link to recover password: http://127.0.0.1:8001/recover?token='.$kiemtra->token,
            ];
            Mail::to($request->input('email'))->send(new MyMail($details));
            session()->flash('success', 'Password Recovery Mail was send to your email');
            return view('pages.forgotpassword');
        }      
        session()->flash('fail', 'Email does not exist in 3TFashion');
        return view('pages.forgotpassword');
    }
}
