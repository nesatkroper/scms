<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::table('exams', function (Blueprint $table) {
      $table->dropColumn('name');
      $table->enum('type', ['lab', 'quiz', 'homework1', 'homework2', 'homework3', 'midterm', 'final'])
        ->after('id');
    });
  }

  public function down(): void
  {
    Schema::table('exams', function (Blueprint $table) {
      $table->dropColumn('type');
      $table->string('name')->after('id');
    });
  }
};
