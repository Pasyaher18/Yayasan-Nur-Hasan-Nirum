<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrasi | Yayasan Nur Hasan Nirum</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Noto+Naskh+Arabic:wght@600&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(rgba(19, 105, 59, 0.85), rgba(19, 105, 59, 0.85)),
                  url('https://images.unsplash.com/photo-1591960743543-c9c5b9b9f403?auto=format&fit=crop&w=1920&q=80');
      background-size: cover;
      background-position: center;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .register-card {
      background: #ffffffee;
      border-radius: 20px;
      padding: 40px 35px;
      width: 100%;
      max-width: 400px;
      box-shadow: 0 6px 25px rgba(0, 0, 0, 0.1);
      animation: fadeInUp 1s ease;
    }

    .register-card h3 {
      text-align: center;
      color: #13693b;
      font-weight: 700;
      margin-bottom: 10px;
    }

    .arabic-text {
      font-family: 'Noto Naskh Arabic', serif;
      color: #ffd700;
      font-size: 1.3rem;
      text-align: center;
      margin-bottom: 20px;
    }

    .form-control {
      border-radius: 12px;
      border: 1px solid #ccc;
      padding: 12px;
    }

    .btn-register {
      background-color: #13693b;
      color: white;
      font-weight: 600;
      border-radius: 12px;
      padding: 12px;
      width: 100%;
      transition: all 0.3s ease;
    }

    .btn-register:hover {
      background-color: #0a915c;
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(19, 105, 59, 0.3);
    }

    .text-muted a {
      color: #13693b;
      text-decoration: none;
      font-weight: 500;
    }

    .text-muted a:hover {
      text-decoration: underline;
    }

    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>

  <div class="register-card">
    <p class="arabic-text">اَلسَّلَامُ عَلَيْكُمْ</p>
    <h3>Registrasi Admin</h3>
    <p class="text-center text-muted mb-4">Yayasan Nur Hasan Nirum</p>

    {{-- ✅ Alert jika registrasi gagal --}}
    @if ($errors->any())
      <div class="alert alert-danger">
        <strong>Terjadi kesalahan!</strong>
        <ul class="mt-2 mb-0 ps-3">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    {{-- ✅ Alert jika registrasi sukses --}}
    @if (session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    <form method="POST" action="{{ route('register.post') }}">
      @csrf
      <div class="mb-3">
        <label for="name" class="form-label fw-semibold">Nama Lengkap</label>
        <input type="text" name="name" class="form-control" id="name" 
               value="{{ old('name') }}" required placeholder="Masukkan nama Anda">
      </div>

      <div class="mb-3">
        <label for="email" class="form-label fw-semibold">Email</label>
        <input type="email" name="email" class="form-control" id="email" 
               value="{{ old('email') }}" required placeholder="Masukkan email">
      </div>

      <div class="mb-4">
        <label for="password" class="form-label fw-semibold">Password</label>
        <input type="password" name="password" class="form-control" id="password" required placeholder="Masukkan password">
      </div>

      <button type="submit" class="btn btn-register">Daftar</button>

      <p class="text-center text-muted mt-4">
        Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
      </p>
    </form>
  </div>

</body>
</html>
