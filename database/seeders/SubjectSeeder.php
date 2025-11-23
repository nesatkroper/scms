<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
{
  public function run(): void
  {

    $subjects = [
      ['name' => 'Introduction to Programming', 'code' => 'CS101', 'credit_hours' => 3],
      ['name' => 'Data Structures', 'code' => 'CS202', 'credit_hours' => 4],
    ];

    foreach ($subjects as $subj) {
      $subj['description'] = $subj['name'] . ' course description.';
      $subj['created_at'] = now();
      $subj['updated_at'] = now();

      DB::table('subjects')->updateOrInsert(['code' => $subj['code']], $subj);
    }
  }
}