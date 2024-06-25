@extends('admin.main')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mt-3">
            <h1 class="h2">Validasi TA</h1>
        </div>
        <a href="{{ route('validasi_ta.create') }}" class="btn btn-primary">Tambah Validasi</a>
        <div class="table-responsive mt-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Mahasiswa</th>
                        <th>Tugas Akhir</th>
                        <th>Status</th>
                        <th>Tanggal Validasi</th>
                        <th>Catatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($validasiTas as $validasiTa)
                        <tr>
                            <td>{{ $validasiTa->mahasiswa->nim }} - {{ $validasiTa->mahasiswa->nama_mahasiswa }}</td>
                            <td>{{ $validasiTa->tugasAkhir->judul }}</td>
                            <td>{{ $validasiTa->status_validasi }}</td>
                            <td>{{ $validasiTa->tanggal_validasi }}</td>
                            <td>{{ $validasiTa->catatan ?? '-'}}</td>
                            <td>
                                <a href="{{ route('validasi_ta.show', $validasiTa->id_validasi) }}"
                                    class="btn btn-info">Lihat</a>
                                <a href="{{ route('validasi_ta.edit', $validasiTa->id_validasi) }}"
                                    class="btn btn-warning">Edit</a>
                                <form action="{{ route('validasi_ta.destroy', $validasiTa->id_validasi) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
