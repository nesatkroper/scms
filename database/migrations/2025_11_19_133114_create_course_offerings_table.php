<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up()
  {
    Schema::create('course_offerings', function (Blueprint $table) {
      $table->id();

      $table->foreignId('subject_id')
        ->constrained()
        ->onDelete('cascade');

      $table->foreignId('teacher_id')
      ->nullable()
        ->constrained('users')
        ->onDelete('set null')
        ->nullable();

      $table->foreignId('classroom_id')
        ->nullable()
        ->constrained()
        ->onDelete('set null');

      $table->enum('time_slot', ['morning', 'afternoon', 'evening'])
        ->default('morning');

      $table->time('start_time')->nullable();
      $table->time('end_time')->nullable();

      $table->date('join_start')->nullable();
      $table->date('join_end')->nullable();

      $table->decimal('fee', 10, 2)->default(0);

      $table->integer('capacity')->nullable();

      $table->timestamps();
      $table->softDeletes();
    });
  }

  public function down()
  {
    Schema::dropIfExists('course_offerings');
  }
};
