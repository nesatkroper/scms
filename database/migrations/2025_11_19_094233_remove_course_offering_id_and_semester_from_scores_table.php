<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveCourseOfferingIdAndSemesterFromScoresTable extends Migration
{
  public function up()
  {
    Schema::table('scores', function (Blueprint $table) {

      if (Schema::hasColumn('scores', 'course_offering_id')) {
        try {
          $table->dropForeign(['course_offering_id']);
        } catch (\Exception $e) {
        }

        $table->dropColumn('course_offering_id');
      }

      if (Schema::hasColumn('scores', 'semester')) {
        $table->dropColumn('semester');
      }
    });
  }

  public function down()
  {
    Schema::table('scores', function (Blueprint $table) {
      $table->unsignedBigInteger('course_offering_id')->nullable();
      $table->foreign('course_offering_id')
        ->references('id')
        ->on('course_offerings')
        ->onDelete('set null');

      $table->string('semester')->nullable();
    });
  }
}
