<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
{
  public function run(): void
  {
    $subjects = [
      [
        'name' => 'Introduction to Programming',
        'code' => 'CS101',
        'description' => 'A foundational course on the principles of computer programming.',
        'credit_hours' => 3,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Data Structures',
        'code' => 'CS202',
        'description' => 'An in-depth study of data organization and management.',
        'credit_hours' => 4,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'British Literature',
        'code' => 'ENGL250',
        'description' => 'A survey of key literary works from Great Britain.',
        'credit_hours' => 3,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Creative Writing',
        'code' => 'ENGL301',
        'description' => 'Focuses on developing skills in various forms of creative writing.',
        'credit_hours' => 3,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Calculus I',
        'code' => 'MATH150',
        'description' => 'The first course in differential and integral calculus.',
        'credit_hours' => 4,
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ];

    DB::table('subjects')->insert($subjects);
  }
}
