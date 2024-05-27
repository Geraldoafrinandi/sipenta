@extends('admin.main')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <h1 class="h2">Form Mahasiswa</h1>
</div>
<div class="col-6">
    <form action="/admin-mahasiswa" method="POST">
        @csrf
    <div class="mb-3">
        <label class="form-label">NIM</label>
        <input type="number" class="form-control @error('nim') is-invalid
        @enderror" name="nim" value="{{ old('nim')}}">

        @error('nim')
            <div class="invalid-feedback">
            {{ $message }}
            </div>
        @enderror


     </div>
     <div class="mb-3">
        <label class="form-label">Nama Mahasiswa</label>
        <input type="text" class="form-control @error('nama_lengkap') is-invalid
        @enderror" name="nama_lengkap" value="{{ old('nama_lengkap')}}">
        @error('nama_lengkap')
            <div class="invalid-feedback">
            {{ $message }}
            </div>
        @enderror
     </div>

     <div class="mb-3">
     <input type="submit" class="btn btn-primary" value="Simpan">
    </form>
</div>
@endsection
