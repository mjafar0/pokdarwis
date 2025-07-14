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
            $table->increments('ai_generated_id');
            $table->text('prompt_text');
            $table->text('hasil_text')->nullable();
            $table->unsignedInteger('pokdarwis_id')->nullable();
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
