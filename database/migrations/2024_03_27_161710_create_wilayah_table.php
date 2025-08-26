<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {   
    Schema::create('wilayah', function (Blueprint $table) {            
      $table->string('id_wilayah', 8);
      $table->char('id_negara', 2);
      $table->char('id_level_wilayah', 1); 
      $table->string('id_induk_wilayah', 8)->nullable(); 
      $table->string('nama_wilayah');       
      
      $table->primary('id_wilayah');
      $table->index('id_induk_wilayah');      
      $table->index('id_negara');      
      $table->index('id_level_wilayah');      
      
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('wilayah');
  }
};
