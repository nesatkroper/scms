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
        // Timetable
        Schema::create('timetables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(false);
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();
        });

        // Timetable Entries
        Schema::create('timetable_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('timetable_id')->constrained()->onDelete('cascade');
            $table->foreignId('class_subject_id')->constrained()->onDelete('cascade');
            $table->time('start_time');
            $table->time('end_time');
            $table->enum('day', ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday']);
            $table->string('room')->nullable();
            $table->timestamps();
        });

        // Notices/Announcements
        Schema::create('notices', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->enum('audience', ['all', 'teachers', 'students', 'parents', 'staff']);
            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('is_published')->default(false);
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
        });

        // Events
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
        });

        // Classrooms
        Schema::create('classrooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('room_number')->unique();
            $table->integer('capacity');
            $table->text('facilities')->nullable(); // JSON array of facilities
            $table->timestamps();
        });

        // Library Books
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author');
            $table->string('isbn')->unique();
            $table->year('publication_year');
            $table->string('publisher');
            $table->integer('quantity');
            $table->text('description')->nullable();
            $table->string('category');
            $table->string('cover_image')->nullable();
            $table->timestamps();
        });

        // Book Circulation
        Schema::create('book_issues', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('issue_date');
            $table->date('due_date');
            $table->date('return_date')->nullable();
            $table->decimal('fine', 8, 2)->default(0);
            $table->enum('status', ['issued', 'returned', 'overdue'])->default('issued');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        // Timetable
        Schema::drop('timetables');

        // Timetable Entries
        Schema::drop('timetable_entries');
            }
};
