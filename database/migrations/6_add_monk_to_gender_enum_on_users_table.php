<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
  public function up(): void
  {
    DB::statement("
            ALTER TABLE users
            MODIFY COLUMN gender ENUM(
                'male',
                'female',
                'other',
                'monk'
            ) NULL DEFAULT 'male'
        ");
  }

  public function down(): void
  {
    DB::statement("
            ALTER TABLE users
            MODIFY COLUMN gender ENUM(
                'male',
                'female',
                'other'
            ) NULL DEFAULT 'male'
        ");
  }
};
