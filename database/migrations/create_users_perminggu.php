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
        Schema::create('perminggu', function (Blueprint $table) {
            $table->increments('idminggu');
            $table->string('nama', 100);
            $table->timestamps();
            $table->date('tanggal'); // Added column name for date
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
