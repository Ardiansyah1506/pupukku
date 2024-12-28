<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $data = User::where('role','!=','owner')->get();
        return view('owner.user.index',compact('data'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string|unique:users|max:255',
            'password' => 'required|string|min:6',
        ]);

        // Simpan data user
        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'pegawai',
        ]);

        // Redirect ke halaman login setelah sukses registrasi
        return redirect()->route('user.index')->with('success', 'Berhasil Menambahkan Akun Pegawai.');
    }
}
