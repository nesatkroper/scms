<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up()
  {
    Schema::table('exams', function (Blueprint $table) {
      $table->enum('type', [
        'midterm',
        'final',
        'speaking',
        'listening',
        'reading',
        'lab1',
        'lab2',
        'lab3',
        'quiz1',
        'quiz2',
        'quiz3',
        'homework1',
        'homework2',
        'homework3',
      ])->change();
    });
  }

  public function down()
  {
    Schema::table('exams', function (Blueprint $table) {
      $table->enum('type', [
        'lab',
        'quiz',
        'homework1',
        'homework2',
        'homework3',
        'midterm',
        'final',
      ])->change();
    });
  }
};
