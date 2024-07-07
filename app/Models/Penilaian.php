<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;

    protected $table = 'penilaians';
    protected $primaryKey = 'id';

    protected $fillable = [
        'ta_id',
        'jabatan',
        'nilai_dosen',
        'presentasi_sikap_penampilan',
        'presentasi_komunikasi_sistematika',
        'presentasi_penguasaan_materi',
        'makalah_identifikasi_masalah',
        'makalah_relevansi_teori',
        'makalah_metode_algoritma',
        'makalah_hasil_pembahasan',
        'makalah_kesimpulan_saran',
        'makalah_bahasa_tata_tulis',
        'produk_kesesuaian_fungsional',
        'total_nilai',
        'komentar',
    ];

    public function tugas_akhir()
    {
        return $this->belongsTo(Tugas_akhir::class, 'ta_id', 'id_ta');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'nilai_dosen', 'id_dosen');
    }

    public function sidang()
    {
        return $this->belongsTo(Sidang::class, 'ta_id', 'ta_id' ,'sidang_id' ,'id');
    }

}
