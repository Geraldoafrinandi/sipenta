<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToCollection;

class ImportUser implements ToModel, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        {
            return new User([
                'name' => $row['name'],
                'email' => $row['email'],
                'role' => $row['role'],
                'password' => bcrypt('password123'), // Default password, user should change it after first login
            ]);
        }
    }
}
