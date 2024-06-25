<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Tugas_akhir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Tugas_akhirController extends Controller
{
    public function download($id_ta)
    {
        $tugasAkhir = DB::table('tugas_akhirs')->where('id_ta', $id_ta)->first();

        if (!$tugasAkhir) {
            abort(404, 'File not found in database.');
        }

        // Pastikan path sesuai dengan struktur yang benar setelah symbolic link
        $filePath = storage_path("app/public/{$tugasAkhir->dokumen}");

        // Gunakan Storage facade untuk memeriksa apakah file ada di disk
        if (!Storage::disk('public')->exists($tugasAkhir->dokumen)) {
            abort(404, 'File not found on disk.');
        }

        // Download file menggunakan Storage facade
        return Storage::disk('public')->download($tugasAkhir->dokumen);
    }


    public function create()
    {
        $dosens = Dosen::all();
        return view('admin.tugas_akhir.create', compact('dosens'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nim' => 'required|string|max:20',
            'pembimbing1_id' => 'required|exists:dosens,id_dosen',
            'pembimbing2_id' => 'required|exists:dosens,id_dosen',
            'judul' => 'required|string',
            'dokumen' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'tgl_pengajuan' => 'required|date',
        ]);

        try {
            if ($request->hasFile('dokumen')) {
                $file = $request->file('dokumen');
                $filename = $file->getClientOriginalName(); // Mengambil nama asli file
                $path = $file->storeAs('public', $filename); // Simpan file ke dalam storage public/dokumen
                $validatedData['dokumen'] = $filename; // Simpan nama file di database
            }

            Tugas_akhir::create([
                'nim' => $request->nim,
                'pembimbing1_id' => $request->pembimbing1_id,
                'pembimbing2_id' => $request->pembimbing2_id,
                'judul' => $request->judul,
                'dokumen' => $filename, // Save the filename
                'tgl_pengajuan' => $request->tgl_pengajuan,
            ]);

            return redirect()->route('tugas_akhir.index')->with('success', 'Tugas Akhir berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menyimpan data. Pesan error: ' . $e->getMessage()]);
        }
    }

    public function index()
    {
        $tugasAkhir = DB::table('tugas_akhirs')->get();
        $tugasAkhir = Tugas_akhir::with(['pembimbing1', 'pembimbing2'])->get();
        return view('admin.tugas_akhir.index', compact('tugasAkhir'));
    }

    public function edit($id)
    {
        $tugasAkhir = Tugas_akhir::findOrFail($id);
        return view('admin.tugas_akhir.edit', compact('tugasAkhir'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nim' => 'required|string|max:20',
            'pembimbing1' => 'required|string|max:100',
            'pembimbing2' => 'required|string|max:100',
            'judul' => 'required|string',
            'dokumen' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'tgl_pengajuan' => 'required|date',
        ]);

        $tugasAkhir = Tugas_akhir::findOrFail($id);

        try {
            if ($request->hasFile('dokumen')) {
                // Delete the old file if exists
                if ($tugasAkhir->dokumen) {
                    Storage::delete('public/storage/' . $tugasAkhir->dokumen);
                }
                // Store the new file
                $file = $request->file('dokumen');
                $filename = $file->getClientOriginalName(); // Mengambil nama asli file
                $path = $file->storeAs('public/dokumen', $filename); // Simpan file ke dalam storage public/dokumen
                $validatedData['dokumen'] = $filename;
            }

            Tugas_akhir::where('id_ta', $id)->update($validatedData);

            return redirect()->route('tugas_akhir.index')->with('success', 'Tugas Akhir berhasil diupdate.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal mengupdate data. Pesan error: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $tugasAkhir = Tugas_akhir::findOrFail($id);

            // Delete the associated file from storage if it exists
            if ($tugasAkhir->dokumen) {
                Storage::delete('public/' . $tugasAkhir->dokumen);
            }

            $tugasAkhir->delete();

            return redirect()->route('tugas_akhir.index')->with('success', 'Tugas Akhir berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menghapus data. Pesan error: ' . $e->getMessage()]);
        }
    }
}
