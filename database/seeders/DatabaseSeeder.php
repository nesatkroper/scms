<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  public function run(): void
  {
    $this->call([
      AttendanceSeeder::class,
      ExamSeeder::class,
      ScoreSeeder::class,
    ]);

    // $this->call([
    //   UserSeeder::class,
    //   CourseDataSeeder::class,
    //   EnrollmentSeeder::class,
    //   ExpenseCategorySeeder::class,
    //   ExpenseSeeder::class,
    //   AttendanceSeeder::class,
    //   ExamSeeder::class,
    //   FeeTypeSeeder::class,
    //   FeeSeeder::class,
    // AttendanceSeeder::class,
    // ]);
  }
}
