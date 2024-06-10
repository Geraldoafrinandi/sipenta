<?php

namespace App\Models;

use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Prodi extends Model
{
    use HasFactory;

    protected $table = 'prodis';
    protected $primaryKey = 'id_prodi';

    protected $fillable = [
        'nama_prodi',
    ];

    public function mahasiswas()
    {
        return $this->hasMany(Mahasiswa::class, 'prodi_id', 'id', 'id_prodi');
    }

    public function dosens()
    {
        return $this->hasMany(Dosen::class, 'prodi_id', 'id', 'id_prodi');
    }
}

