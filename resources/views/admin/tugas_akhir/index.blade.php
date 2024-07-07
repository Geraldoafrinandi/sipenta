@extends('admin.main')
@section('title', 'Data TA')
@section('navMhs', 'active')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Data TA</h1>
    </div>

    <h1 class="text-center mb-4">Daftar Pengajuan Sidang</h1>

    @if (session()->has('success'))
        <div class="alert alert-primary" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if (Auth::user()->role == 'mahasiswa')
        <a href="/tugas_akhir/create" class="btn btn-primary mb-3">Tambah Tugas Akhir</a>
    @endif

    <table class="table table-ordered table-striped">
        <thead>
            <tr>
                <th>NIM</th>
                <th>Nama Mahasiswa</th>
                <th>Pembimbing 1</th>
                <th>Pembimbing 2</th>
                <th>Judul</th>
                <th>Dokumen PKL</th>
                <th>Lembar Bimbingan</th>
                <th>Proposal</th>
                <th>Validasi</th>
                @if (Auth::user()->role == 'kaprodi' || Auth::user()->role == 'dosen')
                    <th>Keterangan Validasi Proposal</th>
                @endif
                @if (Auth::user()->role == 'kaprodi' || Auth::user()->role == 'dosen')
                    <th>Download Tugas Akhir</th>
                @endif
                @if (Auth::user()->role == 'kaprodi' || Auth::user()->role == 'dosen')
                    <th>Validasi Tugas Akhir</th>
                    <th>Keterangan Validasi Tugas Akhir</th>
                @endif
                <th>Tanggal Pengajuan</th>
                @if (Auth::user()->role == 'kaprodi')
                    <th>Aksi</th>
                    @php
                        $showSidangTh = [];
                    @endphp
                @endif
                @foreach ($tugasAkhir as $ta)
                    @if (
                        $ta->validasiTa &&
                        $ta->validasiProposal &&
                        $ta->validasiTa->status_validasi == 'Valid' &&
                        $ta->validasiProposal->status_validasi == 'Valid'
                    )
                        @php
                            $showSidangTh[] = $ta;
                        @endphp
                        @break
                    @endif
                @endforeach
                @if (!empty($showSidangTh))
                    <th>Sidang</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($tugasAkhir as $ta)
                <tr data-ta-id="{{ $ta->id_ta }}">
                    <td>{{ $ta->nim }}</td>
                    <td>{{ $ta->nama_mahasiswa }}</td>
                    <td>{{ $ta->pembimbing1->nama ?? '-' }}</td>
                    <td>{{ $ta->pembimbing2->nama ?? '-' }}</td>
                    <td>{{ $ta->judul }}</td>
                    <td>
                        <a href="{{ route('tugas_akhir.downloadDokumenPKL', ['id_ta' => $ta->id_ta]) }}"
                            class="btn btn-success">Download</a>
                    </td>
                    <td>
                        <a href="{{ route('tugas_akhir.downloadLembarBimbingan', ['id_ta' => $ta->id_ta]) }}"
                            class="btn btn-success">Download</a>
                    </td>
                    <td>
                        <a href="{{ route('tugas_akhir.downloadProposal', ['id_ta' => $ta->id_ta]) }}"
                            class="btn btn-success">Download</a>
                    </td>
                    @if (Auth::user()->role == 'kaprodi' || Auth::user()->role == 'dosen')
                        <td>
                            <button type="button" class="btn btn-primary btn-sm btn-validasi-proposal"
                                data-ta-id="{{ $ta->id_ta }}"
                                data-nim="{{ $ta->nim }}"
                                data-nama="{{ $ta->nama_mahasiswa }}"
                                data-judul="{{ $ta->judul }}">Validasi Proposal</button>
                        </td>
                    @endif
                    @if (Auth::user()->role == 'kaprodi' || Auth::user()->role == 'dosen')
                        <td>
                            {{ $ta->validasiProposal ? $ta->validasiProposal->status_validasi : '-' }}
                            @if ($ta->validasiProposal && $ta->validasiProposal->status_validasi == 'Tidak Valid')
                                <br>
                                Catatan: {{ $ta->validasiProposal->catatan ?? '-' }}
                            @endif
                        </td>
                    @endif
                    <td>
                        <a href="{{ route('tugas_akhir.downloadLaporanTA', ['id_ta' => $ta->id_ta]) }}"
                            class="btn btn-success">Download</a>
                    </td>
                    @if (Auth::user()->role == 'kaprodi' || Auth::user()->role == 'dosen')
                        <td>
                            <button type="button" class="btn btn-primary btn-sm btn-validasi-ta"
                                data-ta-id="{{ $ta->id_ta }}"
                                data-nim="{{ $ta->nim }}"
                                data-nama="{{ $ta->nama_mahasiswa }}"
                                data-judul="{{ $ta->judul }}">Validasi Tugas Akhir</button>
                        </td>
                    @endif
                    @if (Auth::user()->role == 'kaprodi' || Auth::user()->role == 'dosen')
                        <td>
                            {{ $ta->validasiTa ? $ta->validasiTa->status_validasi : '-' }}
                            @if ($ta->validasiTa && $ta->validasiTa->status_validasi == 'Tidak Valid')
                                <br>
                                Catatan: {{ $ta->validasiTa->catatan ?? '-' }}
                            @endif
                        </td>
                    @endif
                    <td>{{ $ta->tgl_pengajuan }}</td>
                    @if (Auth::user()->role == 'kaprodi')
                        <td>
                            <a href="{{ route('tugas_akhir.edit', $ta->id_ta) }}" class="btn btn-success btn-sm">Edit</a>
                            <form action="{{ route('tugas_akhir.destroy', $ta->id_ta) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                        @if (
                            $ta->validasiTa &&
                            $ta->validasiProposal &&
                            $ta->validasiTa->status_validasi == 'Valid' &&
                            $ta->validasiProposal->status_validasi == 'Valid'
                        )
                            <td>
                                <button class="btn btn-primary btn-sm"
                                    onclick="jadwalkanSidang('{{ $ta->id_ta }}', '{{ $ta->nim }}')">Jadwalkan
                                    Sidang</button>
                            </td>
                        @endif
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.addEventListener('click', function(event) {
                if (event.target.classList.contains('btn-validasi-proposal')) {
                    const taId = event.target.dataset.taId;
                    const nim = event.target.dataset.nim;
                    const namaMahasiswa = event.target.dataset.nama;
                    const judul = event.target.dataset.judul;
                    validasi('validasi_proposal', taId, nim, namaMahasiswa, judul);
                }

                if (event.target.classList.contains('btn-validasi-ta')) {
                    const taId = event.target.dataset.taId;
                    const nim = event.target.dataset.nim;
                    const namaMahasiswa = event.target.dataset.nama;
                    const judul = event.target.dataset.judul;
                    validasi('validasi_ta', taId, nim, namaMahasiswa, judul);
                }
            });

            function validasi(type, taId, nim, namaMahasiswa, judul) {
                let url = '';
                if (type === 'validasi_ta') {
                    url = `{{ url('validasi_ta/create') }}?ta_id=${taId}&nim=${nim}&nama_mahasiswa=${encodeURIComponent(namaMahasiswa)}&judul=${encodeURIComponent(judul)}`;
                } else if (type === 'validasi_proposal') {
                    url = `{{ url('validasi_proposal/create') }}?ta_id=${taId}&nim=${nim}&nama_mahasiswa=${encodeURIComponent(namaMahasiswa)}&judul=${encodeURIComponent(judul)}`;
                }
                window.location.href = url;
            }
        });
        // Fungsi untuk jadwalkan sidang
        function jadwalkanSidang(taId, nim) {
            // Redirect to the scheduling page with automatic filling of ID TA and nim
            window.location.href = `{{ route('admin.sidang.create') }}?id_ta=${taId}&nim=${nim}`;


        // Automatically select TA and NIM when page loads
        document.addEventListener('DOMContentLoaded', function () {
            const taId = "{{ old('ta_id') }}"; // Assuming you have old input values
            const nim = "{{ old('nim') }}"; // Assuming you have old input values
            document.getElementById('ta_id').value = taId;
            document.getElementById('nim').value = nim;
        });
    }
    </script>
@endsection
