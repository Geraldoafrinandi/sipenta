<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Sidang;
use App\Models\Tugas_akhir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeDosenController extends Controller
{
    public function index()
{
    // Mengambil data pengguna yang sedang login
    $user = Auth::user();

    // // Memastikan bahwa pengguna yang sedang login adalah dosen
    // if (!$user || !$user->isDosen()) {
    //     // Redirect jika pengguna bukan dosen atau tidak terautentikasi
    //     return redirect()->route('login');
    // }

    // Mendapatkan ID dosen
    $dosenId = $user->id;

    // Mendapatkan data dosen berdasarkan ID
    $dosen = Dosen::find($dosenId);

    // Memeriksa apakah dosen ditemukan
    // if (!$dosen) {
    //     // Mengembalikan response jika dosen tidak ditemukan
    //     abort(404, 'Dosen not found');
    // }

    // Mendapatkan mahasiswa yang dibimbing oleh dosen
    $bimbinganMahasiswa = Tugas_akhir::where('pembimbing1_id', $dosenId)
        ->orWhere('pembimbing2_id', $dosenId)
        ->with('mahasiswa', 'pembimbing1', 'pembimbing2')
        ->get();

    // Mendapatkan mahasiswa yang diuji oleh dosen
    $ujiMahasiswa = Sidang::where('penguji1_id', $dosenId)
        ->orWhere('penguji2_id', $dosenId)
        ->with('tugas_akhir.mahasiswa', 'penguji1', 'penguji2')
        ->get();

    // Mengirimkan data ke view 'admin.dashboard.dosen'
    return view('admin.dashboard.dosen', compact('bimbinganMahasiswa', 'ujiMahasiswa', 'user', 'dosen'));
}


}
