<?php

namespace App\Models;

use App\Models\Prodi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mahasiswa extends Model
{

    use HasFactory;

    protected $table = 'mahasiswas'; // sesuaikan dengan nama tabel di database
    protected $primaryKey = 'id'; // Primary key yang benar

    protected $fillable = [
        'nim',
        'nama_mahasiswa',
        'prodi_id',
        'gender',
        'angkatan',
        'status_mahasiswa',
    ];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id', 'id_prodi');
    }

    public function sidangs()
    {
        return $this->hasMany(Sidang::class, 'nim', 'nim');
    }


    public $timestamps = false;
}
