<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('paket_fasilitas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paket_wisata_id')->constrained('paket_wisata')->cascadeOnDelete();
            $table->string('nama_item', 255);
            $table->enum('tipe', ['include','exclude']); // include = ✅, exclude = ❌
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();

            $table->index(['paket_wisata_id','tipe','sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('paket_fasilitas');
    }
};