<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('teacher_subject', function (Blueprint $table) {
      if (!Schema::hasColumn('teacher_subject', 'time_slot')) {
        $table->enum('time_slot', ['morning', 'afternoon', 'evening'])
          ->default('morning')
          ->after('teacher_id');
      }
        });
    }

    public function down(): void
    {
        Schema::table('teacher_subject', function (Blueprint $table) {
        });
    }
};

