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
            $table->string('nim')->unique(); // Kolom 'nim' unik
            $table->string('pembimbing1');
            $table->string('pembimbing2')->nullable(); // Pembimbing 2 bisa kosong (nullable)
            $table->string('judul');
            $table->date('tgl_pengajuan'); // Menggunakan tipe 'date' untuk tanggal pengajuan
            $table->timestamps(); // Timestamps untuk created_at dan updated_at
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

