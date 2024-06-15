<?php

namespace App\Imports;

use App\Models\Dosen;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportDosen implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Dosen([
            'nama' => $row['nama'],
            'nidn' => $row['nidn'],
            'gender' => $row['gender'],
            'prodi_id' => $row['prodi_id'],
            'email' => $row['email'],
            'status' => $row['status'],
        ]);
    }
}
