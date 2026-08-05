<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('lombas', function (Blueprint $table) {
            $table->dropColumn('deadline_pendaftaran');
        });
    }
    public function down()
    {
        Schema::table('lombas', function (Blueprint $table) {
            $table->date('deadline_pendaftaran')->nullable();
        });
    }
};
