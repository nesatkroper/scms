<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassroomSeeder extends Seeder
{
  public function run(): void
  {
    $rooms = [
      ['name' => 'Room A', 'room_number' => 'A101', 'capacity' => 30],
      ['name' => 'Room B', 'room_number' => 'B201', 'capacity' => 40],
      ['name' => 'Room C', 'room_number' => 'C301', 'capacity' => 25],
    ];

    foreach ($rooms as $room) {
      DB::table('classrooms')->updateOrInsert(
        ['room_number' => $room['room_number']],
        [
          'name' => $room['name'],
          'capacity' => $room['capacity'],
          'created_at' => now(),
          'updated_at' => now(),
        ]
      );
    }
  }
}
