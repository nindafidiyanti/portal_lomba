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
        Schema::create('tempat_latihan', function (Blueprint $table) {
            $table->id();

            // Informasi Tempat
            $table->string('nama_tempat', 150)->comment('Nama dojo / tempat latihan karate');
            $table->text('alamat')->comment('Alamat lengkap tempat latihan');

            // Cabor
            $table->string('cabor', 150)->comment('Cabang Olahraga');

            // Link Google Maps
            $table->string('link_maps', 150)->comment('Link Google Maps');

            // Deskripsi
            $table->text('deskripsi')->nullable()->comment('Deskripsi singkat tentang tempat latihan');

            // Contact Person Pelatih
            $table->string('nama_pelatih', 150)->comment('Nama lengkap pelatih / contact person');
            $table->string('no_telepon', 20)->nullable()->comment('Nomor HP/WA pelatih');

            // Media
            $table->string('foto_tempat')->nullable()->comment('Path foto tempat latihan');

            // Status
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tempat_latihan');
    }
};