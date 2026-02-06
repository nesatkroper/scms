<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class FeeSeeder extends Seeder
{
  public function run(): void
  {
    $enrollments = DB::table('enrollments')->get(); // Get ALL enrollments for high volume
    $feeTypeIds = DB::table('fee_types')->pluck('id')->toArray();
    $fees = [];
    
    // Create at least one fee for every enrollment (high volume)
    foreach ($enrollments as $enrollment) {
        $fees[] = [
          'student_id' => $enrollment->student_id,
          'enrollment_id' => $enrollment->id,
          'fee_type_id' => $feeTypeIds[array_rand($feeTypeIds)],
          'amount' => rand(100, 1000),
          'due_date' => now()->addMonth(),
          'created_by' => 1, // Admin
          // 'payment_date' => null, // Unpaid
          'created_at' => now(),
          'updated_at' => now(),
        ];
    }

    // Insert in chunks to avoid memory issues
    foreach (array_chunk($fees, 500) as $chunk) {
        DB::table('fees')->insert($chunk);
    }
  }
}
