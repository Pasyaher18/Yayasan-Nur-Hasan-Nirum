<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $program->judul }} | Yayasan Nur Hasan Nirum</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f6f9f7;
      color: #2c3e50;
      line-height: 1.9;
    }

    .program-container {
      max-width: 950px;
      margin: 60px auto;
      background: #fff;
      border-radius: 20px;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
      overflow: hidden;
    }

    .program-header img {
      width: 100%;
      height: 450px;
      object-fit: cover;
      display: block;
      border-bottom: 5px solid #1b944e;
    }

    .program-content {
      padding: 2rem 3rem;
    }

    .program-content h1 {
      font-size: 2.2rem;
      font-weight: 700;
      color: #1b944e;
      margin-bottom: 1.8rem;
      text-align: center;
    }

    .program-description {
      text-align: justify;
      white-space: pre-line; /* biar \n di database tetap baris baru */
      margin-bottom: 1.5rem;
    }

    .program-footer {
      text-align: right;
      font-size: 0.9rem;
      color: #888;
      margin-top: 1.5rem;
    }

    .btn-back {
      display: inline-block;
      margin-top: 1.5rem;
      background: #1b944e;
      color: white;
      border-radius: 50px;
      padding: 0.6rem 1.4rem;
      text-decoration: none;
      font-weight: 500;
      transition: all 0.3s;
    }

    .btn-back:hover {
      background: #157d42;
      transform: scale(1.05);
    }

    .related-section {
      max-width: 950px;
      margin: 50px auto;
    }

    .related-section h3 {
      color: #1b944e;
      border-left: 6px solid #1b944e;
      padding-left: 10px;
      margin-bottom: 1.5rem;
      font-weight: 600;
    }

    .related-item {
      background: #fff;
      border-radius: 16px;
      box-shadow: 0 4px 18px rgba(0,0,0,0.05);
      padding: 1.2rem 1.5rem;
      margin-bottom: 1rem;
      transition: all 0.25s ease;
    }

    .related-item:hover {
      transform: translateY(-3px);
      box-shadow: 0 6px 22px rgba(0,0,0,0.08);
    }

    @media (max-width: 768px) {
      .program-header img {
        height: 300px;
      }
      .program-content {
        padding: 1.2rem;
      }
      .program-content h1 {
        font-size: 1.8rem;
      }
    }
  </style>
</head>
<body>

  @php
    use Illuminate\Support\Facades\Storage;
    $imgUrl = null;
    if (!empty($program->ikon)) {
      if (Storage::disk('public')->exists($program->ikon)) {
        $imgUrl = asset('storage/' . $program->ikon);
      } elseif (filter_var($program->ikon, FILTER_VALIDATE_URL)) {
        $imgUrl = $program->ikon;
      }
    }
    $imgUrl = $imgUrl ?? asset('images/default-program.png');
  @endphp

  <div class="program-container">
    <div class="program-header">
      <img src="{{ $imgUrl }}" alt="{{ $program->judul }}">
    </div>

    <div class="program-content">
      <h1>{{ $program->judul }}</h1>

      <div class="program-description">
        {{ $program->deskripsi }}
      </div>

      <div class="program-footer">
        <em>Diperbarui: {{ $program->updated_at->translatedFormat('d F Y') }}</em>
      </div>

      <a href="{{ url('/home') }}" class="btn-back">← Kembali ke Beranda</a>
    </div>
  </div>

  <div class="related-section">
    <h3>Program Lainnya</h3>
    <div class="row">
      @foreach($relatedPrograms as $item)
      <div class="col-md-4">
        <a href="{{ url('/program/' . $item->id) }}" class="text-decoration-none text-dark">
          <div class="related-item">
            <strong>{{ $item->judul }}</strong>
            <div class="text-muted small">{{ $item->created_at->translatedFormat('d M Y') }}</div>
          </div>
        </a>
      </div>
      @endforeach
    </div>
  </div>

</body>
</html>
