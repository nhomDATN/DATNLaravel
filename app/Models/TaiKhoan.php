<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class TaiKhoan extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'ho_ten',
        'dia_chi',
        'ngay_sinh',
        'loai_tai_khoan_id',
        'trang_thai',
        'verify_token'
    ];
}
