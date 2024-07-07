<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use App\Models\Sidang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeMahasiswaController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Mengambil data sidang berdasarkan user yang login (dengan nim)
        $sidang = Sidang::where('nim', $user->nim)->with('tugas_akhir','ruangan')->first();

        return view('admin.dashboard.mahasiswa', compact('user', 'sidang'));
    }
}
