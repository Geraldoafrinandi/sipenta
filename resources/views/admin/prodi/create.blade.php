@extends('admin.main')
@section('title', 'Form Prodi')
@section('navMhs', 'active')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <h1 class="h2">Form Prodi</h1>
    </div>
    <div class="col-6">
        <form action="/admin-prodi" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nama Prodi</label>
                <input type="text" class="form-control @error('nama_prodi') is-invalid @enderror" name="nama_prodi"
                    value="{{ old('nama_prodi') }}">
                @error('nama_prodi')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <input type="submit" class="btn btn-primary" value="Simpan">
            </div>

        </form>
    </div>
@endsection
