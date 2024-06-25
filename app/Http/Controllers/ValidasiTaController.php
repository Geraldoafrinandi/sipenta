<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Tugas_akhir;
use App\Models\ValidasiTa;
use Illuminate\Http\Request;

class ValidasiTaController extends Controller
{
    public function index()
    {
        $validasiTas = ValidasiTa::with('mahasiswa')->get(); // Mengambil relasi mahasiswa

        return view('admin.validasi_ta.index', compact('validasiTas'));
    }

    // Menampilkan form untuk membuat validasi baru
    public function create()
    {
        $mahasiswas = Mahasiswa::all();
        $tugasAkhirs = Tugas_akhir::all();
        return view('admin.validasi_ta.create', compact('mahasiswas', 'tugasAkhirs'));
    }

    // Menyimpan validasi baru ke database
    public function store(Request $request)
{
    $request->validate([
        'mahasiswa_id' => 'required|exists:mahasiswas,id',
        'ta_id' => 'required|exists:tugas_akhirs,id_ta',
        'status_validasi' => 'required|in:Valid,Tidak Valid,Pending',
        'tanggal_validasi' => 'required|date',
        'catatan' => 'nullable|string',
    ]);

    $mahasiswa = Mahasiswa::find($request->mahasiswa_id);

    if (!$mahasiswa) {
        // Handle jika mahasiswa tidak ditemukan
        abort(404, 'Mahasiswa tidak ditemukan.');
    }

    // Lanjutkan dengan menyimpan validasi tugas akhir baru
    ValidasiTa::create([
        'mahasiswa_id' => $request->mahasiswa_id,
        'ta_id' => $request->ta_id,
        'status_validasi' => $request->status_validasi,
        'tanggal_validasi' => $request->tanggal_validasi,
        'catatan' => $request->catatan,
    ]);

    // Redirect dengan pesan sukses jika berhasil
    return redirect()->route('validasi_ta.index')->with('success', 'Validasi Tugas Akhir berhasil disimpan.');
}

    // Menampilkan detail validasi tertentu
    public function show($id)
    {
        $validasiTa = ValidasiTa::findOrFail($id);
        return view('admin.validasi_ta.show', compact('validasiTa'));
    }

    // Menampilkan form untuk mengedit validasi tertentu
    public function edit($id)
    {
        $validasiTa = ValidasiTa::findOrFail($id);
        $mahasiswas = Mahasiswa::all();
        $tugasAkhirs = Tugas_akhir::all();
        return view('admin.validasi_ta.edit', compact('validasiTa', 'mahasiswas', 'tugasAkhirs'));
    }

    // Memperbarui validasi tertentu di database
    public function update(Request $request, $id)
    {
        $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswas,id',
            'ta_id' => 'required|exists:tugas_akhir,id_ta',
            'status_validasi' => 'required|in:Valid,Tidak Valid,Pending',
            'tanggal_validasi' => 'required|date',
            'catatan' => 'nullable|string',
        ]);

        $validasiTa = ValidasiTa::findOrFail($id);
        $validasiTa->update($request->all());

        return redirect()->route('validasi_ta.index')->with('success', 'Validasi tugas akhir berhasil diperbarui.');
    }

    // Menghapus validasi tertentu dari database
    public function destroy($id)
    {
        $validasiTa = ValidasiTa::findOrFail($id);
        $validasiTa->delete();

        return redirect()->route('validasi_ta.index')->with('success', 'Validasi tugas akhir berhasil dihapus.');
    }

    public function getMahasiswasByTugasAkhir($id)
    {
        // Cari tugas akhir berdasarkan ID
        $tugasAkhir = Tugas_akhir::findOrFail($id);

        // Ambil semua mahasiswa yang terdaftar pada tugas akhir ini
        $mahasiswas = $tugasAkhir->mahasiswas()->select('id', 'nim')->get();

        // Kembalikan data dalam format JSON
        return response()->json($mahasiswas);
    }
}
