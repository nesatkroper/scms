<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ScoreSeeder extends Seeder
{
  public function run(): void
  {
    $this->command->info('Seeding Scores...');

    $faker = Faker::create();

    $examsByCourse = DB::table('exams')->get()->groupBy('course_offering_id');

    DB::table('enrollments')->orderBy('id')->chunk(2000, function ($enrollments) use ($examsByCourse, $faker) {
      $scores = [];
      $now = now();

      foreach ($enrollments as $enrollment) {
        $courseId = $enrollment->course_offering_id;

        if (isset($examsByCourse[$courseId])) {
          foreach ($examsByCourse[$courseId] as $exam) {

            if ($faker->boolean(90)) {

              $max = $exam->total_marks;
              $passing = $exam->passing_marks;

              if ($faker->boolean(90)) {
                $scoreVal = $faker->numberBetween($passing, $max);
              } else {
                $scoreVal = $faker->numberBetween(0, $passing - 1);
              }

              $percentage = ($scoreVal / $max) * 100;
              if ($percentage >= 90) $grade = 'A';
              elseif ($percentage >= 80) $grade = 'B';
              elseif ($percentage >= 70) $grade = 'C';
              elseif ($percentage >= 60) $grade = 'D';
              elseif ($percentage >= 50) $grade = 'E';
              else $grade = 'F';

              $scores[] = [
                'student_id' => $enrollment->student_id,
                'exam_id' => $exam->id,
                'score' => $scoreVal,
                'grade' => $grade,
                'remarks' => $faker->optional(0.2)->sentence(),
                'created_at' => $now,
                'updated_at' => $now,
              ];
            }
          }
        }
      }

      DB::table('scores')->insertOrIgnore($scores);
    });

    $this->command->info('Scores seeding completed.');
  }
}
