<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\CourseOffering;
use App\Models\Enrollment;
use Faker\Factory as Faker;

class EnrollmentSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $faker = Faker::create();

    // 1. Get IDs of necessary related records
    $studentIds = User::role('student')->pluck('id')->toArray();
    $courseOfferingIds = CourseOffering::pluck('id')->toArray();

    // Guard clause: ensure we have data to link
    if (empty($studentIds) || empty($courseOfferingIds)) {
      $this->command->error("Cannot seed Enrollments. Ensure UserSeeder (students) and CourseDataSeeder (offerings) have been run.");
      return;
    }

    $this->command->info('Seeding Enrollments...');

    // Delete existing enrollments to start fresh
    Enrollment::query()->delete();

    $enrollmentsToInsert = [];
    $studentsAssigned = [];

    // --- Strategy: Ensure every student is enrolled in at least one course ---
    foreach ($studentIds as $studentId) {
      // Select a random course offering
      $courseOfferingId = $faker->randomElement($courseOfferingIds);

      // Generate a unique key for the enrollment to prevent unique constraint violation
      $enrollmentKey = $studentId . '-' . $courseOfferingId;

      if (!isset($studentsAssigned[$enrollmentKey])) {
        $enrollmentsToInsert[] = [
          'student_id' => $studentId,
          'course_offering_id' => $courseOfferingId,
          'grade_final' => $faker->optional(0.7)->randomFloat(2, 60.00, 99.99), // 70% chance of grade
          'status' => $faker->randomElement(['studying', 'completed']),
          'remarks' => $faker->optional(0.1)->sentence(),
          'created_at' => now(),
          'updated_at' => now(),
        ];
        $studentsAssigned[$enrollmentKey] = true;
      }
    }

    // --- Strategy: Add random additional enrollments for multi-course students ---
    // We will attempt to add 50 more enrollments
    for ($i = 0; $i < 50; $i++) {
      $studentId = $faker->randomElement($studentIds);
      $courseOfferingId = $faker->randomElement($courseOfferingIds);
      $enrollmentKey = $studentId . '-' . $courseOfferingId;

      if (!isset($studentsAssigned[$enrollmentKey])) {
        $enrollmentsToInsert[] = [
          'student_id' => $studentId,
          'course_offering_id' => $courseOfferingId,
          'grade_final' => $faker->optional(0.7)->randomFloat(2, 60.00, 99.99),
          'status' => $faker->randomElement(['studying', 'suspended', 'dropped', 'completed']),
          'remarks' => $faker->optional(0.1)->sentence(),
          'created_at' => now(),
          'updated_at' => now(),
        ];
        $studentsAssigned[$enrollmentKey] = true;
      }
    }

    // Insert all collected enrollments into the database
    Enrollment::insert($enrollmentsToInsert);
    $this->command->info('Successfully seeded ' . count($enrollmentsToInsert) . ' enrollments.');
  }
}
