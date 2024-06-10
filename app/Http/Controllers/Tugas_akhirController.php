<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tugas_akhir;

class Tugas_akhirController extends Controller
{
    public function create()
    {
        return view('admin.tugas_akhir.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nim' => 'required|string|max:20',
            'pembimbing1' => 'required|string|max:100',
            'pembimbing2' => 'required|string|max:100',
            'judul' => 'required|string',
            'tgl_pengajuan' => 'required|date',
        ]);

        Tugas_akhir::create($validatedData);

        return redirect()->route('tugas_akhir.index')->with('success', 'Tugas Akhir berhasil ditambahkan.');
    }

    public function index()
    {
        $tugasAkhir = Tugas_akhir::all();
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
            'tgl_pengajuan' => 'required|date',
        ]);

        Tugas_akhir::where('id_ta', $id)->update($validatedData);

        return redirect()->route('tugas_akhir.index')->with('success', 'Tugas Akhir berhasil diupdate.');
    }

    public function destroy($id)
    {
        $tugasAkhir = Tugas_akhir::findOrFail($id);
        $tugasAkhir->delete();

        return redirect()->route('tugas_akhir.index')->with('success', 'Tugas Akhir berhasil dihapus.');
    }
}
