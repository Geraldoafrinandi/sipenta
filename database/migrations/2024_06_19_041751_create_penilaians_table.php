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
        Schema::create('penilaians', function (Blueprint $table) {
            $table->id('id_penilaian'); // ini akan menjadi bigInteger unsigned
            $table->unsignedBigInteger('sidang_id');
            $table->string('materi_penilaian');
            $table->integer('bobot');
            $table->decimal('skor', 5, 2);
            $table->text('revisi')->nullable();
            $table->timestamps();

            $table->foreign('sidang_id')->references('id')->on('sidangs')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaians');
    }
};
