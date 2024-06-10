<!-- resources/views/admin/sidangs/index.blade.php -->

@extends('admin.main')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Sidang</h1>
    </div>
    <a href="{{ route('admin.sidang.create') }}" class="btn btn-primary">Tambah Sidang</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tugas Akhir</th>
                <th>NIM</th>
                <th>Ketua Sidang</th>
                <th>Penguji 1</th>
                <th>Penguji 2</th>
                <th>Sekretaris</th>
                <th>Ruangan</th>
                <th>Status Sidang</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sidangs as $sidang)
                <tr>
                    <td>{{ $sidang->id }}</td>
                    <td>{{ $sidang->tugas_akhir->judul ?? '-' }}</td>
                    <td>{{ $sidang->nim }}</td>
                    <td>{{ $sidang->ketua_sidang }}</td>
                    <td>{{ $sidang->penguji1 }}</td>
                    <td>{{ $sidang->penguji2 }}</td>
                    <td>{{ $sidang->sekretaris }}</td>
                    <td>{{ $sidang->ruangan->nama_ruangan ?? '-' }}</td>
                    <td>{{ $sidang->status_sidang }}</td>
                    <td>
                        <a href="{{ route('admin.sidang.show', $sidang->id) }}" class="btn btn-info">Lihat</a>
                        <a href="{{ route('admin.sidang.edit', $sidang->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.sidang.destroy', $sidang->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
