@extends('admin.main')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mt-3">
            <h1 class="h2">Daftar Sidang</h1>
        </div>

        <a href="{{ route('admin.sidang.create') }}" class="btn btn-primary mb-3">Tambah Sidang</a>
        @if (session()->has('success'))
            <div class="alert alert-primary" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="table-responsive mt-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Judul Tugas Akhir</th>
                        <th>Nama Mahasiswa</th>
                        <th>Nilai</th>
                        <th>Ketua Sidang</th>
                        <th>Penguji 1</th>
                        <th>Penguji 2</th>
                        <th>Sekretaris</th>
                        <th>Ruangan</th>
                        <th>Jam Sidang</th>
                        <th>Tanggal Sidang</th>
                        <th>Status Sidang</th>
                        <th>Total Nilai</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sidangs as $sidang)
                        <tr>
                            <td>{{ $sidang->tugas_akhir->judul ?? '-' }}</td>
                            <td>{{ $sidang->mahasiswa->nama_mahasiswa }} - {{ $sidang->mahasiswa->nim }}</td>
                            <td> <a href="{{ route('admin.penilaian.index') }}" class="btn btn-primary">Nilai</a></td>
                            <td>{{ $sidang->ketuaSidang->nama ?? '-' }}</td>
                            <td>{{ $sidang->penguji1->nama ?? '-' }}</td>
                            <td>{{ $sidang->penguji2->nama ?? '-' }}</td>
                            <td>{{ $sidang->sekretaris->nama ?? '-' }}</td>
                            <td>{{ $sidang->ruangan->no_ruangan ?? '-' }}</td>
                            <td>{{ $sidang->ruangan->jam_sidang ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($sidang->tanggal)->format('d-m-Y') }}</td>
                            <td>{{ $sidang->status_sidang ?? '-' }}</td>
                            <td>{{ $sidang->penilaian->total_nilai ?? '-' }}</td>
                            <td>
                                <a href="{{ route('admin.sidang.edit', $sidang->id) }}"
                                    class="btn btn-warning btn-sm mb-1">Edit</a>
                                <form action="{{ route('admin.sidang.destroy', $sidang->id) }}" method="POST"
                                    class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus sidang ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="12" class="text-center">Tidak ada data sidang.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            <div class="container">
                <h3>Dosen dengan Jadwal Sidang</h3>

                <table class="table table-ordered table-striped">
                    <thead>
                        <tr>
                            <th>Nama Dosen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sidangs as $sidang)
                            <tr>
                                <td>{{ $sidang->ketuaSidang->nama }} <br> {{ $sidang->penguji1->nama }} <br>
                                    {{ $sidang->penguji2->nama }} <br>{{ $sidang->sekretaris->nama }}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
