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
            // kontak dasar
            $table->string('phone', 50)->nullable()->after('kontak');
            $table->string('email')->nullable()->after('phone');

            // sosial media
            $table->string('facebook')->nullable()->after('email');
            $table->string('twitter')->nullable()->after('facebook');
            $table->string('instagram')->nullable()->after('twitter');
            $table->string('website')->nullable()->after('instagram');
        });
    }

    public function down(): void
    {
        Schema::table('pokdarwis', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'email',
                'facebook',
                'twitter',
                'instagram',
                'website',
            ]);
        });
    }
};
