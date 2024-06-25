@extends('admin.main')

@section('content')
<div class="container">
    <h1>Edit Sidang</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.sidang.update', $sidang->id) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="ta_id" class="form-label">Tugas Akhir</label>
            <select name="ta_id" id="ta_id" class="form-control" required>
                <option value="" disabled>Pilih Tugas Akhir</option>
                @foreach($tugasAkhirs as $tugasAkhir)
                    <option value="{{ $tugasAkhir->id_ta }}" {{ $tugasAkhir->id_ta == $sidang->ta_id ? 'selected' : '' }}>{{ $tugasAkhir->judul }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="nim" class="form-label">NIM Mahasiswa</label>
            <select name="nim" id="nim" class="form-control" required>
                <option value="" disabled>Pilih NIM Mahasiswa</option>
                @foreach($mahasiswas as $mahasiswa)
                    <option value="{{ $mahasiswa->nim }}" {{ $mahasiswa->nim == $sidang->nim ? 'selected' : '' }}>{{ $mahasiswa->nim }} - {{ $mahasiswa->nama_mahasiswa }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="ketua_sidang_id">Ketua Sidang</label>
            <select name="ketua_sidang_id" id="ketua_sidang_id" class="form-control">
                @foreach($dosens as $dosen)
                    <option value="{{ $dosen->id_dosen }}" {{ $dosen->id_dosen == $sidang->ketua_sidang_id ? 'selected' : '' }}>{{ $dosen->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="penguji1_id">Penguji 1</label>
            <select name="penguji1_id" id="penguji1_id" class="form-control">
                @foreach($dosens as $dosen)
                    <option value="{{ $dosen->id_dosen }}" {{ $dosen->id_dosen == $sidang->penguji1_id ? 'selected' : '' }}>{{ $dosen->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="penguji2_id">Penguji 2</label>
            <select name="penguji2_id" id="penguji2_id" class="form-control">
                @foreach($dosens as $dosen)
                    <option value="{{ $dosen->id_dosen }}" {{ $dosen->id_dosen == $sidang->penguji2_id ? 'selected' : '' }}>{{ $dosen->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="sekretaris_id">Sekretaris</label>
            <select name="sekretaris_id" id="sekretaris_id" class="form-control">
                @foreach($dosens as $dosen)
                    <option value="{{ $dosen->id_dosen }}" {{ $dosen->id_dosen == $sidang->sekretaris_id ? 'selected' : '' }}>{{ $dosen->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="ruangan_id" class="form-label">Ruangan</label>
            <select name="ruangan_id" id="ruangan_id" class="form-control" required>
                <option value="" disabled>Pilih Ruangan</option>
                @foreach($ruangans as $ruangan)
                    <option value="{{ $ruangan->id_ruangan }}" {{ $ruangan->id_ruangan == $sidang->ruangan_id ? 'selected' : '' }}>{{ $ruangan->no_ruangan }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ $data->tanggal }}" required>
        </div>

        <div class="mb-3">
            <label for="status_sidang" class="form-label">Status Sidang</label>
            <input type="text" name="status_sidang" id="status_sidang" class="form-control" value="{{ $sidang->status_sidang }}">
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('admin.sidang.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
