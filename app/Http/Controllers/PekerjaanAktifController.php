<?php

namespace App\Http\Controllers;

use App\Models\PekerjaanAktif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PekerjaanAktifController extends Controller
{
    public function index()
    {
        $idUser = Auth::user()->id;
         $data = PekerjaanAktif::where('id_user',$idUser)->where('pekerjaan_aktif.status',0)->join('pekerjaan','pekerjaan.id','pekerjaan_aktif.id_pekerjaan')->paginate(5);
       
        return view('karyawan.pekerjaan_aktif.index',compact('data'));
    }
}
