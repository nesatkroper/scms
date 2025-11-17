<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentCourseSeeder extends Seeder
{
  public function run(): void
  {
    $studentIds = DB::table('users')->role('student')->pluck('id')->toArray();
    $subjectIds = DB::table('subjects')->pluck('id')->toArray();
    $enrollments = [];

    foreach ($studentIds as $studentId) {
      $assignedSubjects = (array) array_rand(array_flip($subjectIds), 3); // 3 random subjects
      foreach ($assignedSubjects as $subjectId) {
        $enrollments[] = [
          'student_id' => $studentId,
          'subject_id' => $subjectId,
          'grade_final' => round(rand(6000, 10000) / 100, 2),
          'created_at' => now(),
          'updated_at' => now(),
        ];
      }
    }
    DB::table('student_course')->upsert($enrollments, ['student_id', 'subject_id']);
  }
}
