<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
  public function run(): void
  {
    $departments = [
      ['name' => 'Administration', 'description' => 'Oversees the daily operations and management of the school.'],
      ['name' => 'Human Resources', 'description' => 'Manages all personnel-related functions.'],
      ['name' => 'Finance', 'description' => 'Responsible for the school\'s budget and accounting.'],
      ['name' => 'Maintenance', 'description' => 'Handles upkeep and repair of facilities.'],
      ['name' => 'Student Services', 'description' => 'Supports student well-being, counseling, extracurriculars.'],
    ];

    foreach ($departments as $dept) {
      DB::table('departments')->updateOrInsert(
        ['name' => $dept['name']],
        array_merge($dept, ['created_at' => now(), 'updated_at' => now()])
      );
    }
  }
}
