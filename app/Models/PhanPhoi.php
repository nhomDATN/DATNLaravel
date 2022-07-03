<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhanPhoi extends Model
{
    use HasFactory;
    protected $fillable = [
        'ma_phan_phoi_id',
        'nguyen_lieu_id',
        'so_luong',
    ];
}
