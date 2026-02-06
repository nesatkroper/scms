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

    // Pre-fetch exams grouped by course_offering_id
    // This is efficient because we only have ~100 courses and ~200 exams.
    $examsByCourse = DB::table('exams')->get()->groupBy('course_offering_id');

    // Process enrollments in chunks
    DB::table('enrollments')->orderBy('id')->chunk(2000, function ($enrollments) use ($examsByCourse, $faker) {
        $scores = [];
        $now = now();

        foreach ($enrollments as $enrollment) {
            $courseId = $enrollment->course_offering_id;
            
            // If there are exams for this course
            if (isset($examsByCourse[$courseId])) {
                foreach ($examsByCourse[$courseId] as $exam) {
                    
                    // Logic: 90% chance student took the exam
                    if ($faker->boolean(90)) {
                        
                        // Generate score based on total marks
                        // bell curve-ish: most people pass
                        $max = $exam->total_marks;
                        $passing = $exam->passing_marks;
                        
                        // Random logic: 10% fail, 90% pass
                        if ($faker->boolean(90)) {
                            $scoreVal = $faker->numberBetween($passing, $max);
                        } else {
                            $scoreVal = $faker->numberBetween(0, $passing - 1);
                        }
                        
                        // Determine Grade (Simple logic)
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
