<!-- resources/views/validasi_ta/edit.blade.php -->

@extends('admin.main')

@section('content')
<div class="container">
    <h1>Edit Validasi Tugas Akhir</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('validasi_ta.update', $validasiTa->id_validasi) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="mahasiswa_id">Mahasiswa</label>
            <select name="mahasiswa_id" id="mahasiswa_id" class="form-control">
                @foreach($tugasAkhirs as $tugasAkhir)
                    <option value="{{ $tugasAkhir->nim }}" {{ $tugasAkhir->nim == $validasiTa->mahasiswa_id ? 'selected' : '' }}>
                        {{ $tugasAkhir->nama_mahasiswa }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="ta_id">Tugas Akhir</label>
            <select name="ta_id" id="ta_id" class="form-control">
                @foreach($tugasAkhirs as $tugasAkhir)
                    <option value="{{ $tugasAkhir->id_ta }}" {{ $tugasAkhir->id_ta == $validasiTa->id_ta ? 'selected' : '' }}>{{ $tugasAkhir->judul }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="status_validasi">Status Validasi</label>
            <div>
                <label>
                    <input type="radio" name="status_validasi" value="Valid" {{ $validasiTa->status_validasi == 'Valid' ? 'checked' : '' }}> Valid
                </label>
            </div>
            <div>
                <label>
                    <input type="radio" name="status_validasi" value="Tidak Valid" {{ $validasiTa->status_validasi == 'Tidak Valid' ? 'checked' : '' }}> Tidak Valid
                </label>
            </div>
            <div>
                <label>
                    <input type="radio" name="status_validasi" value="Pending" {{ $validasiTa->status_validasi == 'Pending' ? 'checked' : '' }}> Pending
                </label>
            </div>
        </div>
        <div class="mb-3">
            <label for="tanggal_validasi">Tanggal Validasi</label>
            <input type="date" name="tanggal_validasi" id="tanggal_validasi" class="form-control" value="{{ $validasiTa->tanggal_validasi }}">
        </div>
        <div class="mb-3">
            <label for="catatan">Catatan</label>
            <textarea name="catatan" id="catatan" class="form-control">{{ $validasiTa->catatan }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
@endsection
