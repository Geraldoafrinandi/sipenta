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
        Schema::create('dosens', function (Blueprint $table) {
            $table->id('id_dosen');
            $table->string('nama');
            $table->string('nidn')->unique();
            $table->enum('gender', ['Laki-laki', 'Perempuan']);
            $table->unsignedBigInteger('prodi_id'); // Menggunakan tipe yang sesuai dengan primary key di tabel prodis
            $table->string('email')->unique();
            $table->enum('status', ['Aktif', 'Tidak Aktif']);
            $table->timestamps();

            // Definisi foreign key constraint
            $table->foreign('prodi_id')->references('id_prodi')->on('prodis')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dosens');
    }
};
