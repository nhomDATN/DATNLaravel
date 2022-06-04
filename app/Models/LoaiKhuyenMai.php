<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoaiKhuyenMai extends Model
{
    use HasFactory;
    protected $fillable = [
        'ten_loai_khuyen_mai',
    ];
}
