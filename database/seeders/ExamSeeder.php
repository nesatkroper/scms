<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExamSeeder extends Seeder
{
  public function run(): void
  {
    $courseIds = DB::table('course_offerings')->pluck('id')->toArray();
    $exams = [];

    foreach ($courseIds as $courseId) {
      // Midterm
      $exams[] = [
        'type' => 'midterm',
        'course_offering_id' => $courseId,
        'description' => "Midterm exam for course offering {$courseId}",
        'date' => now()->addWeeks(rand(4, 6)),
        'total_marks' => 50,
        'passing_marks' => 25,
        'created_at' => now(),
        'updated_at' => now(),
      ];

       // Final
       $exams[] = [
        'type' => 'final',
        'course_offering_id' => $courseId,
        'description' => "Final exam for course offering {$courseId}",
        'date' => now()->addWeeks(rand(10, 12)),
        'total_marks' => 100,
        'passing_marks' => 50,
        'created_at' => now(),
        'updated_at' => now(),
      ];
    }

    DB::table('exams')->insert($exams);
  }
}
