<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradeLevelSeeder extends Seeder
{
  public function run(): void
  {
    $gradeLevels = [
      [
        'name' => 'Year 1',
        'code' => 'Y1',
        'description' => 'First year of formal education.',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Year 2',
        'code' => 'Y2',
        'description' => 'Second year of formal education.',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Year 3',
        'code' => 'Y3',
        'description' => 'Third year of formal education.',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Year 4',
        'code' => 'Y4',
        'description' => 'Fourth year of formal education.',
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ];

    DB::table('grade_levels')->insert($gradeLevels);
  }
}
