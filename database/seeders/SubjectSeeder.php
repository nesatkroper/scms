<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
{
  public function run(): void
  {
    $departmentIds = DB::table('departments')->pluck('id')->toArray();

    $subjects = [
      ['name' => 'Introduction to Programming', 'code' => 'CS101', 'credit_hours' => 3],
      ['name' => 'Data Structures', 'code' => 'CS202', 'credit_hours' => 4],
      ['name' => 'British Literature', 'code' => 'ENGL250', 'credit_hours' => 3],
      ['name' => 'Creative Writing', 'code' => 'ENGL301', 'credit_hours' => 3],
      ['name' => 'Calculus I', 'code' => 'MATH150', 'credit_hours' => 4],
    ];

    foreach ($subjects as $subj) {
      $subj['department_id'] = $departmentIds[array_rand($departmentIds)];
      $subj['description'] = $subj['name'] . ' course description.';
      $subj['created_at'] = now();
      $subj['updated_at'] = now();

      DB::table('subjects')->updateOrInsert(['code' => $subj['code']], $subj);
    }
  }
}
