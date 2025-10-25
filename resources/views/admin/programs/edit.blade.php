@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #f4f7f5;
        font-family: 'Poppins', sans-serif;
    }

    header.navbar, nav.navbar, .navbar {
        display: none !important;
    }

    .edit-container {
        max-width: 700px;
        margin: 60px auto;
        background: #ffffff;
        border-radius: 20px;
        padding: 40px 50px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(15px); }
        to { opacity: 1; transform: translateY(0); }
    }

    h2 {
        color: #1e5631;
        font-weight: 700;
        text-align: center;
        margin-bottom: 30px;
        border-bottom: 2px solid #1e5631;
        display: inline-block;
        padding-bottom: 5px;
    }

    .form-label {
        font-weight: 600;
        color: #333;
    }

    .form-control {
        border-radius: 10px;
        border: 1px solid #ccc;
        padding: 10px 14px;
        transition: border-color 0.2s;
    }

    .form-control:focus {
        border-color: #1e5631;
        box-shadow: 0 0 0 2px rgba(30, 86, 49, 0.1);
    }

    img.preview {
        display: block;
        margin-bottom: 10px;
        border-radius: 10px;
        border: 1px solid #ddd;
        max-width: 180px;
    }

    .btn {
        border-radius: 10px;
        font-weight: 600;
        padding: 10px 20px;
    }

    .btn-secondary {
        background-color: #6c757d;
        border: none;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }

    .btn-primary {
        background-color: #1e5631;
        border: none;
    }

    .btn-primary:hover {
        background-color: #184b29;
    }

    .action-buttons {
        display: flex;
        justify-content: space-between;
        margin-top: 25px;
    }
</style>

<div class="edit-container">
    <h2>Edit Program Yayasan</h2>

    <form action="{{ route('programs.update', $program->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="judul" class="form-label">Judul Program</label>
            <input type="text" name="judul" id="judul" class="form-control"
                   value="{{ old('judul', $program->judul) }}" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="5" required>{{ old('deskripsi', $program->deskripsi) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="ikon" class="form-label">Ikon / Gambar</label><br>

            {{-- ✅ tampilkan gambar lama --}}
            @if($program->ikon)
                <img id="preview" src="{{ asset('storage/'.$program->ikon) }}" alt="Gambar Lama" class="preview">
            @else
                <img id="preview" src="https://via.placeholder.com/150?text=Tidak+Ada+Gambar" class="preview">
            @endif

            {{-- ✅ input file --}}
            <input type="file" name="ikon" id="ikon" class="form-control mt-2" accept="image/*">
        </div>

        <div class="action-buttons">
            <a href="{{ route('programs.index') }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">💾 Simpan Perubahan</button>
        </div>
    </form>
</div>

{{-- ✅ Script untuk preview gambar otomatis --}}
<script>
    document.getElementById('ikon').addEventListener('change', function(event) {
        const [file] = event.target.files;
        if (file) {
            const preview = document.getElementById('preview');
            preview.src = URL.createObjectURL(file);
        }
    });
</script>
@endsection
