@extends('admin.main')
@section('title','Data Mahasiswa')
@section('navMhs','active')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Daftar Mahasiswa TI</h1>
      </div>

    @if (session()->has('pesan'))
    <div class="alert alert-primary" role="alert">
        {{ session('pesan')}}
    </div>
    @endif

<a href="/admin-mahasiswa/create" class="btn btn-primary mb-3">Create Mahasiswa</a>
<table class="table table-ordered table-striped">
    <tr>
        <th>Nim</th>
        <th>Nama</th>
        <th>Tempat Lahir</th>
        <th>Tanggal Lahir</th>
        <th>Email</th>
        <th>Prodi</th>
        <th>Alamat</th>
        <th>Aksi</th>
    </tr>

</table>

@endsection
