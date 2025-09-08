<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
  public function run(): void
  {
    $departments = [
      [
        'name' => 'Administration',
        'description' => 'Oversees the daily operations and management of the school.',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Human Resources',
        'description' => 'Manages all personnel-related functions, including hiring and staff support.',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Finance',
        'description' => 'Responsible for the school\'s budget, financial planning, and accounting.',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Maintenance',
        'description' => 'Handles the upkeep and repair of all school facilities and grounds.',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Student Services',
        'description' => 'Provides support for student well-being, including counseling and extracurricular activities.',
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ];

    DB::table('departments')->insert($departments);
  }
}
