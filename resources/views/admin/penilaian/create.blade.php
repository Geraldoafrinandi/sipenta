@extends('admin.main')
@section('title', 'Form Penilaian')
@section('navMhs', 'active')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <h1 class="h2">Form Penilaian</h1>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="col-6">
        <form action="/admin-penilaian" method="POST">
            @csrf
            @foreach (['BIMBINGAN', 'MAKALAH', 'PRODUK'] as $section)
                <div class="mb-3">
                    <label class="form-label">{{ $section }}</label>
                    @foreach (['Sikap dan Penampilan', 'Komunikasi dan Sistematika', 'Penguasaan Materi', 'Identifikasi Masalah', 'Relevansi Teori', 'Metoda/Algoritma', 'Hasil dan Pembahasan', 'Kesimpulan dan Saran', 'Penggunaan Bahasa dan Tata Tulis', 'Kesesuaian fungsionalitas sistem'] as $materi)
                        <div class="mb-3">
                            <label class="form-label">{{ $materi }}</label>
                            <div class="input-group">
                                <input type="text" name="materi_penilaian[]" value="{{ $materi }}" class="form-control" readonly>
                                <input type="number" name="bobot[]" class="form-control" placeholder="Bobot (%) " required>
                                <input type="number" step="0.01" name="skor[]" class="form-control" placeholder="Skor" required>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
            <div class="mb-3">
                <label class="form-label">Revisi</label>
                <textarea class="form-control" name="revisi" rows="3"></textarea>
            </div>

            <div class="mb-3">
                <input type="submit" class="btn btn-primary" value="Simpan">
            </div>

        </form>
    </div>
@endsection
