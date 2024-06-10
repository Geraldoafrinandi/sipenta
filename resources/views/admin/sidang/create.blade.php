@extends('admin.main')

@section('content')
<div class="container">
    <h1>Tambah Sidang</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.sidang.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="ta_id" class="form-label">Tugas Akhir</label>
            <select name="ta_id" id="ta_id" class="form-control" required>
                <option value="" disabled selected>Pilih Tugas Akhir</option>
                @foreach($tugasAkhirs as $tugasAkhir)
                    <option value="{{ $tugasAkhir->id_ta }}">{{ $tugasAkhir->judul }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="nim" class="form-label">NIM</label>
            <select name="nim" id="nim" class="form-control" required>
                <option value="" disabled selected>Pilih NIM</option>
                @foreach($mahasiswas as $mahasiswa)
                    <option value="{{ $mahasiswa->nim }}">{{ $mahasiswa->nim }} - {{ $mahasiswa->nama_mahasiswa }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="ketua_sidang" class="form-label">Ketua Sidang</label>
            <input type="text" name="ketua_sidang" id="ketua_sidang" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="penguji1" class="form-label">Penguji 1</label>
            <input type="text" name="penguji1" id="penguji1" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="penguji2" class="form-label">Penguji 2</label>
            <input type="text" name="penguji2" id="penguji2" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="sekretaris" class="form-label">Sekretaris</label>
            <input type="text" name="sekretaris" id="sekretaris" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="ruangan_id" class="form-label">Ruangan</label>
            <select name="ruangan_id" id="ruangan_id" class="form-control" required>
                <option value="" disabled selected>Pilih Ruangan</option>
                @foreach($ruangans as $ruangan)
                    <option value="{{ $ruangan->id_ruangan }}">{{ $ruangan->nama_ruangan }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="status_sidang" class="form-label">Status Sidang</label>
            <input type="text" name="status_sidang" id="status_sidang" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.sidang.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
