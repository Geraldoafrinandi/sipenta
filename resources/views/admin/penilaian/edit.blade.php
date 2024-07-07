@extends('admin.main')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Penilaian</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.penilaian.update', $penilaian->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3 mt-4">
            <label for="ta_id" class="form-label">Tugas Akhir</label>
            <select name="ta_id" id="ta_id" class="form-control" required>
                @foreach ($tugasAkhirs as $tugasAkhir)
                    <option value="{{ $tugasAkhir->id_ta }}" {{ $penilaian->ta_id == $tugasAkhir->id_ta ? 'selected' : '' }}>
                        {{ $tugasAkhir->judul }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Jabatan</label>
            <select class="form-control @error('jabatan') is-invalid @enderror" id="jabatan" name="jabatan">
                <option value="jabatan">Pilih Jabatan</option>
                <option value="Pembimbing1" {{ $penilaian->jabatan == 'Pembimbing1' ? 'selected' : '' }}>Pembimbing 1</option>
                <option value="Pembimbing2" {{ $penilaian->jabatan == 'Pembimbing2' ? 'selected' : '' }}>Pembimbing 2</option>
                <option value="KetuaSidang" {{ $penilaian->jabatan == 'KetuaSidang' ? 'selected' : '' }}>Ketua Sidang</option>
                <option value="SekretarisSidang" {{ $penilaian->jabatan == 'SekretarisSidang' ? 'selected' : '' }}>Sekretaris Sidang</option>
                <option value="Penguji1" {{ $penilaian->jabatan == 'Penguji1' ? 'selected' : '' }}>Penguji 1</option>
                <option value="Penguji2" {{ $penilaian->jabatan == 'Penguji2' ? 'selected' : '' }}>Penguji 2</option>
            </select>
            @error('jabatan')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="pembimbing1_id">Dosen</label>
            <select name="pembimbing1_id" id="pembimbing1_id" class="form-control" required>
                <option value="" disabled>Pilih Dosen</option>
                @foreach ($dosens as $dosen)
                    <option value="{{ $dosen->id_dosen }}" {{ $penilaian->pembimbing1_id == $dosen->id_dosen ? 'selected' : '' }}>
                        {{ $dosen->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Form untuk memasukkan nilai penilaian -->
        <div class="form-group">
            <!-- Presentasi -->
            <div class="form-group mb-3">
                <b><p>1. Presentasi</p></b>
                <label for="presentasi_sikap_penampilan">a. Sikap dan Penampilan:</label>
                <input type="number" name="presentasi_sikap_penampilan" id="presentasi_sikap_penampilan"
                    class="form-control" min="0" max="100" value="{{ $penilaian->presentasi_sikap_penampilan }}">

                <label for="presentasi_komunikasi_sistematika">b. Komunikasi dan Sistematika:</label>
                <input type="number" name="presentasi_komunikasi_sistematika" id="presentasi_komunikasi_sistematika"
                    class="form-control" min="0" max="100" value="{{ $penilaian->presentasi_komunikasi_sistematika }}">

                <label for="presentasi_penguasaan_materi">c. Penguasaan Materi:</label>
                <input type="number" name="presentasi_penguasaan_materi" id="presentasi_penguasaan_materi"
                    class="form-control" min="0" max="100" value="{{ $penilaian->presentasi_penguasaan_materi }}">
            </div>

            <!-- Makalah -->
            <div class="form-group mb-3">
                <b><p>2. Makalah</p></b>
                <label for="makalah_identifikasi_masalah">a. Identifikasi Masalah, Tujuan dan Kontribusi Penelitian:</label>
                <input type="number" name="makalah_identifikasi_masalah" id="makalah_identifikasi_masalah"
                    class="form-control" min="0" max="100" value="{{ $penilaian->makalah_identifikasi_masalah }}">

                <label for="makalah_relevansi_teori">b. Relevansi Teori/Referensi Pustaka dan Konsep dengan Masalah Penelitian:</label>
                <input type="number" name="makalah_relevansi_teori" id="makalah_relevansi_teori" class="form-control"
                    min="0" max="100" value="{{ $penilaian->makalah_relevansi_teori }}">

                <label for="makalah_metode_algoritma">c. Metode Algoritma yang Digunakan:</label>
                <input type="number" name="makalah_metode_algoritma" id="makalah_metode_algoritma" class="form-control"
                    min="0" max="100" value="{{ $penilaian->makalah_metode_algoritma }}">

                <label for="makalah_hasil_pembahasan">d. Hasil dan Pembahasan:</label>
                <input type="number" name="makalah_hasil_pembahasan" id="makalah_hasil_pembahasan" class="form-control"
                    min="0" max="100" value="{{ $penilaian->makalah_hasil_pembahasan }}">

                <label for="makalah_kesimpulan_saran">e. Kesimpulan dan Saran:</label>
                <input type="number" name="makalah_kesimpulan_saran" id="makalah_kesimpulan_saran" class="form-control"
                    min="0" max="100" value="{{ $penilaian->makalah_kesimpulan_saran }}">

                <label for="makalah_bahasa_tata_tulis">f. Penggunaan Bahasa dan Tata Tulis:</label>
                <input type="number" name="makalah_bahasa_tata_tulis" id="makalah_bahasa_tata_tulis"
                    class="form-control" min="0" max="100" value="{{ $penilaian->makalah_bahasa_tata_tulis }}">
            </div>

            <!-- Produk -->
            <div class="form-group mb-3">
                <b><p>3. Produk</p></b>
                <label for="produk_kesesuaian_fungsional">a. Kesesuaian Fungsional Sistem:</label>
                <input type="number" name="produk_kesesuaian_fungsional" id="produk_kesesuaian_fungsional"
                    class="form-control" min="0" max="100" value="{{ $penilaian->produk_kesesuaian_fungsional }}">
            </div>
        </div>

        <div class="form-group d-flex align-items-center mb-3">
            <button type="button" class="btn btn-primary mr-3" onclick="hitungTotal()">Hitung Total</button>
            <span id="totalNilai" class="border border-4 p-2">{{ $penilaian->total_nilai }}</span>
            <input type="hidden" name="total_nilai" id="inputTotalNilai" value="{{ $penilaian->total_nilai }}">
        </div>

        <div class="form-group mb-3">
            <b><label for="komentar">Komentar:</label></b>
            <textarea name="komentar" id="komentar" class="form-control" rows="3">{{ $penilaian->komentar }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('admin.penilaian.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>

<script>
    function hitungTotal() {
        // Ambil nilai dari setiap input
        const presentasi_sikap_penampilan = parseFloat(document.getElementById('presentasi_sikap_penampilan').value) || 0;
        const presentasi_komunikasi_sistematika = parseFloat(document.getElementById('presentasi_komunikasi_sistematika').value) || 0;
        const presentasi_penguasaan_materi = parseFloat(document.getElementById('presentasi_penguasaan_materi').value) || 0;
        const makalah_identifikasi_masalah = parseFloat(document.getElementById('makalah_identifikasi_masalah').value) || 0;
        const makalah_relevansi_teori = parseFloat(document.getElementById('makalah_relevansi_teori').value) || 0;
        const makalah_metode_algoritma = parseFloat(document.getElementById('makalah_metode_algoritma').value) || 0;
        const makalah_hasil_pembahasan = parseFloat(document.getElementById('makalah_hasil_pembahasan').value) || 0;
        const makalah_kesimpulan_saran = parseFloat(document.getElementById('makalah_kesimpulan_saran').value) || 0;
        const makalah_bahasa_tata_tulis = parseFloat(document.getElementById('makalah_bahasa_tata_tulis').value) || 0;
        const produk_kesesuaian_fungsional = parseFloat(document.getElementById('produk_kesesuaian_fungsional').value) || 0;

        // Hitung total nilai berdasarkan bobot
        const totalNilai =
            (presentasi_sikap_penampilan * 0.05) +
            (presentasi_komunikasi_sistematika * 0.05) +
            (presentasi_penguasaan_materi * 0.20) +
            (makalah_identifikasi_masalah * 0.05) +
            (makalah_relevansi_teori * 0.05) +
            (makalah_metode_algoritma * 0.10) +
            (makalah_hasil_pembahasan * 0.15) +
            (makalah_kesimpulan_saran * 0.05) +
            (makalah_bahasa_tata_tulis * 0.05) +
            (produk_kesesuaian_fungsional * 0.25);

        // Tampilkan total nilai
        document.getElementById('totalNilai').innerText = totalNilai.toFixed(2);
        document.getElementById('inputTotalNilai').value = totalNilai.toFixed(2);
    }
</script>
@endsection
