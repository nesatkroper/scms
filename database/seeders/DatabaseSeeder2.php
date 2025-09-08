<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Faker\Factory as Faker;

class DatabaseSeeder2 extends Seeder
{
  public function run(): void
  {
    $classrooms = [];
    $letters = ['A', 'B', 'C'];
    foreach ($letters as $letter) {
      for ($i = 1; $i <= 5; $i++) {
        $roomNumber = "{$letter}-10{$i}";

        $classrooms[] = [
          'name' => "Classroom {$letter}",
          'room_number' => $roomNumber,
          'capacity' => 30,
          'created_at' => now(),
          'updated_at' => now(),
        ];
      }
    }

    $departments = [
      [
        'name' => 'Administration',
        'description' => 'Oversees the daily operations and management of the school.',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Human Resources',
        'description' => 'Manages all personnel-related functions, including hiring and staff support.',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Finance',
        'description' => 'Responsible for the school\'s budget, financial planning, and accounting.',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Maintenance',
        'description' => 'Handles the upkeep and repair of all school facilities and grounds.',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Student Services',
        'description' => 'Provides support for student well-being, including counseling and extracurricular activities.',
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ];

    $subjects = [
      [
        'name' => 'Introduction to Programming',
        'code' => 'CS101',
        'description' => 'A foundational course on the principles of computer programming.',
        'credit_hours' => 3,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Data Structures',
        'code' => 'CS202',
        'description' => 'An in-depth study of data organization and management.',
        'credit_hours' => 4,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'British Literature',
        'code' => 'ENGL250',
        'description' => 'A survey of key literary works from Great Britain.',
        'credit_hours' => 3,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Creative Writing',
        'code' => 'ENGL301',
        'description' => 'Focuses on developing skills in various forms of creative writing.',
        'credit_hours' => 3,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Calculus I',
        'code' => 'MATH150',
        'description' => 'The first course in differential and integral calculus.',
        'credit_hours' => 4,
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ];

    $gradeLevels = [
      [
        'name' => 'Year 1',
        'code' => 'Y1',
        'description' => 'First year of formal education.',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Year 2',
        'code' => 'Y2',
        'description' => 'Second year of formal education.',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Year 3',
        'code' => 'Y3',
        'description' => 'Third year of formal education.',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Year 4',
        'code' => 'Y4',
        'description' => 'Fourth year of formal education.',
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ];

    $subjectIds = DB::table('subjects')->pluck('id')->all();
    $userIds = DB::table('users')->pluck('id')->all();
    $classroomIds = DB::table('classrooms')->pluck('id')->all();
    if (empty($subjectIds) || empty($userIds) || empty($classroomIds)) {
      $this->command->warn('Skipping course_offerings seeding. Please seed subjects, users, and classrooms first.');
      return;
    }
    $courseOfferings = [];
    $semesters = ['Fall', 'Spring', 'Summer'];
    $academicYear = now()->year;
    for ($i = 0; $i < 20; $i++) {
      $courseOfferings[] = [
        'subject_id' => $subjectIds[array_rand($subjectIds)],
        'user_id' => $userIds[array_rand($userIds)],
        'classroom_id' => $classroomIds[array_rand($classroomIds)],
        'semester' => $semesters[array_rand($semesters)],
        'academic_year' => $academicYear,
        'created_at' => now(),
        'updated_at' => now(),
      ];
    }

    $faker = Faker::create();
    $departmentIds = DB::table('departments')->pluck('id')->all();
    $hasDepartments = !empty($departmentIds);
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
        'cv' => null,
        'blood_group' => null,
        'nationality' => null,
        'religion' => null,
        'admission_date' => null,
        'occupation' => null,
        'company' => null,
        'avatar' => null,
        'remember_token' => null,
        'created_at' => now(),
        'updated_at' => now(),
      ];
    }
    $students = [];
    for ($i = 0; $i < 100; $i++) {
      $gender = $faker->randomElement(['male', 'female']);
      $students[] = [
        'name' => $faker->name($gender),
        'email' => "student{$i}@example.com",
        'email_verified_at' => now(),
        'password' => Hash::make('password'),
        'phone' => null,
        'address' => null,
        'date_of_birth' => null,
        'gender' => $gender,
        'department_id' => null,
        'joining_date' => null,
        'qualification' => null,
        'experience' => null,
        'specialization' => null,
        'salary' => null,
        'photo' => null,
        'cv' => null,
        'blood_group' => $faker->randomElement(['A+', 'B+', 'O+', 'AB+']),
        'nationality' => $faker->country,
        'religion' => $faker->randomElement(['Christianity', 'Islam', 'Hinduism', 'Buddhism']),
        'admission_date' => $faker->date(),
        'occupation' => null,
        'company' => null,
        'avatar' => $faker->imageUrl(640, 480, 'people', true, 'avatar'),
        'remember_token' => null,
        'created_at' => now(),
        'updated_at' => now(),
      ];
    }

    $studentIds = DB::table('users')->pluck('id')->all();
    $courseOfferingIds = DB::table('course_offerings')->pluck('id')->all();
    if (empty($studentIds) || empty($courseOfferingIds)) {
      $this->command->warn('Skipping student_course seeding. Please seed students and course_offerings tables first.');
      return;
    }
    $enrollments = [];
    $maxAttempts = 500;
    for ($i = 0; $i < $maxAttempts && count($enrollments) < 100; $i++) {
      $studentId = $studentIds[array_rand($studentIds)];
      $courseOfferingId = $courseOfferingIds[array_rand($courseOfferingIds)];
      $uniqueKey = "{$studentId}-{$courseOfferingId}";
      if (!array_key_exists($uniqueKey, $enrollments)) {
        $enrollments[$uniqueKey] = [
          'student_id' => $studentId,
          'course_offering_id' => $courseOfferingId,
          'grade_final' => round(rand(6000, 10000) / 100, 2),
          'created_at' => now(),
          'updated_at' => now(),
        ];
      }
    }

    $categories = [
      [
        'name' => 'Salaries',
        'description' => 'Employee salaries and wages.',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Rent',
        'description' => 'Rental expenses for buildings and facilities.',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Utilities',
        'description' => 'Expenses for electricity, water, gas, and internet.',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Supplies',
        'description' => 'Costs for office, classroom, and maintenance supplies.',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Maintenance',
        'description' => 'Expenses related to the upkeep and repair of school property.',
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ];

    DB::table('grade_levels')->insert($gradeLevels);
    DB::table('classrooms')->insert($classrooms);
    DB::table('departments')->insert($departments);
    DB::table('subjects')->insert($subjects);
    DB::table('users')->insert(array_merge($teachers, $students));
    DB::table('course_offerings')->insert($courseOfferings);
    DB::table('student_course')->insert(array_values($enrollments));
    DB::table('expense_categories')->insert($categories);

    $roles = [
      'admin',
      'teacher',
      'student',
      'guardian',
      'staff',
      ''
    ];
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
