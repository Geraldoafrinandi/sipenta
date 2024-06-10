<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    protected $table = 'ruangans'; // Nama tabel di database

    protected $fillable = [
        'no_ruangan',
        'jam_sidang',
    ];

    public function sidangs()
    {
        return $this->hasMany(Sidang::class, 'ruangan_id');
    }
}
