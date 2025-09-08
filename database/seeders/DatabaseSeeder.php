<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  public function run(): void
  {
    $this->call([
      DepartmentSeeder::class,
      UserSeeder::class,
      ClassroomSeeder::class,
      SubjectSeeder::class,
      GradeLevelSeeder::class,
      ExpenseCategorySeeder::class,
      CourseOfferingSeeder::class,
      StudentCourseSeeder::class,
    ]);
  }
}
