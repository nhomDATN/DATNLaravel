<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NguyenLieu extends Model
{
    use HasFactory;
    protected $fillable = [
        'ten_nguyen_lieu',
        'don_gia',
        'so_luong',
        'don_vi_tinh_id',
        'kho_id',
        'trang_thai',
    ];
}
