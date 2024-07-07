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
        Schema::create('validasi_proposal', function (Blueprint $table) {
            $table->id('id_validasiProposal');
            $table->unsignedBigInteger('mahasiswa_id');
            $table->unsignedBigInteger('ta_id');
            $table->enum('status_validasi', ['Valid', 'Tidak Valid']);
            $table->date('tanggal_validasi');
            $table->text('catatan')->nullable();
            $table->timestamps();

             // Foreign keys
             $table->foreign('mahasiswa_id')->references('nim')->on('tugas_akhirs')->onDelete('cascade');
             $table->foreign('ta_id')->references('id_ta')->on('tugas_akhirs')->onDelete('cascade');
         });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('validasi_proposal');
    }
};
