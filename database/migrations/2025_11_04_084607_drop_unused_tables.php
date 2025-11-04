<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    $tables = [
      'cache',
      'cache_locks',
      'failed_jobs',
      'jobs',
      'job_batches',
      'student_guardian',
    ];

    foreach ($tables as $table) {
      if (Schema::hasTable($table)) {
        Schema::drop($table);
      }
    }
  }

  public function down(): void
  {
  }
};
