<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sidang extends Model
{
    use HasFactory;

    protected $table = 'sidangs';

    protected $fillable = [
        'ta_id',
        'nim',
        'ketua_sidang',
        'penguji1',
        'penguji2',
        'sekretaris',
        'ruangan_id',
        'status_sidang',
    ];

    // Relasi ke tabel TugasAkhir
    public function tugas_akhirs()
    {
        return $this->belongsTo(Tugas_akhir::class, 'ta_id');
    }

    // Relasi ke tabel Mahasiswa
    public function mahasiswas()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim');
    }

    // Relasi ke tabel Ruangan
    public function ruangans()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id','id');
    }
}
