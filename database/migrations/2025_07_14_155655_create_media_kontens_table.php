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
        Schema::create('media_konten', function (Blueprint $table) {
            $table->increments('media_konten_id');
            $table->string('judul_konten', 255);
            $table->enum('tipe_konten', ['video', 'photo']);
            $table->enum('konten', ['produk', 'wisata']);
            $table->string('file_path', 255);
            $table->unsignedInteger('product_id')->nullable();
            $table->unsignedInteger('destinasi_wisata_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media_konten');
    }
};
