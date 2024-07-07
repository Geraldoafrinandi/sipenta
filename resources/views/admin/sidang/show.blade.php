@extends('admin.main')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mt-3">
            <h1 class="h2">Berita Acara Sidang</h1>
        </div>

        <div class="mt-4">
            <h2>Informasi Sidang</h2>
            <p><strong>Judul Tugas Akhir:</strong> {{ $sidang->tugas_akhir->judul ?? '-' }}</p>
            <p><strong>NIM Mahasiswa:</strong> {{ $sidang->tugas_akhir->nim ?? '-' }}</p>
            <p><strong>Nama Mahasiswa:</strong> {{ $sidang->tugas_akhir->nama_mahasiswa ?? '-' }}</p>
            <p><strong>Pembimbing 1:</strong> {{ $sidang->pembimbing1_id->nama ?? '-' }}</p>
            <p><strong>Pembimbing 2:</strong> {{ $sidang->pembimbing2_id->nama ?? '-' }}</p>
            <p><strong>Ketua Sidang:</strong> {{ $sidang->ketuaSidang->nama ?? '-' }}</p>
            <p><strong>Penguji 1:</strong> {{ $sidang->penguji1->nama ?? '-' }}</p>
            <p><strong>Penguji 2:</strong> {{ $sidang->penguji2->nama ?? '-' }}</p>
            <p><strong>Sekretaris:</strong> {{ $sidang->sekretaris->nama ?? '-' }}</p>
            <p><strong>Ruangan:</strong> {{ $sidang->ruangan->no_ruangan ?? '-' }}</p>
            <p><strong>Jam Sidang:</strong> {{ $sidang->ruangan->jam_sidang ?? '-' }}</p>
            <p><strong>Tanggal Sidang:</strong> {{ \Carbon\Carbon::parse($sidang->tanggal)->format('d-m-Y') }}</p>
            <p><strong>Status Sidang:</strong> {{ $sidang->status_sidang ?? '-' }}</p>
            <p><strong>Total Nilai:</strong> {{ $sidang->total_nilai }}</p>

            <hr>

            <h2>Hasil Penilaian</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Jabatan</th>
                        <th>Nama</th>
                        <th>Nilai</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Pembimbing 1</td>
                        <td>{{ $sidang->pembimbing1_id->nama ?? '-' }}</td>
                        <td>{{ $penilaianPembimbing1 ? $penilaianPembimbing1->total_nilai : 'N/A' }}</td>
                        <td>{{ $penilaianPembimbing1 ? $penilaianPembimbing1->keterangan : '-' }}</td>
                    </tr>
                    <tr>
                        <td>Pembimbing 2</td>
                        <td>{{ $sidang->pembimbing2_id->nama ?? '-' }}</td>
                        <td>{{ $penilaianPembimbing2 ? $penilaianPembimbing2->total_nilai : 'N/A' }}</td>
                        <td>{{ $penilaianPembimbing2 ? $penilaianPembimbing2->keterangan : '-' }}</td>
                    </tr>
                    <tr>
                        <td>Ketua Sidang</td>
                        <td>{{ $sidang->ketuaSidang->nama ?? '-' }}</td>
                        <td>{{ $penilaianKetuaSidang ? $penilaianKetuaSidang->total_nilai : 'N/A' }}</td>
                        <td>{{ $penilaianKetuaSidang ? $penilaianKetuaSidang->keterangan : '-' }}</td>
                    </tr>
                    <tr>
                        <td>Penguji 1</td>
                        <td>{{ $sidang->penguji1->nama ?? '-' }}</td>
                        <td>{{ $penilaianPenguji1 ? $penilaianPenguji1->total_nilai : 'N/A' }}</td>
                        <td>{{ $penilaianPenguji1 ? $penilaianPenguji1->keterangan : '-' }}</td>
                    </tr>
                    <tr>
                        <td>Penguji 2</td>
                        <td>{{ $sidang->penguji2->nama ?? '-' }}</td>
                        <td>{{ $penilaianPenguji2 ? $penilaianPenguji2->total_nilai : 'N/A' }}</td>
                        <td>{{ $penilaianPenguji2 ? $penilaianPenguji2->keterangan : '-' }}</td>
                    </tr>
                    <tr>
                        <td>Sekretaris</td>
                        <td>{{ $sidang->sekretaris->nama ?? '-' }}</td>
                        <td>{{ $penilaianSekretaris ? $penilaianSekretaris->total_nilai : 'N/A' }}</td>
                        <td>{{ $penilaianSekretaris ? $penilaianSekretaris->keterangan : '-' }}</td>
                    </tr>
                </tbody>
            </table>

            <hr>

            <p><strong>Rata-Rata Nilai:</strong> {{ $rataRata }}</p>
        </div>
    </div>
@endsection
