<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Prodi;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dosens = Dosen::with('prodi')->paginate(10);
        return view('admin.dosen.index', compact('dosens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $prodis = Prodi::all();
        return view('admin.dosen.create', compact('prodis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|unique:dosens,nama',
            'nidn' => 'required',
            'nip' => 'required',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'prodi_id' => 'required|exists:prodis,id_prodi', // assuming 'id' is the primary key of 'prodis' table
            'email' => 'nullable|email',
            'status' => 'required',
        ]);

        Dosen::create($validated);

        return redirect()->route('admin.dosen.index')->with('success', 'Dosen berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Implementasi jika diperlukan
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Dosen::destroy($id);
        return redirect()->route('admin.dosen.index')->with('success', 'Data berhasil dihapus');
    }
}
