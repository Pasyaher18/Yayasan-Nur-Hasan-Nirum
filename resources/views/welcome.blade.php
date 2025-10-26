<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Yayasan Nur Hasan Nirum</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- AOS -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Noto+Naskh+Arabic:wght@600&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      scroll-behavior: smooth;
      background-color: #fafaf8;
    }

    .navbar {
      background-color: #ffffff;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    .navbar-brand { font-weight: 700; color: #13693b !important; }
    .nav-link { color: #1a5f2b !important; font-weight: 500; }
    .nav-link:hover { color: #0a915c !important; }

    .profile-pic {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid #13693b;
      margin-left: 10px;
    }

    .hero {
      background: linear-gradient(rgba(19, 105, 59, 0.85), rgba(19, 105, 59, 0.85)),
                  url('https://images.unsplash.com/photo-1604429794048-0e3a3c3b59e3?auto=format&fit=crop&w=1920&q=80');
      background-size: cover;
      background-position: center;
      color: white;
      padding: 150px 0;
      text-align: center;
    }

    .hero h1 { font-family: 'Noto Naskh Arabic', serif; font-size: 2.5rem; margin-bottom: 15px; }
    .hero p { font-size: 1.1rem; color: #f5f5f5; }

    .btn-donasi {
      background-color: #ffd700; color: #1a5f2b; font-weight: 700;
      border-radius: 50px; padding: 16px 50px; font-size: 1.2rem;
      box-shadow: 0 0 10px rgba(255, 215, 0, 0.5);
      transition: all 0.3s ease-in-out; animation: fadeInUp 1s ease-in-out;
    }
    .btn-donasi:hover {
      transform: scale(1.08); background-color: #f1c40f; color: #fff;
      box-shadow: 0 0 20px rgba(255, 215, 0, 0.8);
    }

    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .program-section {
      padding: 70px 0 40px;
      background-color: #fffdf7;
      background-image: url('https://www.transparenttextures.com/patterns/arabesque.png');
    }

    .program-card {
      background: white; border-radius: 20px; padding: 25px; text-align: center;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1); transition: all 0.3s ease;
    }
    .program-card:hover { transform: translateY(-10px); box-shadow: 0 6px 20px rgba(0,0,0,0.15); }

    .program-card img {
      width: 100%;
      max-width: 250px;
      height: 180px;
      object-fit: cover;
      border-radius: 12px;
      display: block;
      margin: 0 auto 15px;
      transition: 0.4s ease;
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
    }
    .program-card:hover img { transform: scale(1.05); filter: brightness(1.1); }

    .program-card h5 { margin-top: 15px; color: #13693b; font-weight: 600; }

    footer {
      background-color: #13693b; color: white; text-align: center;
      padding: 30px 0 20px; margin-top: 0px;
    }

    .arabic-text { font-family: 'Noto Naskh Arabic', serif; font-size: 1.5rem; color: #ffd700; }
  </style>
</head>
<body>

<!-- 🌙 Navbar -->
<nav class="navbar navbar-expand-lg fixed-top">
  <div class="container">
    <a class="navbar-brand" href="#">Yayasan Nur Hasan Nirum</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav align-items-center">
        <li class="nav-item"><a class="nav-link" href="#">Beranda</a></li>
        <li class="nav-item"><a class="nav-link" href="#tentang">Tentang</a></li>
        <li class="nav-item"><a class="nav-link" href="#program">Program</a></li>

        @guest
          <li class="nav-item">
            <a href="{{ route('login') }}" class="btn btn-success px-4 ms-2">Login</a>
          </li>
        @else
          <li class="nav-item d-flex align-items-center ms-3">
            <a href="{{ url('/admin/dashboard') }}" class="d-flex align-items-center text-decoration-none">
              <img src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('images/default-profile.png') }}"
                   alt="Profile" class="profile-pic">
              <span class="fw-semibold text-success ms-2">{{ Auth::user()->name }}</span>
            </a>
          </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>

<!-- 🌿 Hero -->
<section class="hero" data-aos="fade-up">
  <div class="container">
    <p class="arabic-text mb-2">بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ</p>
    <h1 class="fw-bold mb-3">Menebar Kebaikan & Cahaya Ilmu</h1>
    <p class="mb-4">Yayasan Nurhasan Nirum berkomitmen membangun generasi Qur’ani yang cerdas, berakhlak, dan peduli sosial.</p>
    
    <button id="donasiBtn" class="btn btn-warning glow-btn">
      <span id="btnText">Donasi Sekarang</span>
      <span id="loadingSpinner" class="spinner-border spinner-border-sm ms-2 d-none" role="status" aria-hidden="true"></span>
    </button>
  </div>
</section>

<!-- 🌿 Program Kami -->
<section class="program-section py-5" id="program">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="fw-bold text-success" data-aos="fade-up">Program Kami</h2>
      <p data-aos="fade-up" data-aos-delay="100">
        Kami menghadirkan berbagai kegiatan Islami dan sosial untuk umat.
      </p>
    </div>

    <!-- Perubahan di sini 👇 -->
    <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-start">
      @foreach($programs as $program)
  <div class="col" data-aos="zoom-in" data-aos-delay="{{ $loop->iteration * 100 }}">
    <a href="{{ route('program.show', $program->id) }}" class="text-decoration-none text-dark">
      <div class="program-card shadow-sm p-4 rounded-4 bg-white">
        @if($program->ikon)
          <img src="{{ asset('storage/' . $program->ikon) }}" alt="{{ $program->judul }}">
        @else
          <img src="{{ asset('images/default.png') }}" alt="Program">
        @endif
        <h5 class="mt-3 text-success fw-bold">{{ $program->judul }}</h5>
      </div>
    </a>
  </div>
@endforeach

    </div>
  </div>
</section>

<!-- 🌾 Footer -->
<footer>
  <p class="arabic-text mb-2">اَلْـحَمْدُ لِلّٰهِ رَبِّ الْعَالَمِيْنَ</p>
  <p class="mb-0">&copy; 2025 Yayasan Nurhasan Nirum | Menebar Cahaya Ilmu & Kebaikan.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
  AOS.init({ duration: 800, once: true });

  const donasiBtn = document.getElementById('donasiBtn');
  const btnText = document.getElementById('btnText');
  const spinner = document.getElementById('loadingSpinner');

  donasiBtn.addEventListener('click', function() {
    this.classList.add('clicked');
    setTimeout(() => this.classList.remove('clicked'), 600);

    btnText.textContent = 'Memproses...';
    spinner.classList.remove('d-none');
    this.disabled = true;

    setTimeout(() => {
      window.location.href = "{{ route('donasi.index') }}";
    }, 1500);
  });

  window.addEventListener('pageshow', () => {
    btnText.textContent = 'Donasi Sekarang';
    spinner.classList.add('d-none');
    donasiBtn.disabled = false;
  });
</script>

</body>
</html>
