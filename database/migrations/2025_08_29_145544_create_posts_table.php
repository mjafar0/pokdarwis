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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();

            // author/creator dari pokdarwis
            $table->foreignId('pokdarwis_id')
                  ->nullable()
                  ->constrained('pokdarwis')
                  ->nullOnDelete();

            $table->string('title', 200);
            $table->string('slug', 200)->unique();

            $table->text('excerpt')->nullable();
            $table->longText('content')->nullable();

            // cover image (path storage atau URL absolut)
            $table->string('cover')->nullable();

            // status & publish time
            $table->enum('status', ['draft','published','archived'])->default('draft')->index();
            $table->timestamp('published_at')->nullable()->index();

            // SEO & analytics ringan
            $table->string('meta_title', 255)->nullable();
            $table->text('meta_description')->nullable();
            $table->unsignedBigInteger('view_count')->default(0);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
