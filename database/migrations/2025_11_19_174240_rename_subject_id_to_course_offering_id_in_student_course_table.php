<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::table('student_course', function (Blueprint $table) {
      $table->renameColumn('subject_id', 'course_offering_id');
    });

    $pivotRows = DB::table('student_course')->get();
    foreach ($pivotRows as $row) {
      $courseOfferingId = DB::table('course_offerings')
        ->where('subject_id', $row->course_offering_id)
        ->value('id');

      if ($courseOfferingId) {
        DB::table('student_course')
          ->where('student_id', $row->student_id)
          ->where('course_offering_id', $row->course_offering_id)
          ->update(['course_offering_id' => $courseOfferingId]);
      }
    }

    Schema::table('student_course', function (Blueprint $table) {
      $table->foreign('course_offering_id')
        ->references('id')
        ->on('course_offerings')
        ->cascadeOnDelete();
    });
  }

  public function down(): void
  {
    Schema::table('student_course', function (Blueprint $table) {
      $table->dropForeign(['course_offering_id']);
    });

    Schema::table('student_course', function (Blueprint $table) {
      $table->renameColumn('course_offering_id', 'subject_id');
    });

    Schema::table('student_course', function (Blueprint $table) {
      $table->foreign('subject_id')
        ->references('id')
        ->on('subjects')
        ->cascadeOnDelete();
    });
  }
};
