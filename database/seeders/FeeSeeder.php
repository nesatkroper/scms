<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class FeeSeeder extends Seeder
{
  public function run(): void
  {
    $feeTypeIds = DB::table('fee_types')->pluck('id')->toArray();
    
    if (empty($feeTypeIds)) {
        $this->command->error("Fee Types must be seeded first.");
        return;
    }

    $this->command->info('Seeding Fees...');

    // Process enrollments in chunks directly from the database query
    // distinct selection to avoid reloading same rows if not ordered strictly, though id order is fine
    DB::table('enrollments')->orderBy('id')->chunk(1000, function ($enrollments) use ($feeTypeIds) {
        $fees = [];
        $now = now();

        foreach ($enrollments as $enrollment) {
            $isPaid = rand(0, 100) < 70; // 70% chance of being paid

            $fees[] = [
              'student_id' => $enrollment->student_id,
              'enrollment_id' => $enrollment->id,
              'fee_type_id' => $feeTypeIds[array_rand($feeTypeIds)],
              'amount' => rand(100, 1000),
              'due_date' => $now->copy()->addMonth(),
              'created_by' => 1, // Admin role ID usually 1
              'payment_date' => $isPaid ? $now->copy()->subDays(rand(1, 10)) : null,
              'payment_method' => $isPaid ? (rand(0, 1) ? 'Cash' : 'Bank Transfer') : null,
              'created_at' => $now,
              'updated_at' => $now,
            ];
        }

        DB::table('fees')->insert($fees);
    });
    
    $this->command->info('Fees seeded successfully.');
  }
}
