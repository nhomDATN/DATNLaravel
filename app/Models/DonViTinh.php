<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonViTinh extends Model
{
    use HasFactory;
    protected $fillable = [
        'ten_don_vi_tinh',
        'trang_thai',
    ];
}
