@extends('layouts.admin')

@section('content')
<div class="container py-5" style="max-width: 1000px;">
    <!-- Judul -->
    <h2 class="text-center fw-bold mb-4 text-success">{{ $program->judul }}</h2>

    <!-- Gambar Utama -->
    <div class="text-center mb-4">
        <img src="{{ asset('storage/' . $program->ikon) }}" 
             class="img-fluid rounded shadow" 
             style="max-height: 420px; object-fit: cover; border: 3px solid #e0e0e0;">
    </div>

    <!-- Deskripsi -->
    <div class="px-md-4" style="text-align: justify; line-height: 1.9; font-size: 1.05rem; color: #333;">
        {!! nl2br(e($program->deskripsi)) !!}
    </div>

    <!-- Informasi Terakhir Diperbarui -->
    <div class="text-muted text-end mt-5">
        <em>Terakhir diperbarui: {{ $program->updated_at->translatedFormat('d F Y') }}</em>
    </div>

    <!-- Tombol Kembali -->
    <div class="text-center mt-4">
        <a href="{{ route('dashboard') }}" class="btn btn-outline-success px-4 py-2 rounded-pill shadow-sm">
            ⬅️ Kembali ke Dashboard
        </a>
    </div>
</div>
@endsection
