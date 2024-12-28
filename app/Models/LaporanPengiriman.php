<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPengiriman extends Model
{
    use HasFactory;

    protected $table = 'laporan_pengiriman';
    protected $guarded = ['id'];
}
