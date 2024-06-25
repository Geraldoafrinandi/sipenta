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
        'ketua_sidang_id',
        'penguji1_id',
        'penguji2_id',
        'sekretaris_id',
        'ruangan_id',
        'tanggal',
        'status_sidang',
        'total_nilai',
    ];

    // Relasi ke tabel TugasAkhir
    public function tugas_akhir()
    {
        return $this->belongsTo(Tugas_akhir::class, 'ta_id','id_ta');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim','nim');
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id','id_ruangan');
    }

    public function ketuaSidang()
    {
        return $this->belongsTo(Dosen::class, 'ketua_sidang_id');
    }

    public function penguji1()
    {
        return $this->belongsTo(Dosen::class, 'penguji1_id');
    }

    public function penguji2()
    {
        return $this->belongsTo(Dosen::class, 'penguji2_id');
    }
    public function sekretaris()
    {
        return $this->belongsTo(Dosen::class, 'sekretaris_id');
    }
    public function penilaians()
    {
        return $this->hasMany(Penilaian::class, 'sidang_id', 'id');
    }
}
