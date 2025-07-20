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
        Schema::create('ai_generate', function (Blueprint $table) {
            $table->id();
            $table->longText('prompt_text');
            $table->longText('result_text');
            $table->foreignId('pokdarwis_id')->constrained('pokdarwis')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ai_generate');
    }
};
