<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
  public function run(): void
  {
    $faker = Faker::create();

    // 1. Ensure Roles and Permissions are set up
    $roles = ['admin', 'teacher', 'student', 'staff'];
    foreach ($roles as $roleName) {
      Role::firstOrCreate(['name' => $roleName]);
    }

    $adminRole = Role::where('name', 'admin')->first();

    Permission::firstOrCreate(['name' => 'view dashboard']);
    Permission::firstOrCreate(['name' => 'view report']);

    $adminRole->syncPermissions(Permission::all());

    // 2. Create Default Admin User
    $admin = User::updateOrCreate(
      ['email' => 'admin@example.com'],
      [
        'name' => 'Admin User',
        'password' => Hash::make('password'),
        'email_verified_at' => now(),
      ]
    );
    $admin->assignRole('admin');

    // --- New Code for Seeding Teachers and Students ---

    // 3. Seed 5 Teacher Users
    $this->seedTeachers($faker, 5);

    // 4. Seed 100 Student Users
    $this->seedStudents($faker, 100);
  }

  /**
   * Seed a specified number of teacher users.
   *
   * @param \Faker\Generator $faker
   * @param int $count
   * @return void
   */
  protected function seedTeachers($faker, int $count): void
  {
    $teacherRole = Role::where('name', 'teacher')->first();
    for ($i = 1; $i <= $count; $i++) {
      $user = User::updateOrCreate(
        ['email' => 'teacher' . $i . '@example.com'],
        [
          'name' => $faker->name('male'),
          'password' => Hash::make('password'),
          'email_verified_at' => now(),
          'phone' => $faker->phoneNumber,
          'address' => $faker->address,
          'date_of_birth' => $faker->dateTimeBetween('-40 years', '-25 years')->format('Y-m-d'),
          'gender' => $faker->randomElement(['male', 'female']),
          'joining_date' => $faker->dateTimeBetween('-5 years', 'now')->format('Y-m-d'),
          'qualification' => $faker->randomElement(['Master in Education', 'PhD in Science', 'Bachelor in Arts']),
          'experience' => $faker->numberBetween(1, 15) . ' years',
          'specialization' => $faker->randomElement(['Mathematics', 'Physics', 'English Literature', 'History']),
          'salary' => $faker->randomFloat(2, 40000, 120000),
          'blood_group' => $faker->randomElement(['A+', 'B+', 'O+', 'AB-']),
          'nationality' => 'Example Country',
          'religion' => 'Example Faith',
        ]
      );
      $user->assignRole($teacherRole);
    }
  }

  /**
   * Seed a specified number of student users.
   *
   * @param \Faker\Generator $faker
   * @param int $count
   * @return void
   */
  protected function seedStudents($faker, int $count): void
  {
    $studentRole = Role::where('name', 'student')->first();
    for ($i = 1; $i <= $count; $i++) {
      $user = User::updateOrCreate(
        ['email' => 'student' . $i . '@example.com'],
        [
          'name' => $faker->name('male'),
          'password' => Hash::make('password'),
          'email_verified_at' => now(),
          'phone' => $faker->phoneNumber,
          'address' => $faker->address,
          'date_of_birth' => $faker->dateTimeBetween('-20 years', '-15 years')->format('Y-m-d'),
          'gender' => $faker->randomElement(['male', 'female']),
          'admission_date' => $faker->dateTimeBetween('-2 years', 'now')->format('Y-m-d'),
          'occupation' => 'Student',
          'blood_group' => $faker->randomElement(['A+', 'B+', 'O+', 'AB-']),
          'nationality' => 'Example Country',
          'religion' => 'Example Faith',
        ]
      );
      $user->assignRole($studentRole);
    }
  }
}

// namespace Database\Seeders;

// use App\Models\User;
// use Illuminate\Database\Seeder;
// use Illuminate\Support\Facades\Hash;
// use Faker\Factory as Faker;
// use Spatie\Permission\Models\Permission;
// use Spatie\Permission\Models\Role;

// class UserSeeder extends Seeder
// {
//   public function run(): void
//   {
//     $roles = ['admin', 'teacher', 'student', 'staff'];
//     foreach ($roles as $roleName) {
//       Role::firstOrCreate(['name' => $roleName]);
//     }

//     $adminRole = Role::where('name', 'admin')->first();

//     Permission::create(['name' => 'view dashboard']);
//     Permission::create(['name' => 'view report']);

//     $adminRole->syncPermissions(Permission::all());

//     $admin = User::updateOrCreate(
//       ['email' => 'admin@example.com'],
//       [
//         'name' => 'Admin User',
//         'password' => Hash::make('password'),
//         'email_verified_at' => now(),
//       ]
//     );
//     $admin->assignRole('admin');
//   }
// }