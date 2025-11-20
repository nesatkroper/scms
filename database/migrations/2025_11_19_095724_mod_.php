<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::table('student_course', function (Blueprint $table) {
      $table->enum('status', ['studying', 'suspended', 'dropped', 'completed'])
        ->default('studying')
        ->after('grade_final');

      $table->enum('payment_status', ['pending', 'paid', 'overdue', 'free'])
        ->default('pending')
        ->after('status');

      $table->text('remarks')->nullable()->after('payment_status');
    });
  }

  public function down(): void
  {
    Schema::table('student_course', function (Blueprint $table) {
      $table->dropColumn(['status', 'payment_status', 'remarks']);
    });
  }
};
