<?php

namespace App\Http\Controllers;

use App\Models\SanPham;
use App\Http\Controllers\Controller;
use App\Models\LoaiSanPham;
use Illuminate\Support\Facades\DB;

class APILoaiSanPhamController extends Controller
{
    # Lấy ds loại sản phẩm 
    function layDanhSachLoaiSP()
    {
        $danhsach = LoaiSanPham::all();
        return response($danhsach, 200);
    }
}
