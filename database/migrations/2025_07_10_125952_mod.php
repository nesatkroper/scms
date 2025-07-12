<?php

// use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\Schema;

// return new class extends Migration
// {
//     /**
//      * Run the migrations.
//      */
//     public function up(): void
//     {
//         Schema::table('students', function (Blueprint $table) {
//             $table->dropUnique('teachers_student_id_unique');

//             $table->dropColumn('student_id');

//             $table->string('name')->nullable();
//             $table->string('image')->nullable();
//         });
//     }

//   /**
//    * Reverse the migrations.
//    */
//   public function down(): void
//   {
//     Schema::table('students', function (Blueprint $table) {
//       //
//     });
//   }
// };



use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            // 🔁 Drop old column and constraint
            if (Schema::hasColumn('students', 'student_id')) {
                $table->dropUnique(['student_id']);
                $table->dropColumn('student_id');
            }

            // ✅ Add new fields to match Student model
            $table->string('student_code')->unique()->after('user_id'); // NEW
            $table->date('date_of_birth')->nullable()->after('admission_date'); // NEW
            $table->enum('gender', ['male', 'female', 'other'])->nullable(); // NEW
            $table->string('nationality')->nullable(); // NEW
            $table->string('address')->nullable(); // NEW
            $table->string('phone')->nullable(); // NEW
            $table->string('email')->nullable(); // NEW
            $table->enum('status', ['active', 'inactive', 'graduated', 'dropped'])->default('active'); // NEW
            $table->string('photo')->nullable(); // renamed from 'image'

            // ✅ Optional: clean up old columns if any were temporary
            if (Schema::hasColumn('students', 'name')) {
                $table->dropColumn('name');
            }
            if (Schema::hasColumn('students', 'image')) {
                $table->dropColumn('image');
            }
        });
    }

    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn([
                'student_code',
                'date_of_birth',
                'gender',
                'nationality',
                'address',
                'phone',
                'email',
                'status',
                'photo',
            ]);

            // Revert to old columns if needed
            $table->string('student_id')->unique();
        });
    }
};

