<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        // Departments
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->foreignId('head_id')->nullable()->constrained('teachers');
            $table->timestamps();
        });

        // Classes (Grade Levels)
        

        // Sections
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., Section A, Morning Shift
            $table->foreignId('grade_level_id')->constrained()->onDelete('cascade');
            $table->foreignId('teacher_id')->nullable()->constrained('teachers');
            $table->integer('capacity')->default(30);
            $table->timestamps();
        });

        // Subjects
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->foreignId('department_id')->nullable()->constrained();
            $table->text('description')->nullable();
            $table->integer('credit_hours')->default(1);
            $table->timestamps();
        });

        // Class Subjects (Pivot)
        Schema::create('class_subject', function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_id')->constrained()->onDelete('cascade');
            $table->foreignId('subject_id')->constrained()->onDelete('cascade');
            $table->foreignId('teacher_id')->constrained('teachers')->onDelete('cascade');
            $table->string('room')->nullable();
            $table->time('start_time');
            $table->time('end_time');
            $table->enum('day', ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday']);
            $table->timestamps();
        });

        // Attendance
        Schema::create('attendances', function (Blueprint $table) {
                $table->id();
                $table->foreignId('student_id')->constrained()->onDelete('cascade');
                $table->foreignId('class_subject_id')->constrained()->onDelete('cascade');
                $table->date('date');
                $table->enum('status', ['present', 'absent', 'late', 'excused']);
                $table->text('remarks')->nullable();
                $table->timestamps();
                
                $table->unique(['student_id', 'class_subject_id', 'date']);
            });

            // Exams/Tests
            Schema::create('exams', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->text('description')->nullable();
                $table->foreignId('subject_id')->constrained()->onDelete('cascade');
                $table->date('date');
                $table->integer('total_marks');
                $table->integer('passing_marks');
                $table->timestamps();
            });

            // Grades
            Schema::create('grades', function (Blueprint $table) {
                $table->id();
                $table->foreignId('student_id')->constrained()->onDelete('cascade');
                $table->foreignId('exam_id')->constrained()->onDelete('cascade');
                $table->decimal('marks_obtained', 5, 2);
                $table->text('comments')->nullable();
                $table->timestamps();
                
                $table->unique(['student_id', 'exam_id']);
            });

            // Grade Scales
            
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        // Departments
        Schema::drop('departments');

        // Classes (Grade Levels)
        Schema::drop('grade_levels');

        // Sections
        Schema::drop('sections');

        // Subjects
        Schema::drop('subjects');

        // Class Subjects (Pivot)
        Schema::drop('class_subject');
        // Attendance
        Schema::drop('attendances');

        // Exams/Tests
        Schema::drop('exams');

        // Grades
        Schema::drop('grades');

        // Grade Scales
        Schema::drop('grade_scales');
    }

};
