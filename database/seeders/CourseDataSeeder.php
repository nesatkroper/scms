<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Classroom;
use App\Models\Subject;
use App\Models\CourseOffering;
use Faker\Factory as Faker;

class CourseDataSeeder extends Seeder
{
  public function run(): void
  {
    $faker = Faker::create();

    $teacherIds = User::role('teacher')->pluck('id')->toArray();

    if (empty($teacherIds)) {
      $this->command->error("Teacher data not found. Please run the UserSeeder first.");
      return;
    }

    $this->command->info('Seeding 8 Classrooms...');
    $classroomRoomNumbers = [];
    for ($i = 1; $i <= 8; $i++) $classroomRoomNumbers[] = 'R' . (8 + $i);
    $faker->unique(true);
    $classroomIds = [];

    foreach ($classroomRoomNumbers as $index => $roomNumber) {
      $classroom = Classroom::updateOrCreate(
        ['room_number' => $roomNumber],
        [
          'name' => 'Room ' . ($index + 8),
          'capacity' => 50,
        ]
      );
      $classroomIds[] = $classroom->id;
    }


    $this->command->info('Seeding 20 Subjects...');
    $subjectData = [
      ['name' => 'English Grammar', 'code' => 'ENGL102'],
      ['name' => 'World History', 'code' => 'HIST201'],
      ['name' => 'Microeconomics', 'code' => 'ECON305'],
      ['name' => 'Mathematics I', 'code' => 'MATH101'],
      ['name' => 'Physics I', 'code' => 'PHYS101'],
      ['name' => 'Chemistry', 'code' => 'CHEM101'],
      ['name' => 'Biology', 'code' => 'BIO101'],
    ];

    $subjectIds = [];
    foreach ($subjectData as $data) {
      $subject = Subject::updateOrCreate(
        ['code' => $data['code']],
        [
          'name' => $data['name'],
          'description' => $faker->sentence(),
          'credit_hours' => $faker->randomElement([3, 4]),
        ]
      );
      $subjectIds[] = $subject->id;
    }

    $this->command->info('Seeding 10 Course Offerings...');

    $totalOfferings = 10;
    $numSubjects = count($subjectIds);
    $subjectAssignments = [];

    for ($i = 0; $i < $totalOfferings; $i++) {
      $subjectAssignments[] = $subjectIds[$i % $numSubjects];
    }

    CourseOffering::query()->delete();

    $teacherIndex = 0;
    $classroomIndex = 0;

    $timeSlots = ['morning', 'afternoon', 'evening'];
    $schedules = ['mon-wed', 'mon-fri', 'wed-fri', 'sat-sun'];

    $usedTeacherCombinations = [];
    $usedClassroomCombinations = [];

    for ($i = 0; $i < $totalOfferings; $i++) {
      $teacherId = $teacherIds[$teacherIndex % count($teacherIds)];
      $classroomId = $classroomIds[$classroomIndex % count($classroomIds)];

      foreach ($schedules as $schedule) {
        foreach ($timeSlots as $timeSlot) {
          $teacherKey = "{$teacherId}-{$schedule}-{$timeSlot}";
          $classroomKey = "{$classroomId}-{$schedule}-{$timeSlot}";

          if (!isset($usedTeacherCombinations[$teacherKey]) && !isset($usedClassroomCombinations[$classroomKey])) {
            $usedTeacherCombinations[$teacherKey] = true;
            $usedClassroomCombinations[$classroomKey] = true;

            $startTime = $faker->time('H:i:s', '09:00:00');
            $endTime = $faker->time('H:i:s', strtotime('+2 hours', strtotime($startTime)));

            CourseOffering::create([
              'subject_id' => $subjectAssignments[$i],
              'teacher_id' => $teacherId,
              'classroom_id' => $classroomId,
              'time_slot' => $timeSlot,
              'schedule' => $schedule,
              'payment_type' => $faker->randomElement(['course', 'monthly']),
              'start_time' => $startTime,
              'end_time' => $endTime,
              'join_start' => $faker->dateTimeBetween('-1 year', '-6 months')->format('Y-m-d'),
              'join_end' => $faker->dateTimeBetween('-6 months', '+3 months')->format('Y-m-d'),
              'fee' => $faker->randomFloat(2, 10, 30),
            ]);

            break 2;
          }
        }
      }

      $teacherIndex++;
      $classroomIndex++;
    }
  }
}
