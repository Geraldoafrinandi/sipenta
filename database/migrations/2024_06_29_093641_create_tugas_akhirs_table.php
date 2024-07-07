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
        Schema::create('tugas_akhirs', function (Blueprint $table) {
            $table->id('id_ta'); // Menggunakan method 'id()' untuk membuat primary key 'id' dengan tipe unsigned big integer
            $table->unsignedBigInteger('nim')->unique(); // Kolom 'nim' unik
            $table->string('nama_mahasiswa'); // Kolom 'nim' unik
            $table->unsignedBigInteger('pembimbing1_id');
            $table->unsignedBigInteger('pembimbing2_id'); // Pembimbing 2 bisa kosong (nullable)
            $table->string('judul');
            $table->string('dokumen_pkl');
            $table->string('lembar_bimbingan');
            $table->string('proposal');
            $table->string('laporan_ta');
            $table->date('tgl_pengajuan'); // Menggunakan tipe 'date' untuk tanggal pengajuan
            $table->timestamps(); // Timestamps untuk created_at dan updated_at

            $table->foreign('pembimbing1_id')->references('id_dosen')->on('dosens')->onDelete('cascade');
            $table->foreign('pembimbing2_id')->references('id_dosen')->on('dosens')->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tugas_akhirs');
    }
};
