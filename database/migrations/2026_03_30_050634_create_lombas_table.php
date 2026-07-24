<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lombas', function (Blueprint $table) {
            $table->id();
            $table->string('judul');                          // nama lomba
            $table->text('deskripsi');
            $table->string('penyelenggara');
            $table->string('cabor');                          // cabang olahraga
            $table->string('kategori');
            $table->string('tingkat_wilayah');                // lokal / regional / nasional
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->string('lokasi')->nullable();
            $table->decimal('biaya_pendaftaran', 12, 2)->nullable();
            $table->string('poster')->nullable();             // path file
            $table->string('link', 500)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lombas');
    }
};
