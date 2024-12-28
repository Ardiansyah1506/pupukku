<?php

namespace App\Http\Controllers;

use App\Models\LaporanPengiriman;
use App\Models\PekerjaanAktif;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function index(){
        $data = LaporanPengiriman::select(
            'laporan_pengiriman.id AS id_laporan',
            'laporan_pengiriman.uang_makan',
            'laporan_pengiriman.uang_tol',
            'laporan_pengiriman.uang_bensin',
            'laporan_pengiriman.file',
            'laporan_pengiriman.created_at', // Tambahkan created_at
            'pekerjaan.lokasi',
            'users.username',
            'pekerjaan_aktif.id_pekerjaan'
        )
        ->join('pekerjaan_aktif', 'laporan_pengiriman.id_pekerjaan', '=', 'pekerjaan_aktif.id')
        ->join('pekerjaan', 'pekerjaan_aktif.id_pekerjaan', '=', 'pekerjaan.id')
        ->join('users', 'users.id', '=', 'pekerjaan_aktif.id_user')
        ->get();
    

        return view('owner.riwayat_pengiriman.index',compact('data'));
    }

    public function daftarKaryawan(){
        $data = User::leftJoin('pekerjaan_aktif', 'pekerjaan_aktif.id_user', '=', 'users.id')
        ->select(
            'users.id',
            'users.username',
            \DB::raw('MAX(pekerjaan_aktif.status) AS status'),
            \DB::raw('(SELECT id FROM pekerjaan_aktif WHERE pekerjaan_aktif.id_user = users.id AND pekerjaan_aktif.status = 1 LIMIT 1) AS pekerjaan_aktif_id')
        )
        ->groupBy('users.id', 'users.username')
        ->get();

        return view('owner.daftar-karyawan.index',compact('data'));
    
    }

    public function showDetailKaryawan($id)
{
    $karyawan = PekerjaanAktif::select(
        'pekerjaan_aktif.*',
        'pekerjaan.lokasi AS tujuan',
        'pekerjaan.total_karung',
        'pekerjaan.kendaraan',
    )
    ->join('pekerjaan', 'pekerjaan_aktif.id_pekerjaan', '=', 'pekerjaan.id')
    ->where('pekerjaan_aktif.id', $id)
    ->first();

    if (!$karyawan) {
        return response()->json(['error' => 'Data tidak ditemukan'], 404);
    }

    return response()->json($karyawan);
}

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_pekerjaan' => 'required|numeric',
            'makan' => 'required|numeric|min:0',
            'bensin' => 'required|numeric|min:0',
            'tol' => 'required|numeric|min:0',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi image
        ]);
        $idPekerjaan = $request->id_pekerjaan;

        $idUser = Auth::user()->id;

        if ($request->hasFile('file')) {
            $imagePath = $request->file('file')->store('styles/images/bukti_pengiriman', 'public'); // Simpan ke folder
            $fileName = $request->file->getClientOriginalName(); // Ambil nama asli file
        } else {
            return back()->withErrors(['file' => 'File harus berupa gambar.']);
        }

        // Simpan data ke database (contoh)
        LaporanPengiriman::create([
            'uang_makan' => $request->makan,
            'uang_bensin' => $request->bensin,
            'uang_tol' => $request->tol,
            'file' => $request->fileName,
            'id_pekerjaan' => $idPekerjaan,
            'id_user' => $idUser,
        ]);

        // Redirect ke halaman sukses
        return redirect()->route('pekerjaanAktif.index')->with('success', 'Laporan berhasil disimpan.');
    }

    public function show($id)
{
    $laporan = LaporanPengiriman::find($id);

    if (!$laporan) {
        return response()->json(['error' => 'Laporan tidak ditemukan'], 404);
    }

    // Format data yang akan dikirim ke AJAX
    return response()->json([
        'totalPupukTerjual' => $laporan->total_pupuk,
        'uangMakan' => $laporan->uang_makan,
        'uangBensin' => $laporan->uang_bensin,
        'uangTol' => $laporan->uang_tol,
        'file' => $laporan->file,
        // 'upahSupir' => $laporan->upah_supir,
    ]);
}
}
