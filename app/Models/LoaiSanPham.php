<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoaiSanPham extends Model
{
    use HasFactory;
    protected $fillable = [
        'ten_loai_san_pham',
        'hinh_anh',
        'trang_thai',
    ];
}
