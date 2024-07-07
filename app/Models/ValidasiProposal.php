<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValidasiProposal extends Model
{
    protected $table = 'validasi_proposal';

    protected $primaryKey = 'id_validasiProposal';

    protected $fillable = [
        'mahasiswa_id',
        'ta_id',
        'status_validasi',
        'tanggal_validasi',
        'catatan',
    ];



    // Definisikan relasi dengan TugasAkhir jika diperlukan
    public function tugasAkhir()
    {
        return $this->belongsTo(Tugas_akhir::class, 'ta_id');
    }
}
