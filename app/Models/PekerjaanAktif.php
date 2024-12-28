<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PekerjaanAktif extends Model
{
    use HasFactory;

    protected $table = 'pekerjaan_aktif';
    protected $guarded = ['id'];
}
