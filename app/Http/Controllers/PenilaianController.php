<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Penilaian;
use App\Models\Tugas_akhir;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    public function index()
    {
        $penilaians = Penilaian::with('sidang', 'tugas_akhir', 'dosen')->get();
        return view('admin.penilaian.index', compact('penilaians'));
    }

    public function create()
    {
        $tugasAkhirs = Tugas_akhir::with('sidang','sekretarisSidang','penguji1','penguji2')->get();
        $dosens = Dosen::all();
        return view('admin.penilaian.create', compact('tugasAkhirs', 'dosens'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'ta_id' => 'required|exists:tugas_akhirs,id_ta',
            'jabatan' => 'required|string',
            'nilai_dosen' => 'required|exists:dosens,id_dosen',
            'presentasi_sikap_penampilan' => 'required|numeric|min:0|max:100',
            'presentasi_komunikasi_sistematika' => 'required|numeric|min:0|max:100',
            'presentasi_penguasaan_materi' => 'required|numeric|min:0|max:100',
            'makalah_identifikasi_masalah' => 'required|numeric|min:0|max:100',
            'makalah_relevansi_teori' => 'required|numeric|min:0|max:100',
            'makalah_metode_algoritma' => 'required|numeric|min:0|max:100',
            'makalah_hasil_pembahasan' => 'required|numeric|min:0|max:100',
            'makalah_kesimpulan_saran' => 'required|numeric|min:0|max:100',
            'makalah_bahasa_tata_tulis' => 'required|numeric|min:0|max:100',
            'produk_kesesuaian_fungsional' => 'required|numeric|min:0|max:100',
            'total_nilai' => 'required|numeric|min:0|max:100',
            'komentar' => 'nullable|string',
        ]);

        // Cek apakah penilaian untuk Tugas Akhir, Jabatan, dan Dosen yang sama sudah ada
        $existingPenilaian = Penilaian::where('ta_id', $request->ta_id)
            ->where('jabatan', $request->jabatan)
            ->where('nilai_dosen', $request->nilai_dosen)
            ->first();

        // Jika penilaian sudah ada, tetapkan nilai baru
        if ($existingPenilaian) {
            $existingPenilaian->update($validatedData);
            $existingPenilaian->total_nilai = $this->calculateTotalNilai($request);
            $existingPenilaian->save();
            return redirect()->route('admin.sidang.index')->with('success', 'Penilaian berhasil diperbarui.');
        }

        // Simpan penilaian baru jika belum ada sebelumnya
        $penilaian = new Penilaian($validatedData);
        $penilaian->total_nilai = $this->calculateTotalNilai($request);
        $penilaian->save();

        return redirect()->route('admin.sidang.index')->with('success', 'Penilaian berhasil ditambahkan.');
    }

    public function show(Penilaian $penilaian)
    {
        return view('admin.penilaian.show', compact('penilaian'));
    }

    public function edit(Penilaian $penilaian)
    {
        $tugasAkhirs = Tugas_akhir::all();
        $dosens = Dosen::all();
        return view('admin.penilaian.edit', compact('penilaian', 'tugasAkhirs', 'dosens'));
    }

    public function update(Request $request, Penilaian $penilaian)
    {
        $validatedData = $request->validate([
            'ta_id' => 'required|exists:tugas_akhirs,id_ta',
            'jabatan' => 'required|string',
            'nilai_dosen' => 'required|exists:dosens,id_dosen',
            'presentasi_sikap_penampilan' => 'required|numeric|min:0|max:100',
            'presentasi_komunikasi_sistematika' => 'required|numeric|min:0|max:100',
            'presentasi_penguasaan_materi' => 'required|numeric|min:0|max:100',
            'makalah_identifikasi_masalah' => 'required|numeric|min:0|max:100',
            'makalah_relevansi_teori' => 'required|numeric|min:0|max:100',
            'makalah_metode_algoritma' => 'required|numeric|min:0|max:100',
            'makalah_hasil_pembahasan' => 'required|numeric|min:0|max:100',
            'makalah_kesimpulan_saran' => 'required|numeric|min:0|max:100',
            'makalah_bahasa_tata_tulis' => 'required|numeric|min:0|max:100',
            'produk_kesesuaian_fungsional' => 'required|numeric|min:0|max:100',
            'total_nilai' => 'required|numeric|min:0|max:100',
            'komentar' => 'nullable|string',
        ]);

        // Cek apakah penilaian untuk Tugas Akhir, Jabatan, dan Dosen yang sama sudah ada di Tugas Akhir yang berbeda
        $existingPenilaian = Penilaian::where('ta_id', '!=', $request->ta_id) // pastikan tidak memeriksa dirinya sendiri
            ->where('jabatan', $request->jabatan)
            ->where('nilai_dosen', $request->nilai_dosen)
            ->first();

        // Jika penilaian sudah ada, tetapkan nilai baru
        if ($existingPenilaian) {
            $existingPenilaian->update($validatedData);
            $existingPenilaian->total_nilai = $this->calculateTotalNilai($request);
            $existingPenilaian->save();
            return redirect()->route('admin.penilaian.index')->with('success', 'Penilaian berhasil diperbarui.');
        }

        // Update penilaian jika belum ada sebelumnya
        $penilaian->update($validatedData);
        $penilaian->total_nilai = $this->calculateTotalNilai($request);
        $penilaian->save();

        return redirect()->route('admin.penilaian.index')->with('success', 'Penilaian berhasil diperbarui.');
    }

    public function destroy(Penilaian $penilaian)
    {
        $penilaian->delete();
        return redirect()->route('admin.penilaian.index')->with('success', 'Penilaian berhasil dihapus.');
    }

    private function calculateTotalNilai(Request $request)
    {
        return
            ($request->presentasi_sikap_penampilan * 0.05) +
            ($request->presentasi_komunikasi_sistematika * 0.05) +
            ($request->presentasi_penguasaan_materi * 0.20) +
            ($request->makalah_identifikasi_masalah * 0.05) +
            ($request->makalah_relevansi_teori * 0.05) +
            ($request->makalah_metode_algoritma * 0.10) +
            ($request->makalah_hasil_pembahasan * 0.15) +
            ($request->makalah_kesimpulan_saran * 0.05) +
            ($request->makalah_bahasa_tata_tulis * 0.05) +
            ($request->produk_kesesuaian_fungsional * 0.25);
    }
}
