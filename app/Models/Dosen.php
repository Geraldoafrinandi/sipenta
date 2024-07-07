<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Dosen extends Model
{
    use HasFactory;
    protected $table = 'dosens'; // sesuaikan dengan nama tabel di database
    protected $primaryKey = 'id_dosen'; // Primary key yang benar
    protected $guarded = [];
    protected $fillable = [
        'nama',
        'nidn',
        'gender',
        'prodi_id',
        'email',
        'status',
    ];



    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id', 'id_prodi');
    }
    public function tugasAkhirPembimbing()
    {
        return $this->hasMany(Tugas_akhir::class, 'pembimbing1_id', 'id')->orWhere('pembimbing2_id', $this->id);
    }

    public function mahasiswas()
    {
        return $this->hasManyThrough(Mahasiswa::class, Tugas_akhir::class, 'pembimbing1_id', 'nim', 'id_dosen', 'nim');
    }
    public function penilaian()
    {
        return $this->hasMany(Penilaian::class, 'nilai_dosen'); // Sesuaikan dengan kunci luar yang sesuai
    }
    public function penilaianPembimbing1()
    {
        return $this->hasMany(Penilaian::class, 'pembimbing1_id', 'id_dosen');
    }

    public function penilaianPembimbing2()
    {
        return $this->hasMany(Penilaian::class, 'pembimbing2_id', 'id_dosen');
    }


    public function tugasAkhirKetuaSidang()
    {
        return $this->hasMany(Tugas_akhir::class, 'ketua_sidang_id');
    }

    public function tugasAkhirSekretarisSidang()
    {
        return $this->hasMany(Tugas_akhir::class, 'sekretaris_sidang_id');
    }

    public function tugasAkhirPenguji1()
    {
        return $this->hasMany(Tugas_akhir::class, 'penguji1_id');
    }

    public function tugasAkhirPenguji2()
    {
        return $this->hasMany(Tugas_akhir::class, 'penguji2_id');
    }

}

