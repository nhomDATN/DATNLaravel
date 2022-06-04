<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KhuyenMai extends Model
{
    use HasFactory;
    protected $fillable = [
        'ma_khuyen_mai',
        'loai_khuyen_mai_id',
        'ngay_bat_dau',
        'ngay_ket_thuc',
        'gia_tri',
        'maximum',
        'trang_thai',
    ];
}
