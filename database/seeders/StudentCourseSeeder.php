<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentCourseSeeder extends Seeder
{
  public function run(): void
  {
    $studentIds = DB::table('users')->whereIn('id', DB::table('model_has_roles')->where('role_id', 3)->pluck('model_id'))->pluck('id')->all();
    $courseOfferingIds = DB::table('course_offerings')->pluck('id')->all();

    if (empty($studentIds) || empty($courseOfferingIds)) {
      $this->command->warn('Skipping student_course seeding. Please seed students and course_offerings tables first.');
      return;
    }

    $enrollments = [];
    $maxAttempts = 500;
    for ($i = 0; $i < $maxAttempts && count($enrollments) < 100; $i++) {
      $studentId = $studentIds[array_rand($studentIds)];
      $courseOfferingId = $courseOfferingIds[array_rand($courseOfferingIds)];
      $uniqueKey = "{$studentId}-{$courseOfferingId}";

      if (!array_key_exists($uniqueKey, $enrollments)) {
        $enrollments[$uniqueKey] = [
          'student_id' => $studentId,
          'course_offering_id' => $courseOfferingId,
          'grade_final' => round(rand(6000, 10000) / 100, 2),
          'created_at' => now(),
          'updated_at' => now(),
        ];
      }
    }

    DB::table('student_course')->insert(array_values($enrollments));
  }
}
