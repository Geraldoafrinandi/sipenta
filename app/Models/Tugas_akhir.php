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
        'pembimbing1',
        'pembimbing2',
        'judul',
        'tgl_pengajuan'
    ];

    public $timestamps = true;

    public function sidangs()
    {
        return $this->hasMany(Sidang::class, 'ta_id');
    }
}
