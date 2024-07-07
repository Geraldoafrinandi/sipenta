<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas_akhir extends Model
{
    use HasFactory;

    protected $table = 'tugas_akhirs';

    protected $primaryKey = 'id_ta';

    protected $fillable = [
        'nim',
        'nama_mahasiswa',
        'pembimbing1_id',
        'pembimbing2_id',
        'judul',
        'dokumen_pkl',
        'lembar_bimbingan',
        'proposal',
        'laporan_ta',
        'tgl_pengajuan'
    ];

    public $timestamps = true;

    public function sidangs()
    {
        return $this->hasMany(Sidang::class, 'ta_id');
    }
    public function sidang()
    {
        return $this->hasOne(Sidang::class, 'ta_id');
    }
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim'); // sesuaikan dengan foreign key yang benar
    }

    // public function validasi_ta()
    // {
    //     return $this->hasOne(Tugas_akhir::class, 'ta_id');
    // }


    public function penilaians()
    {
        return $this->hasMany(Penilaian::class, 'ta_id', 'id_ta');
    }
    //    public function pembimbing1_id()
    //    {
    //        return $this->belongsTo(User::class, 'pembimbing1_id','id');
    //    }

    //    public function pembimbing2_id()
    //    {
    //        return $this->belongsTo(User::class, 'pembimbing2_id','id');
    //    }
    //    public function mahasiswa_id()
    //    {
    //        return $this->belongsTo(User::class, 'pembimbing1_id');
    //    }
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
        return $this->belongsTo(Dosen::class, 'ketua_sidang_id', 'id_dosen');
    }

    public function sekretarisSidang()
    {
        return $this->belongsTo(Dosen::class, 'sekretaris_sidang_id', 'id_dosen');
    }

    public function penguji1()
    {
        return $this->belongsTo(Dosen::class, 'penguji1_id', 'id_dosen');
    }

    public function penguji2()
    {
        return $this->belongsTo(Dosen::class, 'penguji2_id', 'id_dosen');
    }
    public function validasiProposal()
    {
        return $this->hasOne(ValidasiProposal::class, 'ta_id', 'id_ta');
    }
    public function validasiTA()
    {
        return $this->hasOne(ValidasiTa::class, 'ta_id', 'id_ta');
    }
}
