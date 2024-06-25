<?php

namespace App\Http\Controllers;

use App\Models\Sidang;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil semua ruangan
        $ruangans = Ruangan::all();

        // Ambil semua sidang
        $sidangs = Sidang::all();

        // Tambahkan keterangan tersedia atau tidak beserta tanggalnya
        foreach ($ruangans as $ruangan) {
            $ruangan->keterangan = 'Tersedia';
            $ruangan->tanggal_sidang;

            foreach ($sidangs as $sidang) {
                if ($sidang->ruangan_id == $ruangan->id_ruangan) {
                    $ruangan->keterangan = 'Tidak Tersedia';
                    // Asumsikan setiap ruangan hanya memiliki satu tanggal sidang
                    $ruangan->tanggal_sidang = Carbon::parse($sidang->tanggal)->format('d-m-Y');
                }
            }
        }

        return view('admin.dashboard', compact('ruangans'));
    }
}
