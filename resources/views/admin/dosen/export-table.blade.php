<table>
    <thead>
        <tr>
            <th>Nama Dosen</th>
            <th>NIDN</th>
            <th>Gender</th>
            <th>Prodi ID</th>
            <th>Email</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dosens as $dosen)
            <tr>
                <td>{{ $dosen->nama }}</td>
                <td>{{ $dosen->nidn }}</td>
                <td>{{ $dosen->gender }}</td>
                <td>{{ $dosen->prodi_id }}</td>
                <td>{{ $dosen->email }}</td>
                <td>{{ $dosen->status }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
