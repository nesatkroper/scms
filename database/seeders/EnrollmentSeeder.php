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

    // Fetch ONLY IDs to save memory. 50k integers is ~200KB. Good.
    // If we have millions, we'd need to paginate. 50k is fine for pluck.
    $studentIds = User::role('student')->pluck('id')->toArray();
    $courseOfferingIds = CourseOffering::pluck('id')->toArray();

    if (empty($studentIds) || empty($courseOfferingIds)) {
      $this->command->error("Cannot seed Enrollments. Ensure UserSeeder (students) and CourseDataSeeder (offerings) have been run.");
      return;
    }

    $this->command->info('Seeding Enrollments for ' . count($studentIds) . ' students...');

    // Process students in chunks to keep memory low
    $chunkSize = 1000;
    $studentChunks = array_chunk($studentIds, $chunkSize);

    foreach ($studentChunks as $chunkIndex => $chunkStudents) {
        $enrollmentsToInsert = [];
        
        foreach ($chunkStudents as $studentId) {
            // Assign 1 course per student for simplicity and speed at this scale
            // To prevent duplicates, we can just randomly pick one and assume uniqueness for this basic logic
            // or perform a quick check, but for bulk seed, randomness usually avoids collisions if offerings > 1
            
            $courseOfferingId = $faker->randomElement($courseOfferingIds);

            $enrollmentsToInsert[] = [
              'student_id' => $studentId,
              'course_offering_id' => $courseOfferingId,
              'attendance_grade' => $faker->optional(0.7)->randomFloat(2, 5, 10),
              'midterm_grade' => $faker->optional(0.7)->randomFloat(2, 20, 50),
              'final_grade' => $faker->optional(0.7)->randomFloat(2, 20, 50),
              'status' => $faker->randomElement(['studying', 'completed']),
              'remarks' => $faker->optional(0.1)->sentence(), // Warning: Faker sentence can be slow/memory intensive if repeated too much
              'created_at' => now(),
              'updated_at' => now(),
            ];
        }
        
        // Use insertOrIgnore to blindly skip duplicates (requires unique index on table)
        // Or just straightforward insert
        Enrollment::insertOrIgnore($enrollmentsToInsert);
        
        // Force garbage collection in valid cycles if needed, but chunking usually sufficient
        $this->command->info("Seeded chunk " . ($chunkIndex + 1) . " of enrollments...");
    }
  }
}
