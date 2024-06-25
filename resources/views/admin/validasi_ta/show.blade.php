<!-- resources/views/validasi_ta/show.blade.php -->

@extends('admin.main')

@section('content')
<div class="container">
    <h1>Detail Validasi Tugas Akhir</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Mahasiswa: {{ $validasiTa->mahasiswa->nim }} - {{ $validasiTa->mahasiswa->nama_mahasiswa }}</h5>
            <p class="card-text">Tugas Akhir: {{ $validasiTa->tugasAkhir->judul }}</p>
            <p class="card-text">Status Validasi: {{ $validasiTa->status_validasi }}</p>
            <p class="card-text">Tanggal Validasi: {{ $validasiTa->tanggal_validasi }}</p>
            @if ($validasiTa->catatan)
            <p class="card-text">Catatan: {{ $validasiTa->catatan }}</p>
            @endif

            <a href="{{ route('validasi_ta.index') }}" class="btn btn-secondary">Kembali ke Daftar</a>
        </div>
    </div>
</div>
@endsection
