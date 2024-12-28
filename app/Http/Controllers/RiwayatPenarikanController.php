<?php

namespace App\Http\Controllers;

use App\Models\DaftarGaji;
use App\Models\PengajuanGaji;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatPenarikanController extends Controller
{
    public function index(){
        $idUser = Auth::user()->id;
        $dataGaji = DaftarGaji::where('id_user', $idUser)->first();
        $data = PengajuanGaji::where('id_daftar_gaji', $dataGaji->id)->get();

        
        return view('karyawan.riwayat_penarikan.index',compact('data'));
    }
    public function DaftarGaji(){
        $data = PengajuanGaji::get();

        
        return view('owner.daftar-gaji.index',compact('data'));
    }

    public function show($id)
    {
        $laporan = PengajuanGaji::find($id);
    
        if (!$laporan) {
            return response()->json(['error' => 'Laporan tidak ditemukan'], 404);
        }
    
        // Format data yang akan dikirim ke AJAX
        return response()->json([
            'file' => $laporan->file,
            'nama' => $laporan->nama,
            'bank' => $laporan->bank,
            'norek' => $laporan->no_rekening,
            'gaji' => $laporan->total_pengajuan,
            // 'upahSupir' => $laporan->upah_supir,
        ]);
    }
}
