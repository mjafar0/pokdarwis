<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('paket_wisata', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pokdarwis_id')->constrained('pokdarwis')->cascadeOnDelete();
            $table->string('nama_paket', 100);
            $table->text('deskripsi')->nullable();         
            $table->string('waktu_penginapan', 20);        
            $table->unsignedInteger('pax');               
            $table->string('lokasi', 100);
            $table->string('img', 255)->nullable();      
            $table->string('slug')->unique();
            $table->decimal('harga', 10, 2);
            $table->string('currency', 10)->default('USD'); 
            $table->timestamps();

            $table->index(['pokdarwis_id','slug']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('paket_wisata');
    }
};