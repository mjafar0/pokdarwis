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
        Schema::create('destinasi_wisata', function (Blueprint $table) {
            $table->increments('destinasi_wisata_id'); // INT(11) AUTO_INCREMENT
            $table->string('name_destinasi', 255);
            $table->unsignedInteger('pokdarwis_id');
            $table->text('deskripsi')->nullable();
            $table->string('lokasi', 255)->nullable();
            $table->text('fasilitas')->nullable();
            $table->text('img')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinasi_wisata');
    }
};
