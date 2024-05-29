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
        Schema::create('sidangs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_ta');
            $table->string('nim');
            $table->string('ketua_sidang');
            $table->string('penguji1');
            $table->string('penguji2')->nullable();
            $table->string('sekretaris');
            $table->unsignedBigInteger('ruangan_id');
            $table->string('status_sidang');
            $table->timestamps();

            // Definisi foreign key
            $table->foreign('nim')->references('nim')->on('mahasiswas')->onDelete('cascade');
            $table->foreign('ruangan_id')->references('id_ruangan')->on('ruangans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sidangs');
    }
};
