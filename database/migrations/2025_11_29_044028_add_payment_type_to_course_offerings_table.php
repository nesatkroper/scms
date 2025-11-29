<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::table('course_offerings', function (Blueprint $table) {
      $table->enum('payment_type', ['course', 'monthly'])
        ->default('course')
        ->after('fee');
    });
  }

  public function down(): void
  {
    Schema::table('course_offerings', function (Blueprint $table) {
      $table->dropColumn('payment_type');
    });
  }
};
