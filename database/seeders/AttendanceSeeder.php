<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class AttendanceSeeder extends Seeder
{
  public function run(): void
  {
    $this->command->info('Seeding Attendances...');

    $faker = Faker::create();
    $startDate = now()->subMonth();
    $endDate = now();

    // Determine IDs locally if possible, but for 50k enrollments, simpler to just query them.
    // We reuse the chunking pattern from FeeSeeder/EnrollmentSeeder

    DB::table('enrollments')->orderBy('id')->chunk(1000, function ($enrollments) use ($faker, $startDate, $endDate) {
        $attendances = [];
        $now = now();

        foreach ($enrollments as $enrollment) {
            // Generate 2 attendance records per enrollment for random dates in the last month
            // To ensure uniqueness of date per student+course, we pick distinct dates
            
            $dates = [
                $faker->dateTimeBetween($startDate, $endDate)->format('Y-m-d'),
                $faker->dateTimeBetween($startDate, $endDate)->format('Y-m-d'),
            ];
            
            // Ensure dates are unique
            if ($dates[0] === $dates[1]) {
                continue; 
            }

            foreach ($dates as $date) {
                // Weighted status: 80% attending, 10% absence, 10% permission
                $rand = rand(1, 100);
                if ($rand <= 80) $status = 'attending';
                elseif ($rand <= 90) $status = 'absence';
                else $status = 'permission';

                $attendances[] = [
                    'student_id' => $enrollment->student_id,
                    'course_offering_id' => $enrollment->course_offering_id,
                    'date' => $date,
                    'status' => $status,
                    'remarks' => $status !== 'attending' ? $faker->randomElement(['Sick', 'Family Event', 'Unknown']) : null,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
        }

        // Use insertOrIgnore to handle potential (rare) unique constraint violations on date collision if logic fails
        DB::table('attendances')->insertOrIgnore($attendances);
    });

    $this->command->info('Attendance seeding completed.');
  }
}
