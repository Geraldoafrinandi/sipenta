<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dosen', function (Blueprint $table) {
            $table->id('id_dosen');
            $table->string('nama');
            $table->string('nidn')->unique();
            $table->string('nip')->unique();
            $table->enum('gender',['Laki-laki','Perempuan']);
            $table->string('id_prodi');
            $table->string('email')->unique();
            $table->string('image');
            $table->enum('status',['Aktif','Tidak Aktif']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dosen');
    }
};
