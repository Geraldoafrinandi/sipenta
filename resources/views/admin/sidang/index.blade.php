
    @extends('admin.main')
    @section('title', 'Data TA')
    @section('navMhs', 'active')

    @section('content')
        <div class="container">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Daftar Sidang</h1>
            </div>
            <h1 class="text-center mt-4">Daftar Penjadwalan Sidang</h1>

            {{-- @if (Auth::user()->role == 'kaprodi')
                <a href="{{ route('admin.sidang.create') }}" class="btn btn-primary mb-3">Tambah Sidang</a>
            @endif --}}


            @if (session()->has('success'))
                <div class="alert alert-primary" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <div class="table-responsive mt-3">
                <form action="{{ route('admin.sidang.index') }}" method="GET" class="mb-3 border p-3 rounded">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari..." value="{{ request()->get('search') }}">
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </div>
                </form>

                <table class="table table-ordered table-striped">
                    <thead>
                        <tr>
                            <th>Judul Tugas Akhir</th>
                            <th>Nama Mahasiswa</th>
                            <th>Pembimbing 1</th>
                            <th>Pembimbing 2</th>
                            <th>Ketua Sidang</th>
                            <th>Penguji 1</th>
                            <th>Penguji 2</th>
                            <th>Sekretaris</th>
                            <th>Ruangan</th>
                            <th>Jam Sidang</th>
                            <th>Tanggal Sidang</th>
                            <th>Status Sidang</th>
                            <th>Total Nilai</th>
                            @if (Auth::user()->role == 'kaprodi' || Auth::user()->role == 'dosen')
                                <th>Aksi</th>
                                @if (Auth::user()->role == 'kaprodi')
                                <th>Berita Acara</th>
                                <th>Rekap Nilai</th>
                                @endif
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sidangs as $sidang)
                            <tr>
                                <td>{{ $sidang->tugas_akhir->judul ?? '-' }}</td>
                                <td>{{ $sidang->tugas_akhir->nim }} - {{ $sidang->tugas_akhir->nama_mahasiswa }} </td>
                                <td>
                                    @php
                                        $penilaianPembimbing1 = $sidang->penilaianPembimbing1()->where('jabatan', 'Pembimbing1')->where('ta_id', $sidang->ta_id)->first();
                                    @endphp
                                    {{ $sidang->pembimbing1->nama ?? '-' }} - ({{ $penilaianPembimbing1->total_nilai ?? 'N/A' }})
                                </td>
                                <td>
                                    @php
                                        $penilaianPembimbing2 = $sidang->penilaianPembimbing2()->where('jabatan', 'Pembimbing2')->where('ta_id', $sidang->ta_id)->first();
                                    @endphp
                                    {{ $sidang->pembimbing2->nama ?? '-' }} - ({{ $penilaianPembimbing2->total_nilai ?? 'N/A' }})
                                </td>
                                <td>
                                    @php
                                        $penilaianKetuaSidang = $sidang->penilaianKetuaSidang()->where('jabatan', 'KetuaSidang')->where('ta_id', $sidang->ta_id)->first();
                                    @endphp
                                    {{ $sidang->ketuaSidang->nama ?? '-' }} - ({{ $penilaianKetuaSidang->total_nilai ?? 'N/A' }})
                                </td>
                                <td>
                                    @php
                                        $penilaianPenguji1 = $sidang->penilaianPenguji1()->where('jabatan', 'Penguji1')->where('ta_id', $sidang->ta_id)->first();
                                    @endphp
                                    {{ $sidang->penguji1->nama ?? '-' }} - ({{ $penilaianPenguji1->total_nilai ?? 'N/A' }})
                                </td>
                                <td>
                                    @php
                                        $penilaianPenguji2 = $sidang->penilaianPenguji2()->where('jabatan', 'Penguji2')->where('ta_id', $sidang->ta_id)->first();
                                    @endphp
                                    {{ $sidang->penguji2->nama ?? '-' }} - ({{ $penilaianPenguji2->total_nilai ?? 'N/A' }})
                                </td>
                                <td>
                                    @php
                                        $penilaianSekretaris = $sidang->penilaianSekretaris()->where('jabatan', 'SekretarisSidang')->where('ta_id', $sidang->ta_id)->first();
                                    @endphp
                                    {{ $sidang->sekretaris->nama ?? '-' }} - ({{ $penilaianSekretaris->total_nilai ?? 'N/A' }})
                                </td>
                                <td>{{ $sidang->ruangan->no_ruangan ?? '-' }}</td>
                                <td>{{ $sidang->ruangan->jam_sidang ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($sidang->tanggal)->format('d-m-Y') }}</td>
                                <td>
                                    @php
                                        $totalNilaiPembimbing1 = $penilaianPembimbing1 ? $penilaianPembimbing1->total_nilai : 0;
                                        $totalNilaiPembimbing2 = $penilaianPembimbing2 ? $penilaianPembimbing2->total_nilai : 0;
                                        $totalNilaiKetua = $penilaianKetuaSidang ? $penilaianKetuaSidang->total_nilai : 0;
                                        $totalNilaiPenguji1 = $penilaianPenguji1 ? $penilaianPenguji1->total_nilai : 0;
                                        $totalNilaiPenguji2 = $penilaianPenguji2 ? $penilaianPenguji2->total_nilai : 0;
                                        $totalNilaiSekretaris = $penilaianSekretaris ? $penilaianSekretaris->total_nilai : 0;

                                        $jumlahPenilaian = 0;
                                        $totalNilai = 0;

                                        if ($totalNilaiPembimbing1 > 0) {
                                            $jumlahPenilaian++;
                                            $totalNilai += $totalNilaiPembimbing1;
                                        }

                                        if ($totalNilaiPembimbing2 > 0) {
                                            $jumlahPenilaian++;
                                            $totalNilai += $totalNilaiPembimbing2;
                                        }

                                        if ($totalNilaiKetua > 0) {
                                            $jumlahPenilaian++;
                                            $totalNilai += $totalNilaiKetua;
                                        }

                                        if ($totalNilaiPenguji1 > 0) {
                                            $jumlahPenilaian++;
                                            $totalNilai += $totalNilaiPenguji1;
                                        }

                                        if ($totalNilaiPenguji2 > 0) {
                                            $jumlahPenilaian++;
                                            $totalNilai += $totalNilaiPenguji2;
                                        }

                                        if ($totalNilaiSekretaris > 0) {
                                            $jumlahPenilaian++;
                                            $totalNilai += $totalNilaiSekretaris;
                                        }

                                        $rataRata = $jumlahPenilaian > 0 ? number_format($totalNilai / $jumlahPenilaian, 2) : '-';
                                        $statusSidang = $rataRata !== '-' ? ($rataRata > 70 ? 'Lulus' : 'Tidak Lulus') : '-';
                                    @endphp
                                    {{ $statusSidang }}
                                </td>
                                <td>
                                    {{ $rataRata }}
                                </td>
                                @if (Auth::user()->role == 'kaprodi' || Auth::user()->role == 'dosen')
                                <td>
                                    @if (Auth::user()->role == 'kaprodi')
                                        <a href="{{ route('admin.sidang.edit', $sidang->id) }}" class="btn btn-warning btn-sm mb-1">Edit</a>
                                        <form action="{{ route('admin.sidang.destroy', $sidang->id) }}" method="POST" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus sidang ini?')">Hapus</button>
                                        </form>
                                        <td><a href="{{ route('admin.sidang.print', ['sidang' => $sidang->id]) }}" class="btn btn-info btn-sm mb-1">Cetak Berita Acara</a></td>
                                        <td>
                                            <a href="{{ route('admin.sidang.rekap', ['id' => $sidang->id]) }}" class="btn btn-success btn-sm mb-1">Rekap Nilai</a>
                                             </td>
                                    @elseif (Auth::user()->role == 'dosen')
                                        <a href="{{ route('admin.penilaian.create', ['id' => $sidang->id]) }}" class="btn btn-primary btn-sm mb-1">Nilai</a>

                                    @endif
                                </td>
                            @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="13" class="text-center">Tidak ada data sidang.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>


    @endsection
