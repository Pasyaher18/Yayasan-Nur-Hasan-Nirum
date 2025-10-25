<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yayasan Nurhasan Nirum</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Custom CSS --}}
    <style>
        body {
            font-family: "Poppins", sans-serif;
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .footer {
            background-color: #0a3d2e;
            color: #fff;
            text-align: center;
            padding: 20px 0;
        }
        .footer a {
            color: #ffc107;
            text-decoration: none;
        }
        .nav-link, .btn-link {
            color: #13693b !important;
            font-weight: 500;
        }
        .btn-logout {
            border: none;
            background: none;
            padding: 0;
            color: #13693b;
            cursor: pointer;
        }
        .btn-logout:hover {
            text-decoration: underline;
            color: #0a915c;
        }
    </style>

    @stack('styles')
</head>
<body>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-success" href="{{ url('/') }}">
                Yayasan Nur Hasan Nirum
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item"><a href="{{ url('/') }}" class="nav-link">Beranda</a></li>

                    {{-- 🌿 Tampilkan hanya di halaman publik --}}
                    @if(!Request::is('admin/*'))
                        <li class="nav-item"><a href="#tentang" class="nav-link">Tentang</a></li>
                        <li class="nav-item"><a href="#program" class="nav-link">Program</a></li>
                    @endif

                    {{-- Cek apakah user login --}}
                    @guest
                        {{-- Jika belum login --}}
                        <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
                        <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Register</a></li>
                    @else
                        {{-- Jika sudah login --}}
                        @if(Request::is('admin/*'))
                            {{-- Jika sedang di halaman admin, jangan tampilkan link dashboard lagi --}}
                        @else
                            <li class="nav-item">
                                <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
                            </li>
                        @endif

                        <li class="nav-item d-flex align-items-center">
                            <form action="{{ route('logout') }}" method="POST" class="m-0">
                                @csrf
                                <button type="submit" class="btn-logout nav-link">
                                    Logout
                                </button>
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    {{-- Main content --}}
    <main class="py-4">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="footer">
        <div class="container">
            <p>© 2025 Yayasan Nurhasan Nirum | Menebar Cahaya Ilmu & Kebaikan</p>
            <p class="mt-1" style="font-family: 'Amiri', serif; font-size: 18px;">ٱلْـحَمْدُ لِلَّهِ رَبِّ الْعَالَمِينَ</p>
        </div>
    </footer>

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    {{-- ✅ SweetAlert2 Popup --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if(session('success'))
        <script>
            Swal.fire({
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonColor: '#198754',
                confirmButtonText: 'OK'
            })
        </script>
    @endif

    @stack('scripts')

</body>
</html>
