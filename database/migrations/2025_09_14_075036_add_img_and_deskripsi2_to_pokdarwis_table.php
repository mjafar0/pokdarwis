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
        Schema::table('pokdarwis', function (Blueprint $table) {
            $table->string('img')->nullable()->after('slug');          // foto profil
            $table->text('deskripsi2')->nullable()->after('deskripsi'); // deskripsi tambahan
        });
    }

    public function down(): void
    {
        Schema::table('pokdarwis', function (Blueprint $table) {
            $table->dropColumn(['img', 'deskripsi2']);
        });
    }
};
