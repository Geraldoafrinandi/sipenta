<table class="table table-ordered table-striped">
    <tr>
        <th>NIM</th>
        <th>Nama Mahasiswa</th>
        <th>Prodi</th>
        <th>Gender</th>
        <th>Angkatan</th>
        <th>Status Mahasiswa</th>
        <th>Aksi</th>
    </tr>
    @foreach ($mahasiswas as $mahasiswa)
        <tr>
            <td>{{ $mahasiswa->nim }}</td>
            <td>{{ $mahasiswa->nama_mahasiswa }}</td>
            <td>{{ $mahasiswa->prodi->nama_prodi}}</td>
            <td>{{ $mahasiswa->gender }}</td>
            <td>{{ $mahasiswa->angkatan }}</td>
            <td>{{ $mahasiswa->status_mahasiswa }}</td>
            <td>
                <form action="{{ route('admin.mahasiswa.edit', $mahasiswa->id) }}"  class="d-inline">
                    @method('UPDATE')
                    @csrf
                    <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Yakin akan mengedit data?')">Edit</button>
                </form>
                <!-- Form untuk menghapus data -->
                <form action="{{ route('mahasiswa.destroy', $mahasiswa->id) }}" method="POST" class="d-inline">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin akan menghapus data?')">Hapus</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
