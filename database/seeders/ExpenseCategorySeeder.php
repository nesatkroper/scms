<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExpenseCategorySeeder extends Seeder
{
  public function run(): void
  {
    $categories = [
      [
        'name' => 'Salaries',
        'description' => 'Employee salaries and wages.',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Rent',
        'description' => 'Rental expenses for buildings and facilities.',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Utilities',
        'description' => 'Expenses for electricity, water, gas, and internet.',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Supplies',
        'description' => 'Costs for office, classroom, and maintenance supplies.',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Maintenance',
        'description' => 'Expenses related to the upkeep and repair of school property.',
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ];

    DB::table('expense_categories')->insert($categories);
  }
}
