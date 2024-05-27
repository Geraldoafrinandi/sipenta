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
        <th>Nik</th>
        <th>Nama</th>
        <th>Email</th>
        <th>No Telepon</th>
        <th>Prodi</th>
        <th>Alamat</th>
        <th>Aksi</th>
    </tr>

    @foreach ($dosens as $itemDos)
    <tr>
       <td>{{ $dosens->firstItem()+$loop->index }}</td>
       <td>{{ $itemDos->nama_lengkap }}</td>
        <td>{{ $itemDos->email }}</td>
        <td>{{ $itemDos->no_telp }}</td>
        <td>{{ $itemDos->prodi_id }}</td>
        <td>{{ $itemDos->alamat }}</td>
       <td>
        <a href="/admin-dosen/{{$itemDos->id}}/edit" class="btn btn-success btn-sm">Edit</a>
        <!-- <a href="" class="btn btn-danger btn-sm">Hapus</a> -->
        <form action="/admin-dosen/{{$itemDos->id}}" method="post" class="d-inline">
            @method('DELETE')
            @csrf
            <button type="submit" class="btn btn-danger btn-sm d-inline" onclick="return confirm('Yakin akan menghapus data?')">Hapus</button>
        </form>
       </td>
    </tr>
@endforeach
</table>
{{ $dosens->links() }}
@endsection
