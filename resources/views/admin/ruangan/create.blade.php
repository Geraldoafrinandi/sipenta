@extends('admin.main')

@section('title', 'Create Ruangan')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tambah Ruangan Baru</h1>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.ruangan.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="no_ruangan" class="form-label">Nomor Ruangan</label>
                    <input type="text" class="form-control @error('no_ruangan') is-invalid @enderror" id="no_ruangan" name="no_ruangan" value="{{ old('no_ruangan') }}" required>
                    @error('no_ruangan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="jam_sidang" class="form-label">Jam Sidang</label>
                    <select class="form-select @error('jam_sidang') is-invalid @enderror" id="jam_sidang" name="jam_sidang" required>
                        <option value="">Pilih Jam Sidang</option>
                        <option value="08:00-10:00" {{ old('jam_sidang') == '08:00-10:00' ? 'selected' : '' }}>08:00 - 10:00</option>
                        <option value="10:00-12:00" {{ old('jam_sidang') == '10:00-12:00' ? 'selected' : '' }}>10:00 - 12:00</option>
                        <option value="13:00-15:00" {{ old('jam_sidang') == '13:00-15:00' ? 'selected' : '' }}>13:00 - 15:00</option>
                        <option value="15:00-17:00" {{ old('jam_sidang') == '15:00-17:00' ? 'selected' : '' }}>15:00 - 17:00</option>
                    </select>
                    @error('jam_sidang')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="tanggal_sidang">Tanggal Sidang</label>
                    <input type="date" class="form-control" id="tanggal_sidang" name="tanggal_sidang">
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.ruangan.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection
