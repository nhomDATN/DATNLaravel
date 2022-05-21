<?php

namespace App\Http\Controllers;

use App\Models\ChiTietSanPham;
use App\Models\DonHang;
use App\Models\TaiKhoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $donhangmoi = DonHang::where('trang_thai', '0')->count();
        $taikhoankhachhang = TaiKhoan::where('loai_tai_khoan_id', '2')->count();
        $soluong = DonHang::join('chi_tiet_don_hangs', 'chi_tiet_don_hangs.don_hang_id', '=', 'don_hangs.id')
            ->join('chi_tiet_san_phams', 'chi_tiet_san_phams.id', '=', 'chi_tiet_don_hangs.chi_tiet_san_pham_id')
            ->join('san_phams', 'san_phams.id', '=', 'chi_tiet_san_phams.san_pham_id')
            ->where('don_hangs.trang_thai', '=', 3)
            ->select('chi_tiet_don_hangs.so_luong')
            ->get();
        $gia = DonHang::join('chi_tiet_don_hangs', 'chi_tiet_don_hangs.don_hang_id', '=', 'don_hangs.id')
            ->join('chi_tiet_san_phams', 'chi_tiet_san_phams.id', '=', 'chi_tiet_don_hangs.chi_tiet_san_pham_id')
            ->join('san_phams', 'san_phams.id', '=', 'chi_tiet_san_phams.san_pham_id')
            ->where('don_hangs.trang_thai', '=', 3)
            ->select('san_phams.gia')
            ->get();
        $tongdoanhthu = 0;
        for ($i = 0; $i < count($gia); $i++) {
            $tongdoanhthu = $tongdoanhthu + $gia[$i]->gia * $soluong[$i]->so_luong;
        }
        $doanhthutungthang = DonHang::join('chi_tiet_don_hangs', 'chi_tiet_don_hangs.don_hang_id', '=', 'don_hangs.id')
        ->whereYear('don_hangs.created_at', '=', now()->year)
        ->where('trang_thai', '=', 3)
        ->select(DB::raw("MONTH(don_hangs.created_at) month"), DB::raw('sum(chi_tiet_don_hangs.so_luong * chi_tiet_don_hangs.gia) doanhthu'))
        ->groupBy('month')
        ->get();
        $sanphamtonkho = ChiTietSanPham::sum('so_luong');
        return view('pages.home', ['donhangmoi' => $donhangmoi, 'taikhoankhachhang' => $taikhoankhachhang, 'tongdoanhthu' => $tongdoanhthu, 'sanphamtonkho' => $sanphamtonkho, 'doanhthutungthang' => $doanhthutungthang]);
    }
}
