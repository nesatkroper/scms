<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentCourseSeeder extends Seeder
{
  public function run(): void
  {
    // $studentIds = DB::table('users')->whereIn('id', DB::table('model_has_roles')->where('role_id', 3)->pluck('model_id'))->pluck('id')->all();

    // if (empty($studentIds)) {
    //   $this->command->warn('Skipping student_course seeding. Please seed students and course_offerings tables first.');
    //   return;
    // }

    // $enrollments = [];
    // $maxAttempts = 500;
    // for ($i = 0; $i < $maxAttempts && count($enrollments) < 100; $i++) {
    //   $studentId = $studentIds[array_rand($studentIds)];
    //   $uniqueKey = "{$studentId}-";

    //   if (!array_key_exists($uniqueKey, $enrollments)) {
    //     $enrollments[$uniqueKey] = [
    //       'student_id' => $studentId,
    //       'grade_final' => round(rand(6000, 10000) / 100, 2),
    //       'created_at' => now(),
    //       'updated_at' => now(),
    //     ];
    //   }
    // }

    // DB::table('student_course')->insert(array_values($enrollments));

    $studentIds = DB::table('users')->role('student')->pluck('id')->toArray();
    $subjectIds = DB::table('subjects')->pluck('id')->toArray();
    $enrollments = [];

    foreach ($studentIds as $studentId) {
      $assignedSubjects = (array) array_rand(array_flip($subjectIds), 3);
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
    DB::table('student_course')->insert($enrollments);

  }
}
