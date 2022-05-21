<?php

namespace App\Http\Controllers;

use App\Models\SanPham;
use App\Http\Controllers\Controller;
use App\Models\ChiTietSanPham;
use App\Models\LoaiSanPham;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class APISanPhamController extends Controller
{
    function layChiTietSanPham(ChiTietSanPham $chiTietSanPham)
    {
        $danhSach = SanPham::join('chi_tiet_san_phams', 'chi_tiet_san_phams.san_pham_id', '=', 'san_phams.id')
            ->join('hinh_anhs', 'hinh_anhs.chi_tiet_san_pham_id', '=', 'chi_tiet_san_phams.id')
            ->join('thuong_hieus', 'thuong_hieus.id', '=', 'san_phams.thuong_hieu_id')
            ->select('chi_tiet_san_phams.id','san_phams.ten_san_pham','san_phams.gia','san_phams.mo_ta','thuong_hieus.ten_thuong_hieu', 'hinh_anhs.hinh_anh',)
            ->where('hinh_anhs.hinh_dai_dien', '=', 0)
            ->where('hinh_anhs.chi_tiet_san_pham_id', '=', $chiTietSanPham->id)
            ->get();
        return response()->json($danhSach, 200);
    }
    # Lấy ds  sản phẩm 
    function layDanhSach()
    {
        $danhSach = SanPham::join('chi_tiet_san_phams', 'chi_tiet_san_phams.san_pham_id', '=', 'san_phams.id')
            ->join('hinh_anhs', 'hinh_anhs.chi_tiet_san_pham_id', '=', 'chi_tiet_san_phams.id')
            ->join('thuong_hieus', 'thuong_hieus.id', '=', 'san_phams.thuong_hieu_id')
            ->select('chi_tiet_san_phams.id','san_phams.ten_san_pham','san_phams.mo_ta','san_phams.gia','san_phams.loai_san_pham_id','san_phams.thuong_hieu_id','thuong_hieus.ten_thuong_hieu', 'hinh_anhs.hinh_anh')
            ->where('hinh_anhs.hinh_dai_dien', '=', 1)
            ->get();
        return response()->json($danhSach, 200);
    }
    function layDanhSachSanPhamRecom()
    {
        $danhSach =  SanPham::join('chi_tiet_san_phams', 'chi_tiet_san_phams.san_pham_id', '=', 'san_phams.id')
            ->join('hinh_anhs', 'hinh_anhs.chi_tiet_san_pham_id', '=', 'chi_tiet_san_phams.id')
            ->join('thuong_hieus', 'thuong_hieus.id', '=', 'san_phams.thuong_hieu_id')
            ->select('chi_tiet_san_phams.id','san_phams.ten_san_pham','san_phams.mo_ta','san_phams.gia','san_phams.loai_san_pham_id','san_phams.thuong_hieu_id','thuong_hieus.ten_thuong_hieu', 'hinh_anhs.hinh_anh')
            ->where('chi_tiet_san_phams.so_luong', '>=', 50)
            ->where('hinh_anhs.hinh_dai_dien', '=', 1)
            ->get();
        return response()->json($danhSach, 200);
    }
    function layDanhSachSanPhamFea()
    {
        $danhSach =  SanPham::join('chi_tiet_san_phams', 'chi_tiet_san_phams.san_pham_id', '=', 'san_phams.id')
            ->join('hinh_anhs', 'hinh_anhs.chi_tiet_san_pham_id', '=', 'chi_tiet_san_phams.id')
            ->join('thuong_hieus', 'thuong_hieus.id', '=', 'san_phams.thuong_hieu_id')
            ->select('chi_tiet_san_phams.id','san_phams.ten_san_pham','san_phams.mo_ta','san_phams.gia','san_phams.loai_san_pham_id','san_phams.thuong_hieu_id','thuong_hieus.ten_thuong_hieu', 'hinh_anhs.hinh_anh')
            ->where('san_phams.loai_san_pham_id', '=', 4)
            ->where('hinh_anhs.hinh_dai_dien', '=', 1)
            ->get();
        return response()->json($danhSach, 200);
    }
    function layDanhSachSanPhamNew()
    {
        $danhSach =  SanPham::join('chi_tiet_san_phams', 'chi_tiet_san_phams.san_pham_id', '=', 'san_phams.id')
            ->join('hinh_anhs', 'hinh_anhs.chi_tiet_san_pham_id', '=', 'chi_tiet_san_phams.id')
            ->join('thuong_hieus', 'thuong_hieus.id', '=', 'san_phams.thuong_hieu_id')
            ->select('chi_tiet_san_phams.id','san_phams.ten_san_pham','san_phams.mo_ta','san_phams.gia','san_phams.loai_san_pham_id','san_phams.thuong_hieu_id','san_phams.created_at','thuong_hieus.ten_thuong_hieu', 'hinh_anhs.hinh_anh')
            ->where('hinh_anhs.hinh_dai_dien', '=', 1)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        return response()->json($danhSach, 200);
    }

    function layDanhSachTheoLoai(LoaiSanPham $loaiSanPham)
    {
        $danhSach = SanPham::join('chi_tiet_san_phams', 'chi_tiet_san_phams.san_pham_id', '=', 'san_phams.id')
        ->join('hinh_anhs', 'hinh_anhs.chi_tiet_san_pham_id', '=', 'chi_tiet_san_phams.id')
        ->join('thuong_hieus', 'thuong_hieus.id', '=', 'san_phams.thuong_hieu_id')
        ->select('chi_tiet_san_phams.id','san_phams.ten_san_pham','san_phams.mo_ta','san_phams.gia','san_phams.loai_san_pham_id','san_phams.thuong_hieu_id','san_phams.created_at','thuong_hieus.ten_thuong_hieu', 'hinh_anhs.hinh_anh')
        ->where('hinh_anhs.hinh_dai_dien', '=', 1)
        ->where('loai_san_pham_id', $loaiSanPham->id)
        ->get();
        return response()->json($danhSach, 200);
    }

    function search(Request $request){
        $idLSP = $request['idLSP'];
        if($request['idLSP'] == 0)
        {
            $idLSP ='';
        }
        $sanPham = SanPham::join('chi_tiet_san_phams', 'chi_tiet_san_phams.san_pham_id', '=', 'san_phams.id')
        ->join('hinh_anhs', 'hinh_anhs.chi_tiet_san_pham_id', '=', 'chi_tiet_san_phams.id')
        ->join('thuong_hieus', 'thuong_hieus.id', '=', 'san_phams.thuong_hieu_id')
        ->select('chi_tiet_san_phams.id','san_phams.ten_san_pham','san_phams.mo_ta','san_phams.gia','san_phams.loai_san_pham_id','san_phams.thuong_hieu_id','thuong_hieus.ten_thuong_hieu', 'hinh_anhs.hinh_anh')
        ->where('hinh_anhs.hinh_dai_dien', '=', 1)
        ->where('ten_san_pham','LIKE','%'.$request['query'].'%')
        ->where('san_phams.loai_san_pham_id','LIKE','%'.$idLSP.'%')
        ->get();
        return response()->json($sanPham, 200);
    }

}
