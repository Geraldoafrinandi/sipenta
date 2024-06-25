@extends('admin.main')

@section('title', 'Tambah Tugas Akhir')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tambah Tugas Akhir Baru</h1>
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
            <form action="{{ route('tugas_akhir.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="nim" class="form-label">NIM</label>
                    <input type="text" class="form-control" id="nim" name="nim" required>
                </div>

                <div class="mb-3">
                    <label for="pembimbing1_id" class="form-label">Pembimbing 1</label>
                    <select class="form-select" id="pembimbing1_id" name="pembimbing1_id" required>
                        <option value="">Pilih Pembimbing 1</option>
                        @foreach ($dosens as $dosen)
                            <option value="{{ $dosen->id_dosen }}">{{ $dosen->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="pembimbing2_id" class="form-label">Pembimbing 2</label>
                    <select class="form-select" id="pembimbing2_id" name="pembimbing2_id">
                        <option value="">Pilih Pembimbing 2</option>
                        @foreach ($dosens as $dosen)
                            <option value="{{ $dosen->id_dosen }}">{{ $dosen->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" class="form-control" id="judul" name="judul" required>
                </div>

                <div class="mb-3">
                    <label for="dokumen" class="form-label">Upload Dokumen</label>
                    <input type="file" class="form-control" id="dokumen" name="dokumen" required>
                </div>

                <div class="mb-3">
                    <label for="tgl_pengajuan" class="form-label">Tanggal Pengajuan</label>
                    <input type="date" class="form-control" id="tgl_pengajuan" name="tgl_pengajuan" required>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
