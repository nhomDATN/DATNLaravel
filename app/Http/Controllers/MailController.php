<?php

namespace App\Http\Controllers;

use App\Mail\MailVerify;
use App\Mail\SendMail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mail;

class MailController extends Controller
{
    public function sendMailVerifyAccount(Request $request)
    {
        
       $email = '';
       $email = $request->EmailAddress;
       $select = DB::table('tai_khoans')->where('email',$request->EmailAddress)->get();
       $src = "http://127.0.0.1:8000/vertifyEmail/".$select[0]->id.'/'. $request->_token;
       DB::table('tai_khoans')->where('email',$email)->update(['verify_token'=>$request->_token]);
       $details = [
        'title' => 'Xác thực Email',
        'body' => 'Nhấn vào địa chỉ kế bên để xác thực tài khoản cho CKCFastFood',
        'verifiedAdrress' => $src,
       ];
       Mail::to($email)->send(new MailVerify($details));
       return view('emailVerify.reSend',['id' => $select[0]->id,'EmailAddress' => $request->EmailAddress, 'VeryfiedAddress'=>$src]);
    }
    public function verifyAccount($id,$token)
    {
        //dd($token);
        $select = DB::table('tai_khoans')->where('id',$id)->get();
        if($token == $select[0]->verify_token)
       {
            DB::update('update tai_khoans set trang_thai = 1, verify_token = "" where id = ?', [$id]);
            return view('emailVerify.confirm_veryfied');
       }
       return redirect()->route('homeuser');
    }
    public function feedback(Request $request)
    {
        $details = [
            'name' => $request->fullname,
            'title' => $request->topic,
            'body' => $request->content,
           ];
        Mail::to("ckcfood.dev@gmail.com")->send(new SendMail($details));
        return redirect()->back()->with('message',1);
    }
}
