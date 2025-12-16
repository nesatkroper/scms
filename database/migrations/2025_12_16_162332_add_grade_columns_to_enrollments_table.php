<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up()
  {
    Schema::table('enrollments', function (Blueprint $table) {
      $table->decimal('attendance_grade', 5, 2)->nullable();
      $table->decimal('listening_grade', 5, 2)->nullable();
      $table->decimal('writing_grade', 5, 2)->nullable();
      $table->decimal('reading_grade', 5, 2)->nullable();
      $table->decimal('speaking_grade', 5, 2)->nullable();
      $table->decimal('midterm_grade', 5, 2)->nullable();
      $table->decimal('final_grade', 5, 2)->nullable();
    });
  }

  public function down()
  {
    Schema::table('enrollments', function (Blueprint $table) {
      $table->dropColumn([
        'attendance_grade',
        'listening_grade',
        'writing_grade',
        'reading_grade',
        'speaking_grade',
        'midterm_grade',
        'final_grade',
      ]);
    });
  }
};
