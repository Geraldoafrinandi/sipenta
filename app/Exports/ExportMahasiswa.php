<?php

namespace App\Exports;

use App\Models\Mahasiswa;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class ExportMahasiswa implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function view():View
    {
        $mahasiswas = Mahasiswa::latest()->paginate(10);
        return view('admin.mahasiswa.table', ['mahasiswas' => $mahasiswas]);
    }
}
