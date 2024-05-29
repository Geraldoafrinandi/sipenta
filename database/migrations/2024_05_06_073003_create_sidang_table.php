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
        Schema::create('sidang', function (Blueprint $table) {
            $table->id('id_sidang');
            $table->string('id_ta');
            $table->string('nim');
            $table->string('ketua_sidang');
            $table->string('penguji1');
            $table->string('penguji2');
            $table->string('sekretaris');
            $table->string('id_ruangan');
            $table->string('status_sidang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sidang');
    }
};
