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

    $roles = ['admin', 'teacher', 'student', 'staff'];

    foreach ($roles as $roleName) {
      Role::firstOrCreate(['name' => $roleName]);
    }

    $adminRole = Role::where('name', 'admin')->first();
    $staffRole = Role::where('name', 'staff')->first();

    $modules = [
      'attendance',
      'student',
      'teacher',
      'classroom',
      'course-offering',
      'enrollment',
      'score',
      'subject',
      'fee',
      'expense',
      'expense-category',
      'fee-type',
    ];

    $actions = ['view', 'create', 'update'];

    $permissions = collect();

    foreach ($modules as $module) {
      foreach ($actions as $action) {
        $permissions->push(
          Permission::firstOrCreate([
            'name' => "{$action}_{$module}"
          ])
        );
      }
    }

    $permissions->push(
      Permission::firstOrCreate(['name' => 'view_dashboard']),
      Permission::firstOrCreate(['name' => 'view_report'])
    );

    $staffRole->syncPermissions($permissions);
    $adminRole->syncPermissions(Permission::all());

    $admin = User::updateOrCreate(
      ['email' => 'admin@example.com'],
      [
        'name' => 'Admin User',
        'password' => Hash::make('password'),
        'email_verified_at' => now(),
      ]
    );

    $admin->assignRole('admin');

    $this->command->info('Seeding 5 Teachers...');
    $this->seedTeachers($faker, 5);

    $this->command->info('Seeding 50 Students...');
    $this->seedStudents($faker, 50);
  }

  protected function seedTeachers($faker, int $count): void
  {
    $teacherRole = Role::where('name', 'teacher')->first();
    $password = Hash::make('password');

    $modules = [
      'attendance',
      'student',
      'classroom',
      'course-offering',
      'enrollment',
      'exam',
      'score',
      'subject',
    ];

    $actions = ['view', 'create', 'update'];

    $permissions = collect();

    foreach ($modules as $module) {
      foreach ($actions as $action) {
        $permissions->push(
          Permission::firstOrCreate([
            'name' => "{$action}_{$module}"
          ])
        );
      }
    }

    $teacherRole->syncPermissions($permissions);

    for ($i = 1; $i <= $count; $i++) {
      $gender = $faker->randomElement(['male', 'female']);

      $user = User::updateOrCreate(
        ['email' => "teacher{$i}@example.com"],
        [
          'name' => $faker->name($gender),
          'password' => $password,
          'email_verified_at' => now(),
          'phone' => $faker->phoneNumber,
          'address' => $faker->address,
          'date_of_birth' => $faker->dateTimeBetween('-40 years', '-30 years')->format('Y-m-d'),
          'gender' => $gender,
          'joining_date' => $faker->dateTimeBetween('-5 years', 'now')->format('Y-m-d'),
          'qualification' => $faker->randomElement([
            'Master in Education',
            'PhD in Science',
            'Bachelor in Arts'
          ]),
          'experience' => $faker->numberBetween(1, 5) . ' years',
          'specialization' => $faker->randomElement([
            'Mathematics',
            'Physics',
            'English Literature',
            'History'
          ]),
          'salary' => $faker->randomFloat(2, 200, 500),
          'nationality' => 'Cambodian',
          'religion' => 'Buddhism',
        ]
      );

      $user->assignRole($teacherRole);
    }
  }

  protected function seedStudents($faker, int $count): void
  {
    $studentRole = Role::where('name', 'student')->first();
    $password = Hash::make('password');
    $chunkSize = 1000;

    for ($i = 0; $i < $count; $i += $chunkSize) {
      $currentChunkSize = min($chunkSize, $count - $i);

      for ($j = 0; $j < $currentChunkSize; $j++) {
        $index = $i + $j + 1;
        $gender = $faker->randomElement(['male', 'female']);

        $user = User::create([
          'email' => 'student' . $index . '@example.com',
          'name' => $faker->name($gender),
          'password' => $password,
          'email_verified_at' => now(),
          'phone' => $faker->phoneNumber,
          'address' => $faker->address,
          'date_of_birth' => $faker->dateTimeBetween('-20 years', '-15 years')->format('Y-m-d'),
          'gender' => $gender,
          'admission_date' => $faker->dateTimeBetween('-2 years', 'now')->format('Y-m-d'),
          'occupation' => 'Student',
          'nationality' => 'Cambodian',
          'religion' => 'Buddhism',
        ]);

        $user->assignRole($studentRole);
      }
      $this->command->info("Seeded " . ($i + $currentChunkSize) . " students...");
    }
  }
}
