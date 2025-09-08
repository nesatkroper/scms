<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassroomSeeder extends Seeder
{
  public function run(): void
  {
    $classrooms = [];
    $letters = ['A', 'B', 'C'];
    foreach ($letters as $letter) {
      for ($i = 1; $i <= 5; $i++) {
        $roomNumber = "{$letter}-10{$i}";

        $classrooms[] = [
          'name' => "Classroom {$letter}",
          'room_number' => $roomNumber,
          'capacity' => 30,
          'created_at' => now(),
          'updated_at' => now(),
        ];
      }
    }

    DB::table('classrooms')->insert($classrooms);
  }
}
