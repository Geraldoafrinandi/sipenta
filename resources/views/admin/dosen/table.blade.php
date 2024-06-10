<table class="table table-ordered table-striped">
    <tr>
        <th>Nama Dosen</th>
        <th>NIDN</th>
        <th>Gender</th>
        <th>Prodi</th>
        <th>Email</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    @foreach ($dosens as $dosen)
        <tr>
            <td>{{ $dosen->nama }}</td>
            <td>{{ $dosen->nidn }}</td>
            <td>{{ $dosen->gender }}</td>
            <td>{{ $dosen->prodi->nama_prodi }}</td>
            <td>{{ $dosen->email }}</td>
            <td>{{ $dosen->status }}</td>
            <td>
                <form action="{{ route('admin.dosen.edit', $dosen->id_dosen) }}" class="d-inline">
                    @method('UPDATE')
                    @csrf
                    <button type="submit" class="btn btn-success btn-sm"
                        onclick="return confirm('Yakin akan mengedit data?')">Edit</button>
                </form>

                <form action="{{ route('dosen.destroy', $dosen->id_dosen) }}" method="POST" class="d-inline">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm"
                        onclick="return confirm('Yakin akan menghapus data?')">Hapus</button>
                </form>

            </td>
        </tr>
    @endforeach
</table>

