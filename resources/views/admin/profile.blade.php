@extends('layouts.app')

@section('content')
<style>
    body {
        background: #f4f7f5;
        font-family: 'Poppins', sans-serif;
    }
    .profile-container {
        max-width: 700px;
        margin: 60px auto;
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        padding: 40px;
        animation: fadeIn 0.7s ease-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .profile-header {
        text-align: center;
        margin-bottom: 25px;
    }
    .profile-header h3 {
        color: #13693b;
        font-weight: 700;
    }
    .profile-pic {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        display: block;
        margin: 0 auto 10px auto;
        border: 3px solid #13693b;
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
    /* Modal Crop */
    .modal-lg {
        max-width: 800px;
    }
    .cropper-container {
        max-height: 500px;
        width: 100%;
    }
</style>

<div class="profile-container">
    <div class="profile-header">
        <h3>Profil Saya</h3>

        {{-- Foto Profil --}}
        <img 
            id="profilePhoto"
            src="{{ $user->photo && file_exists(storage_path('app/public/' . $user->photo)) 
                ? asset('storage/' . $user->photo) 
                : asset('images/admin-avatar.png') }}" 
            class="profile-pic" 
            alt="Foto Profil"
        >

        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 mt-3 text-center">
                <label class="form-label fw-bold">Foto Profil (Opsional)</label>
                <input type="file" name="photo" class="form-control mt-2" accept="image/*" id="photoInput">
                <small class="text-muted">* Ukuran maks 2MB (jpg, jpeg, png)</small>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Nama Lengkap</label>
                <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Email</label>
                <input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ url('/admin/dashboard') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Cropper --}}
<div class="modal fade" id="cropModal" tabindex="-1" aria-labelledby="cropModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cropModalLabel">Atur & Crop Foto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div>
            <img id="imageToCrop" style="width:100%; max-height:500px;">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-success" id="cropButton">Crop & Gunakan</button>
      </div>
    </div>
  </div>
</div>

{{-- CropperJS --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Berhasil!',
    text: '{{ session("success") }}',
    timer: 1800,
    showConfirmButton: false
});
</script>
@endif

<script>
    let cropper;
    const photoInput = document.getElementById('photoInput');
    const profilePhoto = document.getElementById('profilePhoto');
    const imageToCrop = document.getElementById('imageToCrop');
    const cropModal = new bootstrap.Modal(document.getElementById('cropModal'));

    // Saat file dipilih
    photoInput.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = e => {
                imageToCrop.src = e.target.result;
                cropModal.show();
            };
            reader.readAsDataURL(file);
        }
    });

    // Inisialisasi cropper saat modal dibuka
    document.getElementById('cropModal').addEventListener('shown.bs.modal', () => {
        cropper = new Cropper(imageToCrop, {
            aspectRatio: 1,
            viewMode: 1,
            movable: true,
            zoomable: true,
            rotatable: false,
            scalable: false,
            background: false,
        });
    });

    // Hapus cropper saat modal ditutup
    document.getElementById('cropModal').addEventListener('hidden.bs.modal', () => {
        if (cropper) {
            cropper.destroy();
            cropper = null;
        }
    });

    // Tombol crop ditekan
    document.getElementById('cropButton').addEventListener('click', () => {
        const canvas = cropper.getCroppedCanvas({
            width: 300,
            height: 300,
        });
        profilePhoto.src = canvas.toDataURL(); // tampilkan preview hasil crop
        cropModal.hide();

        // Ganti file input jadi hasil crop
        canvas.toBlob(blob => {
            const file = new File([blob], "cropped.png", { type: "image/png" });
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);
            photoInput.files = dataTransfer.files;
        });
    });
</script>
@endsection
