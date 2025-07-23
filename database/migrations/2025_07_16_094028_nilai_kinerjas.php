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
        Schema::create('nilai_kinerjas', function (Blueprint $table) {
            $table->id('id_kinerja');
            $table->string('rfid_uid')->nullable();
            $table->unsignedTinyInteger('bulan')->nullable();
            $table->unsignedSmallInteger('tahun')->nullable(); 
            $table->float('rule_1')->nullable();
            $table->float('rule_2')->nullable();
            $table->float('rule_3')->nullable();
            $table->float('rule_4')->nullable();
            $table->float('rule_5')->nullable();
            $table->float('rule_6')->nullable();
            $table->float('rule_7')->nullable();
            $table->float('rule_8')->nullable();
            $table->float('rule_9')->nullable();
            $table->float('nilai_defuzzifikasi')->nullable();
            $table->string('status')->nullable();
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
