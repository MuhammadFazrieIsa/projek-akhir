<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('absen', function (Blueprint $table) {
            $table->id();
            $table->string('rfid_uid');
            $table->date('tanggal');
            $table->time('kedatangan'); // Fixed from `times` to `time`
            $table->time('kepulangan')->nullable(); // Fixed and nullable
            $table->string('status_kedatangan')->nullable();
            $table->string('status_kehadiran')->nullable();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absen');
    }
};
