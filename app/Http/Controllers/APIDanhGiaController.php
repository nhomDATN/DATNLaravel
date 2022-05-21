<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ChiTietDonHang;
use App\Models\ChiTietSanPham;
use App\Models\DanhGia;
use App\Models\TaiKhoan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class APIDanhGiaController extends Controller
{
    function layDanhSachChuaDanhGia(Request $request)
    {
        $danhSach = TaiKhoan::join('don_hangs', 'don_hangs.tai_khoan_id', '=', 'tai_khoans.id')
            ->join('chi_tiet_don_hangs', 'chi_tiet_don_hangs.don_hang_id', '=', 'don_hangs.id')
            ->join('chi_tiet_san_phams', 'chi_tiet_san_phams.id', '=', 'chi_tiet_don_hangs.chi_tiet_san_pham_id')
            ->join('san_phams', 'san_phams.id', '=', 'chi_tiet_san_phams.san_pham_id')
            ->join('sizes', 'sizes.id', '=', 'chi_tiet_san_phams.size_id')
            ->join('thuong_hieus', 'thuong_hieus.id', '=', 'san_phams.thuong_hieu_id')
            ->where('tai_khoans.id', $request['taiKhoanID'])
            ->where('chi_tiet_don_hangs.trang_thai_danh_gia', 0)
            ->where('don_hangs.trang_thai', 3)
            ->select('chi_tiet_don_hangs.id', 'chi_tiet_don_hangs.chi_tiet_san_pham_id', 'thuong_hieus.ten_thuong_hieu', 'san_phams.ten_san_pham', 'san_phams.gia', 'sizes.ten_size')
            ->get();
        return response()->json($danhSach, 200);
    }

    function layDanhSachDaDanhGia(Request $request)
    {
        $danhSach = DB::select('select danh_gias.id,danh_gias.noi_dung,danh_gias.so_sao,danh_gias.chi_tiet_san_pham_id,thuong_hieus.ten_thuong_hieu,san_phams.ten_san_pham,san_phams.gia,sizes.ten_size from danh_gias,chi_tiet_san_phams,san_phams,thuong_hieus,sizes where danh_gias.chi_tiet_san_pham_id = chi_tiet_san_phams.id and chi_tiet_san_phams.san_pham_id = san_phams.id and san_phams.thuong_hieu_id = thuong_hieus.id and chi_tiet_san_phams.size_id = sizes.id and danh_gias.tai_khoan_id ='.$request['taiKhoanID']);
        return response()->json($danhSach, 200);
    }

    function layDanhGiaTheoSanPham(Request $request)
    {
        $idmau = ChiTietSanPham::where('id', $request['ctspID'])
            ->select('mau_id')
            ->first();
        $idsp = ChiTietSanPham::where('id', $request['ctspID'])
            ->select('san_pham_id')
            ->first();
        $danhSach = DanhGia::join('chi_tiet_san_phams', 'chi_tiet_san_phams.id', '=', 'danh_gias.chi_tiet_san_pham_id')
            ->join('sizes', 'sizes.id', '=', 'chi_tiet_san_phams.size_id')
            ->join('tai_khoans', 'tai_khoans.id', '=', 'danh_gias.tai_khoan_id')
            ->where('chi_tiet_san_phams.san_pham_id', $idsp->san_pham_id)
            ->where('chi_tiet_san_phams.mau_id', $idmau->mau_id)
            ->select('tai_khoans.email', 'danh_gias.so_sao', 'danh_gias.noi_dung', 'danh_gias.created_at', 'sizes.ten_size')
            ->get();
        return response()->json($danhSach, 200);
    }

    function trungBinhSao(Request $request)
    {
        $idmau = ChiTietSanPham::where('id', $request['ctspID'])
            ->select('mau_id')
            ->first();
        $idsp = ChiTietSanPham::where('id', $request['ctspID'])
            ->select('san_pham_id')
            ->first();
        $tb = DanhGia::join('chi_tiet_san_phams', 'chi_tiet_san_phams.id', '=', 'danh_gias.chi_tiet_san_pham_id')
            ->join('sizes', 'sizes.id', '=', 'chi_tiet_san_phams.size_id')
            ->join('tai_khoans', 'tai_khoans.id', '=', 'danh_gias.tai_khoan_id')
            ->where('chi_tiet_san_phams.san_pham_id', $idsp->san_pham_id)
            ->where('chi_tiet_san_phams.mau_id', $idmau->mau_id)
            ->avg('danh_gias.so_sao');
        if ($tb == null) {
            return response()->json(0, 200);
        }
        return response()->json($tb, 200);
    }

    function themDanhGia(Request $request)
    {
        $ctdh = ChiTietDonHang::where('id', $request['ctdhID'])->first();
        $ctdh->fill([
            'trang_thai_danh_gia' => 1
        ]);
        $ctdh->save();
        $danhGia = DanhGia::where('chi_tiet_san_pham_id', $request['ctspID'])
            ->where('danh_gias.tai_khoan_id', $request['taiKhoanID'])
            ->first();
        if (empty($danhGia)) {
            if (DanhGia::insert([
                'noi_dung' => $request['noiDung'],
                'so_sao' => $request['soSao'],
                'tai_khoan_id' => $request['taiKhoanID'],
                'chi_tiet_san_pham_id' => $request['ctspID'],
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh')
            ]) == true) {
                return response()->json(1, 200);
            }
            return response()->json(0, 404);
        } else {
            $danhGia->fill([
                'noi_dung' => $request['noiDung'],
                'so_sao' => $request['soSao'],
            ]);
            $danhGia->save();
            return response()->json(1, 200);
        }
    }
}
