<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mahasiswas=Mahasiswa::latest()->paginate(5);
        return view('admin.mahasiswa.index',['mahasiswas'=>$mahasiswas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nim' => 'required|unique:mahasiswas',
            'nama_mahasiswa'=> 'required|min:2',
            'prodi'=> 'required',
            'angkatan'=> 'required',
            'status_mahasiswa'=> 'required',
            'prodi_id'=> 'required',
        ]);

        Mahasiswa::create($validated);
        return redirect('admin-mahasiswa');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.mahasiswa.edit',['prodis'=>Prodi::all(),'mahasiswa'=>Mahasiswa::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nim' => 'required',
            'nama_lengkap'=> 'required|min:2',
            'tempat_lahir'=> 'required',
            'tgl_lahir'=> 'required',
            'email'=> 'required',
            'prodi_id'=> 'required',
            'alamat'=> 'nullable',
        ]);

        Mahasiswa::where('id',$id)->update($validated);
        return redirect('/admin-mahasiswa')->with('pesan','Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Mahasiswa::destroy($id);
        return redirect('/admin-mahasiswa')->with('pesan','Data berhasil dihapus');
    }
}
