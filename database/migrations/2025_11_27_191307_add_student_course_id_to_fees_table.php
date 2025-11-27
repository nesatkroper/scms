<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up()
  {
    Schema::table('student_course', function (Blueprint $table) {
      if (Schema::hasColumn('student_course', 'payment_status')) {
        $table->dropColumn('payment_status');
      }
    });

    Schema::table('fees', function (Blueprint $table) {
      $table->unsignedBigInteger('student_course_id')->nullable()->after('student_id');
      $table->foreign('student_course_id')
        ->references('id')->on('student_courses')
        ->onDelete('set null');
    });
  }

  public function down()
  {
    Schema::table('student_course', function (Blueprint $table) {
      $table->string('payment_status')->nullable()->after('status');
    });

    Schema::table('fees', function (Blueprint $table) {
      if (Schema::hasColumn('fees', 'student_course_id')) {
        $table->dropForeign(['student_course_id']);
        $table->dropColumn('student_course_id');
      }
    });
  }
};
