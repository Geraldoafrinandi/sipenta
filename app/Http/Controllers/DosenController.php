<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Prodi;
use App\Exports\ExportDosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Gate::allows('isAdmin')){
            abort(403);
        }


        $dosen = Dosen::latest()->paginate(10);
        return view('admin.dosen.index', ['dosens'=>$dosen]);
    }

    public function export_excel(){
        return Excel::download(new ExportDosen,"dosen.xlsx");
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

        Excel::import(new ImportDosen, $request->file('file'));

        return redirect()->back()->with('success', 'Data Dosen berhasil diimpor.');
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
            'nama' => 'required|string|max:255',
            'nidn' => 'required|string|max:50',
            'nip' => 'required|string|max:50',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'prodi_id' => 'required|string|exists:prodis,id_prodi',
            'email' => 'required|email|max:255',
            'status' => 'required',
        ]);


        Dosen::create($validated);

        return redirect()->route('admin.dosen.index')->with('success', 'Dosen berhasil ditambahkan.');
    }
    public function edit($id)
    {
        try {
            $dosen = Dosen::findOrFail($id);
            $prodis = Prodi::all();
            return view('admin.dosen.edit', compact('dosen', 'prodis'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.dosen.index')->with('error', 'Data dosen tidak ditemukan.');
        }
    }

    /**
     * Menyimpan perubahan data dosen ke dalam database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $dosen = Dosen::findOrFail($id);

            $validated = $request->validate([
                'nama' => 'required|string|max:255',
                'nidn' => 'required|string|max:50',
                'gender' => 'required|in:Laki-laki,Perempuan',
                'prodi_id' => 'required|exists:prodis,id_prodi',
                'email' => 'required|email|max:255',
                'status' => 'required',
            ]);

            $dosen->update($validated);

            return redirect()->route('admin.dosen.index')->with('success', 'Data dosen berhasil diperbarui.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.dosen.index')->with('error', 'Data dosen tidak ditemukan.');
        }
    }

    /**
     * Menampilkan detail data dosen.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        try {
            $dosen = Dosen::findOrFail($id);
            return view('admin.dosen.show', compact('dosen'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.dosen.index')->with('error', 'Data dosen tidak ditemukan.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Dosen::destroy($id);
        return redirect()->route('admin.dosen.index')->with('success', 'Data berhasil dihapus');
    }

    public function getDataDosen($dosenId)
    {
        try {
            $dosen = Dosen::findOrFail($dosenId);
            $namaProdi = $dosen->prodi->nama;

            return $namaProdi;
        } catch (ModelNotFoundException $e) {
            // Handle jika data dosen tidak ditemukan
            return "Data dosen tidak ditemukan.";
        }
    }
}
