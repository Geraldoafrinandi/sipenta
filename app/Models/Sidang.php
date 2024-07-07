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
        'pembimbing1_id',
        'pembimbing2_id',
        'ruangan_id',
        'tanggal',
        'jam_sidang_id',
        'status_sidang',
        'total_nilai',
    ];

    // Relasi ke tabel TugasAkhir
    public function tugas_akhir()
    {
        return $this->belongsTo(Tugas_akhir::class, 'ta_id', 'id_ta');
    }
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim');
    }
    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id', 'id_ruangan');
    }
    public function penilaians()
    {
        return $this->hasMany(Penilaian::class, 'id');
    }

    public function penilaianKetuaSidang()
    {
        return $this->hasMany(Penilaian::class, 'nilai_dosen', 'ketua_sidang_id');
    }

    public function penilaianPenguji1()
    {
        return $this->hasMany(Penilaian::class, 'nilai_dosen', 'penguji1_id');
    }

    public function penilaianPenguji2()
    {
        return $this->hasMany(Penilaian::class, 'nilai_dosen', 'penguji2_id');
    }

    public function penilaianSekretaris()
    {
        return $this->hasMany(Penilaian::class, 'nilai_dosen', 'sekretaris_id');
    }
    public function penilaianPembimbing1()
    {
        return $this->hasMany(Penilaian::class, 'nilai_dosen', 'pembimbing1_id');
    }
    public function penilaianPembimbing2()
    {
        return $this->hasMany(Penilaian::class, 'nilai_dosen', 'pembimbing2_id');
    }


    public function pembimbing1()
    {
        return $this->belongsTo(Dosen::class, 'pembimbing1_id', 'id_dosen');
    }

    public function pembimbing2()
    {
        return $this->belongsTo(Dosen::class, 'pembimbing2_id', 'id_dosen');
    }
    public function ketuaSidang()
    {
        return $this->belongsTo(Dosen::class, 'ketua_sidang_id','id_dosen');
    }

    public function penguji1()
    {
        return $this->belongsTo(Dosen::class, 'penguji1_id','id_dosen');
    }

    public function penguji2()
    {
        return $this->belongsTo(Dosen::class, 'penguji2_id','id_dosen');
    }
    public function sekretaris()
    {
        return $this->belongsTo(Dosen::class, 'sekretaris_id','id_dosen');
    }

}
