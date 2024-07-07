<!-- resources/views/admin/validasi_proposal/edit.blade.php -->

@extends('admin.main')

@section('content')
<div class="container">
    <h2 class="mb-5" >Edit Validasi Proposal</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('validasi_proposal.update', $validasiProposal->id_validasiProposal) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="mahasiswa_id">Mahasiswa ID</label>
            <select name="mahasiswa_id" id="mahasiswa_id" class="form-control">
                @foreach($tugasAkhirs as $tugasAkhir)
                    <option value="{{ $tugasAkhir->nim }}" {{ $validasiProposal->mahasiswa_id == $tugasAkhir->nim ? 'selected' : '' }}>{{ $tugasAkhir->nim }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="ta_id">TA ID</label>
            <select name="ta_id" id="ta_id" class="form-control">
                @foreach($tugasAkhirs as $tugasAkhir)
                    <option value="{{ $tugasAkhir->id_ta }}" {{ $validasiProposal->ta_id == $tugasAkhir->id_ta ? 'selected' : '' }}>{{ $tugasAkhir->id_ta }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="status_validasi">Status Validasi</label>
            <select name="status_validasi" id="status_validasi" class="form-control">
                <option value="Valid" {{ $validasiProposal->status_validasi == 'Valid' ? 'selected' : '' }}>Valid</option>
                <option value="Tidak Valid" {{ $validasiProposal->status_validasi == 'Tidak Valid' ? 'selected' : '' }}>Tidak Valid</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="tanggal_validasi">Tanggal Validasi</label>
            <input type="date" name="tanggal_validasi" id="tanggal_validasi" class="form-control" value="{{ $validasiProposal->tanggal_validasi }}">
        </div>

        <div class="mb-3">
            <label for="catatan">Catatan</label>
            <textarea name="catatan" id="catatan" class="form-control">{{ $validasiProposal->catatan }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
