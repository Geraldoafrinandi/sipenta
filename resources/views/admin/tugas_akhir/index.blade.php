@extends('admin.main')
@section('title', 'Data TA')
@section('navMhs', 'active')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Data Ta</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-primary" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <a href="/tugas_akhir/create" class="btn btn-primary mb-3">Create Tugas Akhir</a>
    <table class="table table-ordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>NIM</th>
                <th>Pembimbing 1</th>
                <th>Pembimbing 2</th>
                <th>Judul</th>
                <th>Tanggal Pengajuan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tugasAkhir as $ta)
                <tr>
                    <td>{{ $ta->id_ta }}</td>
                    <td>{{ $ta->nim }}</td>
                    <td>{{ $ta->pembimbing1 }}</td>
                    <td>{{ $ta->pembimbing2 }}</td>
                    <td>{{ $ta->judul }}</td>
                    <td>{{ $ta->tgl_pengajuan }}</td>
                    <td>
                        <a href="{{ route('tugas_akhir.edit', $ta->id_ta) }}" class="btn btn-success btn-sm">Edit</a>
                        <form action="{{ route('tugas_akhir.destroy', $ta->id_ta) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endsection
