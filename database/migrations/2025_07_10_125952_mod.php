<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropUnique(['student_id']);
            $table->dropColumn('student_id');
            $table->string('name')->nullable()->after('user_id');
            $table->string('image')->nullable()->after('name');
        });
    }
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->string('student_id')->unique()->after('user_id');
            $table->dropColumn(['name', 'image']);
        });
    }
};
