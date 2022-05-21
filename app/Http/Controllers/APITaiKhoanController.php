<?php

namespace App\Http\Controllers;

use App\Models\TaiKhoan;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Mail\MyMail;
use Illuminate\Support\Facades\Mail;

class APITaiKhoanController extends Controller
{
    # Lấy ds  sản phẩm 
    function dangNhap(Request $request)
    {
        $taiKhoan = [];
        if (Auth::attempt(['email' => $request['email'], 'password' => $request['matKhau']])) {
            $taiKhoan = TaiKhoan::where('email', $request['email'])->first();
            return response()->json($taiKhoan, 200);
        }

        //nguoc lai du lieu rong~ thi tra ve status 404
        return response()->json($taiKhoan, 404);
    }

    function dangKy(Request $request)
    {
        $tonTai = TaiKhoan::where('email', $request['email'])->first();
        if (empty($tonTai)) {
            $taiKhoan = TaiKhoan::insert([
                'email' => $request['email'],
                'hoten' => $request['hoTen'],
                'password' => bcrypt($request['matKhau']),
                'ngaysinh' => Carbon::now('Asia/Ho_Chi_Minh'),
                'diachi' => '',
                'sdt' => '',
                'loai_tai_khoan_id' => 2,
                'token' => Str::random(60),
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'updated_at' => null,
            ]);
            if ($taiKhoan != null) {
                return response()->json($taiKhoan, 200);
            }
        }
        return response()->json('', 404);
    }

    function layLaiMatKhau(Request $request)
    {
        $kiemtra = TaiKhoan::where('email', $request->input('email'))->first();
        if (!empty($kiemtra)) {
            $details = [
                'title' => 'Password Recovery Mail from 3TFashion',
                'body' => 'Click link to recover password: http://127.0.0.1:8001/recover?token=' . $kiemtra->token,
            ];
            Mail::to($request->input('email'))->send(new MyMail($details));
            return response()->json($kiemtra, 200);
        }
        return response()->json($kiemtra, 404);
    }

    function layIDTaiKhoan(Request $request)
    {
        $taiKhoan = TaiKhoan::where('email', $request['email'])->first();
        return response()->json($taiKhoan, 200);
    }

    function layThongTinTaiKhoan(Request $request)
    {
        $taiKhoan = TaiKhoan::where('id', $request['id'])->first();
        return response()->json($taiKhoan, 200);
    }

    function doiMatKhau(Request $request)
    {
        $taiKhoan = [];
        if (Auth::attempt(['email' => $request['email'], 'password' => $request['matKhau']])) {
            $taiKhoan = TaiKhoan::where('email', $request['email'])->first();
            $taiKhoan->fill([
                'password' => bcrypt($request['matKhauMoi']),
            ]);
            $taiKhoan->save();
            return response()->json($taiKhoan, 200);
        }
        return response()->json($taiKhoan, 404);
    }

    function capNhatTaiKhoan(Request $request)
    {
        $taiKhoan = [];
        $taiKhoan = TaiKhoan::where('email', $request['email'])->first();
        $taiKhoan->fill([
            'hoten' => $request['hoTen'],
            'ngaysinh' => $request['ngaySinh'],
            'diachi' => $request['diaChi'],
            'sdt' => $request['sdt'],
        ]);
        $taiKhoan->save();
        return response()->json($taiKhoan, 200);
    }

    function dangNhapBangSocial(Request $request)
    {
        $taiKhoan = TaiKhoan::where('email', $request['email'])->where('loai_tai_khoan_id', 1)->orwhere('email', $request['email'])->where('loai_tai_khoan_id', 2)->first();
        if (empty($taiKhoan)) {
            $taiKhoan = TaiKhoan::where('email', $request['email'])->where('loai_tai_khoan_id', 3)->orwhere('email', $request['email'])->where('loai_tai_khoan_id', 4)->first();
            if (empty($taiKhoan)) {
                $taiKhoan = TaiKhoan::insert([
                    'email' => $request['email'],
                    'hoten' => $request['name'],
                    'password' => bcrypt(Str::random(50)),
                    'ngaysinh' => Carbon::now('Asia/Ho_Chi_Minh'),
                    'diachi' => '',
                    'sdt' => '',
                    'loai_tai_khoan_id' => $request['loai'],
                    'token' => Str::random(60),
                    'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                    'updated_at' => null,
                ]);
                if ($taiKhoan == true) {
                    $taiKhoan = TaiKhoan::where('email', $request['email'])->where('loai_tai_khoan_id', $request['loai'])->first();
                    return response()->json($taiKhoan, 200);
                }
                return response()->json($taiKhoan, 404);
            }
            else if($request['loai'] !=$taiKhoan->loai_tai_khoan_id)
            {
                    return response()->json($taiKhoan, 404);
            }
            return response()->json($taiKhoan, 200);         
        }
        return response()->json($taiKhoan, 404);
    }
}
