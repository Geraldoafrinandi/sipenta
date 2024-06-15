<?php

namespace App\Imports;

use App\Models\Mahasiswa;
// use Illuminate\Support\Collection;
// use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class ImportMahasiswa implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new mahasiswa([
            'nim' => $row['nim'],
            'nama_mahasiswa' => $row['nama_mahasiswa'],
            'prodi_id' => $row['prodi_id'],
            'gender' => $row['gender'],
            'angkatan' => $row['angkatan'],
            'status_mahasiswa' => $row['status_mahasiswa'],
   ]);
}
}
