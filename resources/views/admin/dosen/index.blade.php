@extends('admin.main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Daftar Dosen TI</h1>
    </div>

    @if (session()->has('pesan'))
        <div class="alert alert-primary" role="alert">
            {{ session('pesan') }}
        </div>
    @endif

    <a href="/admin-dosen/create" class="btn btn-primary mb-3">Create Dosen</a>
    <table class="table table-ordered table-striped">
        <tr>
            <th>Nama</th>
            <th>NIDN</th>
            <th>NIP</th>
            <th>Gender</th>
            <th>Prodi</th>
            <th>Email</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

        @foreach ($dosens as $dosen)
            <tr>
                <td>{{ $dosen->id_dosen }}</td>
                <td>{{ $dosen->nama_dosen }}</td>
                <td>{{ $dosen->nidn }}</td>
                <td>{{ $dosen->nip }}</td>
                <td>{{ $$dosen->gender }}</td>
                <td>{{ $dosen->prodi->nama_prodi }}</td>
                <td>{{ $$dosen->email }}</td>
                <td>{{ $$dosen->status }}</td>
                <td>

                </td>
            </tr>
        @endforeach
    </table>
    {{ $dosens->links() }}
@endsection
