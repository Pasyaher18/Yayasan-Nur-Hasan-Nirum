<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\ProfileController;

// 🚀 Redirect otomatis ke /home saat buka domain utama
Route::get('/', function () {
    return redirect('/home');
});

// 🏠 Halaman utama menampilkan program (frontend)
Route::get('/home', [HomeController::class, 'home'])->name('home');

// 💰 Halaman Donasi
Route::get('/donasi', [DonasiController::class, 'index'])->name('donasi.index');
Route::post('/donasi', [DonasiController::class, 'store'])->name('donasi.store');

// 🔑 Auth (Login & Register)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
});

// 🔒 Area admin (harus login)
Route::middleware('auth')->group(function () {

    // 📊 Dashboard admin
    Route::get('/admin/dashboard', [HomeController::class, 'index'])->name('dashboard');

    // 🔚 Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // ⚙️ CRUD Program
    Route::resource('/admin/programs', ProgramController::class);

    // 👁️‍🗨️ Fitur Hide / Unhide Program
    Route::patch('/admin/programs/{program}/toggle', [ProgramController::class, 'toggleVisibility'])
        ->name('programs.toggle');

    // 🧑‍💼 Profile Admin
    Route::get('/admin/profile', [ProfileController::class, 'index'])->name('admin.profile');
    Route::post('/admin/profile/update', [ProfileController::class, 'update'])->name('admin.profile.update');

    // 👀 Preview Program (khusus admin)
    Route::get('/admin/programs/{id}/preview', [ProgramController::class, 'preview'])->name('programs.preview');
});

// 📄 Halaman detail program (frontend)
Route::get('/program/{id}', [ProgramController::class, 'show'])->name('program.show');
