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
            $table->id();
            $table->string('judul_konten', 100);
            $table->enum('tipe_konten', ['foto', 'video']);
            $table->enum('konten', ['produk', 'wisata']);
            $table->string('file_path', 255);
            $table->foreignId('product_id')->nullable()->constrained('products')->onDelete('cascade');
            $table->foreignId('destinasi_wisata_id')->nullable()->constrained('destinasi_wisata')->onDelete('cascade');
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
