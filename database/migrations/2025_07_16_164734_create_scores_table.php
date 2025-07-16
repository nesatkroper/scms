<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('scores', function (Blueprint $table) {
      $table->id();
      $table->foreignId('student_id')->constrained()->onDelete('cascade');
      $table->foreignId('exam_id')->constrained()->onDelete('cascade');
      $table->string('semester');
      $table->integer('score');
      $table->string('grade')->nullable();
      $table->text('remarks')->nullable();
      $table->timestamps();
      $table->softDeletes();

      $table->unique(['student_id', 'exam_id', 'semester']);
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('scores');
  }
};