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
        'pembimbing1_id',
        'pembimbing2_id',
        'judul',
        'dokumen',
        'tgl_pengajuan'
    ];

    public $timestamps = true;

    public function sidangs()
    {
        return $this->hasMany(Sidang::class, 'ta_id');
    }

   public function validasi_ta()
    {
        return $this->hasMany(Tugas_akhir::class,'ta_id');
   }

   public function pembimbing1()
   {
       return $this->belongsTo(Dosen::class, 'pembimbing1_id');
   }

   public function pembimbing2()
   {
       return $this->belongsTo(Dosen::class, 'pembimbing2_id');
   }
}

