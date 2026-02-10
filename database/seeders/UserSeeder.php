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

    // Original permissions you wanted to keep
    Permission::firstOrCreate(['name' => 'view_dashboard']);
    Permission::firstOrCreate(['name' => 'view_report']);

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


    // Scaled up as requested
    $this->command->info('Seeding 10 Teachers...');
    $this->seedTeachers($faker, 10);

    $this->command->info('Seeding 500 Students...');
    $this->seedStudents($faker, 500);
  }

  protected function seedTeachers($faker, int $count): void
  {
    $teacherRole = Role::where('name', 'teacher')->first();
    $password = Hash::make('password'); // Pre-hash for performance

    for ($i = 1; $i <= $count; $i++) {
      $gender = $faker->randomElement(['male', 'female']);
      $user = User::updateOrCreate(
        ['email' => 'teacher' . $i . '@example.com'],
        [
          'name' => $faker->name($gender),
          'password' => $password,
          'email_verified_at' => now(),
          'phone' => $faker->phoneNumber,
          'address' => $faker->address,
          'date_of_birth' => $faker->dateTimeBetween('-40 years', '-25 years')->format('Y-m-d'),
          'gender' => $gender,
          'joining_date' => $faker->dateTimeBetween('-5 years', 'now')->format('Y-m-d'),
          'qualification' => $faker->randomElement(['Master in Education', 'PhD in Science', 'Bachelor in Arts']),
          'experience' => $faker->numberBetween(1, 15) . ' years',
          'specialization' => $faker->randomElement(['Mathematics', 'Physics', 'English Literature', 'History']),
          'salary' => $faker->randomFloat(2, 40000, 120000),
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
    $password = Hash::make('password'); // Pre-hash is crucial for 50k records
    
    $chunkSize = 1000;
    
    // We'll iterate in chunks
    for ($i = 0; $i < $count; $i += $chunkSize) {
        $usersData = [];
        $roleData = [];
        $currentChunkSize = min($chunkSize, $count - $i);
        
        // Predict IDs (unsafe in production, valid for fresh seed)
        // Better approach: Insert users, then query them back or use lastInsertId ?
        // MySQL doesn't return all IDs on batch insert easily.
        // Since we are running clean, let's assume we can fetch them by email range or just trust the loop if we are careful.
        // SAFEST FAST WAY: Generate array, insert, then fetch IDs by email? Slow.
        // ALTERNATIVE: Just loop 'create' but with pre-hashed password. 
        // 50,000 simple inserts is reasonably fast (maybe 1-2 mins) compared to hashing 50k times.
        // Let's try single inserts with pre-hashed password first. It's much simpler and safer for Role assignment.
        
        for ($j = 0; $j < $currentChunkSize; $j++) {
            $index = $i + $j + 1;
            $gender = $faker->randomElement(['male', 'female']);
            
            // Use create directly to skip 'updateOrCreate' overhead checks
            // We assume fresh db
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
            
            // Assign role - this does one insert into model_has_roles
            $user->assignRole($studentRole);
        }
        $this->command->info("Seeded " . ($i + $currentChunkSize) . " students...");
    }
  }
}

