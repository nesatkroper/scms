<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
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

    Schema::create('book_categories', function (Blueprint $table) {
      $table->id();
      $table->string('name')->unique();
      $table->text('description')->nullable();
      $table->timestamps();
      $table->softDeletes();
    });

    Schema::create('books', function (Blueprint $table) {
      $table->id();
      $table->string('title');
      $table->foreignId('category_id')->constrained('book_categories')->onDelete('cascade');
      $table->string('author');
      $table->string('isbn')->unique();
      $table->year('publication_year');
      $table->string('publisher');
      $table->integer('quantity');
      $table->text('description')->nullable();
      $table->string('cover_image')->nullable();
      $table->longText('content')->nullable();
      $table->timestamps();
      $table->softDeletes();
    });

    Schema::create('events', function (Blueprint $table) {
      $table->id();
      $table->string('title');
      $table->text('description');
      $table->date('date');
      $table->time('start_time');
      $table->time('end_time')->nullable();
      $table->string('location')->nullable();
      $table->enum('type', ['academic', 'cultural', 'sports', 'holiday', 'other']);
      $table->boolean('is_holiday')->default(false);
      $table->timestamps();
      $table->softDeletes();
    });

    Schema::create('grade_levels', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('code')->unique();
      $table->text('description')->nullable();
      $table->timestamps();
      $table->softDeletes();
    });

    Schema::create('departments', function (Blueprint $table) {
      $table->id();
      $table->string('name')->unique();
      $table->text('description')->nullable();
      $table->timestamps();
      $table->softDeletes();
    });

    Schema::create('teachers', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->enum('gender', ['male', 'female'])->default('male');
      $table->date('dob');
      $table->foreignId('department_id')->nullable()->constrained()->onDelete('set null');
      $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
      $table->date('joining_date');
      $table->string('qualification');
      $table->string('experience');
      $table->string('phone');
      $table->string('email')->unique();
      $table->string('address');
      $table->text('specialization')->nullable();
      $table->decimal('salary', 10, 2)->nullable();
      $table->string('photo')->nullable();
      $table->string('cv')->nullable();
      $table->timestamps();
      $table->softDeletes();
    });

    Schema::create('subjects', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('code')->unique();
      $table->foreignId('department_id')->nullable()->constrained()->onDelete('set null');
      $table->text('description')->nullable();
      $table->integer('credit_hours')->default(1);
      $table->timestamps();
      $table->softDeletes();
    });

    Schema::create('course_offerings', function (Blueprint $table) {
      $table->id();
      $table->foreignId('subject_id')->constrained()->onDelete('cascade');
      $table->foreignId('teacher_id')->constrained()->onDelete('cascade');
      $table->foreignId('classroom_id')->constrained()->onDelete('cascade');
      $table->string('semester')->nullable();
      $table->year('academic_year');
      $table->timestamps();
      $table->softDeletes();
    });

    Schema::create('guardians', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('phone');
      $table->string('email')->unique();
      $table->string('address');
      $table->string('occupation')->nullable();
      $table->string('company')->nullable();
      $table->string('relation');
      $table->string('photo')->nullable();
      $table->timestamps();
      $table->softDeletes();
    });

    Schema::create('students', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('phone');
      $table->string('email')->unique();
      $table->string('address');
      $table->string('photo')->nullable();
      $table->date('dob')->nullable();
      $table->string('gender')->nullable();
      $table->foreignId('grade_level_id')->nullable()->constrained()->onDelete('set null');
      $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
      $table->string('blood_group')->nullable();
      $table->string('nationality')->nullable();
      $table->string('religion')->nullable();
      $table->date('admission_date');
      $table->timestamps();
      $table->softDeletes();
    });

    Schema::create('student_guardian', function (Blueprint $table) {
      $table->foreignId('student_id')->constrained()->onDelete('cascade');
      $table->foreignId('guardian_id')->constrained()->onDelete('cascade');
      $table->string('relation_to_student')->nullable();
      $table->timestamps();
      $table->primary(['student_id', 'guardian_id']);
    });

    Schema::create('student_course', function (Blueprint $table) {
      $table->foreignId('student_id')->constrained()->onDelete('cascade');
      $table->foreignId('course_offering_id')->constrained('course_offerings')->onDelete('cascade');
      $table->decimal('grade_final', 5, 2)->nullable();
      $table->timestamps();
      $table->primary(['student_id', 'course_offering_id']);
    });

    Schema::create('book_issues', function (Blueprint $table) {
      $table->id();
      $table->foreignId('book_id')->constrained()->onDelete('cascade');
      $table->foreignId('student_id')->nullable()->constrained()->onDelete('set null');
      $table->foreignId('teacher_id')->nullable()->constrained()->onDelete('set null');
      $table->date('issue_date');
      $table->date('due_date');
      $table->date('return_date')->nullable();
      $table->decimal('fine', 8, 2)->default(0);
      $table->enum('status', ['issued', 'returned', 'overdue'])->default('issued');
      $table->timestamps();
      $table->softDeletes();
    });

    Schema::create('notices', function (Blueprint $table) {
      $table->id();
      $table->string('title');
      $table->text('content');
      $table->enum('audience', ['all', 'teachers', 'students', 'parents', 'staff']);
      $table->date('start_date');
      $table->date('end_date');
      $table->boolean('is_published')->default(false);
      $table->foreignId('created_by')->constrained('users')->onDelete('restrict');
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
      $table->timestamps();
      $table->softDeletes();
    });

    Schema::create('fee_structures', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->foreignId('grade_level_id')->constrained()->onDelete('cascade');
      $table->decimal('amount', 10, 2);
      $table->enum('frequency', ['monthly', 'quarterly', 'semester', 'annual']);
      $table->date('effective_from');
      $table->date('effective_to')->nullable();
      $table->text('description')->nullable();
      $table->timestamps();
      $table->softDeletes();
    });

    Schema::create('attendances', function (Blueprint $table) {
      $table->id();
      $table->foreignId('student_id')->constrained()->onDelete('cascade');
      $table->foreignId('course_offering_id')->constrained('course_offerings')->onDelete('cascade');
      $table->date('date');
      $table->enum('status', ['present', 'absent', 'late', 'excused']);
      $table->text('remarks')->nullable();
      $table->timestamps();
      $table->unique(['student_id', 'course_offering_id', 'date']);
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
      $table->foreignId('student_id')->constrained()->onDelete('cascade');
      $table->foreignId('exam_id')->constrained()->onDelete('cascade');
      $table->decimal('marks_obtained', 5, 2);
      $table->text('comments')->nullable();
      $table->timestamps();
      $table->unique(['student_id', 'exam_id']);
      $table->softDeletes();
    });

    Schema::create('student_fees', function (Blueprint $table) {
      $table->id();
      $table->foreignId('student_id')->constrained()->onDelete('cascade');
      $table->foreignId('fee_structure_id')->constrained()->onDelete('cascade');
      $table->decimal('amount', 10, 2);
      $table->decimal('discount', 10, 2)->default(0);
      $table->decimal('paid_amount', 10, 2)->default(0);
      $table->enum('status', ['pending', 'partial', 'paid'])->default('pending');
      $table->date('due_date');
      $table->text('remarks')->nullable();
      $table->timestamps();
      $table->softDeletes();
    });

    Schema::create('payments', function (Blueprint $table) {
      $table->id();
      $table->foreignId('student_fee_id')->constrained()->onDelete('cascade');
      $table->decimal('amount', 10, 2);
      $table->date('payment_date');
      $table->string('payment_method');
      $table->string('transaction_id')->nullable();
      $table->text('remarks')->nullable();
      $table->foreignId('received_by')->constrained('users')->onDelete('restrict');
      $table->timestamps();
      $table->softDeletes();
    });

    Schema::create('provinces', function (Blueprint $table) {
      $table->id();
      $table->string('type');
      $table->string('code');
      $table->string('khmer_name');
      $table->string('name');
      $table->timestamps();
    });

    Schema::create('districts', function (Blueprint $table) {
      $table->id();
      $table->string('type');
      $table->string('code');
      $table->string('khmer_name');
      $table->string('name');
      $table->unsignedBigInteger('province_id');
      $table->timestamps();
      $table->foreign('province_id')->references('id')->on('provinces')->onDelete('cascade');
    });

    Schema::create('communes', function (Blueprint $table) {
      $table->id();
      $table->string('type');
      $table->string('code');
      $table->string('khmer_name');
      $table->string('name');
      $table->unsignedBigInteger('province_id');
      $table->unsignedBigInteger('district_id');
      $table->timestamps();
      $table->foreign('province_id')->references('id')->on('provinces')->onDelete('cascade');
      $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');
    });

    Schema::create('villages', function (Blueprint $table) {
      $table->id();
      $table->string('type');
      $table->string('code');
      $table->string('khmer_name');
      $table->string('name');
      $table->unsignedBigInteger('province_id');
      $table->unsignedBigInteger('district_id');
      $table->unsignedBigInteger('commune_id');
      $table->timestamps();
      $table->foreign('province_id')->references('id')->on('provinces')->onDelete('cascade');
      $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');
      $table->foreign('commune_id')->references('id')->on('communes')->onDelete('cascade');
    });

    Schema::create('addresses', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('province_id');
      $table->unsignedBigInteger('district_id');
      $table->unsignedBigInteger('commune_id');
      $table->unsignedBigInteger('village_id');

      $table->string('description')->nullable();
      $table->enum('status', ['active', 'inactive'])->default('active');
      $table->timestamps();
      $table->foreign('province_id')->references('id')->on('provinces')->onDelete('cascade');
      $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');
      $table->foreign('commune_id')->references('id')->on('communes')->onDelete('cascade');
      $table->foreign('village_id')->references('id')->on('villages')->onDelete('cascade');
    });

    // Schema::create('scores', function (Blueprint $table) {
    //   $table->id();
    //   $table->foreignId('student_id')->constrained()->onDelete('cascade');
    //   $table->foreignId('exam_id')->constrained()->onDelete('cascade');
    //   $table->string('semester');
    //   $table->integer('score');
    //   $table->string('grade')->nullable();
    //   $table->text('remarks')->nullable();
    //   $table->timestamps();
    //   $table->softDeletes();

    //   $table->unique(['student_id', 'exam_id', 'semester']);
    // });
  }

  public function down(): void
  {
    Schema::dropIfExists('payments');
    Schema::dropIfExists('student_fees');
    Schema::dropIfExists('grades');
    Schema::dropIfExists('exams');
    Schema::dropIfExists('attendances');
    Schema::dropIfExists('student_course');
    Schema::dropIfExists('course_offerings');
    Schema::dropIfExists('book_issues');
    Schema::dropIfExists('notices');
    Schema::dropIfExists('expenses');
    Schema::dropIfExists('fee_structures');
    Schema::dropIfExists('student_guardian');
    Schema::dropIfExists('students');
    Schema::dropIfExists('guardians');
    Schema::dropIfExists('subjects');
    Schema::dropIfExists('teachers');
    Schema::dropIfExists('departments');
    Schema::dropIfExists('grade_levels');
    Schema::dropIfExists('events');
    Schema::dropIfExists('books');
    Schema::dropIfExists('book_categories');
    Schema::dropIfExists('expense_categories');
    Schema::dropIfExists('classrooms');
    Schema::dropIfExists('addresses');
  }
};