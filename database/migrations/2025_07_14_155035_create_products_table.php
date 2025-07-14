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
            $table->increments('product_id'); // primary key
            $table->string('name_product', 255);
            $table->unsignedInteger('pokdarwis_id');
            $table->text('deskripsi_product')->nullable();
            $table->decimal('harga_product', 10, 0)->nullable();
            $table->string('img', 255)->nullable();
            $table->string('detail_tambahan', 255)->nullable();
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
