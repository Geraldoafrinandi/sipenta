@extends('admin.main')

@section('title', 'Tambah Tugas Akhir')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tambah Tugas Akhir Baru</h1>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('tugas_akhir.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="nim" class="form-label">NIM</label>
                    <input type="text" class="form-control" id="nim" name="nim" required>
                </div>

                <div class="mb-3">
                    <label for="pembimbing1" class="form-label">Pembimbing 1</label>
                    <input type="text" class="form-control" id="pembimbing1" name="pembimbing1" required>
                </div>

                <div class="mb-3">
                    <label for="pembimbing2" class="form-label">Pembimbing 2</label>
                    <input type="text" class="form-control" id="pembimbing2" name="pembimbing2" required>
                </div>

                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" class="form-control" id="judul" name="judul" required>
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
