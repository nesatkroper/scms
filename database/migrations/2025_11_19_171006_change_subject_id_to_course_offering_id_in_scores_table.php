<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::table('scores', function (Blueprint $table) {
      $table->dropForeign(['subject_id']);
    });

    Schema::table('scores', function (Blueprint $table) {
      $table->renameColumn('subject_id', 'course_offering_id');
    });

    Schema::table('scores', function (Blueprint $table) {
      $table->foreign('course_offering_id')
        ->references('id')
        ->on('course_offerings')
        ->cascadeOnDelete();
    });
  }

  public function down(): void
  {

    Schema::table('scores', function (Blueprint $table) {
      $table->dropForeign(['course_offering_id']);
    });

    Schema::table('scores', function (Blueprint $table) {
      $table->renameColumn('course_offering_id', 'subject_id');
    });

    Schema::table('scores', function (Blueprint $table) {
      $table->foreign('subject_id')
        ->references('id')
        ->on('subjects')
        ->cascadeOnDelete();
    });
  }
};
