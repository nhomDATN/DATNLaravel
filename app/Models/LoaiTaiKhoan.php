<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoaiTaiKhoan extends Model
{
    use HasFactory;
    protected $fillable = [
        'ten_loai_tai_khoan',
        'trang_thai',
    ];
}
