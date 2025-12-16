<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::table('enrollments', function (Blueprint $blueprint) {
      $blueprint->dropColumn('grade_final');
    });
  }

  public function down(): void
  {
    Schema::table('enrollments', function (Blueprint $blueprint) {
      $blueprint->decimal('grade_final', 8, 2)->nullable();
    });
  }
};
