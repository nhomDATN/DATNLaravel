<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhGia extends Model
{
    use HasFactory;
    protected $fillable = [
        'yeu_thich',
        'so_sao',
        'tai_khoan_id',
        'san_pham_id',
        'trang_thai',
    ];
}
