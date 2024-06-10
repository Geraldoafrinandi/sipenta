@extends('admin.main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Mahasiswa</h1>
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
            <form action="{{ route('admin.mahasiswa.update', $mahasiswa->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="nim">NIM</label>
                    <input type="text" class="form-control" id="nim" name="nim" value="{{ $mahasiswa->nim }}"
                        required>
                </div>
                <div class="form-group mb-3">
                    <label for="nama_mahasiswa">Nama Mahasiswa</label>
                    <input type="text" class="form-control" id="nama_mahasiswa" name="nama_mahasiswa"
                        value="{{ $mahasiswa->nama_mahasiswa }}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="prodi_id">Program Studi</label>
                    <select class="form-control" id="prodi_id" name="prodi_id" required>
                        @foreach ($prodis as $prodi)
                            <option value="{{ $prodi->id_prodi }}"
                                {{ $mahasiswa->prodi_id == $prodi->id_prodi ? 'selected' : '' }}>{{ $prodi->nama_prodi }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="gender">Jenis Kelamin</label>
                    <select class="form-control" id="gender" name="gender" required>
                        <option value="Laki-laki" {{ $mahasiswa->gender == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                        </option>
                        <option value="Perempuan" {{ $mahasiswa->gender == 'Perempuan' ? 'selected' : '' }}>Perempuan
                        </option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="angkatan">Angkatan</label>
                    <input type="text" class="form-control" id="angkatan" name="angkatan"
                        value="{{ $mahasiswa->angkatan }}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="status_mahasiswa">Status Mahasiswa</label>
                    <input type="text" class="form-control" id="status_mahasiswa" name="status_mahasiswa"
                        value="{{ $mahasiswa->status_mahasiswa }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>
@endsection
