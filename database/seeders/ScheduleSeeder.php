<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScheduleSeeder extends Seeder
{
  public function run(): void
  {
    $teacherIds = DB::table('users')->role('teacher')->pluck('id')->toArray();
    $subjectIds = DB::table('subjects')->pluck('id')->toArray();
    $classroomIds = DB::table('classrooms')->pluck('id')->toArray();
    $weekdays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
    $schedules = [];

    foreach ($teacherIds as $teacherId) {
      for ($i = 0; $i < 3; $i++) {
        $schedules[] = [
          'teacher_id' => $teacherId,
          'subject_id' => $subjectIds[array_rand($subjectIds)],
          'classroom_id' => $classroomIds[array_rand($classroomIds)],
          'weekday' => $weekdays[array_rand($weekdays)],
          'start_time' => '08:00:00',
          'end_time' => '09:30:00',
          'created_at' => now(),
          'updated_at' => now(),
        ];
      }
    }

    DB::table('schedules')->insert($schedules);
  }
}
