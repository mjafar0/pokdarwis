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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name_product', 100);
            $table->longText('deskripsi')->nullable();
            $table->decimal('harga_product', 10, 2)->nullable();
            $table->string('img', 255)->nullable();
            $table->longText('detail_tambahan')->nullable();
            $table->foreignId('pokdarwis_id')->constrained('pokdarwis')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
