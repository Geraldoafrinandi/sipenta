<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;
    protected $table = 'dosens'; // sesuaikan dengan nama tabel di database
    protected $fillable = [
        'nama',
        'nidn',
        'nip',
        'gender',
        'id_prodi',
        'email',
        'status',
    ];

    protected $primaryKey = 'id_dosen'; // Primary key yang benar
    protected $guarded = [];
}
