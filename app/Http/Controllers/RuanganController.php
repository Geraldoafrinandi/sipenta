<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    /**
     * Menampilkan daftar ruangan.
     */
    public function index()
    {
        $ruangan = Ruangan::latest()->paginate(10);

        return view('admin.ruangan.index', ['ruangans' => $ruangan]);
    }

    /**
     * Menampilkan form untuk membuat ruangan baru.
     */
    public function create()
    {
        return view('admin.ruangan.create');
    }

    /**
     * Menyimpan ruangan baru ke dalam database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_ruangan' => 'required|string|max:50',
            'jam_sidang' => 'required|string|max:50',
            'tanggal_sidang' => 'required|date',
        ]);

        Ruangan::create($validated);

        return redirect()->route('admin.ruangan.index')
                         ->with('success', 'Ruangan berhasil ditambahkan.');
    }

    /**
     * Menghapus ruangan dari database.
     */
    public function destroy($id)
    {
        Ruangan::where('id_ruangan', $id)->delete();

    return redirect()->route('admin.ruangan.index')
                     ->with('success', 'Ruangan berhasil dihapus.');
    }

    public function availableRooms()
    {
        // Mengambil ruangan yang belum digunakan dalam tabel sidang
        $ruangans = Ruangan::whereNotIn('id_ruangan', function ($query) {
            $query->select('ruangan_id')->from('sidangs');
        })->get();

        return view('admin.ruangan.available', compact('ruangans'));
    }
}
