@extends('admin.main')
@section('title', 'Dashboard Dosen')
@section('navDashboard', 'active')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard Dosen</h1>
</div>

<div class="card mb-4">
    <div class="card-header bg-info text-white">
        <h3 class="card-title">Halo, Selamat Datang, {{ $user->name }}!</h3>
    </div>
    <div class="card-body">
        <h5>Profil Dosen:</h5>
        <ul class="list-unstyled">
            <li><strong>Nama:</strong> {{ $user->name }}</li>
            <li><strong>NIDN:</strong> {{ $user->nim }}</li>
            <li><strong>Email:</strong> {{ $user->email }}</li>
        </ul>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title">Mahasiswa yang Dibimbing</h3>
            </div>
            <div class="card-body">
                @if($bimbinganMahasiswa->isEmpty())
                    <p class="text-center text-muted">Tidak ada data mahasiswa yang dibimbing.</p>
                @else
                    <table class="table table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>NIM</th>
                                <th>Nama Mahasiswa</th>
                                <th>Judul Tugas Akhir</th>
                                <th>Pembimbing 1</th>
                                <th>Pembimbing 2</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bimbinganMahasiswa as $ta)
                                <tr>
                                    <td>{{ $ta->mahasiswa->nim }}</td>
                                    <td>{{ $ta->mahasiswa->nama_mahasiswa }}</td>
                                    <td>{{ $ta->judul }}</td>
                                    <td>{{ $ta->pembimbing1->nama ?? '-' }}</td>
                                    <td>{{ $ta->pembimbing2->nama ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title">Mahasiswa yang Diuji</h3>
            </div>
            <div class="card-body">
                @if($ujiMahasiswa->isEmpty())
                    <p class="text-center text-muted">Tidak ada data mahasiswa yang diuji.</p>
                @else
                    <table class="table table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>NIM</th>
                                <th>Nama Mahasiswa</th>
                                <th>Judul Tugas Akhir</th>
                                <th>Penguji 1</th>
                                <th>Penguji 2</th>
                                <th>Tanggal Sidang</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ujiMahasiswa as $sidang)
                                <tr>
                                    <td>{{ $sidang->tugas_akhir->mahasiswa->nim }}</td>
                                    <td>{{ $sidang->tugas_akhir->mahasiswa->nama_mahasiswa }}</td>
                                    <td>{{ $sidang->tugas_akhir->judul }}</td>
                                    <td>{{ $sidang->penguji1->nama ?? '-' }}</td>
                                    <td>{{ $sidang->penguji2->nama ?? '-' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($sidang->tanggal)->format('d-m-Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
