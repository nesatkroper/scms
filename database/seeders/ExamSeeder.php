<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExamSeeder extends Seeder
{
  public function run(): void
  {
    $subjectIds = DB::table('subjects')->pluck('id')->toArray();
    $exams = [];

    foreach ($subjectIds as $subjectId) {
      $exams[] = [
        'name' => "Midterm Exam Subject {$subjectId}",
        'subject_id' => $subjectId,
        'description' => "Midterm exam for subject {$subjectId}",
        'date' => now()->addWeeks(2),
        'total_marks' => 100,
        'passing_marks' => 50,
        'created_at' => now(),
        'updated_at' => now(),
      ];
    }

    DB::table('exams')->upsert($exams, ['name', 'subject_id']);
  }
}
