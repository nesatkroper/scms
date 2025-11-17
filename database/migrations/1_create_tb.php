<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void
  {
    //
    Schema::create('classrooms', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('room_number')->unique();
      $table->integer('capacity');
      $table->timestamps();
      $table->softDeletes();
    });

    //
    Schema::create('departments', function (Blueprint $table) {
      $table->id();
      $table->string('name')->unique();
      $table->text('description')->nullable();
      $table->timestamps();
      $table->softDeletes();
    });

    //
    Schema::create('users', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('email')->unique();
      $table->timestamp('email_verified_at')->nullable();
      $table->string('password');
      $table->string('phone')->nullable();
      $table->text('address')->nullable();
      $table->date('date_of_birth')->nullable();
      $table->enum('gender', ['male', 'female', 'other'])->nullable()->default('male');
      $table->foreignId('department_id')->nullable()->constrained()->onDelete('set null');
      $table->date('joining_date')->nullable();
      $table->string('qualification')->nullable();
      $table->string('experience')->nullable();
      $table->text('specialization')->nullable();
      $table->decimal('salary', 10, 2)->nullable();
      $table->string('cv')->nullable();
      $table->string('blood_group')->nullable();
      $table->string('nationality')->nullable();
      $table->string('religion')->nullable();
      $table->date('admission_date')->nullable();
      $table->string('occupation')->nullable();
      $table->string('company')->nullable();
      $table->string('avatar')->nullable();
      $table->rememberToken();
      $table->timestamps();
      $table->softDeletes();
    });
    //
    Schema::create('password_reset_tokens', function (Blueprint $table) {
      $table->string('email')->primary();
      $table->string('token');
      $table->timestamp('created_at')->nullable();
    });
    //
    Schema::create('sessions', function (Blueprint $table) {
      $table->string('id')->primary();
      $table->foreignId('user_id')->nullable()->index();
      $table->string('ip_address', 45)->nullable();
      $table->text('user_agent')->nullable();
      $table->longText('payload');
      $table->integer('last_activity')->index();
    });

    //
    Schema::create('subjects', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->foreignId('department_id')->nullable()->constrained()->after('code');
      $table->string('code')->unique();
      $table->text('description')->nullable();
      $table->integer('credit_hours')->default(1);
      $table->timestamps();
      $table->softDeletes();
    });

    //
    Schema::create('student_course', function (Blueprint $table) {
      $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
      $table->decimal('grade_final', 5, 2)->nullable();
      $table->timestamps();
    });

    Schema::create('expense_categories', function (Blueprint $table) {
      $table->id();
      $table->string('name')->unique();
      $table->text('description')->nullable();
      $table->timestamps();
      $table->softDeletes();
    });

    //
    Schema::create('expenses', function (Blueprint $table) {
      $table->id();
      $table->string('title');
      $table->text('description');
      $table->decimal('amount', 10, 2);
      $table->date('date');
      $table->foreignId('expense_category_id')->nullable()->constrained('expense_categories')->onDelete('set null');
      $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null');
      $table->timestamps();
      $table->softDeletes();
    });

    Schema::create('attendances', function (Blueprint $table) {
      $table->id();
      $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
      $table->date('date');
      $table->enum('status', ['present', 'absent', 'late', 'excused']);
      $table->text('remarks')->nullable();
      $table->timestamps();
      $table->unique(['student_id', 'date']);
      $table->softDeletes();
    });

    Schema::create('exams', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->text('description')->nullable();
      $table->foreignId('subject_id')->constrained()->onDelete('cascade');
      $table->date('date');
      $table->integer('total_marks');
      $table->integer('passing_marks');
      $table->timestamps();
      $table->softDeletes();
    });

    Schema::create('grades', function (Blueprint $table) {
      $table->id();
      $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
      $table->foreignId('exam_id')->constrained()->onDelete('cascade');
      $table->decimal('marks_obtained', 5, 2);
      $table->text('comments')->nullable();
      $table->timestamps();
      $table->unique(['student_id', 'exam_id']);
      $table->softDeletes();
    });

    Schema::create('payments', function (Blueprint $table) {
      $table->id();
      $table->decimal('amount', 10, 2);
      $table->date('payment_date');
      $table->string('payment_method');
      $table->string('transaction_id')->nullable();
      $table->text('remarks')->nullable();
      $table->foreignId('received_by')->constrained('users')->onDelete('restrict');
      $table->timestamps();
      $table->softDeletes();
    });

    Schema::create('scores', function (Blueprint $table) {
      $table->id();
      $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
      $table->foreignId('exam_id')->constrained()->onDelete('cascade');
      $table->foreignId('subject_id')->constrained()->onDelete('cascade');
      $table->string('semester');
      $table->integer('score');
      $table->string('grade')->nullable();
      $table->text('remarks')->nullable();
      $table->timestamps();
      $table->softDeletes();
      $table->unique(['student_id', 'exam_id', 'subject_id', 'semester']);
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('payments');
    Schema::dropIfExists('grades');
    Schema::dropIfExists('exams');
    Schema::dropIfExists('attendances');
    Schema::dropIfExists('student_course');
    Schema::dropIfExists('book_issues');
    Schema::dropIfExists('notices');
    Schema::dropIfExists('students');
    Schema::dropIfExists('guardians');
    Schema::dropIfExists('subjects');
    Schema::dropIfExists('teachers');
    Schema::dropIfExists('departments');
    Schema::dropIfExists('events');
    Schema::dropIfExists('books');
    Schema::dropIfExists('book_categories');
    Schema::dropIfExists('classrooms');
    Schema::dropIfExists('users');
    Schema::dropIfExists('password_reset_tokens');
    Schema::dropIfExists('sessions');
  }
};
