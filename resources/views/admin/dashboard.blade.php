@extends('layouts.app')

@section('content')
<style>
    body {
        background: #f4f7f5;
        font-family: 'Poppins', sans-serif;
    }

    header.navbar, nav.navbar, .navbar {
        display: none !important;
    }

    .top-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 18px 60px;
        background: #ffffff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        position: sticky;
        top: 0;
        z-index: 10;
        border-bottom: 3px solid #13693b15;
    }

    .logo {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #13693b;
        font-weight: 700;
        font-size: 1.3rem;
        letter-spacing: 0.5px;
    }

    .profile-area {
        position: relative;
        display: flex;
        align-items: center;
        gap: 12px;
        cursor: pointer;
        transition: all 0.2s ease;
        padding: 6px 12px;
        border-radius: 8px;
    }

    .profile-area:hover { background-color: #f1f5f3; }

    .profile-area img {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        border: 2px solid #13693b;
        object-fit: cover;
    }

    .profile-area span {
        font-weight: 600;
        color: #13693b;
        font-size: 0.95rem;
    }

    .profile-dropdown {
        position: absolute;
        top: 55px;
        right: 0;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        display: none;
        width: 200px;
        overflow: hidden;
        animation: fadeSlideDown 0.2s ease-out forwards;
    }

    @keyframes fadeSlideDown {
        from { opacity: 0; transform: translateY(-8px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .profile-dropdown a, .profile-dropdown button {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 12px 18px;
        color: #333;
        text-decoration: none;
        font-size: 0.95rem;
        transition: background 0.2s ease;
        width: 100%;
        background: transparent;
        border: none;
        text-align: left;
    }

    .profile-dropdown a:hover, .profile-dropdown button:hover {
        background-color: #f4f4f4;
    }

    .profile-dropdown hr {
        margin: 0;
        border: 0;
        border-top: 1px solid #e5e5e5;
    }

    .dashboard-container {
        max-width: 1200px;
        margin: 60px auto;
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
        padding: 50px 60px;
        animation: fadeIn 0.7s ease-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .dashboard-header h1 {
        color: #13693b;
        font-weight: 700;
        font-size: 2rem;
        margin-bottom: 8px;
    }

    .dashboard-header p {
        color: #6b7280;
        font-size: 1rem;
        margin-bottom: 35px;
    }

    .program-section h3 {
        color: #13693b;
        font-weight: 600;
        margin-bottom: 20px;
    }

    .btn-success {
        background: linear-gradient(90deg, #13693b, #1ba663);
        border: none;
        border-radius: 10px;
        padding: 10px 18px;
        font-weight: 600;
        transition: all 0.3s;
    }

    .btn-success:hover {
        background: linear-gradient(90deg, #0f4f2c, #198754);
        transform: scale(1.05);
    }

    .program-table {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .program-table th {
        background: #13693b;
        color: #fff;
        text-align: center;
        vertical-align: middle;
        border: none;
        font-weight: 600;
        letter-spacing: 0.3px;
    }

    .program-table tbody tr:hover { background-color: #f7faf8; }

    .program-table td {
        text-align: center;
        vertical-align: middle;
        padding: 14px;
        color: #333;
        font-size: 0.95rem;
    }

    td.aksi-cell {
        white-space: nowrap;
        width: 260px;
        text-align: center;
    }

    .aksi-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
    }

    .btn-warning, .btn-danger, .btn-info, .btn-secondary {
        border-radius: 8px;
        padding: 6px 12px;
        font-weight: 500;
        font-size: 0.9rem;
        border: none;
        transition: 0.2s;
        flex-shrink: 0;
    }

    .btn-warning { background-color: #f4c542; color: #fff; }
    .btn-warning:hover { background-color: #e0b52d; transform: scale(1.05); }

    .btn-danger { background-color: #e74c3c; color: #fff; }
    .btn-danger:hover { background-color: #c0392b; transform: scale(1.05); }

    .btn-info { background-color: #0dcaf0; color: #fff; }
    .btn-info:hover { background-color: #0bb2d4; transform: scale(1.05); }

    .btn-secondary { background-color: #6c757d; color: #fff; }
    .btn-secondary:hover { background-color: #5a6268; transform: scale(1.05); }

    .preview-img {
        display: block;
        margin: 10px auto;
        max-width: 100px;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .img-detail-program {
        width: 100%;
        max-width: 1000px;
        border-radius: 15px;
        object-fit: cover;
        box-shadow: 0 5px 18px rgba(0,0,0,0.15);
    }

    .program-description {
        max-width: 850px;
        text-align: justify;
        line-height: 1.9;
        font-size: 1.05rem;
        color: #444;
        margin: 0 auto;
        padding: 0 20px;
        white-space: pre-line;
    }

    .program-description::first-letter {
        font-size: 1.4rem;
        font-weight: 600;
        color: #13693b;
    }
</style>

<div class="top-bar">
    <div class="logo">
        <span>Yayasan Nur Hasan Nirum</span>
    </div>

    <div class="profile-area" id="profileToggle">
        @php
            $photoPath = Auth::user()->photo && file_exists(public_path('storage/' . Auth::user()->photo))
                ? asset('storage/' . Auth::user()->photo)
                : asset('images/admin-avatar.png');
        @endphp
        <img src="{{ $photoPath }}" alt="Profil Admin">
        <span>{{ Auth::user()->name ?? 'Admin' }}</span>
        <div class="profile-dropdown" id="profileDropdown">
            <a href="{{ route('admin.profile') }}"><i class="bi bi-person-circle"></i> Profil</a>
            <a href="{{ route('home') }}"><i class="bi bi-house-door"></i> Beranda</a>
            <hr>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-danger">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>
    </div>
</div>

<div class="dashboard-container">
    <div class="dashboard-header text-center">
        <h1>Selamat Datang, {{ Auth::user()->name ?? 'Admin' }}!</h1>
        <p>Kelola data program Yayasan Nur Hasan Nirum dengan mudah dan cepat.</p>
    </div>

    <div class="program-section">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Daftar Program Yayasan</h3>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahProgram">
                <i class="bi bi-plus-circle"></i> Tambah Program
            </button>
        </div>

        <table class="table table-bordered program-table">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Ikon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($programs as $program)
                    @php
                        $ikonPath = $program->ikon && file_exists(public_path('storage/'.$program->ikon))
                            ? asset('storage/'.$program->ikon)
                            : asset('images/default-icon.png');
                    @endphp
                    <tr>
                        <td><strong>{{ $program->judul }}</strong></td>
                        <td style="text-align: left;">{{ Str::limit($program->deskripsi, 80) }}</td>
                        <td><img src="{{ $ikonPath }}" width="50" height="50" class="rounded shadow-sm" alt="Ikon"></td>
                        <td class="aksi-cell">
                            <div class="aksi-wrapper">
                                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalDetailProgram{{ $program->id }}">
                                    <i class="bi bi-eye"></i> Detail
                                </button>
                                <a href="{{ route('programs.edit', $program->id) }}" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>

                                <button type="button"
                                    class="btn {{ $program->is_visible ? 'btn-secondary' : 'btn-success' }} btn-sm toggle-visibility-btn"
                                    data-id="{{ $program->id }}">
                                    <i class="bi {{ $program->is_visible ? 'bi-eye-slash' : 'bi-eye' }}"></i>
                                    {{ $program->is_visible ? 'Hide' : 'Unhide' }}
                                </button>

                                <form action="{{ route('programs.destroy', $program->id) }}" method="POST" class="form-hapus m-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash3"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    {{-- Modal Detail --}}
                    <div class="modal fade" id="modalDetailProgram{{ $program->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-fullscreen">
                            <div class="modal-content border-0">
                                <div class="modal-header bg-success text-white">
                                    <h5 class="modal-title fw-bold">Detail Program</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body text-center p-5">
                                    <img src="{{ $ikonPath }}" alt="Ikon Program" class="img-detail-program mb-4">
                                    <h2 class="text-success fw-bold mb-3">{{ $program->judul }}</h2>
                                    <p class="program-description">{{ $program->deskripsi }}</p>
                                </div>
                                <div class="modal-footer border-0 d-flex justify-content-center">
                                    <a href="{{ route('programs.edit', $program->id) }}" class="btn btn-warning px-4">Edit</a>
                                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <tr><td colspan="4"><em>Belum ada program ditambahkan.</em></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah Program -->
<div class="modal fade" id="modalTambahProgram" tabindex="-1" aria-labelledby="modalTambahProgramLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg" style="border-radius: 16px;">
      <div class="modal-header bg-success text-white border-0">
        <h5 class="modal-title fw-bold" id="modalTambahProgramLabel">Tambah Program Baru</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form id="formTambahProgram" action="{{ route('programs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body px-4 py-3">
          <div class="mb-3">
            <label class="form-label fw-semibold">Judul Program</label>
            <input type="text" name="judul" class="form-control" placeholder="Masukkan judul program" required>
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="4" placeholder="Tuliskan deskripsi program" required></textarea>
          </div>

          <div class="mb-3 text-center">
            <label class="form-label fw-semibold">Ikon Program</label>
            <input type="file" name="ikon" id="ikonInput" class="form-control" accept="image/*">
            <img id="previewIkon" class="preview-img" style="display:none;" alt="Preview Ikon">
          </div>
        </div>
        <div class="modal-footer border-0">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-success px-4">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const toggle = document.getElementById("profileToggle");
    const dropdown = document.getElementById("profileDropdown");
    toggle.addEventListener("click", () => dropdown.style.display = dropdown.style.display === "block" ? "none" : "block");
    window.addEventListener("click", e => { if (!toggle.contains(e.target)) dropdown.style.display = "none"; });

    const ikonInput = document.getElementById('ikonInput');
    const preview = document.getElementById('previewIkon');
    if (ikonInput) {
        ikonInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = e => {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
            }
        });
    }

    // 🚀 Tambah Program
    const formTambah = document.getElementById('formTambahProgram');
    if (formTambah) {
        formTambah.addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            try {
                const res = await fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
                });
                if (!res.ok) throw new Error('Gagal menyimpan data');
                await Swal.fire({ icon: 'success', title: 'Berhasil!', text: 'Program berhasil ditambahkan!', timer: 1800, showConfirmButton: false });
                location.reload();
            } catch {
                Swal.fire({ icon: 'error', title: 'Gagal!', text: 'Terjadi kesalahan saat menambahkan program.' });
            }
        });
    }

    // 🗑️ Hapus Program
    document.querySelectorAll('.form-hapus').forEach(form => {
        form.addEventListener('submit', async e => {
            e.preventDefault();
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: 'Data yang dihapus tidak bisa dikembalikan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    await fetch(form.action, { method: 'POST', body: new FormData(form) });
                    Swal.fire({ icon: 'success', title: 'Dihapus!', text: 'Program berhasil dihapus.', timer: 1500, showConfirmButton: false });
                    setTimeout(() => location.reload(), 1200);
                }
            });
        });
    });

    // 👁️ Toggle Visibility
    document.querySelectorAll('.toggle-visibility-btn').forEach(btn => {
        btn.addEventListener('click', async () => {
            const id = btn.dataset.id;
            try {
                const res = await fetch(`/admin/programs/${id}/toggle`, {
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                if (!res.ok) throw new Error();
                await Swal.fire({ icon: 'success', title: 'Berhasil!', text: 'Visibilitas program diperbarui.', timer: 1500, showConfirmButton: false });
                location.reload();
            } catch {
                Swal.fire({ icon: 'error', title: 'Gagal!', text: 'Tidak dapat memperbarui visibilitas program.' });
            }
        });
    });
});
</script>
@endsection
