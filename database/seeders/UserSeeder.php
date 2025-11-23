<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
  public function run(): void
  {
    $faker = Faker::create();

    // Create roles
    $roles = ['admin', 'teacher', 'student', 'guardian', 'staff'];
    foreach ($roles as $roleName) {
      Role::firstOrCreate(['name' => $roleName]);
    }

    // Admin
    $admin = User::updateOrCreate(
      ['email' => 'admin@example.com'],
      [
        'name' => 'Admin User',
        'password' => Hash::make('password'),
        'email_verified_at' => now(),
      ]
    );
    $admin->assignRole('admin');

    // Teachers
    for ($i = 0; $i < 5; $i++) {
      $gender = $faker->randomElement(['male', 'female']);

      $teacher = User::updateOrCreate(
        ['email' => "teacher{$i}@example.com"],
        [
          'name' => $faker->name($gender),
          'password' => Hash::make('password'),
          'email_verified_at' => now(),
          'gender' => $gender,
          'joining_date' => $faker->date(),
          'qualification' => $faker->randomElement(['PhD', 'Master', 'Bachelor']),
          'experience' => $faker->randomElement(['3 years', '5 years', '10 years']),
          'specialization' => $faker->randomElement(['Science', 'Math', 'Literature']),
          'salary' => $faker->randomFloat(2, 40000, 80000),
        ]
      );

      $teacher->assignRole('teacher');
    }

    // Students
    for ($i = 0; $i < 50; $i++) {
      $gender = $faker->randomElement(['male', 'female']);

      $student = User::updateOrCreate(
        ['email' => "student{$i}@example.com"],
        [
          'name' => $faker->name($gender),
          'password' => Hash::make('password'),
          'email_verified_at' => now(),
          'gender' => $gender,
          'blood_group' => $faker->randomElement(['A+', 'B+', 'O+', 'AB+']),
          'nationality' => $faker->country,
          'religion' => $faker->randomElement(['Christianity', 'Islam', 'Hinduism']),
          'admission_date' => $faker->date(),
        ]
      );

      $student->assignRole('student');
    }
  }
}
