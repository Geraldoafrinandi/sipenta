@extends('admin.main')
@section('title', 'Data Mahasiswa')
@section('navMhs', 'active')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Daftar Mahasiswa TI</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-primary" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <a href="/admin-mahasiswa/create" class="btn btn-primary mb-3">Create Mahasiswa</a>
    <table class="table table-ordered table-striped">
        <tr>
            <th>NIM</th>
            <th>Nama Mahasiswa</th>
            <th>Prodi</th>
            <th>Angkatan</th>
            <th>Gender</th>
            <th>Status Mahasiswa</th>
            <th>Aksi</th>
        </tr>
        @foreach ($mahasiswas as $mahasiswa)
            <tr>
                <td>{{ $mahasiswa->nim }}</td>
                <td>{{ $mahasiswa->nama_mahasiswa }}</td>
                <td>{{ $mahasiswa->id_prodi->nama_prodi }}</td>
                <td>{{ $mahasiswa->angkatan }}</td>
                <td>{{ $mahasiswa->gender }}</td>
                <td>{{ $mahasiswa->status }}</td>
                <td>

                    <!-- Form untuk menghapus data -->
                    <form action="{{ route('mahasiswa.destroy', $mahasiswa->id_mahasiswa) }}" method="POST" class="d-inline">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Yakin akan menghapus data?')">Hapus</button>
                    </form>

                </td>
            </tr>
        @endforeach
    </table>
    {{ $mahasiswas->links() }}
@endsection
