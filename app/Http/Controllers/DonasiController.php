<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DonasiController extends Controller
{
    // Halaman utama donasi
    public function index()
    {
        return view('donasi');
    }

    // Menangani form donasi (sementara hanya tampilkan data)
    public function store(Request $request)
    {
        $data = $request->all();

        // Nanti di sini bisa ditambahkan logic simpan ke database
        return back()->with('success', 'Terima kasih atas donasinya!');
    }
}
