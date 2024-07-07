@extends('admin.main')

@section('title', 'Edit Tugas Akhir')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Tugas Akhir</h1>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('tugas_akhir.update', $tugasAkhir->id_ta) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nim" class="form-label">NIM</label>
                    <input type="text" class="form-control" id="nim" name="nim" value="{{ $tugasAkhir->nim }}" required>
                </div>

                <div class="mb-3">
                    <label for="nama_mahasiswa" class="form-label">Nama Mahasiswa</label>
                    <input type="text" class="form-control" id="nama_mahasiswa" name="nama_mahasiswa" value="{{ $tugasAkhir->nama_mahasiswa }}" required>
                </div>

                <div class="mb-3">
                    <label for="pembimbing1_id" class="form-label">Pembimbing 1</label>
                    <select class="form-control" id="pembimbing1_id" name="pembimbing1_id" required>
                        @foreach($dosens as $dosen)
                            <option value="{{ $dosen->id_dosen }}" {{
                            $dosen->id_dosen == $tugasAkhir->pembimbing1_id  ? 'selected' : '' }}>
                                {{ $dosen->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="pembimbing2_id" class="form-label">Pembimbing 2</label>
                    <select class="form-control" id="pembimbing2_id" name="pembimbing2_id">
                        <option value="">Pilih Pembimbing 2 (Opsional)</option>
                        @foreach($dosens as $dosen)
                            <option value="{{ $dosen->id_dosen }}" {{ $tugasAkhir->pembimbing2_id == $dosen->id_dosen ? 'selected' : '' }}>
                                {{ $dosen->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" class="form-control" id="judul" name="judul" value="{{ $tugasAkhir->judul }}" required>
                </div>

                {{-- <div class="mb-3">
                    <label for="dokumen_pkl" class="form-label">Upload Dokumen PKL</label>
                    <input type="file" class="form-control" id="dokumen" name="dokumen" required>
                </div> --}}

                <div class="mb-3">
                    <label for="tgl_pengajuan" class="form-label">Tanggal Pengajuan</label>
                    <input type="date" class="form-control" id="tgl_pengajuan" name="tgl_pengajuan" value="{{ $tugasAkhir->tgl_pengajuan }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
