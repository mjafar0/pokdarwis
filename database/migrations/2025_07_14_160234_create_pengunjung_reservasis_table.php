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
        Schema::create('pengunjung_reservasi', function (Blueprint $table) {
            $table->increments('pengunjung_reservasi_id');
            $table->unsignedInteger('reservasi_id');
            $table->string('name_pengunjung', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengunjung_reservasi');
    }
};
