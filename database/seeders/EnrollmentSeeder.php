<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\CourseOffering;
use App\Models\Enrollment;
use Faker\Factory as Faker;

class EnrollmentSeeder extends Seeder
{
  public function run(): void
  {
    $faker = Faker::create();

    $studentIds = User::role('student')->pluck('id')->toArray();
    $courseOfferingIds = CourseOffering::pluck('id')->toArray();

    if (empty($studentIds) || empty($courseOfferingIds)) {
      $this->command->error("Cannot seed Enrollments. Ensure UserSeeder (students) and CourseDataSeeder (offerings) have been run.");
      return;
    }

    $this->command->info('Seeding Enrollments for ' . count($studentIds) . ' students...');

    $chunkSize = 1000;
    $studentChunks = array_chunk($studentIds, $chunkSize);

    foreach ($studentChunks as $chunkIndex => $chunkStudents) {
      $enrollmentsToInsert = [];

      foreach ($chunkStudents as $studentId) {

        $courseOfferingId = $faker->randomElement($courseOfferingIds);

        $enrollmentsToInsert[] = [
          'student_id' => $studentId,
          'course_offering_id' => $courseOfferingId,
          'attendance_grade' => $faker->optional(0.7)->randomFloat(2, 5, 10),
          'midterm_grade' => $faker->optional(0.7)->randomFloat(2, 20, 50),
          'final_grade' => $faker->optional(0.7)->randomFloat(2, 20, 50),
          'status' => $faker->randomElement(['studying', 'completed']),
          'remarks' => $faker->optional(0.1)->sentence(),
          'created_at' => now(),
          'updated_at' => now(),
        ];
      }

      Enrollment::insertOrIgnore($enrollmentsToInsert);

      $this->command->info("Seeded chunk " . ($chunkIndex + 1) . " of enrollments...");
    }
  }
}
