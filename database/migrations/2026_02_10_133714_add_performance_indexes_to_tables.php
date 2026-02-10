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
        // Add indexes to users table for student queries
        Schema::table('users', function (Blueprint $table) {
            $table->index('created_at', 'idx_users_created_at');
            $table->index(['email', 'name'], 'idx_users_email_name');
            $table->index('deleted_at', 'idx_users_deleted_at');
        });

        // Add indexes to fees table for count queries
        Schema::table('fees', function (Blueprint $table) {
            $table->index('student_id', 'idx_fees_student_id');
            $table->index(['student_id', 'status'], 'idx_fees_student_status');
        });

        // Add indexes to attendances table for count queries
        Schema::table('attendances', function (Blueprint $table) {
            $table->index('student_id', 'idx_attendances_student_id');
        });

        // Add indexes to enrollments table for count and join queries
        Schema::table('enrollments', function (Blueprint $table) {
            $table->index('student_id', 'idx_enrollments_student_id');
            $table->index('course_offering_id', 'idx_enrollments_course_offering_id');
            $table->index(['student_id', 'course_offering_id'], 'idx_enrollments_student_course');
        });

        // Add indexes to course_offerings table for teacher queries
        Schema::table('course_offerings', function (Blueprint $table) {
            $table->index('teacher_id', 'idx_course_offerings_teacher_id');
            $table->index('created_at', 'idx_course_offerings_created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex('idx_users_created_at');
            $table->dropIndex('idx_users_email_name');
            $table->dropIndex('idx_users_deleted_at');
        });

        Schema::table('fees', function (Blueprint $table) {
            $table->dropIndex('idx_fees_student_id');
            $table->dropIndex('idx_fees_student_status');
        });

        Schema::table('attendances', function (Blueprint $table) {
            $table->dropIndex('idx_attendances_student_id');
        });

        Schema::table('enrollments', function (Blueprint $table) {
            $table->dropIndex('idx_enrollments_student_id');
            $table->dropIndex('idx_enrollments_course_offering_id');
            $table->dropIndex('idx_enrollments_student_course');
        });

        Schema::table('course_offerings', function (Blueprint $table) {
            $table->dropIndex('idx_course_offerings_teacher_id');
            $table->dropIndex('idx_course_offerings_created_at');
        });
    }
};
