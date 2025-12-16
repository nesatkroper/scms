<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
  public function up(): void
  {
    DB::statement("
            ALTER TABLE exams
            MODIFY COLUMN type ENUM(
                'midterm',
                'final',
                'speaking',
                'listening',
                'reading',
                'writing'
            ) NOT NULL
        ");
  }

  public function down(): void
  {
    DB::statement("
            ALTER TABLE exams
            MODIFY COLUMN type ENUM(
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
                'homework3'
            ) NOT NULL
        ");
  }
};
