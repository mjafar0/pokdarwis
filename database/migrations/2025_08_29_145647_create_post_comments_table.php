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
        Schema::create('post_comments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('post_id')
                  ->constrained('posts')
                  ->cascadeOnDelete();

            // komentar sederhana (tanpa auth)
            $table->string('name', 120);
            $table->string('email', 190)->nullable();
            $table->text('body');

            $table->boolean('is_approved')->default(true)->index();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_comments');
    }
};
