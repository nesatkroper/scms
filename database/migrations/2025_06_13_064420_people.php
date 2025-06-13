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

        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->onDelete('cascade');
            $table->string('student_id')->unique();
            $table->date('admission_date');
            $table->foreignId('section_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        // Teachers
        

        // Parents/Guardians
        

        // Student-Parent Relationship
        Schema::create('student_guardian', function (Blueprint $table) {
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('guardian_id')->constrained()->onDelete('cascade');
            $table->primary(['student_id', 'guardian_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        // Students
        Schema::drop('students');

        // Teachers
        Schema::drop('teachers');

        // Parents/Guardians
        Schema::drop('guardians');

        // Student-Parent Relationship
        Schema::drop('student_guardian');
    }
};
