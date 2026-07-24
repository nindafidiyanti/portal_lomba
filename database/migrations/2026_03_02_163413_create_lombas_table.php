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
    Schema::create('lombas', function (Blueprint $table) {
        $table->id();
        $table->string('judul');
        $table->text('deskripsi');
        $table->string('penyelenggara');
        $table->string('cabor'); 
        $table->string('kategori'); 
        $table->string('tingkat_wilayah'); 
        $table->date('tanggal_mulai')->nullable();
        $table->date('tanggal_selesai')->nullable();
        $table->string('lokasi')->nullable();
        $table->decimal('biaya_pendaftaran', 12, 2)->nullable();
        $table->string('poster')->nullable();
        $table->string('link')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lombas');
    }
};
