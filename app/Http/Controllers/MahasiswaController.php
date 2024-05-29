<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswas = Mahasiswa::with('prodi')->paginate(10); // menggunakan pagination
        return view('admin.mahasiswa.index', compact('mahasiswas'));
    }

    public function create()
    {
        $prodis = Prodi::all();
        return view('admin.mahasiswa.create', compact('prodis'));
    }

    public function store(Request $request)
    {
        // Debugging statement untuk melihat data yang dikirim
        // dd($request->all());

        $validatedData = $request->validate([
            'nim' => 'required|numeric|unique:mahasiswas,nim',
            'nama_mahasiswa' => 'required|string|max:255',
            'id_prodi' => 'required|exists:prodis,id', // validasi sesuai dengan primary key 'id' pada tabel 'prodis'
            'angkatan' => 'required|numeric|digits:4',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'status' => 'required|string|max:25',
        ]);

        Mahasiswa::create($validatedData);

        return redirect()->route('admin-mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Mahasiswa berhasil dihapus.');
    }


}


