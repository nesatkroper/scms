<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::table('teachers', function (Blueprint $table) {
      $table->dropUnique('teachers_teacher_id_unique');

      $table->dropColumn('teacher_id');

      $table->string('name')->nullable();
      $table->string('image')->nullables();
    });
  }

  public function down(): void
  {
    Schema::table('teachers', function (Blueprint $table) {});
  }
};