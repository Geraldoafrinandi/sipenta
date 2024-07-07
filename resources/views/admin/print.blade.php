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
            justify-content: space-between;
            margin-top: 40px;
            page-break-inside: avoid;
        }

        .signatures .left,
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
        <p>Telah dilaksanakan Sidang Mahasiswa tingkat 4 Jurusan Teknologi Informasi pada :</p>
        <p>Hari / Tanggal : Selasa / 14 Februari 2023</p>
        <p>Tempat : Ruang TUK / E305</p>
        <p>Dengan hasil sebagai berikut :</p>
    </div>

    <table>
        <thead>
            <tr class="table-info">
                <th>Judul Tugas Akhir</th>
                <th>Nama Mahasiswa</th>
                <th>Ketua Sidang</th>
                <th>Penguji 1</th>
                <th>Penguji 2</th>
                <th>Sekretaris Sidang</th>
                <th>Ruangan</th>
                <th>Jam Sidang</th>
                <th>Tanggal Sidang</th>
                <th>Status Sidang</th>
                <th>Rata-rata Nilai</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $sidang->tugas_akhir->judul ?? '-' }}</td>
                <td>{{ optional($sidang->tugas_akhir->mahasiswa)->nama_mahasiswa ?? '-' }}</td>
                <td>{{ optional($sidang->ketuaSidang)->nama ?? '-' }}</td>
                <td>{{ optional($sidang->penguji1)->nama ?? '-' }}</td>
                <td>{{ optional($sidang->penguji2)->nama ?? '-' }}</td>
                <td>{{ optional($sidang->sekretaris)->nama ?? '-' }}</td>
                <td>{{ optional($sidang->ruangan)->no_ruangan ?? '-' }}</td>
                <td>{{ optional($sidang->ruangan)->jam_sidang ?? '-' }}</td>
                <td>{{ \Carbon\Carbon::parse($sidang->tanggal)->format('d-m-Y') }}</td>
                <td>{{ $sidang->status_sidang ?? '-' }}</td>
                <td>{{ $sidang->rataRata ?? '-' }}</td>
            </tr>
        </tbody>
    </table>

    <div class="signatures">
        <table>
            <tr>
                <td class="left">
                    <p>Kepala Program Studi Teknologi Rekayasa Perangkat lunak</p>
                    <br><br><br><br>
                    <p>Meri Azmi, ST., M.Cs</p>
                </td>
            </tr>
        </table>
    </div>

    <div class="signatures">
        <div class="right">
            <p>Mengetahui</p>
            <br><br><br><br>
            <p>Ronal Hadi, S.T., M.Kom</p>
        </div>
    </div>

</body>

</html>
