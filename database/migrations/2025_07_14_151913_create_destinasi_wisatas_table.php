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
            $table->id();
            $table->string('name_destinasi', 255);
            $table->foreignId('pokdarwis_id')->constrained('pokdarwis')->onDelete('cascade');
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
