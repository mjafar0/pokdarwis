<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('media_konten', function (Blueprint $table) {
        // hapus dulu FK lama
        $table->dropForeign(['destinasi_wisata_id']);
        $table->dropColumn('destinasi_wisata_id');

        // ganti dengan pokdarwis_id
        $table->unsignedBigInteger('pokdarwis_id')->nullable()->after('product_id');
        $table->foreign('pokdarwis_id')->references('id')->on('pokdarwis')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('media_konten', function (Blueprint $table) {
        $table->dropForeign(['pokdarwis_id']);
        $table->dropColumn('pokdarwis_id');

        $table->unsignedBigInteger('destinasi_wisata_id')->nullable();
        $table->foreign('destinasi_wisata_id')->references('id')->on('destinasi_wisata')->onDelete('cascade');
    });
}

};
