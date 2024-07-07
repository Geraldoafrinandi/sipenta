@extends('admin.main')
@section('title', 'Validasi Proposal')
@section('navMhs', 'active')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Validasi Proposal</h1>
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

    <form action="{{ route('validasi_proposal.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="judul">Judul Proposal</label>
            <input type="text" class="form-control" id="judul" value="{{ $judul }}" readonly>
        </div>
        <div class="mb-3">
            <label for="nim">NIM</label>
            <input type="text" class="form-control" id="nim" name="mahasiswa_id" value="{{ $nim }}" readonly>
        </div>
        <div class="mb-3">
            <label for="nama_mahasiswa">Nama Mahasiswa</label>
            <input type="text" class="form-control" id="nama_mahasiswa" value="{{ $namaMahasiswa }}" readonly>
        </div>
        <div class="" hidden>
            <label for="ta_id"></label>
            <input type="hidden" class="form-control" id="ta_id" name="ta_id" value="{{ $taId }}" readonly>
        </div>
        <div class="mb-3">
            <label for="status_validasi">Status Validasi</label>
            <select class="form-control" id="status_validasi" name="status_validasi" required>
                <option value="Valid">Valid</option>
                <option value="Tidak Valid">Tidak Valid</option>
                <option value="Pending">Pending</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="tanggal_validasi">Tanggal Validasi</label>
            <input type="date" class="form-control" id="tanggal_validasi" name="tanggal_validasi" required>
        </div>
        <div class="mb-3">
            <label for="catatan">Catatan</label>
            <textarea class="form-control" id="catatan" name="catatan" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection
