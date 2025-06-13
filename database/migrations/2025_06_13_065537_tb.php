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

        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        Schema::create('guardians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->onDelete('cascade');
            $table->string('occupation')->nullable();
            $table->string('company')->nullable();
            $table->string('relation'); // e.g., Father, Mother, Guardian
            $table->timestamps();
        });

        Schema::create('grade_levels', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., Grade 1, Class 8
            $table->string('code')->unique(); // e.g., G1, C8
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('grade_scales', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., A, B, C
            $table->decimal('min_percentage', 5, 2);
            $table->decimal('max_percentage', 5, 2);
            $table->decimal('gpa', 3, 2);
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->onDelete('cascade');
            $table->string('teacher_id')->unique();
            $table->foreignId('department_id')->nullable()->constrained();
            $table->date('joining_date');
            $table->string('qualification');
            $table->text('specialization')->nullable();
            $table->decimal('salary', 10, 2)->nullable();
            $table->timestamps();
        });

        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->decimal('amount', 10, 2);
            $table->date('date');
            $table->string('category'); // e.g., salaries, utilities, supplies
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->timestamps();
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
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::drop('settings');
        Schema::drop('fee_structures');
        Schema::drop('student_fees');
        Schema::drop('payments');
        Schema::drop('expenses');
    }
};
