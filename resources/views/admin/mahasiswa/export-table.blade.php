<table>
    <thead>
        <tr>
            <th>NIM</th>
            <th>Nama Mahasiswa</th>
            <th>Prodi ID</th>
            <th>Gender</th>
            <th>Angkatan</th>
            <th>Status Mahasiswa</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($mahasiswas as $mahasiswa)
            <tr>
                <td>{{ $mahasiswa->nim }}</td>
                <td>{{ $mahasiswa->nama_mahasiswa }}</td>
                <td>{{ $mahasiswa->prodi_id }}</td>
                <td>{{ $mahasiswa->gender }}</td>
                <td>{{ $mahasiswa->angkatan }}</td>
                <td>{{ $mahasiswa->status_mahasiswa }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
