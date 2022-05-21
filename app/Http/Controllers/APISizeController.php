<?php

namespace App\Http\Controllers;

use App\Models\SanPham;
use App\Http\Controllers\Controller;
use App\Models\ChiTietSanPham;
use App\Models\Size;

class APISizeController extends Controller
{

    function laySize(ChiTietSanPham $chiTietSanPham)
    {
        $loaiid = SanPham::join('chi_tiet_san_phams', 'chi_tiet_san_phams.san_pham_id', '=', 'san_phams.id')
            ->select('san_phams.loai_san_pham_id')
            ->where('chi_tiet_san_phams.id', $chiTietSanPham->id)
            ->first();
        if ($loaiid->loai_san_pham_id == 4) {
            $danhsach = Size::where('id', '>', '6')->select('id', 'ten_size')->get();
        } else {
            $danhsach = Size::where('id', '<', '7')->select('id', 'ten_size')->get();
        }
        return response()->json($danhsach, 200);
    }
}
