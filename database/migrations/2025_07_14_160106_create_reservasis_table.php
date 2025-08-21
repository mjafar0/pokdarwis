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
            $table->id();
            $table->string('nama_pemesan', 100);
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('paket_wisata_id')->constrained('paket_wisata')->onDelete('cascade');
            $table->string('no_telp', 45);
            $table->string('email', 45);
            $table->date('tanggal_kunjungan');
            $table->string('waktu_kunjungan', 45);
            $table->text('catatan')->nullable();
            $table->longText('alasan_ditolak')->nullable();
            $table->enum('status', ['pending', 'diterima', 'ditolak', 'selesai'])->default('pending');
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
