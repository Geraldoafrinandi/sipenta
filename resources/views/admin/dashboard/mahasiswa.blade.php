@extends('admin.main')

@section('content')
<div class="container">
    <h1 class="mb-5">selamat datang</h1>
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title text-white">Selamat Datang, {{ $user->name }}!</h3>
            <p class="card-subtitle mb-0 text-white">Anda login sebagai <strong>{{ $user->role }}</strong>.</p>
        </div>
        <div class="card-body">
            @if($sidang)
                <div class="card">
                    <div class="card-header">
                        <b><h3>Informasi Sidang</h3></b>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li><strong>Nama Mahasiswa:</strong>  {{ $user->name }}</li>
                            <li><strong>Judul Tugas Akhir:</strong>  {{ $sidang->tugas_akhir->judul }}</li>
                            <li><strong>Tanggal Sidang:</strong>  {{ $sidang->tanggal }}</li>
                            <li><strong>Jam Sidang:</strong>  {{ $sidang->ruangan->jam_sidang }}</li>
                            <li><strong>Ruangan:</strong>  {{ $sidang->ruangan->no_ruangan }}</li>
                            {{-- <li><strong>Nilai:</strong>  {{ $sidang->total_nilai }}</li> --}}
                        </ul>
                    </div>
                </div>
            @else
                <div class="alert alert-warning mt-4">
                    Anda belum memiliki jadwal sidang.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
