@extends('admin.main')
@section('title')
@section('navMhs','active')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <h1 class="h2">Form Dosen</h1>
</div>
<div class="col-6">
    <form action="/admin-dosen" method="POST">
        @csrf
    <div class="mb-3">
        <label class="form-label">NIK</label>
        <input type="number" class="form-control @error('nik') is-invalid
        @enderror" name="nik" value="{{ old('nik')}}">

        @error('nik')
            <div class="invalid-feedback">
            {{ $message }}
            </div>
        @enderror
     </div>

     <div class="mb-3">
        <label class="form-label">Nama Dosen</label>
        <input type="text" class="form-control @error('nama_lengkap') is-invalid
        @enderror" name="nama_lengkap" value="{{ old('nama_lengkap')}}">
        @error('nama_lengkap')
            <div class="invalid-feedback">
            {{ $message }}
            </div>
        @enderror
     </div>

     <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" class="form-control @error('email') is-invalid
        @enderror" name="email"  value="{{ old('email')}}">
     </div>

     <div class="mb-3">
        <label class="form-label">No Telepon</label>
        <input type="number" class="form-control @error('no_telp') is-invalid
        @enderror" name="no_telp" value="{{ old('no_telp')}}">

        @error('no_telp')
            <div class="invalid-feedback">
            {{ $message }}
            </div>
        @enderror
     </div>

    <select name="prodi_id" class="form-select @error('prodi_id') is-invalid
        @enderror" >
        <option value="">--Pilih Prodi--</option>
        @foreach ($prodis as $prodi)
            <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi }}</option>
        @endforeach

    </select>

     <div class="mb-3">
        <label class="form-label">Alamat</label>
        <textarea class="form-control @error('alamat') is-invalid
        @enderror" rows="3" name="alamat"  value="{{ old('alamat')}}"></textarea>
     </div>

     <div class="mb-3">
     <input type="submit" class="btn btn-primary" value="Simpan">
    </form>
</div>
@endsection
