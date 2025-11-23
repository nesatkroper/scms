<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('classrooms', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('room_number')->unique();
      $table->integer('capacity');
      $table->timestamps();
      $table->softDeletes();
    });

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

    Schema::create('password_reset_tokens', function (Blueprint $table) {
      $table->string('email')->primary();
      $table->string('token');
      $table->timestamp('created_at')->nullable();
    });

    Schema::create('sessions', function (Blueprint $table) {
      $table->string('id')->primary();
      $table->foreignId('user_id')->nullable()->index();
      $table->string('ip_address', 45)->nullable();
      $table->text('user_agent')->nullable();
      $table->longText('payload');
      $table->integer('last_activity')->index();
    });

    Schema::create('subjects', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('code')->unique();
      $table->text('description')->nullable();
      $table->integer('credit_hours')->default(1);
      $table->timestamps();
      $table->softDeletes();
    });

    Schema::create('expense_categories', function (Blueprint $table) {
      $table->id();
      $table->string('name')->unique();
      $table->text('description')->nullable();
      $table->timestamps();
      $table->softDeletes();
    });

    Schema::create('expenses', function (Blueprint $table) {
      $table->id();
      $table->string('title');
      $table->text('description');
      $table->decimal('amount', 10, 2);
      $table->date('date');
      $table->foreignId('expense_category_id')->nullable()->constrained('expense_categories')->onDelete('set null');
      $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null');
      $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
      $table->timestamps();
      $table->softDeletes();
    });

    Schema::create('course_offerings', function (Blueprint $table) {
      $table->id();
      $table->foreignId('subject_id')->constrained()->onDelete('cascade');
      $table->foreignId('teacher_id')->nullable()->constrained('users')->onDelete('set null');
      $table->foreignId('classroom_id')->nullable()->constrained()->onDelete('set null');
      $table->enum('time_slot', ['morning', 'afternoon', 'evening'])->default('morning');
      $table->enum('schedule', ['mon-wed', 'mon-fri', 'wed-fri', 'sat-sun'])->default('mon-fri');
      $table->time('start_time')->nullable();
      $table->time('end_time')->nullable();
      $table->date('join_start')->nullable();
      $table->date('join_end')->nullable();
      $table->decimal('fee', 10, 2)->default(0);
      $table->timestamps();
      $table->softDeletes();
    });

    Schema::create('student_course', function (Blueprint $table) {
      $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
      $table->foreignId('course_offering_id')->constrained()->onDelete('cascade');
      $table->decimal('grade_final', 5, 2)->nullable();
      $table->enum('status', ['studying', 'suspended', 'dropped', 'completed'])->default('studying');
      $table->enum('payment_status', ['pending', 'paid', 'overdue', 'free'])->default('pending');
      $table->text('remarks')->nullable();
      $table->timestamps();
      $table->unique(['student_id', 'course_offering_id']);
    });

    Schema::create('attendances', function (Blueprint $table) {
      $table->id();
      $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
      $table->foreignId('course_offering_id')->nullable()->constrained();
      $table->date('date');
      $table->enum('status', ['present', 'absent', 'late', 'excused']);
      $table->text('remarks')->nullable();
      $table->timestamps();
      $table->softDeletes();
      $table->unique(['student_id', 'course_offering_id',  'date'], 'attendances_unique_idx');
    });


    Schema::create('exams', function (Blueprint $table) {
      $table->id();
      $table->enum('type', ['lab', 'quiz', 'homework1', 'homework2', 'homework3', 'midterm', 'final']);
      $table->text('description')->nullable();
      $table->foreignId('course_offering_id')->constrained()->onDelete('cascade');
      $table->date('date');
      $table->integer('total_marks');
      $table->integer('passing_marks');
      $table->timestamps();
      $table->softDeletes();
    });

    Schema::create('fee_types', function (Blueprint $table) {
      $table->id();
      $table->string('name')->unique();
      $table->text('description')->nullable();
      $table->timestamps();
      $table->softDeletes();
    });

    Schema::create('fees', function (Blueprint $table) {
      $table->id();
      $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
      $table->foreignId('fee_type_id')->constrained('fee_types')->onDelete('cascade');
      $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
      $table->decimal('amount', 10, 2);
      $table->date('due_date')->nullable();
      $table->date('paid_date')->nullable(); // quick check
      $table->enum('status', ['unpaid', 'partially_paid', 'paid'])->default('unpaid');
      $table->text('remarks')->nullable();
      $table->timestamps();
      $table->softDeletes();
    });

    Schema::create('payments', function (Blueprint $table) {
      $table->id();
      $table->decimal('amount', 10, 2);
      $table->date('payment_date');
      $table->string('payment_method');
      $table->string('transaction_id')->nullable();
      $table->text('remarks')->nullable();
      $table->foreignId('course_offering_id')->constrained('course_offerings')->onDelete('restrict');
      $table->foreignId('received_by')->constrained('users')->onDelete('restrict');
      $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
      $table->foreignId('fee_id')->nullable()->constrained('fees')->onDelete('cascade');
      $table->timestamps();
      $table->softDeletes();
    });

    Schema::create('scores', function (Blueprint $table) {
      $table->id();
      $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
      $table->foreignId('exam_id')->constrained()->onDelete('cascade');
      $table->integer('score');
      $table->string('grade')->nullable();
      $table->text('remarks')->nullable();
      $table->timestamps();
      $table->softDeletes();
      $table->unique(['student_id', 'exam_id']);
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('scores');
    Schema::dropIfExists('payments');
    Schema::dropIfExists('fees');
    Schema::dropIfExists('fee_types');
    Schema::dropIfExists('exams');
    Schema::dropIfExists('attendances');
    Schema::dropIfExists('student_course');
    Schema::dropIfExists('course_offerings');
    Schema::dropIfExists('expenses');
    Schema::dropIfExists('expense_categories');
    Schema::dropIfExists('subjects');
    Schema::dropIfExists('sessions');
    Schema::dropIfExists('users');
    Schema::dropIfExists('classrooms');
    Schema::dropIfExists('password_reset_tokens');
  }
};