<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanGaji extends Model
{
    use HasFactory;
    protected $table = "pengajuan_gaji";
    protected $guarded = ['id'];
}
