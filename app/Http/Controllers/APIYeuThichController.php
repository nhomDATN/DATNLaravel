<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\YeuThich;
use Illuminate\Http\Request;
use Carbon\Carbon;

class APIYeuThichController extends Controller
{
    function themHoacXoaYeuThich(Request $request)
    {
        $yeuThich = YeuThich::where('tai_khoan_id',$request['taiKhoanID'])
        ->where('chi_tiet_san_pham_id',$request['chiTietSanPhamID'])
        ->first();
        if(empty($yeuThich)){
            $yeuThich = YeuThich::insert([
                'tai_khoan_id'=>$request['taiKhoanID'],
                'chi_tiet_san_pham_id'=>$request['chiTietSanPhamID'],
                'trang_thai'=> 1,
                'created_at'=> Carbon::now('Asia/Ho_Chi_Minh')
            ]);
            return response()->json($yeuThich, 200);
        }
        else{
            if($yeuThich->trang_thai == 1){
                $yeuThich->fill([
                    'trang_thai'=>0,
                ]);
                $yeuThich->save();
                return response()->json($yeuThich, 200);
            }
            $yeuThich->fill([
                'trang_thai'=>1,
            ]);
            $yeuThich->save();
            return response()->json($yeuThich, 200);
        }
    }
    
    function layTrangThai(Request $request){
        $trangThai = YeuThich::where('tai_khoan_id',$request['taiKhoanID'])
        ->where('chi_tiet_san_pham_id',$request['chiTietSanPhamID'])
        ->select('trang_thai')
        ->first();
        if(empty($trangThai))
        {
            return response()->json(0, 200);
        }
        $temp =$trangThai->trang_thai;
        return response()->json($temp, 200);
    }

    function layDanhSachYeuThich(Request $request){
        $danhSach = YeuThich::join('chi_tiet_san_phams', 'chi_tiet_san_phams.id', '=', 'yeu_thiches.chi_tiet_san_pham_id')
        ->join('san_phams', 'san_phams.id', '=', 'chi_tiet_san_phams.san_pham_id')
        ->join('thuong_hieus', 'thuong_hieus.id', '=', 'san_phams.thuong_hieu_id')
        ->join('hinh_anhs', 'hinh_anhs.chi_tiet_san_pham_id', '=', 'chi_tiet_san_phams.id')
        ->where('hinh_anhs.hinh_dai_dien', '=', 1)
        ->where('yeu_thiches.tai_khoan_id', $request['taiKhoanID'])
        ->where('yeu_thiches.trang_thai', '=', 1)
        ->select('yeu_thiches.id','yeu_thiches.chi_tiet_san_pham_id','san_phams.ten_san_pham', 'san_phams.gia','thuong_hieus.ten_thuong_hieu','hinh_anhs.hinh_anh','yeu_thiches.trang_thai')
        ->get();
        return response()->json($danhSach, 200);
    }

    function xoaYeuThich(Request $request){
        $yeuThich = YeuThich::where('id',$request['id'])->first();
        $yeuThich->fill([
            'trang_thai'=>0,
        ]);
        $yeuThich->save();
        return response()->json($yeuThich, 200);
    }
}