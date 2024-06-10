<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Dosen extends Model
{
    use HasFactory;
    protected $table = 'dosens'; // sesuaikan dengan nama tabel di database
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

    protected $primaryKey = 'id_dosen'; // Primary key yang benar
    protected $guarded = [];


}

