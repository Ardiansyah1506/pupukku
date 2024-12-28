<?php

namespace App\Http\Controllers;

use App\Models\Pekerjaan;
use App\Models\PekerjaanAktif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PekerjaanController extends Controller
{
    public function index()
    {
        return view('owner.tambah-pekerjaan.index');
    }

    public function DaftarPekerjaanBaru(){
        $data = Pekerjaan::where('status',0)->get();
        return view('karyawan.pekerjaan_baru.index',compact('data'));
    }

    public function ambilPekerjaan(Request $request)
    {
        $request->validate([
            'id' => 'required|integer'
        ]);
        $idUser = Auth::user()->id;

        try {
            $pekerjaanId = $request->input('id');

            // Contoh proses: Update status pekerjaan berdasarkan ID
            Pekerjaan::findOrFail($pekerjaanId)->update(['status' => 1]);
            PekerjaanAktif::create([
                'id_pekerjaan' => $pekerjaanId,
                'id_user' => $idUser,
            ]);
            return response()->json(['success' => true, 'message' => 'Pekerjaan berhasil diambil']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'kendaraan' => 'required|string|max:255',
            'no_pol' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'tanggal' => 'required|date', // Pastikan formatnya tanggal
            'total_karung' => 'required|integer',
        ]);

        Pekerjaan::create([
            'kendaraan' => $request->kendaraan,
            'no_pol' => $request->no_pol,
            'alamat' => $request->alamat,
            'lokasi' => $request->lokasi,
            'tanggal' => $request->tanggal,
            'total_karung' => $request->total_karung,
            'created_at' => $request->tanggal, // Isi created_at dengan input tanggal
        ]);

        return redirect()->route('pekerjaan.index')->with('success', 'Photo uploaded successfully.');
    }
}
