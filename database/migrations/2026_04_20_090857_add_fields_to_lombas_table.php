<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('lombas', function (Blueprint $table) {

            // Deadline pendaftaran lomba
            $table->date('deadline_pendaftaran')->nullable()->after('tanggal_selesai');

            // Link pendaftaran panitia
            $table->string('link_pendaftaran_panitia')->nullable()->after('link');

            // Deadline pendaftaran panitia
            $table->date('deadline_panitia')->nullable()->after('link_pendaftaran_panitia');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lombas', function (Blueprint $table) {
            $table->dropColumn([
                'deadline_pendaftaran',
                'link_pendaftaran_panitia',
                'deadline_panitia'
            ]);
        });
    }
};