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
            StudentCourseSeeder::class,
            FeeTypeSeeder::class,
            FeeSeeder::class,
            ExamSeeder::class,
            ScheduleSeeder::class,
            ExpenseCategorySeeder::class,
            ExpenseSeeder::class,
        ]);
    }
}
