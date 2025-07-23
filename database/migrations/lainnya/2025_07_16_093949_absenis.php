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
        Schema::create('absensis', function (Blueprint $table) {
            $table->id('idAbsensi');
            $table->unsignedBigInteger('idUsers');
            $table->date('tanggal');
            $table->time('jam_datang')->nullable();
            $table->time('jam_pulang')->nullable();
            $table->string('status_kedatangan')->nullable();
            $table->string('status_kehadiran')->nullable();
            $table->timestamps();
        
            $table->foreign('idUsers')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
