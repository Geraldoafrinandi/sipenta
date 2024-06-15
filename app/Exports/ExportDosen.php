<?php

namespace App\Exports;

use App\Models\Dosen;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class ExportDosen implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function view():View
    {
            $dosens = Dosen::all(); // Mengambil semua data tanpa pagination
            return view('admin.dosen.export-table', ['dosens' => $dosens]);
    }
}
