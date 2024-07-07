<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Sidang;
use App\Models\Ruangan;
use Barryvdh\DomPDF\Facade\PDF;
use App\Models\Mahasiswa;
use App\Models\Tugas_akhir;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SidangController extends Controller
{

    public function getScheduledProfessors()
    {
        // Ambil daftar ID dosen yang sudah terjadwal sidang
        $scheduledProfessorIds = collect([]);

        $scheduledProfessorIds = $scheduledProfessorIds->merge(Sidang::distinct()->pluck('ketua_sidang_id'));
        $scheduledProfessorIds = $scheduledProfessorIds->merge(Sidang::distinct()->pluck('pembimbing1_id'));
        $scheduledProfessorIds = $scheduledProfessorIds->merge(Sidang::distinct()->pluck('pembimbing2_id'));
        $scheduledProfessorIds = $scheduledProfessorIds->merge(Sidang::distinct()->pluck('sekretaris_id'));
        $scheduledProfessorIds = $scheduledProfessorIds->merge(Sidang::distinct()->pluck('penguji1_id'));
        $scheduledProfessorIds = $scheduledProfessorIds->merge(Sidang::distinct()->pluck('penguji2_id'));

        // Menghapus nilai-nilai duplikat
        $scheduledProfessorIds = $scheduledProfessorIds->unique()->values();

        // Ambil detail dosen berdasarkan ID yang sudah terjadwal
        $scheduledProfessors = Dosen::whereIn('id_dosen', $scheduledProfessorIds)->get();

        // Mengembalikan dalam bentuk JSON
        return response()->json($scheduledProfessors);
    }



    public function index()
    {
        $user = Auth::user();
        $sidangs = Sidang::query();

        // Filter the data based on the user's role
        if ($user->role == 'mahasiswa') {
            // If the user is a student, show only their data
            $sidangs = $sidangs->where('nim', $user->nim);
        } elseif ($user->role == 'dosen') {
            // If the user is a lecturer, filter sidangs related to them
            $sidangs = $sidangs->where(function ($query) use ($user) {
                $query->where('penguji1_id', $user->id)
                    ->orWhere('penguji2_id', $user->id)
                    ->orWhere('ketua_sidang_id', $user->id)
                    ->orWhere('sekretaris_id', $user->id)
                    ->orWhere('pembimbing1_id', $user->id)
                    ->orWhere('pembimbing2_id', $user->id);
            });
        }

        // Eager load relationships
        $sidangs = $sidangs->with([
            'tugas_akhir',
            'ketuaSidang',
            'penguji1',
            'penguji2',
            'sekretaris',
            'ruangan',
            'penilaianPenguji1',
            'pembimbing1',
            'pembimbing2'
        ])->get();

        return view('admin.sidang.index', compact('sidangs'));
    }


    private function getNilai($penilaian, $jabatan)
    {
        $nilai = $penilaian->where('jabatan', $jabatan)->first();
        return $nilai ? $nilai->total_nilai : 0;
    }

    private function getKomentar($penilaian, $jabatan)
    {
        $nilai = $penilaian->where('jabatan', $jabatan)->first();
        return $nilai ? $nilai->komentar : '-';
    }


    public function print(Sidang $sidang)
    {
        try {
            // Memuat sidang bersama dengan semua relasinya
            $sidang = Sidang::with([
                'tugas_akhir',
                'mahasiswa',
                'ruangan',
                'ketuaSidang',
                'penguji1',
                'penguji2',
                'sekretaris',
                'penilaians',
                'penilaianKetuaSidang',
                'penilaianPenguji1',
                'penilaianPenguji2',
                'penilaianSekretaris',
                'penilaianPembimbing1',
                'penilaianPembimbing2',
                'pembimbing1',
                'pembimbing2',
            ])->findOrFail($sidang->id);

            // Load view dan generate PDF
            $pdf = PDF::loadView('admin.print', compact('sidang'));

            // Mengunduh file PDF
            return $pdf->download('berita_acara_sidang.pdf');
        } catch (ModelNotFoundException $e) {
            // Mengarahkan kembali jika sidang tidak ditemukan
            return redirect()->route('admin.sidang.index')->with('error', 'Data sidang tidak ditemukan.');
        }
    }


    public function create()
    {
        $tugasAkhirs = Tugas_akhir::all();
        $mahasiswas = Mahasiswa::all();
        $ruangans = Ruangan::all();
        $dosens = Dosen::all();

        return view('admin.sidang.create', compact('tugasAkhirs', 'mahasiswas', 'ruangans', 'dosens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ta_id' => 'required|exists:tugas_akhirs,id_ta',
            'nim' => 'required|exists:tugas_akhirs,nim',
            'pembimbing1_id' => 'required|exists:dosens,id_dosen',
            'pembimbing2_id' => 'required|different:pembimbing1_id|exists:dosens,id_dosen',
            'penguji1_id' => 'required|different:pembimbing1_id|different:pembimbing2_id|exists:dosens,id_dosen',
            'penguji2_id' => 'required|different:pembimbing1_id|different:pembimbing2_id|different:penguji1_id|exists:dosens,id_dosen',
            'sekretaris_id' => 'required|different:pembimbing1_id|different:pembimbing2_id|different:penguji1_id|different:penguji2_id|exists:dosens,id_dosen',
            'ruangan_id' => [
                'required',
                'exists:ruangans,id_ruangan',
                Rule::unique('sidangs')->where(function ($query) use ($request) {
                    return $query->where('ruangan_id', $request->ruangan_id)
                        ->where('tanggal', $request->tanggal);
                }),
            ],
            'jam_sidang_id' => 'required|exists:ruangans,id_ruangan',
            'tanggal' => 'required|date',
            'status_sidang' => 'nullable|string|max:20',
            'total_nilai' => 'nullable|numeric',
        ]);

        try {
            // Set `ketua_sidang_id` secara otomatis ke `pembimbing1_id`
            $request->merge(['ketua_sidang_id' => $request->pembimbing1_id]);

            Sidang::create([
                'ta_id' => $request->ta_id,
                'nim' => $request->nim,
                'pembimbing1_id' => $request->pembimbing1_id,
                'pembimbing2_id' => $request->pembimbing2_id,
                'ketua_sidang_id' => $request->ketua_sidang_id,
                'penguji1_id' => $request->penguji1_id,
                'penguji2_id' => $request->penguji2_id,
                'sekretaris_id' => $request->sekretaris_id,
                'ruangan_id' => $request->ruangan_id,
                'jam_sidang_id' => $request->jam_sidang_id,
                'tanggal' => $request->tanggal,
                'status_sidang' => $request->status_sidang,
                'total_nilai' => $request->total_nilai,
            ]);

            return redirect()->route('admin.sidang.index')
                ->with('success', 'Sidang berhasil ditambahkan.');
        } catch (\Exception $e) {
            // Tampilkan pesan error atau log jika terjadi kesalahan
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Gagal menambahkan sidang: ' . $e->getMessage()]);
        }
    }



    public function show(Sidang $sidang)
    {
        $sidang->load(
            'tugas_akhir',
            'ruangan',
            'ketuaSidang',
            'penguji1',
            'penguji2',
            'sekretaris',
            'penilaianKetuaSidang',
            'penilaianPenguji1',
            'penilaianPenguji2',
            'penilaianSekretaris',
            'penilaianPembimbing1',
            'penilaianPembimbing2'
        );

        // Ambil penilaian dari relasi dengan penambahan where untuk masing-masing jabatan
        $penilaianKetuaSidang = $sidang->penilaianKetuaSidang()->where('jabatan', 'KetuaSidang')->first();
        $penilaianPenguji1 = $sidang->penilaianPenguji1()->where('jabatan', 'Penguji1')->first();
        $penilaianPenguji2 = $sidang->penilaianPenguji2()->where('jabatan', 'Penguji2')->first();
        $penilaianSekretaris = $sidang->penilaianSekretaris()->where('jabatan', 'SekretarisSidang')->first();
        $penilaianPembimbing1 = $sidang->penilaianPembimbing1()->where('jabatan', 'Pembimbing1')->first();
        $penilaianPembimbing2 = $sidang->penilaianPembimbing2()->where('jabatan', 'Pembimbing2')->first();

        // Hitung total nilai dan jumlah penilaian
        $totalNilai = 0;
        $jumlahPenilaian = 0;

        if ($penilaianKetuaSidang) {
            $totalNilai += $penilaianKetuaSidang->total_nilai;
            $jumlahPenilaian++;
        }

        if ($penilaianPenguji1) {
            $totalNilai += $penilaianPenguji1->total_nilai;
            $jumlahPenilaian++;
        }

        if ($penilaianPenguji2) {
            $totalNilai += $penilaianPenguji2->total_nilai;
            $jumlahPenilaian++;
        }

        if ($penilaianSekretaris) {
            $totalNilai += $penilaianSekretaris->total_nilai;
            $jumlahPenilaian++;
        }

        if ($penilaianPembimbing1) {
            $totalNilai += $penilaianPembimbing1->total_nilai;
            $jumlahPenilaian++;
        }
        if ($penilaianPembimbing2) {
            $totalNilai += $penilaianPembimbing2->total_nilai;
            $jumlahPenilaian++;
        }

        // Hitung rata-rata nilai
        $rataRata = $jumlahPenilaian > 0 ? number_format($totalNilai / $jumlahPenilaian, 2) : 'N/A';

        return view('admin.sidang.show', compact('sidang', 'penilaianKetuaSidang', 'penilaianPenguji1', 'penilaianPenguji2', 'penilaianSekretaris', 'penilaianPembimbing1', 'penilaianPembimbing2', 'rataRata'));
    }



    public function edit(Sidang $sidang)
    {
        $tugasAkhirs = Tugas_akhir::all();
        $mahasiswas = Mahasiswa::all();
        $ruangans = Ruangan::all();
        $dosens = Dosen::all();
        return view('admin.sidang.edit', compact('sidang', 'tugasAkhirs', 'mahasiswas', 'ruangans', 'dosens'));
    }

    public function update(Request $request, Sidang $sidang)
    {
        $request->validate([
            'ta_id' => 'required|exists:tugas_akhirs,id_ta',
            'nim' => 'required|exists:tugas_akhirs,nim',
            'ketua_sidang_id' => 'required|exists:dosens,id_dosen',
            'penguji1_id' => 'required|exists:dosens,id_dosen',
            'penguji2_id' => 'required|exists:dosens,id_dosen',
            'sekretaris_id' => 'required|exists:dosens,id_dosen',
            'pembimbing1_id' => 'required|exists:dosens,id_dosen',
            'pembimbing2_id' => 'required|exists:dosens,id_dosen',
            'ruangan_id' => [
                'required',
                'exists:ruangans,id_ruangan',
                // Validasi unik untuk ruangan pada tanggal tertentu, kecuali untuk sidang yang sedang diupdate
                Rule::unique('sidangs')->where(function ($query) use ($request, $sidang) {
                    return $query->where('ruangan_id', $request->ruangan_id)
                        ->where('tanggal', $request->tanggal)
                        ->where('id', '!=', $sidang->id); // Exclude the current sidang id
                }),
            ],
            // Perbaikan pada validasi
            'tanggal' => 'required|date',
            'jam_sidang_id' => 'required|exists:ruangans,id_ruangan',
            'status_sidang' => 'nullable|string|max:20',
            'total_nilai' => 'nullable|numeric', // Validasi total_nilai
        ]);

        $sidang->update($request->all());

        return redirect()->route('admin.sidang.index')
            ->with('success', 'Sidang berhasil diperbarui.');
    }

    public function destroy($id)
    {
        try {
            $sidang = Sidang::findOrFail($id);
            $sidang->delete();

            return redirect()->route('admin.sidang.index')->with('success', 'Sidang berhasil dihapus.');
        } catch (\Throwable $th) {
            return redirect()->route('admin.sidang.index')->with('error', 'Gagal menghapus sidang.');
        }
    }

    public function getDataRuangan($ruanganId)
    {
        try {
            $ruangan = Ruangan::findOrFail($ruanganId);
            return $ruangan->no_ruangan;
        } catch (ModelNotFoundException $e) {
            return "Data Ruangan tidak ditemukan.";
        }
    }

    public function getDataTa($taId)
    {
        try {
            $ta = Tugas_akhir::findOrFail($taId);
            return $ta->judul;
        } catch (ModelNotFoundException $e) {
            return "Data Tugas Akhir tidak ditemukan.";
        }
    }

    public function getDataDosen($dosenId)
    {
        try {
            $dosen = Dosen::findOrFail($dosenId);
            return $dosen->nama;
        } catch (ModelNotFoundException $e) {
            return "Data Dosen tidak ditemukan.";
        }
    }

    public function showByTaId($taId)
    {
        $sidang = Sidang::where('ta_id', $taId)->first();

        if ($sidang) {
            return view('admin.sidang.detail', compact('sidang'));
        } else {
            return redirect()->route('admin.sidang.index')->with('error', 'Sidang tidak ditemukan.');
        }
    }
    public function getPembimbingByTA($taId)
    {
        try {
            // Cari data tugas akhir berdasarkan ID
            $tugasAkhir = Tugas_akhir::findOrFail($taId);

            // Ambil ID pembimbing 1 dan pembimbing 2 dari tugas akhir
            $pembimbing1Id = $tugasAkhir->pembimbing1_id;
            $pembimbing2Id = $tugasAkhir->pembimbing2_id;

            // Mengembalikan response JSON dengan ID pembimbing 1 dan pembimbing 2
            return response()->json([
                'pembimbing1_id' => $pembimbing1Id,
                'pembimbing2_id' => $pembimbing2Id,
            ]);
        } catch (ModelNotFoundException $e) {
            // Jika tugas akhir tidak ditemukan, kembalikan response dengan pesan error
            return response()->json(['error' => 'Data Tugas Akhir tidak ditemukan.'], 404);
        }
    }
    public function setKetuaSidang(Request $request)
    {
        try {
            $sidang = Sidang::findOrFail($request->sidang_id);
            $pembimbing1 = Dosen::findOrFail($sidang->pembimbing1_id);

            // Update ketua_sidang_id menjadi pembimbing1_id
            $sidang->update(['ketua_sidang_id' => $pembimbing1->id_dosen]);

            return response()->json(['success' => true, 'message' => 'Berhasil mengubah Ketua Sidang.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal mengubah Ketua Sidang.']);
        }
    }

    public function rekap($id)
    {
        $sidang = Sidang::with([
            'tugas_akhir',
            'pembimbing1', 'pembimbing2',
            'ketuaSidang', 'penguji1', 'penguji2', 'sekretaris',
            'ruangan'
        ])->findOrFail($id);

        // Dapatkan data penilaian
        $penilaianPembimbing1 = $sidang->penilaianPembimbing1()->where('jabatan', 'Pembimbing1')->first();
        $penilaianPembimbing2 = $sidang->penilaianPembimbing2()->where('jabatan', 'Pembimbing2')->first();
        $penilaianKetuaSidang = $sidang->penilaianKetuaSidang()->where('jabatan', 'KetuaSidang')->first();
        $penilaianPenguji1 = $sidang->penilaianPenguji1()->where('jabatan', 'Penguji1')->first();
        $penilaianPenguji2 = $sidang->penilaianPenguji2()->where('jabatan', 'Penguji2')->first();
        $penilaianSekretaris = $sidang->penilaianSekretaris()->where('jabatan', 'SekretarisSidang')->first();

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

        // Data yang akan diteruskan ke view PDF
        $data = [
            'sidang' => $sidang,
            'totalNilaiPembimbing1' => $totalNilaiPembimbing1,
            'totalNilaiPembimbing2' => $totalNilaiPembimbing2,
            'totalNilaiKetua' => $totalNilaiKetua,
            'totalNilaiPenguji1' => $totalNilaiPenguji1,
            'totalNilaiPenguji2' => $totalNilaiPenguji2,
            'totalNilaiSekretaris' => $totalNilaiSekretaris,
            'rataRata' => $rataRata,
            'statusSidang' => $statusSidang,
        ];

        $pdf = PDF::loadView('admin.rekap_pdf', $data);

        return $pdf->download('rekap_nilai_sidang.pdf');
    }
}
