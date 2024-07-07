@extends('admin.main')

@section('content')
    <div class="container">
        <h1 class="mb-4">Tambah Penilaian</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.penilaian.store') }}" method="POST">
            @csrf
            <div class="mb-3 mt-4">
                <label for="ta_id" class="form-label">Tugas Akhir</label>
                <select name="ta_id" id="ta_id" class="form-control" required>
                    <option value="" disabled selected>Pilih Tugas Akhir</option>
                @foreach ($tugasAkhirs as $tugasAkhir)
                <option value="{{ $tugasAkhir->id_ta }}"
                        data-pembimbing1-id="{{ $tugasAkhir->pembimbing1_id }}"
                        data-pembimbing1-nama="{{ $tugasAkhir->pembimbing1->nama ?? '' }}"
                        data-pembimbing2-id="{{ $tugasAkhir->pembimbing2_id }}"
                        data-pembimbing2-nama="{{ $tugasAkhir->pembimbing2->nama ?? '' }}"
                        data-penguji1-id="{{ $tugasAkhir->sidang->penguji1_id ?? '' }}"
                        data-penguji1-nama="{{ $tugasAkhir->sidang->penguji1->nama ?? '' }}"
                        data-penguji2-id="{{ $tugasAkhir->sidang->penguji2_id ?? '' }}"
                        data-penguji2-nama="{{ $tugasAkhir->sidang->penguji2->nama ?? '' }}"
                        data-sekretaris-id="{{ $tugasAkhir->sidang->sekretaris_id ?? '' }}"
                        data-sekretaris-nama="{{ $tugasAkhir->sidang->sekretaris->nama ?? '' }}">
                    {{ $tugasAkhir->judul }}
                </option>
                @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Jabatan</label>
                <select class="form-control @error('jabatan') is-invalid @enderror" id="jabatan" name="jabatan">
                    <option value="">Pilih Jabatan</option>
                    <option value="Pembimbing1">Pembimbing 1</option>
                    <option value="Pembimbing2">Pembimbing 2</option>
                    <option value="KetuaSidang">Ketua Sidang</option>
                    <option value="Penguji1">Penguji 1</option>
                    <option value="Penguji2">Penguji 2</option>
                    <option value="SekretarisSidang">Sekretaris</option>
                </select>
                @error('jabatan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="nilai_dosen" class="form-label">Dosen</label>
                <select name="nilai_dosen" id="nilai_dosen" class="form-control" required>
                    <option value="" disabled selected>Pilih Dosen</option>
                    @foreach ($dosens as $dosen)
                        <option value="{{ $dosen->id_dosen }}">
                            {{ $dosen->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Form untuk memasukkan nilai penilaian -->
            <div class="form-group">
                <!-- Presentasi -->
                <div class="form-group mb-3">
                    <b>
                        <p>1. Presentasi</p>
                    </b>
                    <label for="presentasi_sikap_penampilan">a. Sikap dan Penampilan:</label>
                    <input type="number" name="presentasi_sikap_penampilan" id="presentasi_sikap_penampilan"
                        class="form-control nilai" min="0" max="100" required>

                    <label for="presentasi_komunikasi_sistematika">b. Komunikasi dan Sistematika:</label>
                    <input type="number" name="presentasi_komunikasi_sistematika" id="presentasi_komunikasi_sistematika"
                        class="form-control nilai" min="0" max="100" required>

                    <label for="presentasi_penguasaan_materi">c. Penguasaan Materi:</label>
                    <input type="number" name="presentasi_penguasaan_materi" id="presentasi_penguasaan_materi"
                        class="form-control nilai" min="0" max="100" required>
                </div>

                <!-- Makalah -->
                <div class="form-group mb-3">
                    <b>
                        <p>2. Makalah</p>
                    </b>
                    <label for="makalah_identifikasi_masalah">a. Identifikasi Masalah, Tujuan dan Kontribusi
                        Penelitian:</label>
                    <input type="number" name="makalah_identifikasi_masalah" id="makalah_identifikasi_masalah"
                        class="form-control nilai" min="0" max="100" required>

                    <label for="makalah_relevansi_teori">b. Relevansi Teori/Referensi Pustaka dan Konsep dengan Masalah
                        Penelitian:</label>
                    <input type="number" name="makalah_relevansi_teori" id="makalah_relevansi_teori"
                        class="form-control nilai" min="0" max="100" required>

                    <label for="makalah_metode_algoritma">c. Metode Algoritma yang Digunakan:</label>
                    <input type="number" name="makalah_metode_algoritma" id="makalah_metode_algoritma"
                        class="form-control nilai" min="0" max="100" required>

                    <label for="makalah_hasil_pembahasan">d. Hasil dan Pembahasan:</label>
                    <input type="number" name="makalah_hasil_pembahasan" id="makalah_hasil_pembahasan"
                        class="form-control nilai" min="0" max="100" required>

                    <label for="makalah_kesimpulan_saran">e. Kesimpulan dan Saran:</label>
                    <input type="number" name="makalah_kesimpulan_saran" id="makalah_kesimpulan_saran"
                        class="form-control nilai" min="0" max="100" required>

                    <label for="makalah_bahasa_tata_tulis">f. Penggunaan Bahasa dan Tata Tulis:</label>
                    <input type="number" name="makalah_bahasa_tata_tulis" id="makalah_bahasa_tata_tulis"
                        class="form-control nilai" min="0" max="100" required>
                </div>

                <!-- Produk -->
                <div class="form-group mb-3">
                    <b>
                        <p>3. Produk</p>
                    </b>
                    <label for="produk_kesesuaian_fungsional">a. Kesesuaian Fungsional Sistem:</label>
                    <input type="number" name="produk_kesesuaian_fungsional" id="produk_kesesuaian_fungsional"
                        class="form-control nilai" min="0" max="100" required>
                </div>
            </div>

            <div class="form-group d-flex align-items-center mb-3">
                <button type="button" class="btn btn-primary mr-3" id="hitungTotal">Hitung Total</button>
                <span id="totalNilai" class="border border-4 p-2">0</span>
                <input type="hidden" name="total_nilai" id="inputTotalNilai" value="0">
            </div>
            <div class="form-group mb-3">
                <b><label for="komentar">Komentar:</label></b>
                <textarea name="komentar" id="komentar" class="form-control" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.sidang.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const taSelect = document.getElementById('ta_id');
            const jabatanSelect = document.getElementById('jabatan');
            const dosenSelect = document.getElementById('nilai_dosen');
            const hiddenNilaiDosen = document.getElementById('hidden_nilai_dosen');
            const hitungTotalBtn = document.getElementById('hitungTotal');
            const totalNilaiSpan = document.getElementById('totalNilai');
            const inputTotalNilai = document.getElementById('inputTotalNilai');
            const nilaiInputs = document.querySelectorAll('.nilai');

            taSelect.addEventListener('change', updateDosen);
            jabatanSelect.addEventListener('change', updateDosen);
            hitungTotalBtn.addEventListener('click', hitungTotal);

            function updateDosen() {
                const selectedTA = taSelect.options[taSelect.selectedIndex];
                const selectedJabatan = jabatanSelect.value;

                let dosenId = '';
                let dosenNama = '';

                switch(selectedJabatan) {
                    case 'KetuaSidang':
                    case 'Pembimbing1':
                        dosenId = selectedTA.dataset.pembimbing1Id;
                        dosenNama = selectedTA.dataset.pembimbing1Nama;
                        break;
                    case 'Pembimbing2':
                        dosenId = selectedTA.dataset.pembimbing2Id;
                        dosenNama = selectedTA.dataset.pembimbing2Nama;
                        break;
                    case 'Penguji1':
                        dosenId = selectedTA.dataset.penguji1Id;
                        dosenNama = selectedTA.dataset.penguji1Nama;
                        break;
                    case 'Penguji2':
                        dosenId = selectedTA.dataset.penguji2Id;
                        dosenNama = selectedTA.dataset.penguji2Nama;
                        break;
                    case 'SekretarisSidang':
                        dosenId = selectedTA.dataset.sekretarisId;
                        dosenNama = selectedTA.dataset.sekretarisNama;
                        break;
                }

                if (dosenId && dosenNama) {
                    setSelectedDosen(dosenId, dosenNama);
                    dosenSelect.disabled = false;
                } else {
                    dosenSelect.value = '';
                    dosenSelect.disabled = false;
                }
            }

            function setSelectedDosen(id, nama) {
                const option = Array.from(dosenSelect.options).find(opt => opt.value === id);
                if (option) {
                    option.selected = true;
                } else {
                    const newOption = new Option(nama, id, true, true);
                    dosenSelect.add(newOption);
                }
                hiddenNilaiDosen.value = id;
            }

            function hitungTotal() {
                const bobot = {
                    presentasi_sikap_penampilan: 0.05,
                    presentasi_komunikasi_sistematika: 0.05,
                    presentasi_penguasaan_materi: 0.20,
                    makalah_identifikasi_masalah: 0.05,
                    makalah_relevansi_teori: 0.05,
                    makalah_metode_algoritma: 0.10,
                    makalah_hasil_pembahasan: 0.15,
                    makalah_kesimpulan_saran: 0.05,
                    makalah_bahasa_tata_tulis: 0.05,
                    produk_kesesuaian_fungsional: 0.25
                };

                let totalNilai = 0;

                nilaiInputs.forEach(input => {
                    const nilai = parseFloat(input.value) || 0;
                    const bobotNilai = bobot[input.name] || 0;
                    totalNilai += nilai * bobotNilai;
                });

                totalNilaiSpan.textContent = totalNilai.toFixed(2);
                inputTotalNilai.value = totalNilai.toFixed(2);
            }
        });
        </script>

@endsection
