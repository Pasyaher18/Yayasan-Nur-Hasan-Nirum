<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    // Tampilkan semua data
    public function index()
    {
        $programs = Program::all();
        return view('admin.programs.index', compact('programs'));
    }

    // Tampilkan form tambah data
    public function create()
    {
        return view('admin.programs.create');
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'ikon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $gambar = null;
        if ($request->hasFile('ikon')) {
            $gambar = $request->file('ikon')->store('programs', 'public');
        }

        Program::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'ikon' => $gambar,
        ]);

        return redirect()->route('programs.index')
                         ->with('success', 'Program berhasil disimpan!');
    }

    // Edit data
    public function edit($id)
    {
        $program = Program::findOrFail($id);
        return view('admin.programs.edit', compact('program'));
    }

    // Update data
    public function update(Request $request, $id)
    {
        $program = Program::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'ikon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('ikon')) {
            $gambar = $request->file('ikon')->store('programs', 'public');
        } else {
            $gambar = $program->ikon;
        }

        $program->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'ikon' => $gambar,
        ]);

        return redirect()->route('programs.index')
                         ->with('success', 'Program berhasil diperbarui!');
    }

    // Hapus data
    public function destroy($id)
    {
        $program = Program::findOrFail($id);
        $program->delete();
        return redirect()->route('programs.index')
                         ->with('success', 'Program berhasil dihapus!');
    }
}
