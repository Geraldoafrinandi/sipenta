<?php

namespace App\Http\Controllers;

use App\Models\Tugas_akhir;
use Illuminate\Http\Request;
use App\Models\ValidasiProposal;
use Illuminate\Support\Facades\Storage;

class ValidasiProposalController extends Controller
{
    public function index()
    {
        $validasiProposals = ValidasiProposal::with('tugasAkhir')->get(); // Mengambil relasi mahasiswa
        return view('admin.validasi_proposal.index', compact('validasiProposals'));
    }

    public function downloadProposal($id)
{
    // Cari validasi proposal berdasarkan ID
    $validasiProposal = ValidasiProposal::findOrFail($id);

    // Ambil nama file proposal dari relasi Tugas Akhir
    $proposalFileName = $validasiProposal->tugasAkhir->proposal;

    // Pastikan file ada di dalam direktori yang tepat dalam storage publik
    $filePath = storage_path("app/public/proposal/{$proposalFileName}");

    // Cek apakah file ada di storage publik
    if (Storage::disk('public')->exists("proposal/{$proposalFileName}")) {
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

        return view('admin.validasi_proposal.create', compact('taId', 'nim', 'namaMahasiswa', 'judul'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mahasiswa_id' => 'required|exists:tugas_akhirs,nim',
            'ta_id' => 'required|exists:tugas_akhirs,id_ta',
            'status_validasi' => 'required|in:Valid,Tidak Valid,Pending',
            'tanggal_validasi' => 'required|date',
            'catatan' => 'nullable|string',
        ]);

        ValidasiProposal::create([
            'mahasiswa_id' => $request->mahasiswa_id,
            'ta_id' => $request->ta_id,
            'status_validasi' => $request->status_validasi,
            'tanggal_validasi' => $request->tanggal_validasi,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('admin.tugas_akhir.index')->with('success', 'Validasi Proposal berhasil disimpan.');
    }

    // Menampilkan detail validasi tertentu
    public function show($id)
    {
        $validasiProposal = ValidasiProposal::findOrFail($id);
        return view('admin.validasi_proposal.show', compact('validasiProposal'));
    }

    // Menampilkan form untuk mengedit validasi tertentu
    public function edit($id)
    {
        $validasiProposal = ValidasiProposal::findOrFail($id);
        $tugasAkhirs = Tugas_akhir::all();
        return view('admin.validasi_proposal.edit', compact('validasiProposal', 'tugasAkhirs'));
    }

    // Memperbarui validasi tertentu di database
    public function update(Request $request, $id)
    {
        $request->validate([
            'mahasiswa_id' => 'required|exists:tugas_akhirs,nim',
            'ta_id' => 'required|exists:tugas_akhirs,id_ta',
            'status_validasi' => 'required|in:Valid,Tidak Valid',
            'tanggal_validasi' => 'required|date',
            'catatan' => 'nullable|string',
        ]);

        $validasiProposal = ValidasiProposal::findOrFail($id);
        $validasiProposal->update($request->all());

        return redirect()->route('validasi_proposal.index')->with('success', 'Validasi Proposal berhasil diperbarui.');
    }

    // Menghapus validasi tertentu dari database
    public function destroy($id)
    {
        $validasiProposal = ValidasiProposal::findOrFail($id);
        $validasiProposal->delete();

        return redirect()->route('validasi_proposal.index')->with('success', 'Validasi Proposal berhasil dihapus.');
    }
}
