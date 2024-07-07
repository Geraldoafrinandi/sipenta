@extends('admin.main')

@section('content')
    <div class="container">
        <h1 class>Tambah Sidang</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.sidang.store') }}" method="POST">
            @csrf

            <div class="mb-3 mt-4">
                <label for="ta_id" class="form-label">Tugas Akhir</label>
                <select name="ta_id" id="ta_id" class="form-control" required onchange="fetchPembimbing()">
                    <option value="" disabled selected>Pilih Tugas Akhir</option>
                    @foreach ($tugasAkhirs as $tugasAkhir)
                        <option value="{{ $tugasAkhir->id_ta }}" {{ old('ta_id') == $tugasAkhir->id_ta ? 'selected' : '' }}>
                            {{ $tugasAkhir->judul }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="nim" class="form-label">Pilih Mahasiswa</label>
                <select name="nim" id="nim" class="form-control" required>
                    <option value="" disabled selected>Pilih NIM</option>
                    @foreach ($tugasAkhirs as $tugasAkhir)
                        <option value="{{ $tugasAkhir->nim }}" {{ old('nim') == $tugasAkhir->nim ? 'selected' : '' }}>
                            {{ $tugasAkhir->nim }} - {{ $tugasAkhir->nama_mahasiswa }}
                        </option>
                    @endforeach
                </select>
            </div>


            <div class="mb-3">
                <label for="ketua_sidang_id">Ketua Sidang</label>
                <select name="ketua_sidang_id" id="ketua_sidang_id" class="form-control" required>
                    <option value="" disabled selected>Pilih Dosen</option>
                    @foreach ($dosens as $dosen)
                        <option value="{{ $dosen->id_dosen }}"
                            {{ old('ketua_sidang_id') == $dosen->id_dosen ? 'selected' : '' }}>
                            {{ $dosen->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="penguji1_id">Penguji 1</label>
                <select name="penguji1_id" id="penguji1_id" class="form-control" required>
                    <option value="" disabled selected>Pilih Dosen</option>
                    @foreach ($dosens as $dosen)
                        <option value="{{ $dosen->id_dosen }}"
                            {{ old('penguji1_id') == $dosen->id_dosen ? 'selected' : '' }}>
                            {{ $dosen->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="penguji2_id">Penguji 2</label>
                <select name="penguji2_id" id="penguji2_id" class="form-control" required>
                    <option value="" disabled selected>Pilih Dosen</option>
                    @foreach ($dosens as $dosen)
                        <option value="{{ $dosen->id_dosen }}"
                            {{ old('penguji2_id') == $dosen->id_dosen ? 'selected' : '' }}>
                            {{ $dosen->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="sekretaris_id">Sekretaris</label>
                <select name="sekretaris_id" id="sekretaris_id" class="form-control" required>
                    <option value="" disabled selected>Pilih Dosen</option>
                    @foreach ($dosens as $dosen)
                        <option value="{{ $dosen->id_dosen }}"
                            {{ old('sekretaris_id') == $dosen->id_dosen ? 'selected' : '' }}>
                            {{ $dosen->nama }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="pembimbing1_id">Pembimbing 1</label>
                <select id="pembimbing1_id" name="pembimbing1_id" class="form-control" required readonly>
                    <option disabled selected value="">Dosen</option>
                    @foreach ($dosens as $dosen)
                        <option value="{{ $dosen->id_dosen }}"
                            {{ old('pembimbing1_id') == $dosen->id_dosen ? 'selected' : '' }}>
                            {{ $dosen->nama }}
                        </option>
                    @endforeach
                </select>
                <input type="hidden" name="pembimbing1_id" id="hidden_pembimbing1_id" value="{{ old('pembimbing1_id') }}">
            </div>

            <div class="mb-3">
                <label for="pembimbing2_id">Pembimbing 2</label>
                <select id="pembimbing2_id" class="form-control" required readonly>
                    <option disabled selected value="">Dosen</option>
                    @foreach ($dosens as $dosen)
                        <option value="{{ $dosen->id_dosen }}"
                            {{ old('pembimbing2_id') == $dosen->id_dosen ? 'selected' : '' }}>
                            {{ $dosen->nama }}
                        </option>
                    @endforeach
                </select>
                <input type="hidden" name="pembimbing2_id" id="hidden_pembimbing2_id" value="{{ old('pembimbing2_id') }}">
            </div>

            <div class="mb-3">
                <label for="ruangan_id" class="form-label">Ruangan</label>
                <select name="ruangan_id" id="ruangan_id" class="form-control" required>
                    <option value="" disabled selected>Pilih Ruangan</option>
                    @foreach ($ruangans as $ruangan)
                        <option value="{{ $ruangan->id_ruangan }}">{{ $ruangan->no_ruangan }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="jam_sidang_id" class="form-label">Jam Sidang</label>
                <select name="jam_sidang_id" id="jam_sidang_id" class="form-control" required>
                    <option value="" disabled selected>Pilih Jam Sidang</option>
                    @foreach ($ruangans as $ruangan)
                        <option value="{{ $ruangan->id_ruangan }}"
                            {{ old('jam_sidang') == $ruangan->id_ruangan ? 'selected' : '' }}>
                            {{ $ruangan->jam_sidang }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ old('tanggal') }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="status_sidang" class="form-label">Status Sidang</label>
                <input type="text" name="status_sidang" id="status_sidang" class="form-control"
                    value="{{ old('status_sidang') }}">
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.sidang.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection


<script>


    // Function to fill form fields automatically
function fillFormFields(taId, nim, pembimbing1_id, pembimbing2_id) {
    document.getElementById('ta_id').value = taId;
    document.getElementById('nim').value = nim;
    document.getElementById('pembimbing1_id').value = pembimbing1_id;
    document.getElementById('hidden_pembimbing1_id').value = pembimbing1_id;
    document.getElementById('pembimbing2_id').value = pembimbing2_id;
    document.getElementById('hidden_pembimbing2_id').value = pembimbing2_id;
    document.getElementById('ketua_sidang_id').value = pembimbing1_id; // Set ketua sidang to pembimbing 1
}

// Event listener for when the page loads
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const taId = urlParams.get('id_ta');
    const nim = urlParams.get('nim');

    // Check if taId and nim are not null or undefined
    if (taId && nim) {
        // Fetch pembimbing data based on taId
        fetch(`/getPembimbingByTA/${taId}`)
            .then(response => response.json())
            .then(data => {
                fillFormFields(taId, nim, data.pembimbing1_id, data.pembimbing2_id);
            })
            .catch(error => console.error('Error:', error));
    }
});

// Event listener for ta_id change
document.getElementById('ta_id').addEventListener('change', function() {
    const taId = this.value;

    // Fetch pembimbing data based on taId
    fetch(`/getPembimbingByTA/${taId}`)
        .then(response => response.json())
        .then(data => {
            fillFormFields(taId, '', data.pembimbing1_id, data.pembimbing2_id);
        })
        .catch(error => console.error('Error:', error));
});

//     document.addEventListener('DOMContentLoaded', function () {
//     // Fungsi untuk mengambil dan menyembunyikan nama dosen yang sudah terjadwal sidang
//     function hideScheduledProfessors() {
//         // Kirim permintaan AJAX untuk mendapatkan dosens yang sudah terjadwal
//         fetch(`/getScheduledProfessors`)
//             .then(response => response.json())
//             .then(data => {
//                 var scheduledProfessors = data;

//                 // Loop melalui setiap opsi di dropdown
//                 var dropdowns = document.querySelectorAll('select.form-control');
//                 dropdowns.forEach(dropdown => {
//                     var options = dropdown.options;
//                     for (var i = 0; i < options.length; i++) {
//                         var option = options[i];
//                         console.log('Checking option value:', option.value);
//                         if (scheduledProfessors.includes(parseInt(option.value))) {
//                             option.disabled = true; // Menonaktifkan opsi jika dosen sudah terjadwal
//                             console.log('Disabled option:', option.value);
//                         }
//                     }
//                 });
//             })
//             .catch(error => console.error('Error:', error));
//     }

//     // Panggil fungsi untuk menyembunyikan dosens yang sudah terjadwal saat halaman dimuat
//     hideScheduledProfessors();
// });

 // Script untuk membuat pembimbing 1 menjadi default ketua sidang
 document.addEventListener('DOMContentLoaded', function() {
        // Ambil nilai id_dosen dari pembimbing 1
        var pembimbing1Id = "{{ $sidang->pembimbing1->id_dosen ?? '' }}";

        // Setel nilai default untuk select dengan id ketua_sidang_id
        var selectKetuaSidang = document.getElementById('ketua_sidang_id');
        if (selectKetuaSidang) {
            // Loop through options
            for (var i = 0; i < selectKetuaSidang.options.length; i++) {
                if (selectKetuaSidang.options[i].value === pembimbing1Id) {
                    selectKetuaSidang.selectedIndex = i;
                    break;
                }
            }
        }
    });





</script>
