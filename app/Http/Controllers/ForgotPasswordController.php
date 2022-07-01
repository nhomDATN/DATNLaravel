<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MyMail;
use App\Models\TaiKhoan;
use Illuminate\Support\Facades\DB;

class ForgotPasswordController extends Controller
{
    //
    public function sendMailRecover(Request $request)
    {
       
        $kiemtra = TaiKhoan::where('email',$request->input('email'))->first();
        DB::update('update tai_khoans set verify_token = ? where email = ?', [$request->_token,$request->input('email')]);
        if(!empty($kiemtra))
        {
            $details = [
                'title' => 'Khôi phục password CKC FastFood',
                'body' => 'Nhấn vào đường dẫn để khôi phục password: http://127.0.0.1:8000/recover?token='.$request->_token,
            ];
            Mail::to($request->input('email'))->send(new MyMail($details));
            session()->flash('success', 'Password Recovery Mail was send to your email');
            return view('admin.pages.forgotpassword');
        }      
        session()->flash('fail', 'Email không tồn tại');
        return view('admin.pages.forgotpassword');
    }
}
