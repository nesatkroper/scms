<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::table('fees', function (Blueprint $table) {
      if (Schema::hasColumn('fees', 'paid_date')) {
        $table->dropColumn('paid_date');
      }

      if (Schema::hasColumn('fees', 'status')) {
        $table->dropColumn('status');
      }
    });

    Schema::table('payments', function (Blueprint $table) {
      if (Schema::hasColumn('payments', 'course_offering_id')) {
        $table->dropForeign(['course_offering_id']);
        $table->dropColumn('course_offering_id');
      }

      if (Schema::hasColumn('payments', 'student_id')) {
        $table->dropForeign(['student_id']);
        $table->dropColumn('student_id');
      }
    });
  }

  public function down(): void
  {
    Schema::table('fees', function (Blueprint $table) {
      $table->date('paid_date')->nullable();
      $table->string('status')->nullable();
    });

    Schema::table('payments', function (Blueprint $table) {
      $table->unsignedBigInteger('course_offering_id')->nullable();
      $table->foreign('course_offering_id')->references('id')->on('course_offerings');

      $table->unsignedBigInteger('student_id')->nullable();
      $table->foreign('student_id')->references('id')->on('users');
    });
  }
};
