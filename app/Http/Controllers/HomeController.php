<?php

namespace App\Http\Controllers;

use App\Models\ChiTietSanPham;
use App\Models\HoaDon;
use App\Models\SanPham;
use App\Models\TaiKhoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $donhangmoi = HoaDon::where('trang_thai', '0')->count();
        $taikhoankhachhang = TaiKhoan::where('loai_tai_khoan_id', '2')->count();
        $soluong = HoaDon::join('chi_tiet_hoa_dons', 'chi_tiet_hoa_dons.hoa_don_id', '=', 'hoa_dons.id')
            ->join('san_phams', 'san_phams.id', '=', 'chi_tiet_hoa_dons.san_pham_id')
            ->where('hoa_dons.trang_thai', '=', 3)
            ->select('chi_tiet_hoa_dons.so_luong')
            ->get();
        $gia = HoaDon::join('chi_tiet_hoa_dons', 'chi_tiet_hoa_dons.hoa_don_id', '=', 'hoa_dons.id')
            ->join('san_phams', 'san_phams.id', '=', 'chi_tiet_hoa_dons.san_pham_id')
            ->where('hoa_dons.trang_thai', '=', 3)
            ->select('san_phams.gia')
            ->get();
        $tongdoanhthu = 0;
        for ($i = 0; $i < count($gia); $i++) {
            $tongdoanhthu = $tongdoanhthu + $gia[$i]->gia * $soluong[$i]->so_luong;
        }
        $doanhthutungthang = HoaDon::join('chi_tiet_hoa_dons', 'chi_tiet_hoa_dons.hoa_don_id', '=', 'hoa_dons.id')
        ->whereYear('hoa_dons.created_at', '=', now()->year)
        ->where('trang_thai', '=', 3)
        ->select(DB::raw("MONTH(hoa_dons.created_at) month"), DB::raw('sum(chi_tiet_hoa_dons.so_luong * chi_tiet_hoa_dons.gia) doanhthu'))
        ->groupBy('month')
        ->get();
        
        return view('admin/pages.home', ['donhangmoi' => $donhangmoi, 'taikhoankhachhang' => $taikhoankhachhang, 'tongdoanhthu' => $tongdoanhthu, 'doanhthutungthang' => $doanhthutungthang]);
    }
}
