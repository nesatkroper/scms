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

    $courseSchedules = DB::table('course_offerings')->pluck('schedule', 'id')->toArray();

    DB::table('enrollments')->orderBy('id')->chunk(500, function ($enrollments) use ($faker, $courseSchedules) {
      $attendances = [];
      $now = now();

      foreach ($enrollments as $enrollment) {
        $schedule = $courseSchedules[$enrollment->course_offering_id] ?? 'mon-fri';
        $status = $enrollment->status;

        if ($status === 'completed') {
          $startDate = $now->copy()->subDays(90);
          $endDate = $now->copy();
        } else {
          $startDate = $now->copy()->subDays(30);
          $endDate = $now->copy();
        }

        $current = $startDate->copy();
        while ($current <= $endDate) {

          $shouldLog = false;
          $dayOfWeek = $current->dayOfWeek;

          switch ($schedule) {
            case 'mon-fri':
              if ($dayOfWeek >= 1 && $dayOfWeek <= 5) $shouldLog = true;
              break;
            case 'mon-wed':
              if ($dayOfWeek === 1 || $dayOfWeek === 3) $shouldLog = true;
              break;
            case 'wed-fri':
              if ($dayOfWeek >= 3 && $dayOfWeek <= 5) $shouldLog = true;
              break;
            case 'sat-sun':
              if ($dayOfWeek === 0 || $dayOfWeek === 6) $shouldLog = true;
              break;
          }

          if ($shouldLog) {
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

      foreach (array_chunk($attendances, 1000) as $chunk) {
        DB::table('attendances')->insertOrIgnore($chunk);
      }
    });

    $this->command->info('Attendance seeding completed.');
  }
}
