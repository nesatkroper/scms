<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  public function run(): void
  {
    $this->call([
      AttendanceSeeder::class,
      FeeSeeder::class,
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
    // ]);
  }
}
