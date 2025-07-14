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
        Schema::create('reservasi', function (Blueprint $table) {
            $table->increments('reservasi_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('paket_wisata_id')->nullable();
            $table->string('username', 255);
            $table->string('no_telp', 45);
            $table->string('email', 45);
            $table->date('tanggal_kunjungan');
            $table->time('waktu_kunjungan');
            $table->text('catatan')->nullable();
            $table->enum('status', ['pending', 'diterima', 'ditolak', 'selesai'])->default('pending');
            $table->text('alasan_ditolak')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservasi');
    }
};
