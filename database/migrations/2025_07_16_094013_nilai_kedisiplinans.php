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
        Schema::create('nilai_kedisiplinans', function (Blueprint $table) {
            $table->id('id_kedisiplinan');
            $table->string('rfid_uid')->nullable();
            $table->unsignedTinyInteger('bulan')->nullable();
            $table->unsignedSmallInteger('tahun')->nullable(); 
            $table->integer('lebih_awal')->default(0);
            $table->integer('tepat_waktu')->default(0);
            $table->integer('agak_terlambat')->default(0);
            $table->integer('terlambat')->default(0);
            $table->float('jumlah_keseluruhan')->default(0);
            $table->float('nilai_disiplin')->nullable();
            $table->float('nilai_cukup_disiplin')->nullable();
            $table->float('nilai_kurang_disiplin')->nullable();
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
