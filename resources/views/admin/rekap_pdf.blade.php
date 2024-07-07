<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Berita Acara Sidang</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 0.5cm 1.5cm 1cm 1.5cm;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .details {
            margin-top: 15px;
            margin-bottom: 20px;
        }

        .details p {
            margin: 0;
            line-height: 1.6;
        }

        .details .label {
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            page-break-inside: auto;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }

        .table-info th {
            text-align: center;
            padding: 8px;
            background-color: #f2f2f2;
        }

        .table-info tr {
            padding: 18px; /* Tambahkan padding pada setiap baris */
        }

        .table-info td {
            text-align: center;
            padding: 8px;
        }

        .signatures {
            display: flex;
            justify-content: flex-end;
            margin-top: 40px;
            page-break-inside: avoid;
        }

        .signatures .left{
            text-align: right;
        }

        .signatures .center,
        .signatures .right {
            width: 30%;
            text-align: center;
            border: none;
            page-break-inside: avoid;
        }

        .signatures .center {
            width: 40%;
            margin-top: 20px;
        }

        .signatures .center p {
            margin-bottom: 60px;
            page-break-after: avoid;
        }

        .kepala {
            margin: 0;
            padding: 0;
            width: 100%;
            border-spacing: 0;
        }

        .kepala td {
            padding: 0;
        }
    </style>
</head>

<body>

    <div class="kepala">
        <table style="width: 100%;">
            <tr>
                <td colspan="1" style="text-align: center;">
                    <div style="display: flex; justify-content: center; bottom: 40px; padding-top: 20px">
                    <img src="{{ public_path('landing_page/images/logoPNP.png') }}" alt="Logo" style="max-width: 90%;" />
                    </div>
                </td>
                <td colspan="1">
                    <b>
                    <center>
                        <font style="font-size: 17px; bold">KEMENTRIAN PENDIDIKAN, KEBUDAYAAN,</font><br>
                        <font style="font-size: 17px;">RISET, DAN TEKNOLOGI</font><br>
                        <font style="font-size: 15px;">POLITEKNIK NEGERI PADANG</font><br>
                        <font style="font-size: 15px;">PUSAT PENINGKATAN DAN PENGEMBANGAN AKTIVITAS INSTITUSIONAL</font><br>
                        <font style="font-size: 13px;">(P3AI)</font><br>
                        <font style="font-size: 15px;">FORMULIR</font><br>
                    </center>
                    <center>
                        <font style="font-size: 15px;">VERIFIKASI RENCANA PEMBELAJARAN SEMESTER</font><br>
                        <font style="font-size: 15px;">JURUSAN : TEKNOLOGI INFORMASI PROGRAM STUDI : TRPL</font><br>
                    </center>
                </b>
                </td>
            </tr>
        </table>
    </div>

    <div class="details">
        <h1 style="text-align: center">Rekap Nilai Sidang</h1>
        <p><b>Judul Tugas Akhir : </b>{{ $sidang->tugas_akhir->judul ?? '-' }}</p>
        <p><b>Nama Mahasiswa: </b>{{ $sidang->tugas_akhir->nama_mahasiswa }} - {{ $sidang->tugas_akhir->nim }}</p>
    </div>

    <table>
        <thead>
            <tr class="table-info">
                <th>Nama Dosen</th>
                <th>Jabatan</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $sidang->pembimbing1->nama ?? '-' }}</td>
                <td>Pembimbing 1</td>
                <td>{{ $totalNilaiPembimbing1 ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>{{ $sidang->pembimbing2->nama ?? '-' }}</td>
                <td>Pembimbing 2</td>
                <td>{{ $totalNilaiPembimbing2 ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>{{ $sidang->ketuaSidang->nama ?? '-' }}</td>
                <td>Ketua Sidang</td>
                <td>{{ $totalNilaiKetua ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>{{ $sidang->penguji1->nama ?? '-' }}</td>
                <td>Penguji 1</td>
                <td>{{ $totalNilaiPenguji1 ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>{{ $sidang->penguji2->nama ?? '-' }}</td>
                <td>Penguji 2</td>
                <td>{{ $totalNilaiPenguji2 ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>{{ $sidang->sekretaris->nama ?? '-' }}</td>
                <td>Sekretaris</td>
                <td>{{ $totalNilaiSekretaris ?? 'N/A' }}</td>
            </tr>
        </tbody>
    </table>

    <p>Total Nilai Rata-rata: <b>{{ $rataRata }}</b></p>
    <p>Status Sidang: <b>{{ $statusSidang }}</b></p>

    <div class="signatures">
        <div class="left">
            <p style="margin-right: 45px">Mengetahui</p>
            <br><br><br><br>
            <p>Ronal Hadi, S.T., M.Kom</p>
        </div>
    </div>
</body>
</html>
