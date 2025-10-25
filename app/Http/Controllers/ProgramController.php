<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::all();
        return view('admin.dashboard', compact('programs'));
    }

    public function create()
    {
        return view('admin.programs.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'judul' => 'required|string|max:255',
                'deskripsi' => 'required|string',
                'ikon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $ikonPath = $request->hasFile('ikon')
                ? $request->file('ikon')->store('programs', 'public')
                : null;

            $program = Program::create([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'ikon' => $ikonPath,
                'is_visible' => true, // ✅ default tampil di publik
            ]);

            if (!$request->ajax()) {
                return redirect()->route('programs.dashboard')
                    ->with('success', 'Program berhasil disimpan!');
            }

            return response()->json([
                'success' => true,
                'program' => $program,
                'message' => 'Program berhasil disimpan!',
            ]);
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                ], 500);
            }

            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $program = Program::findOrFail($id);
        return view('admin.programs.edit', compact('program'));
    }

    public function update(Request $request, $id)
    {
        $program = Program::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'ikon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('ikon')) {
            if ($program->ikon && Storage::disk('public')->exists($program->ikon)) {
                Storage::disk('public')->delete($program->ikon);
            }

            $ikonPath = $request->file('ikon')->store('programs', 'public');
        } else {
            $ikonPath = $program->ikon;
        }

        $program->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'ikon' => $ikonPath,
        ]);

        if (!$request->ajax()) {
            return redirect()->route('programs.index')
                ->with('success', 'Program berhasil diperbarui!');
        }

        return response()->json([
            'success' => true,
            'program' => $program,
            'message' => 'Program berhasil diperbarui!',
        ]);
    }

    public function destroy($id)
    {
        $program = Program::findOrFail($id);

        if ($program->ikon && Storage::disk('public')->exists($program->ikon)) {
            Storage::disk('public')->delete($program->ikon);
        }

        $program->delete();

        return response()->json([
            'success' => true,
            'message' => 'Program berhasil dihapus!',
        ]);
    }

    public function show($id)
    {
        $program = Program::where('is_visible', true)->findOrFail($id);

        $relatedPrograms = Program::where('id', '!=', $id)
            ->where('is_visible', true)
            ->latest()
            ->take(3)
            ->get();

        return view('programs.show', compact('program', 'relatedPrograms'));
    }

    public function preview($id)
    {
        $program = Program::findOrFail($id);
        return view('admin.programs.preview', compact('program'));
    }

    public function toggleVisibility(Program $program)
{
    try {
        $program->is_visible = !$program->is_visible;
        $program->save();

        return response()->json([
            'success' => true,
            'message' => $program->is_visible
                ? 'Program berhasil ditampilkan ke publik.'
                : 'Program berhasil disembunyikan dari publik.'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
        ], 500);
    }
}

}
