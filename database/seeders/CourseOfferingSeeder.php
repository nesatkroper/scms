<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseOfferingSeeder extends Seeder
{
  public function run(): void
  {
    $subjectIds = DB::table('subjects')->pluck('id')->all();
    $userIds = DB::table('users')->whereIn('id', DB::table('model_has_roles')->where('role_id', 2)->pluck('model_id'))->pluck('id')->all();
    $classroomIds = DB::table('classrooms')->pluck('id')->all();

    if (empty($subjectIds) || empty($userIds) || empty($classroomIds)) {
      $this->command->warn('Skipping course_offerings seeding. Please seed subjects, teachers, and classrooms first.');
      return;
    }

    $courseOfferings = [];
    $semesters = ['Fall', 'Spring', 'Summer'];
    $academicYear = now()->year;

    for ($i = 0; $i < 20; $i++) {
      $courseOfferings[] = [
        'subject_id' => $subjectIds[array_rand($subjectIds)],
        'student_id' => $userIds[array_rand($userIds)],
        'classroom_id' => $classroomIds[array_rand($classroomIds)],
        'semester' => $semesters[array_rand($semesters)],
        'academic_year' => $academicYear,
        'created_at' => now(),
        'updated_at' => now(),
      ];
    }

    DB::table('course_offerings')->insert($courseOfferings);
  }
}
