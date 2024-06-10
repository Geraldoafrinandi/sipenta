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
        $dosens = Dosen::latest()->paginate(10);
        return view('admin.dosen.table', ['dosens' => $dosens]);

    }
}
