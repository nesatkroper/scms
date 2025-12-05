<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Classroom;
use App\Models\Subject;
use App\Models\CourseOffering;
use Faker\Factory as Faker;

class CourseDataSeeder extends Seeder // Use the original name or replace with your chosen name
{
  public function run(): void
  {
    $faker = Faker::create();

    // 1. Get IDs of necessary related records
    $teacherIds = User::role('teacher')->pluck('id')->toArray();

    if (empty($teacherIds)) {
      $this->command->error("Teacher data not found. Please run the UserSeeder first.");
      return;
    }

    // --- 2. Seed or Update Classrooms (5 Records) ---
    $this->command->info('Seeding 5 Classrooms...');
    $classroomRoomNumbers = ['A145', 'B201', 'C310', 'D005', 'E122'];
    $faker->unique(true); // Reset faker unique
    $classroomIds = [];

    foreach ($classroomRoomNumbers as $index => $roomNumber) {
      $classroom = Classroom::updateOrCreate(
        // Fields to check for existence (unique key)
        ['room_number' => $roomNumber],
        // Fields to set or update
        [
          'name' => 'Room ' . ($index + 1),
          'capacity' => $faker->numberBetween(20, 50),
        ]
      );
      $classroomIds[] = $classroom->id;
    }


    // --- 3. Seed or Update Subjects (5 Records) ---
    $this->command->info('Seeding 5 Subjects...');
    $subjectData = [
      ['name' => 'Calculus I', 'code' => 'MATH101'],
      ['name' => 'English Grammar', 'code' => 'ENGL102'],
      ['name' => 'World History', 'code' => 'HIST201'],
      ['name' => 'Introduction to Programming', 'code' => 'CS101'],
      ['name' => 'Microeconomics', 'code' => 'ECON305'],
    ];

    $subjectIds = [];
    foreach ($subjectData as $data) {
      $subject = Subject::updateOrCreate(
        // Fields to check for existence (unique key)
        ['code' => $data['code']],
        // Fields to set or update
        [
          'name' => $data['name'],
          'description' => $faker->sentence(),
          'credit_hours' => $faker->randomElement([3, 4]),
        ]
      );
      $subjectIds[] = $subject->id;
    }

    // --- 4. Seed Course Offerings (15 Records) ---
    $this->command->info('Seeding 15 Course Offerings...');

    // SIMPLIFIED LOGIC: Create a list of 15 subject IDs by cycling through the available IDs.
    $totalOfferings = 15;
    $numSubjects = count($subjectIds);
    $subjectAssignments = [];

    // Cycle through subject IDs 15 times
    for ($i = 0; $i < $totalOfferings; $i++) {
      // Use modulo operator (%) to cycle: 0%5=0, 1%5=1, ..., 5%5=0, etc.
      $subjectAssignments[] = $subjectIds[$i % $numSubjects];
    }

    // Delete existing course offerings to avoid duplicates on the related tables
    CourseOffering::query()->delete();

    $teacherIndex = 0;
    $classroomIndex = 0;

    for ($i = 0; $i < $totalOfferings; $i++) {
      $startTime = $faker->time('H:i:s', '09:00:00');
      $endTime = $faker->time('H:i:s', strtotime('+2 hours', strtotime($startTime)));

      CourseOffering::create([
        'subject_id' => $subjectAssignments[$i], // Use the correctly cycled subject ID
        'teacher_id' => $teacherIds[$teacherIndex % count($teacherIds)],
        'classroom_id' => $classroomIds[$classroomIndex % count($classroomIds)],
        'time_slot' => $faker->randomElement(['morning', 'afternoon']),
        'schedule' => $faker->randomElement(['mon-wed', 'mon-fri', 'wed-fri']),
        'payment_type' => $faker->randomElement(['course', 'monthly']),
        'start_time' => $startTime,
        'end_time' => $endTime,
        'join_start' => $faker->dateTimeBetween('-1 year', '-6 months')->format('Y-m-d'),
        'join_end' => $faker->dateTimeBetween('-6 months', '+3 months')->format('Y-m-d'),
        'fee' => $faker->randomFloat(2, 50, 300),
      ]);

      $teacherIndex++;
      $classroomIndex++;
    }
  }
}
