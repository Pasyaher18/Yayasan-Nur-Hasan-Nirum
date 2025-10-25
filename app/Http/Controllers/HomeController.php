<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Program;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('home');
    }

    // 🏠 Halaman utama (frontend)
    public function home()
    {
        // Hanya ambil program yang aktif (tidak di-hide)
        $programs = Program::where('is_visible', true)->latest()->get();

        return view('welcome', compact('programs'));
    }

    // 📊 Dashboard admin (hanya login)
    public function index()
    {
        $programs = Program::all();
        return view('admin.dashboard', compact('programs'));
    }
}
