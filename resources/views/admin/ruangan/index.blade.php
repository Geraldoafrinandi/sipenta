@extends('admin.main')
@section('title', 'Data Ruangan')
@section('navMhs', 'active')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Daftar Ruangan TI</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-primary" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <a href="/admin-ruangan/create" class="btn btn-primary mb-3">Create Ruangan</a>
    <table class="table table-ordered table-striped">
        <tr>
            <th>No Ruangan</th>
            <th>Jam Sidang</th>
            <th>Aksi</th>
        </tr>
        @foreach ($ruangans as $ruangan)
        <tr>
            <td>{{ $ruangan->no_ruangan }}</td>
            <td>{{ $ruangan->jam_sidang }}</td>

            <td>
                <!-- Form untuk menghapus data -->
                <form action="{{ route('admin.ruangan.destroy', $ruangan->id_ruangan) }}" method="POST" class="d-inline">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin akan menghapus data?')">Hapus</button>
                </form>
            </td>
        </tr>
    @endforeach


        @endsection
    </table>
