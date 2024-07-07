<!-- resources/views/validasi_ta/show.blade.php -->

@extends('admin.main')

@section('content')
<div class="container">
    <h1>Detail Validasi Proposal</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Mahasiswa: {{ $validasiProposal->tugasAkhir->nama_mahasiswa }} - {{ $validasiProposal->tugasAkhir->nim }}</h5>
            <p class="card-text">Tugas Akhir: {{ $validasiProposal->tugasAkhir->judul }}</p>
            <p class="card-text">Status Validasi: {{ $validasiProposal->status_validasi }}</p>
            <p class="card-text">Tanggal Validasi: {{ $validasiProposal->tanggal_validasi }}</p>
            @if ($validasiProposal->catatan)
            <p class="card-text">Catatan: {{ $validasiProposal->catatan }}</p>
            @endif

            <a href="{{ route('validasi_ta.index') }}" class="btn btn-secondary">Kembali ke Daftar</a>
        </div>
    </div>
</div>
@endsection
