<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | Yayasan Nur Hasan Nirum</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Noto+Naskh+Arabic:wght@600&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #13693b;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .login-card {
      background: #f6f9f7;
      border-radius: 20px;
      padding: 40px 35px;
      width: 100%;
      max-width: 400px;
      box-shadow: 0 6px 25px rgba(0, 0, 0, 0.15);
      animation: fadeInUp 1s ease;
    }

    .login-card h3 {
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
      margin-bottom: 15px;
    }

    .form-control {
      border-radius: 12px;
      border: 1px solid #d9e2dc;
      padding: 12px;
      background-color: #eef5f0;
    }

    .btn-login {
      background-color: #13693b;
      color: white;
      font-weight: 600;
      border-radius: 12px;
      padding: 12px;
      width: 100%;
      transition: all 0.3s ease;
    }

    .btn-login:hover {
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

    .alert {
      border-radius: 12px;
      font-weight: 500;
    }

    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>

  <div class="login-card">
    <p class="arabic-text">اَلسَّلَامُ عَلَيْكُمْ</p>
    <h3>Login</h3>
    <p class="text-center text-muted mb-4">Yayasan Nur Hasan Nirum</p>

    {{-- ALERT PESAN SUKSES --}}
    @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    {{-- ALERT LOGIN GAGAL --}}
    @if (session('error'))
      <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    {{-- ALERT VALIDASI --}}
    @if ($errors->any())
      <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
        <ul class="mb-0 list-unstyled">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <form method="POST" action="{{ route('login.post') }}">
      @csrf
      <div class="mb-3">
        <label for="email" class="form-label fw-semibold">Email</label>
        <input type="email" name="email" class="form-control" id="email" required placeholder="Masukkan email Anda">
      </div>
      <div class="mb-4">
        <label for="password" class="form-label fw-semibold">Password</label>
        <input type="password" name="password" class="form-control" id="password" required placeholder="Masukkan password">
      </div>

      <button type="submit" class="btn btn-login">Masuk</button>

      <p class="text-center text-muted mt-3">
        <a href="#">Lupa password?</a>
      </p>
      <p class="text-center mt-2 text-muted">
        Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
      </p>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    // Auto-close alert setelah 4 detik
    setTimeout(() => {
      const alerts = document.querySelectorAll('.alert');
      alerts.forEach(alert => {
        const bsAlert = new bootstrap.Alert(alert);
        bsAlert.close();
      });
    }, 4000);
  </script>

</body>
</html>
