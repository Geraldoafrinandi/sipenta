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
                $table->foreignId('ta_id')->constrained('tugas_akhirs', 'id_ta')->onDelete('cascade');
                $table->string('nim');
                $table->foreignId('ketua_sidang_id')->constrained('dosens', 'id_dosen')->onDelete('cascade');
                $table->foreignId('penguji1_id')->constrained('dosens', 'id_dosen')->onDelete('cascade');
                $table->foreignId('penguji2_id')->constrained('dosens', 'id_dosen')->onDelete('cascade');
                $table->foreignId('sekretaris_id')->constrained('dosens', 'id_dosen')->onDelete('cascade');
                $table->foreignId('ruangan_id')->constrained('ruangans', 'id_ruangan')->onDelete('cascade');
                $table->date('tanggal');
                $table->string('status_sidang', 20)->nullable();
                $table->decimal('total_nilai', 5, 2)->nullable();
                $table->timestamps();

                $table->foreign('nim')->references('nim')->on('tugas_akhirs')->onDelete('cascade'); // Foreign key constraint on nim
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
