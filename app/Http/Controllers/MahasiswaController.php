<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Exports\ExportMahasiswa;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MahasiswaController extends Controller
{


    public function index()
    {
        $mahasiswas = Mahasiswa::latest()->paginate(10);
        return view('admin.mahasiswa.index', ['mahasiswas' => $mahasiswas]);
    }

    public function export_excel(){
        return Excel::download(new ExportMahasiswa,"mahasiswa.xlsx");
    }

    public function showImportForm()
    {
        return view('admin.dosen.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx',
        ]);

        Excel::import(new ImportMahasiswa, $request->file('file'));

        return redirect()->back()->with('success', 'Data Dosen berhasil diimpor.');
    }

    public function create()
    {
        $prodis = Prodi::all();
        return view('admin.mahasiswa.create', compact('prodis'));
    }

    public function edit($id)
    {
        try {
            $mahasiswa = Mahasiswa::findOrFail($id);
            $prodis = Prodi::all(); // Ambil semua data prodi untuk dropdown

            return view('admin.mahasiswa.edit', compact('mahasiswa', 'prodis'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.mahasiswa.index')->with('error', 'Mahasiswa tidak ditemukan.');
        }
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nim' => 'required|numeric|unique:mahasiswas,nim,' . $id,
            'nama_mahasiswa' => 'required|string|max:255',
            'prodi_id' => 'required|string|exists:prodis,id_prodi',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'angkatan' => 'required|numeric|digits:4',
            'status_mahasiswa' => 'required|string|max:25',
        ]);

        try {
            $mahasiswa = Mahasiswa::findOrFail($id);
            $mahasiswa->update($validatedData); // Update data mahasiswa

            return redirect()->route('admin.mahasiswa.index')->with('success', 'Mahasiswa berhasil diperbarui.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.mahasiswa.index')->with('error', 'Mahasiswa tidak ditemukan.');
        }
    }


    public function store(Request $request)
    {


        $validatedData = $request->validate([
            'nim' => 'required|numeric|unique:mahasiswas,nim',
            'nama_mahasiswa' => 'required|string|max:255',
            'prodi_id' => 'required|string|exists:prodis,id_prodi',  //  validasi sesuai dengan primary key 'id' pada tabel 'prodis'
            'gender' => 'required|in:Laki-laki,Perempuan',
            'angkatan' => 'required|numeric|digits:4',
            'status_mahasiswa' => 'required|string|max:25',
        ]);



        Mahasiswa::create($validatedData);

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan.');
    }


    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Mahasiswa berhasil dihapus.');
    }

    public function getDataMahasiswa($mahasiswaId)
    {
        try {
            $mahasiswa = Mahasiswa::findOrFail($mahasiswaId);
            $namaProdi = $mahasiswa->prodi->nama;

            return $namaProdi;
        } catch (ModelNotFoundException $e) {
            // Handle jika data dosen tidak ditemukan
            return "Data Dosen tidak ditemukan.";
        }
    }
}
