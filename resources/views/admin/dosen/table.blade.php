<div class="container">

    <form action="{{ route('admin.dosen.index') }}" method="GET" class="mb-3 border p-3 rounded">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari nama dosen...">
            <button type="submit" class="btn btn-primary">Cari</button>
        </div>
    </form>

    <table class="table table-ordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Dosen</th>
                <th>NIDN</th>
                <th>Gender</th>
                <th>Prodi</th>
                <th>Email</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dosens as $dosen)
                <tr>
                    <td>{{ $loop->iteration }}</td>
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

                        <form action="{{ route('admin.dosen.destroy', $dosen->id_dosen) }}" method="POST" class="d-inline">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin akan menghapus data?')">Hapus</button>
                        </form>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
