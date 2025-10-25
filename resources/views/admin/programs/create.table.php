<form action="{{ route('programs.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label>Judul Program</label>
        <input type="text" name="judul" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Deskripsi</label>
        <textarea name="deskripsi" class="form-control" required></textarea>
    </div>

    <div class="mb-3">
        <label>Ikon (Opsional)</label>
        <input type="file" name="ikon" class="form-control">
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
</form>
