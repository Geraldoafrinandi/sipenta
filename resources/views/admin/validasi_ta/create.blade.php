<!-- resources/views/validasi_ta/create.blade.php -->

@extends('admin.main')

@section('content')
<div class="container">
    <h1>Tambah Validasi Tugas Akhir</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('validasi_ta.store') }}" method="POST" id="validasiForm">
        @csrf
        <div class="mb-3">
            <label for="ta_id">Tugas Akhir</label>
            <select name="ta_id" id="ta_id" class="form-control" required>
                <option value="" disabled selected>Pilih Tugas Akhir</option>
                @foreach($tugasAkhirs as $tugasAkhir)
                    <option value="{{ $tugasAkhir->id_ta }}">{{ $tugasAkhir->judul }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="mahasiswa_id">Mahasiswa</label>
            <select name="mahasiswa_id" id="mahasiswa_id" class="form-control" required>
                <option value="" disabled selected>Pilih Mahasiswa</option>
                @if(isset($mahasiswas))
                    @foreach($mahasiswas as $mahasiswa)
                        <option value="{{ $mahasiswa->id }}">{{ $mahasiswa->nama_mahasiswa }}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="mb-3">
            <label for="status_validasi">Status Validasi</label>
            <div>
                <label>
                    <input type="radio" name="status_validasi" value="Valid" checked> Valid
                </label>
            </div>
            <div>
                <label>
                    <input type="radio" name="status_validasi" value="Tidak Valid"> Tidak Valid
                </label>
            </div>
            <div>
                <label>
                    <input type="radio" name="status_validasi" value="Pending"> Pending
                </label>
            </div>
        </div>
        <div class="mb-3">
            <label for="tanggal_validasi">Tanggal Validasi</label>
            <input type="date" name="tanggal_validasi" id="tanggal_validasi" class="form-control">
        </div>
        <div class="mb-3">
            <label for="catatan">Catatan</label>
            <textarea name="catatan" id="catatan" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

@endsection
