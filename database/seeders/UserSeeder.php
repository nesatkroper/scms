<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
  public function run(): void
  {
    $faker = Faker::create();
    $departmentIds = DB::table('departments')->pluck('id')->all();
    $hasDepartments = !empty($departmentIds);

    $roles = [
      'admin',
      'teacher',
      'student',
      'guardian',
      'staff',
    ];
    foreach ($roles as $roleName) {
      Role::firstOrCreate(['name' => $roleName]);
    }

    $teachers = [];
    for ($i = 0; $i < 5; $i++) {
      $gender = $faker->randomElement(['male', 'female']);
      $teachers[] = [
        'name' => $faker->name($gender),
        'email' => "teacher{$i}@example.com",
        'email_verified_at' => now(),
        'password' => Hash::make('password'),
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'date_of_birth' => $faker->date(),
        'gender' => $gender,
        'department_id' => $hasDepartments ? $departmentIds[array_rand($departmentIds)] : null,
        'joining_date' => $faker->date(),
        'qualification' => $faker->randomElement(['PhD', 'Master', 'Bachelor']),
        'experience' => $faker->randomElement(['3 years', '5 years', '10 years']),
        'specialization' => $faker->randomElement(['Science', 'Mathematics', 'Literature']),
        'salary' => $faker->randomFloat(2, 40000, 80000),
        'photo' => $faker->imageUrl(),
        'created_at' => now(),
        'updated_at' => now(),
      ];
    }

    DB::table('users')->insert($teachers);

    $students = [];
    for ($i = 0; $i < 100; $i++) {
      $gender = $faker->randomElement(['male', 'female']);
      $students[] = [
        'name' => $faker->name($gender),
        'email' => "student{$i}@example.com",
        'email_verified_at' => now(),
        'password' => Hash::make('password'),
        'gender' => $gender,
        'blood_group' => $faker->randomElement(['A+', 'B+', 'O+', 'AB+']),
        'nationality' => $faker->country,
        'religion' => $faker->randomElement(['Christianity', 'Islam', 'Hinduism', 'Buddhism']),
        'admission_date' => $faker->date(),
        'avatar' => $faker->imageUrl(640, 480, 'people', true, 'avatar'),
        'created_at' => now(),
        'updated_at' => now(),
      ];
    }

    DB::table('users')->insert($students);

    $adminUser = User::firstOrCreate(
      ['email' => "admin@example.com"],
      [
        'name' => "Admin User",
        'password' => Hash::make('password'),
        'email_verified_at' => now(),
      ]
    );
    $adminUser->assignRole('admin');

    $teacherIds = DB::table('users')->where('email', 'like', 'teacher%')->pluck('id')->all();
    $studentIds = DB::table('users')->where('email', 'like', 'student%')->pluck('id')->all();

    $teacherRole = Role::where('name', 'teacher')->first();
    $studentRole = Role::where('name', 'student')->first();

    if ($teacherRole) {
      foreach ($teacherIds as $id) {
        User::find($id)->assignRole($teacherRole);
      }
    }

    if ($studentRole) {
      foreach ($studentIds as $id) {
        User::find($id)->assignRole($studentRole);
      }
    }
  }
}
