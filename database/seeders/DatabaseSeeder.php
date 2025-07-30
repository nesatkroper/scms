<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
  public function run(): void
  {
    DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    DB::table('payments')->truncate();
    DB::table('student_fees')->truncate();
    DB::table('grades')->truncate();
    DB::table('exams')->truncate();
    DB::table('attendances')->truncate();
    DB::table('student_course')->truncate();
    DB::table('course_offerings')->truncate();
    DB::table('book_issues')->truncate();
    DB::table('notices')->truncate();
    DB::table('expenses')->truncate();
    DB::table('expense_categories')->truncate();
    DB::table('fee_structures')->truncate();
    DB::table('student_guardian')->truncate();
    DB::table('students')->truncate();
    DB::table('guardians')->truncate();
    DB::table('subjects')->truncate();
    DB::table('teachers')->truncate();
    DB::table('departments')->truncate();
    DB::table('grade_levels')->truncate();
    DB::table('events')->truncate();
    DB::table('books')->truncate();
    DB::table('book_categories')->truncate();
    DB::table('classrooms')->truncate();
    DB::table('users')->truncate();

    DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    $roles = ['admin', 'teacher', 'student'];
    foreach ($roles as $roleName) {
      Role::firstOrCreate(['name' => $roleName]);
    }

    $adminUser = User::firstOrCreate(
      ['email' => "admin@example.com"],
      [
        'name' => "Admin User",
        'password' => Hash::make('password'),
        'email_verified_at' => now(),
      ]
    );

    $adminUser->assignRole('admin');
  }
}