<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
  public function run(): void
  {
    $departments = [
      ['name' => 'English', 'description' => 'Oversees the daily operations and management of the school.'],
      ['name' => 'Office Word I', 'description' => 'Manages all personnel-related functions.'],
      ['name' => 'Office Word II', 'description' => 'Responsible for the school\'s budget and accounting.'],
      ['name' => 'Office Excel I', 'description' => 'Handles upkeep and repair of facilities.'],
      ['name' => 'Office Excel II', 'description' => 'Supports student well-being, counseling, extracurriculars.'],
    ];

    foreach ($departments as $dept) {
      DB::table('departments')->updateOrInsert(
        ['name' => $dept['name']],
        array_merge($dept, ['created_at' => now(), 'updated_at' => now()])
      );
    }
  }
}
