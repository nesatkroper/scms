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
Schema::table('teachers', function (Blueprint $table) {
    // Drop the unique constraint using the correct index name
    $table->dropUnique('teachers_teacher_id_unique');
    
    // Then drop the column
    $table->dropColumn('teacher_id');
    
    // Add new columns
    $table->string('name')->nullable();
    $table->string('image')->nullable();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teachers', function (Blueprint $table) {
            //
        });
    }
};
