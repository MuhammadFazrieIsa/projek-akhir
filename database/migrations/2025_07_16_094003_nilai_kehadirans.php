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
        Schema::create('nilai_kehadirans', function (Blueprint $table) {
            $table->id('id_kehadiran');
            $table->string('rfid_uid')->nullable();
            $table->unsignedTinyInteger('bulan')->nullable();
            $table->unsignedSmallInteger('tahun')->nullable(); 
            $table->integer('hadir')->default(0);
            $table->integer('izin')->default(0);
            $table->integer('alpa')->default(0);
            $table->integer('jumlah_kehadiran')->default(0);
            $table->float('nilai_kurang_baik')->nullable();
            $table->float('nilai_cukup_baik')->nullable();
            $table->float('nilai_baik')->nullable();
            $table->timestamps();
        
            $table->foreign('rfid_uid')->references('rfid_uid')->on('users')->onDelete('cascade');
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
