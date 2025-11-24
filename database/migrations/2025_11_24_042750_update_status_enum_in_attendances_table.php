<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateStatusEnumInAttendancesTable extends Migration
{
  public function up()
  {
    Schema::table('attendances', function (Blueprint $table) {
      $table->enum('status', ['attending', 'absence', 'permission'])->change();
    });
  }

  public function down()
  {
    Schema::table('attendances', function (Blueprint $table) {
      $table->enum('status', ['present', 'absent', 'late', 'excused'])->change();
    });
  }
}
