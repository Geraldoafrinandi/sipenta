@extends('admin.main')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Daftar Penilaian TI</h1>
    </div>
    <h1 class="text-center mt-4">Daftar Penilaian</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-ordered table-striped">
        <thead>
            <tr>
                <th>Tugas Akhir</th>
                <th>Jabatan Penilai</th>
                <th>Dosen</th>
                <th>Total Nilai</th>
                <th>Komentar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penilaians as $penilaian)
            <tr>
                <td>{{ $penilaian->tugas_akhir->judul }}</td>
                <td>{{ $penilaian->jabatan }}</td>
                <td>{{ $penilaian->dosen->nama }}</td>
                <td>{{ $penilaian->total_nilai }}</td>
                <td>{{ $penilaian->komentar }}</td>
                <td>
                    <a href="{{ route('admin.penilaian.show', $penilaian->id) }}" class="btn btn-info btn-sm">Lihat</a>
                    <a href="{{ route('admin.penilaian.edit', $penilaian->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    @if(Auth::user()->role == 'kaprodi')
                    <form action="{{ route('admin.penilaian.destroy', $penilaian->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus penilaian ini?')">Hapus</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script></script>
@endsection
