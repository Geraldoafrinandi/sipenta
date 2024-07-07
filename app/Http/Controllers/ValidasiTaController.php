<?php

namespace App\Http\Controllers;

use App\Models\ValidasiTa;
use App\Models\Tugas_akhir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ValidasiTaController extends Controller
{
    public function index()
    {
        $validasiTas = ValidasiTa::with('tugasAkhir')->get(); // Mengambil relasi mahasiswa

        return view('admin.validasi_ta.index', compact('validasiTas'));
    }

    public function downloadTa($id)
{
    // Cari validasi proposal berdasarkan ID
    $validasiTa = ValidasiTa::findOrFail($id);

    // Ambil nama file proposal dari relasi Tugas Akhir
    $proposalFileName = $validasiTa->tugasAkhir->laporan_ta;

    // Pastikan file ada di dalam direktori yang tepat dalam storage publik
    $filePath = storage_path("app/public/laporan_ta/{$proposalFileName}");

    // Cek apakah file ada di storage publik
    if (Storage::disk('public')->exists("laporan_ta/{$proposalFileName}")) {
        // Jika ada, kirim response untuk mengunduh file
        return response()->download($filePath);
    } else {
        // Jika tidak ditemukan, tampilkan error 404
        abort(404, 'File not found');
    }
}

    // Menampilkan form untuk membuat validasi baru
    public function create(Request $request)
    {
        $taId = $request->query('ta_id');
        $nim = $request->query('nim');
        $namaMahasiswa = $request->query('nama_mahasiswa');
        $judul = $request->query('judul');

        return view('admin.validasi_ta.create', compact('taId', 'nim', 'namaMahasiswa', 'judul'));
    }

    // Menyimpan validasi baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'mahasiswa_id' => 'required|exists:tugas_akhirs,nim',
            'ta_id' => 'required|exists:tugas_akhirs,id_ta',
            'status_validasi' => 'required|in:Valid,Tidak Valid,Pending',
            'tanggal_validasi' => 'required|date',
            'catatan' => 'nullable|string',
        ]);

        // Lanjutkan dengan menyimpan validasi tugas akhir baru
        ValidasiTa::create([
            'mahasiswa_id' => $request->mahasiswa_id,
            'ta_id' => $request->ta_id,
            'status_validasi' => $request->status_validasi,
            'tanggal_validasi' => $request->tanggal_validasi,
            'catatan' => $request->catatan,
        ]);

        // Redirect dengan pesan sukses jika berhasil
        return redirect()->route('admin.tugas_akhir.index')->with('success', 'Validasi Tugas Akhir berhasil disimpan.');
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
        $tugasAkhirs = Tugas_akhir::all();
        return view('admin.validasi_ta.edit', compact('validasiTa', 'tugasAkhirs'));
    }

    // Memperbarui validasi tertentu di database
    public function update(Request $request, $id)
    {
        $request->validate([
            'mahasiswa_id' => 'required|exists:tugas_akhirs,nim',
            'ta_id' => 'required|exists:tugas_akhirs,id_ta',
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
}
