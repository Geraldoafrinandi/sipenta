<?php

namespace App\Http\Controllers;

use App\Models\Sidang;
use App\Models\Ruangan;
use App\Models\Mahasiswa;
use App\Models\Tugas_akhir;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SidangController extends Controller
{
    public function index()
    {
        $sidangs = Sidang::all();
        return view('admin.sidang.index', compact('sidangs'));
    }

    public function create()
    {
        $tugasAkhirs = Tugas_akhir::all();
        $mahasiswas = Mahasiswa::all();
        $ruangans = Ruangan::all();
        return view('admin.sidang.create', compact('tugasAkhirs', 'mahasiswas', 'ruangans'));
    }

    public function store(Request $request)
    {
        dd($request->all());
        $request->validate([
            'ta_id' => 'required|string|exists:tugas_akhirs,id_ta',
            'nim' => 'required',
            'ketua_sidang' => 'required|string|max:50',
            'penguji1' => 'required|string|max:50',
            'penguji2' => 'required|string|max:50',
            'sekretaris' => 'required|string|max:50',
            'ruangan_id' => 'required|string|exists:ruangans,id_ruangan',
            'status_sidang' => 'nullable|string|max:20',
        ]);

        return redirect()->route('admin.sidang.index')
                         ->with('success', 'Sidang berhasil ditambahkan.');
    }

    public function show(Sidang $sidang)
    {
        $sidang->load('tugas_akhirs', 'ruangans');
        return view('admin.sidang.show', compact('sidang'));
    }

    public function edit(Sidang $sidang)
    {
        $tugasAkhirs = Tugas_akhir::all();
        $mahasiswas = Mahasiswa::all();
        $ruangans = Ruangan::all();
        return view('admin.sidang.edit', compact('sidang', 'tugasAkhirs', 'mahasiswas', 'ruangans'));
    }

    public function update(Request $request, Sidang $sidang)
    {
        $request->validate([
            'ta_id' => 'required|exists:tugas_akhirs,id_ta',
            'nim' => 'required',
            'ketua_sidang' => 'required|string|max:50',
            'penguji1' => 'required|string|max:50',
            'penguji2' => 'required|string|max:50',
            'sekretaris' => 'required|string|max:50',
            'ruangan_id' => 'required|string|exists:ruangans,id_ruangan',
            'status_sidang' => 'nullable|string|max:20',
        ]);

        return redirect()->route('admin.sidang.index')->with('success', 'Sidang berhasil diperbarui.');
    }

    public function destroy(Sidang $sidang)
    {
        $sidang->delete();
        return redirect()->route('admin.sidang.index')->with('success', 'Sidang berhasil dihapus.');
    }

    public function getDataRuangan($ruanganId)
    {
        try {
            $ruangan = Ruangan::findOrFail($ruanganId);
            $nama_ruangan = $ruangan->ruangan->nama_ruangan;

            return $nama_ruangan;
        } catch (ModelNotFoundException $e) {
            // Handle jika data dosen tidak ditemukan
            return "Data Ruangan tidak ditemukan.";
        }
    }

    public function getDataTa($taId)
    {
        try {
            $ta = Tugas_akhir::findOrFail($taId);
            $judulTa = $ta->tugasAkhir->judul;

            return $judulTa;
        } catch (ModelNotFoundException $e) {
            // Handle jika data dosen tidak ditemukan
            return "Data Ruangan tidak ditemukan.";
        }
    }

    // Fungsi untuk menampilkan detail Sidang berdasarkan ta_id
    public function showByTaId($taId)
    {
        $sidang = Sidang::where('ta_id', $taId)->first();

        if ($sidang) {
            // Sidang ditemukan, lakukan apa yang diperlukan
            return view('sidang.detail', compact('sidang'));
        } else {
            // Sidang tidak ditemukan, mungkin tampilkan pesan atau redirect
            return redirect()->route('admin.sidang.index')->with('error', 'Sidang tidak ditemukan.');
        }
    }
}
