<?php

namespace App\Http\Controllers;

use App\Models\Penilaian;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    public function index()
    {
        $penilaians = Penilaian::paginate(10); // Menggunakan pagination
        return view('admin.penilaian.index', compact('penilaians'));
    }

    public function create()
    {
        return view('admin.penilaian.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'materi_penilaian' => 'nullable|array',
            'materi_penilaian.*' => 'nullable|string',
            'bobot' => 'required|array',
            'bobot.*' => 'required|integer',
            'skor' => 'nullable|array',
            'skor.*' => 'required|numeric',
            'revisi' => 'nullable|string',
        ]);

        // Periksa apakah 'materi_penilaian' ada dalam $validatedData
        if (isset($validatedData['materi_penilaian'])) {
            foreach ($validatedData['materi_penilaian'] as $index => $materi_penilaian) {
                // Pastikan untuk mengakses $validatedData['bobot'][$index] dan $validatedData['skor'][$index] dengan aman
                $bobot = isset($validatedData['bobot'][$index]) ? $validatedData['bobot'][$index] : null;
                $skor = isset($validatedData['skor'][$index]) ? $validatedData['skor'][$index] : null;

                // Buat entri baru Penilaian
                Penilaian::create([
                    'materi_penilaian' => $materi_penilaian,
                    'bobot' => $bobot,
                    'skor' => $skor,
                    'revisi' => $validatedData['revisi'] ?? 'Tidak ada',
                ]);
            }
        } else {
            // Tangani kasus jika 'materi_penilaian' tidak ada dalam $validatedData
            // Contoh: kirimkan pesan kesalahan atau lakukan tindakan yang sesuai
            return redirect()->back()->withErrors(['message' => 'Data materi penilaian tidak valid.']);
        }

        return redirect()->route('admin.penilaian.index')->with('success', 'Penilaian berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $penilaian = Penilaian::findOrFail($id);
        $penilaian->delete();

        return redirect()->route('admin.penilaian.index')->with('success', 'Penilaian berhasil dihapus.');
}
}
