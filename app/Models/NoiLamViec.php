<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoiLamViec extends Model
{
    use HasFactory;
    protected $fillable = [
        'ma_noi_lam_viec',
        'dia_chi',
        'trang_thai',
    ];
   
}
