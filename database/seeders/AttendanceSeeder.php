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
    
    // Map Course ID => Schedule for O(1) lookup
    $courseSchedules = DB::table('course_offerings')->pluck('schedule', 'id')->toArray();

    // Process enrollments in chunks
    DB::table('enrollments')->orderBy('id')->chunk(500, function ($enrollments) use ($faker, $courseSchedules) {
        $attendances = [];
        $now = now();

        foreach ($enrollments as $enrollment) {
            $schedule = $courseSchedules[$enrollment->course_offering_id] ?? 'mon-fri';
            $status = $enrollment->status;
            
            // Determine date range
            if ($status === 'completed') {
                 // 3 months history
                 $startDate = $now->copy()->subDays(90);
                 $endDate = $now->copy();
            } else {
                 // 1 month history
                 $startDate = $now->copy()->subDays(30);
                 $endDate = $now->copy();
            }

            // Iterate through days
            $current = $startDate->copy();
            while ($current <= $endDate) {
                
                $shouldLog = false;
                $dayOfWeek = $current->dayOfWeek; // 0 (Sun) - 6 (Sat)
                
                // Logic for schedules
                switch ($schedule) {
                    case 'mon-fri':
                        if ($dayOfWeek >= 1 && $dayOfWeek <= 5) $shouldLog = true; 
                        break;
                    case 'mon-wed': // assuming mon & wed only for simplicity of this seed
                        if ($dayOfWeek === 1 || $dayOfWeek === 3) $shouldLog = true;
                        break;
                    case 'wed-fri': // assuming wed, thu, fri?
                        if ($dayOfWeek >= 3 && $dayOfWeek <= 5) $shouldLog = true;
                        break;
                    case 'sat-sun':
                        if ($dayOfWeek === 0 || $dayOfWeek === 6) $shouldLog = true;
                        break;
                }

                if ($shouldLog) {
                    // Weighted status: 85% attending, 10% absence, 5% permission
                    $rand = rand(1, 100);
                    if ($rand <= 85) $attStatus = 'attending';
                    elseif ($rand <= 95) $attStatus = 'absence';
                    else $attStatus = 'permission';

                    $attendances[] = [
                        'student_id' => $enrollment->student_id,
                        'course_offering_id' => $enrollment->course_offering_id,
                        'date' => $current->format('Y-m-d'),
                        'status' => $attStatus,
                        'remarks' => $attStatus !== 'attending' ? $faker->randomElement(['Sick', 'Family Event', 'Unknown']) : null,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];
                }
                
                $current->addDay();
            }
        }

        // Insert in sub-chunks if array gets too big (e.g., 500 students * 90 days = 45,000 rows - safe for one insert)
        foreach (array_chunk($attendances, 1000) as $chunk) {
             DB::table('attendances')->insertOrIgnore($chunk);
        }
    });

    $this->command->info('Attendance seeding completed.');
  }
}
