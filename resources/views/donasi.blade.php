@extends('layouts.app')

@section('content')
<div class="container text-center py-5">
    <h2 class="fw-bold text-success mb-3">Donasi Yayasan Nur hasan Nirum</h2>
    <p class="mb-4">
        Terima kasih atas niat baik Anda untuk berbagi kebaikan.  
        Donasi dapat disalurkan melalui rekening resmi berikut:
    </p>

    <div class="card mx-auto shadow-sm border-0" style="max-width: 450px;">
        <div class="card-body">
            <h5 class="fw-bold text-success">Bank Syariah Indonesia (BSI)</h5>
            <h3 class="fw-bold my-2 text-dark">1234 5678 9012</h3>
            <p class="mb-0 text-muted">a.n. Yayasan Nurhasan Nirum</p>
        </div>
    </div>

    <p class="mt-4">
        Setelah melakukan transfer, Anda dapat mengonfirmasi melalui:
    </p>
    <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-success rounded-pill px-4 py-2">
        <i class="bi bi-whatsapp"></i> Konfirmasi via WhatsApp
    </a>
</div>
@endsection
