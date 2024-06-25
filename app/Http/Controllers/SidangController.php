<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
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
        $sidangs = Sidang::with('penilaians')->get();
        return view('admin.sidang.index', compact('sidangs'));
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
        'nim' => 'required',
        'ketua_sidang_id' => 'required|exists:dosens,id_dosen',
        'penguji1_id' => 'required|exists:dosens,id_dosen',
        'penguji2_id' => 'required|exists:dosens,id_dosen',
        'sekretaris_id' => 'required|exists:dosens,id_dosen',
        'ruangan_id' => 'required|exists:ruangans,id_ruangan',
        'tanggal'=> 'required|date',
        'status_sidang' => 'nullable|string|max:20',
        'total_nilai' => 'nullable|numeric', // Validasi total_nilai
    ]);

    Sidang::create($request->all());

    return redirect()->route('admin.sidang.index')
                     ->with('success', 'Sidang berhasil ditambahkan.');
}

public function show(Sidang $sidang)
{
    $sidang->load('tugas_akhir', 'ruangan', 'ketuaSidang', 'penguji1', 'penguji2', 'sekretaris');

    return view('admin.sidang.show', compact('sidang'));
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
        'nim' => 'required',
        'ketua_sidang_id' => 'required|exists:dosens,id_dosen',
        'penguji1_id' => 'required|exists:dosens,id_dosen',
        'penguji2_id' => 'required|exists:dosens,id_dosen',
        'sekretaris_id' => 'required|exists:dosens,id_dosen',
        'ruangan_id' => 'required|exists:ruangans,id_ruangan',
        'tanggal'=> 'required|date',
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
}
