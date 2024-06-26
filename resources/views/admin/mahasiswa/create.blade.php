@extends('admin.main')
@section('title', 'Form Mahasiswa')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <h1 class="h2">Form Mahasiswa</h1>
    </div>
    <div class="col-6">
        <form action="/admin-mahasiswa" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nim" id="nim" class="form-label">NIM</label>
                <input type="number" class="form-control @error('nim') is-invalid @enderror" name="nim"
                    value="{{ old('nim') }}">
                @error('nim')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="nama_mahasiswa" id="nama_mahasiswa" class="form-label">Nama Mahasiswa</label>
                <input type="text" class="form-control @error('nama_mahasiswa') is-invalid @enderror"
                    name="nama_mahasiswa" value="{{ old('nama_mahasiswa') }}">
                @error('nama_mahasiswa')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="prodi_id" class="form-label">Prodi</label>
                <select name="prodi_id" class="form-select @error('prodi_id') is-invalid
                @enderror">
                    <option value="">--Pilih Prodi--</option>
                    @foreach ($prodis as $prodi)
                        <option value="{{ $prodi->id_prodi }}">{{ $prodi->nama_prodi }}</option>
                    @endforeach

                </select>
                @error('prodi_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="gender" id="gender" class="mb-2">Gender:</label>
                <select class="form-control @error('gender') is-invalid @enderror" id="gender" name="gender">
                    <option value="">Pilih Gender</option>
                    <option value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
                @error('gender')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="angkatan" id="angkatan" class="form-label">Angkatan</label>
                <input type="text" class="form-control @error('angkatan') is-invalid @enderror" name="angkatan"
                    value="{{ old('angkatan') }}">
                @error('angkatan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="status_mahasiswa" id="status_mahasiswa" class="form-label">Status Mahasiswa</label>
                <input type="text" class="form-control @error('status_mahasiswa') is-invalid @enderror"
                    name="status_mahasiswa" value="{{ old('status_mahasiswa') }}">
                @error('status_mahasiswa')
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
