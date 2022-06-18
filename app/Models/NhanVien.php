<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhanVien extends Model
{
    use HasFactory;
    protected $fillable = [
        'ten_nhan_vien',
        'dia_chi',
        'ngay_sinh',
        'sdt',
        'ho_ten',
        'CCCD',
        'luong',
        'thuong_thang',
        'noi_lam_id',
        'chuc_vu_id',
        'trang_thai',
    ];
}
