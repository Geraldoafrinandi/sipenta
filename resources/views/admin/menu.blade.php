<!DOCTYPE html>
<html>
<head>
    <title>Menu</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
</head>
<body>
    <nav>
        <ul>
            <!-- Menu Umum -->
            <li><a href="/dashboard">Dashboard</a></li>

            <!-- Menu untuk Mahasiswa -->
            @can('isMahasiswa')
                <li><a href="/tugas_akhir">Tugas Akhir</a></li>
                <li><a href="/dashboard">Dashboard</a></li>
            @endcan

            <!-- Menu untuk Admin -->
            @can('isAdmin')
                <li><a href="/admin-panel">Panel Admin</a></li>
            @endcan

            <!-- Menu untuk Dosen -->
            @can('isDosen')
                <li><a href="/dosen-panel">Panel Dosen</a></li>
            @endcan

            <!-- Menu untuk Kaprodi -->
            @can('isKaprodi')
                <li><a href="/kaprodi-panel">Panel Kaprodi</a></li>
            @endcan
        </ul>
    </nav>
</body>
</html>
