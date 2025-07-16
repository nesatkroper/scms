<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up()
  {
    Schema::create('addresses', function (Blueprint $table) {
      $table->id();
      $table->foreign('province_id')->references('id')->on('provinces')->onDelete('cascade');
      $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');
      $table->foreign('commune_id')->references('id')->on('communes')->onDelete('cascade');
      $table->foreign('village_id')->references('id')->on('villages')->onDelete('cascade');
      $table->string('description')->nullable();
      $table->enum('status', ['active', 'inactive'])->default('active');
      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists('addresses');
  }
};
