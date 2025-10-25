<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('admin.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'nullable|min:6|confirmed',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Update data dasar
        $user->name = $request->name;
        $user->email = $request->email;

        // Ganti password kalau diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Upload foto baru kalau ada
        if ($request->hasFile('photo')) {
            // Hapus foto lama
            if ($user->photo && Storage::exists('public/' . $user->photo)) {
                Storage::delete('public/' . $user->photo);
            }

            // Simpan foto baru
            $path = $request->file('photo')->store('profiles', 'public');
            $user->photo = $path;
        }

        $user->save();

        // 🔁 Redirect langsung ke dashboard setelah update
        return redirect('/admin/dashboard')->with('success', 'Profil berhasil diperbarui!');
    }
}
