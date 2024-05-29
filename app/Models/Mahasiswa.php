<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{

    use HasFactory;

    protected $table = 'mahasiswas'; // sesuaikan dengan nama tabel di database

    protected $fillable = [
        'nim',
        'nama_mahasiswa',
        'id_prodi',
        'angkatan',
        'gender',
        'status',
    ];

    protected $primaryKey = 'id_mahasiswa'; // Primary key yang benar

    public $timestamps = false;
}
