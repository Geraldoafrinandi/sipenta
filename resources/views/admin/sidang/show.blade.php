@extends('admin.main')

@section('content')
<div class="container">
    <h1>Detail Sidang</h1>

    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">ID Sidang: {{ $sidang->id }}</h5>
            <p class="card-text">Tugas Akhir: {{ $sidang->tugas_akhirs->judul ?? '-' }}</p>
            <p class="card-text">Nama Mahasiswa: {{ $sidang->mahasiswas->nama_mahasiswa ?? '-' }}</p>
            <p class="card-text">Ketua Sidang: {{ $sidang->ketua_sidang }}</p>
            <p class="card-text">Penguji 1: {{ $sidang->penguji1 }}</p>
            <p class="card-text">Penguji 2: {{ $sidang->penguji2 }}</p>
            <p class="card-text">Sekretaris: {{ $sidang->sekretaris }}</p>
            <p class="card-text">Ruangan: {{ $sidang->ruangans->no_ruangan ?? '-' }}</p>
            <p class="card-text">Status Sidang: {{ $sidang->status_sidang }}</p>
        </div>
    </div>

    <a href="{{ route('admin.sidang.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection
