@extends('admin.main')

@section('content')
<div class="container">
    <h1 class="mb-4">Detail Penilaian</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Tugas Akhir: {{ $penilaian->tugas_akhir->judul }}</h5>
            <p class="card-text"><strong>Jabatan Penilai:</strong> {{ $penilaian->jabatan }}</p>
            <p class="card-text"><strong>Pembimbing 1:</strong> {{ $penilaian->dosen->nama }}</p>
            <p class="card-text"><strong>Total Nilai:</strong> {{ $penilaian->total_nilai }}</p>

            <h6 class="mt-4">Detail Penilaian:</h6>
            <ul>
                <li>Presentasi - Sikap dan Penampilan: {{ $penilaian->presentasi_sikap_penampilan }}</li>
                <li>Presentasi - Komunikasi dan Sistematika: {{ $penilaian->presentasi_komunikasi_sistematika }}</li>
                <li>Presentasi - Penguasaan Materi: {{ $penilaian->presentasi_penguasaan_materi }}</li>
                <li>Makalah - Identifikasi Masalah: {{ $penilaian->makalah_identifikasi_masalah }}</li>
                <li>Makalah - Relevansi Teori: {{ $penilaian->makalah_relevansi_teori }}</li>
                <li>Makalah - Metode Algoritma: {{ $penilaian->makalah_metode_algoritma }}</li>
                <li>Makalah - Hasil dan Pembahasan: {{ $penilaian->makalah_hasil_pembahasan }}</li>
                <li>Makalah - Kesimpulan dan Saran: {{ $penilaian->makalah_kesimpulan_saran }}</li>
                <li>Makalah - Bahasa dan Tata Tulis: {{ $penilaian->makalah_bahasa_tata_tulis }}</li>
                <li>Produk - Kesesuaian Fungsional: {{ $penilaian->produk_kesesuaian_fungsional }}</li>
            </ul>

            <p class="card-text"><strong>Komentar:</strong> {{ $penilaian->komentar }}</p>
        </div>
    </div>

    <a href="{{ route('admin.penilaian.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    <a href="{{ route('admin.penilaian.edit', $penilaian->id) }}" class="btn btn-warning mt-3">Edit</a>
</div>
@endsection
