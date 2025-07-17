<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
    DB::table('timetable_slots')->truncate();
    DB::table('timetables')->truncate();
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
    DB::table('sections')->truncate();
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

    $users = [];
    for ($i = 1; $i <= 10; $i++) {
      $users[] = User::firstOrCreate(
        ['email' => "user{$i}@example.com"],
        [
          'name' => "User {$i}",
          'password' => bcrypt('password'),
        ]
      );
    }
    $adminUser = $users[0];
    $staffUser = $users[1];

    DB::table('classrooms')->insert([
      ['name' => 'Room 101', 'room_number' => 'R-101', 'capacity' => 30, 'facilities' => 'Projector, Whiteboard', 'created_at' => now(), 'updated_at' => now()],
      ['name' => 'Room 102', 'room_number' => 'R-102', 'capacity' => 25, 'facilities' => 'Smartboard', 'created_at' => now(), 'updated_at' => now()],
      ['name' => 'Lab A', 'room_number' => 'L-A', 'capacity' => 20, 'facilities' => 'Science equipment', 'created_at' => now(), 'updated_at' => now()],
      ['name' => 'Lab B', 'room_number' => 'L-B', 'capacity' => 22, 'facilities' => 'Computer workstations', 'created_at' => now(), 'updated_at' => now()],
      ['name' => 'Auditorium', 'room_number' => 'AUD-01', 'capacity' => 150, 'facilities' => 'Stage, Sound system', 'created_at' => now(), 'updated_at' => now()],
      ['name' => 'Art Room', 'room_number' => 'AR-01', 'capacity' => 18, 'facilities' => 'Easels, Sinks', 'created_at' => now(), 'updated_at' => now()],
      ['name' => 'Music Room', 'room_number' => 'MR-01', 'capacity' => 15, 'facilities' => 'Pianos, Instruments', 'created_at' => now(), 'updated_at' => now()],
      ['name' => 'Library Room', 'room_number' => 'LIB-01', 'capacity' => 50, 'facilities' => 'Books, Computers', 'created_at' => now(), 'updated_at' => now()],
      ['name' => 'Gymnasium', 'room_number' => 'GYM-01', 'capacity' => 100, 'facilities' => 'Sports equipment', 'created_at' => now(), 'updated_at' => now()],
      ['name' => 'Counseling Office', 'room_number' => 'CO-01', 'capacity' => 5, 'facilities' => 'Private office', 'created_at' => now(), 'updated_at' => now()],
    ]);

    $bookCategories = [];
    for ($i = 1; $i <= 10; $i++) {
      $bookCategories[] = DB::table('book_categories')->insertGetId([
        'name' => "Category {$i}",
        'description' => "Description for category {$i}",
        'created_at' => now(),
        'updated_at' => now(),
      ]);
    }

    $books = [];
    for ($i = 1; $i <= 10; $i++) {
      $books[] = DB::table('books')->insertGetId([
        'title' => "Book Title {$i}",
        'category_id' => $bookCategories[($i - 1) % count($bookCategories)],
        'author' => "Author {$i}",
        'isbn' => "ISBN-{$i}-" . str_pad($i, 4, '0', STR_PAD_LEFT),
        'publication_year' => 2000 + $i,
        'publisher' => "Publisher {$i}",
        'quantity' => 10 + $i,
        'description' => "Description of Book Title {$i}.",
        'cover_image' => null,
        'created_at' => now(),
        'updated_at' => now(),
      ]);
    }

    DB::table('events')->insert([
      ['title' => 'First Day of School', 'description' => 'Orientation for new students.', 'date' => '2025-09-01', 'start_time' => '08:00:00', 'end_time' => '12:00:00', 'location' => 'Auditorium', 'type' => 'academic', 'is_holiday' => false, 'created_at' => now(), 'updated_at' => now()],
      ['title' => 'School Holiday', 'description' => 'Public holiday, school closed.', 'date' => '2025-09-02', 'start_time' => '00:00:00', 'end_time' => '23:59:59', 'location' => null, 'type' => 'holiday', 'is_holiday' => true, 'created_at' => now(), 'updated_at' => now()],
      ['title' => 'Science Fair', 'description' => 'Student science projects exhibition.', 'date' => '2025-10-15', 'start_time' => '09:00:00', 'end_time' => '16:00:00', 'location' => 'Gymnasium', 'type' => 'academic', 'is_holiday' => false, 'created_at' => now(), 'updated_at' => now()],
      ['title' => 'Cultural Day', 'description' => 'Celebration of various cultures.', 'date' => '2025-11-05', 'start_time' => '10:00:00', 'end_time' => '17:00:00', 'location' => 'School Ground', 'type' => 'cultural', 'is_holiday' => false, 'created_at' => now(), 'updated_at' => now()],
      ['title' => 'Sports Tournament', 'description' => 'Inter-school sports competition.', 'date' => '2025-11-20', 'start_time' => '08:30:00', 'end_time' => '17:30:00', 'location' => 'Gymnasium', 'type' => 'sports', 'is_holiday' => false, 'created_at' => now(), 'updated_at' => now()],
      ['title' => 'Winter Concert', 'description' => 'Annual holiday music performance.', 'date' => '2025-12-10', 'start_time' => '18:00:00', 'end_time' => '20:00:00', 'location' => 'Auditorium', 'type' => 'cultural', 'is_holiday' => false, 'created_at' => now(), 'updated_at' => now()],
      ['title' => 'Christmas Break', 'description' => 'School closed for holidays.', 'date' => '2025-12-24', 'start_time' => '00:00:00', 'end_time' => '23:59:59', 'location' => null, 'type' => 'holiday', 'is_holiday' => true, 'created_at' => now(), 'updated_at' => now()],
      ['title' => 'New Year Holiday', 'description' => 'School closed for New Year.', 'date' => '2026-01-01', 'start_time' => '00:00:00', 'end_time' => '23:59:59', 'location' => null, 'type' => 'holiday', 'is_holiday' => true, 'created_at' => now(), 'updated_at' => now()],
      ['title' => 'Exams Week', 'description' => 'Midterm examinations for all grades.', 'date' => '2026-02-10', 'start_time' => '08:00:00', 'end_time' => '17:00:00', 'location' => 'Various Classrooms', 'type' => 'academic', 'is_holiday' => false, 'created_at' => now(), 'updated_at' => now()],
      ['title' => 'Spring Festival', 'description' => 'School festival with games and food.', 'date' => '2026-03-20', 'start_time' => '09:00:00', 'end_time' => '18:00:00', 'location' => 'School Ground', 'type' => 'other', 'is_holiday' => false, 'created_at' => now(), 'updated_at' => now()],
    ]);

    $gradeLevels = [];
    for ($i = 1; $i <= 10; $i++) {
      $gradeLevels[] = DB::table('grade_levels')->insertGetId([
        'name' => "Grade {$i}",
        'code' => "G{$i}",
        'description' => "Year {$i} of education",
        'created_at' => now(),
        'updated_at' => now(),
      ]);
    }

    $departments = [];
    for ($i = 1; $i <= 5; $i++) {
      $departments[] = DB::table('departments')->insertGetId([
        'name' => "Department {$i}",
        'description' => "Focuses on area {$i}",
        'created_at' => now(),
        'updated_at' => now(),
      ]);
    }

    $teachers = [];
    for ($i = 0; $i < 10; $i++) {
      $teachers[] = DB::table('teachers')->insertGetId([
        'user_id' => $users[rand(0, count($users) - 1)]->id,
        'teacher_id' => 'TCH' . str_pad($i + 1, 3, '0', STR_PAD_LEFT),
        'department_id' => $departments[$i % count($departments)],
        'joining_date' => now()->subYears(rand(1, 5)),
        'qualification' => 'M.A. in Education',
        'experience' => (rand(1, 10)) . ' Years',
        'phone' => '0123456' . str_pad($i, 2, '0', STR_PAD_LEFT),
        'email' => "teacher{$i}@example.com",
        'address' => "Teacher Address {$i}",
        'specialization' => "Specialization {$i}",
        'salary' => 45000.0 + ($i * 1000),
        'photo' => null,
        'cv' => null,
        'created_at' => now(),
        'updated_at' => now(),
      ]);
    }

    $sections = [];
    for ($i = 0; $i < 10; $i++) {
      $sections[] = DB::table('sections')->insertGetId([
        'name' => 'Section ' . chr(65 + $i),
        'grade_level_id' => $gradeLevels[$i % count($gradeLevels)],
        'teacher_id' => $teachers[$i % count($teachers)],
        'created_at' => now(),
        'updated_at' => now(),
      ]);
    }

    $subjects = [];
    for ($i = 1; $i <= 10; $i++) {
      $subjects[] = DB::table('subjects')->insertGetId([
        'name' => "Subject {$i}",
        'code' => 'SUB' . str_pad($i, 3, '0', STR_PAD_LEFT),
        'department_id' => $departments[($i - 1) % count($departments)],
        'description' => "Description for Subject {$i}",
        'credit_hours' => rand(2, 4),
        'created_at' => now(),
        'updated_at' => now(),
      ]);
    }

    $courseOfferings = [];
    $classrooms = DB::table('classrooms')->pluck('id');
    for ($i = 0; $i < 10; $i++) {
      $courseOfferings[] = DB::table('course_offerings')->insertGetId([
        'subject_id' => $subjects[$i % count($subjects)],
        'teacher_id' => $teachers[$i % count($teachers)],
        'classroom_id' => $classrooms[$i % count($classrooms)],
        'section_id' => $sections[$i % count($sections)],
        'semester' => ($i % 2 == 0) ? 'Fall' : 'Spring',
        'academic_year' => 2025,
        'created_at' => now(),
        'updated_at' => now(),
      ]);
    }

    $timetableSlots = [];
    for ($i = 0; $i < 10; $i++) {
      $timetableSlots[] = DB::table('timetable_slots')->insertGetId([
        'course_offering_id' => $courseOfferings[$i % count($courseOfferings)],
        'start_time' => sprintf('%02d:00:00', 8 + ($i % 8)),
        'end_time' => sprintf('%02d:00:00', 9 + ($i % 8)),
        'day' => ['monday', 'tuesday', 'wednesday', 'thursday', 'friday'][rand(0, 4)],
        'room_override' => null,
        'created_at' => now(),
        'updated_at' => now(),
      ]);
    }

    $guardians = [];
    for ($i = 0; $i < 10; $i++) {
      $guardians[] = DB::table('guardians')->insertGetId([
        'name' => "Guardian {$i}",
        'phone' => '0987654' . str_pad($i, 2, '0', STR_PAD_LEFT),
        'email' => "guardian{$i}@example.com",
        'address' => "Guardian Address {$i}",
        'occupation' => "Occupation {$i}",
        'company' => "Company {$i}",
        'relation' => ($i % 2 == 0) ? 'Father' : 'Mother',
        'photo' => null,
        'created_at' => now(),
        'updated_at' => now(),
      ]);
    }

    $students = [];
    for ($i = 0; $i < 10; $i++) {
      $students[] = DB::table('students')->insertGetId([
        'name' => "Student Name {$i}",
        'phone' => '0112233' . str_pad($i, 2, '0', STR_PAD_LEFT),
        'email' => "student{$i}@example.com",
        'address' => "Student Address {$i}",
        'photo' => null,
        'dob' => now()->subYears(10 + $i),
        'gender' => ($i % 2 == 0) ? 'Male' : 'Female',
        'grade_level_id' => $gradeLevels[$i % count($gradeLevels)],
        'user_id' => $users[rand(0, count($users) - 1)]->id,
        'blood_group' => ['A+', 'B+', 'O+', 'AB+'][rand(0, 3)],
        'nationality' => 'Cambodian',
        'religion' => 'Buddhism',
        'admission_date' => now()->subYears(rand(1, 5)),
        'created_at' => now(),
        'updated_at' => now(),
      ]);
    }

    for ($i = 0; $i < 10; $i++) {
      DB::table('student_guardian')->insert([
        'student_id' => $students[$i % count($students)],
        'guardian_id' => $guardians[$i % count($guardians)],
        'relation_to_student' => ($i % 2 == 0) ? 'Primary Contact' : 'Emergency Contact',
        'created_at' => now(),
        'updated_at' => now(),
      ]);
    }

    for ($i = 0; $i < 10; $i++) {
      DB::table('student_course')->insert([
        'student_id' => $students[$i % count($students)],
        'course_offering_id' => $courseOfferings[$i % count($courseOfferings)],
        'grade_final' => rand(5000, 9900) / 100,
        'created_at' => now(),
        'updated_at' => now(),
      ]);
    }

    for ($i = 0; $i < 10; $i++) {
      $borrowerStudentId = ($i % 2 == 0) ? $students[$i % count($students)] : null;
      $borrowerTeacherId = ($i % 2 != 0) ? $teachers[$i % count($teachers)] : null;

      DB::table('book_issues')->insert([
        'book_id' => $books[$i % count($books)],
        'student_id' => $borrowerStudentId,
        'teacher_id' => $borrowerTeacherId,
        'issue_date' => now()->subDays(rand(1, 30)),
        'due_date' => now()->addDays(rand(1, 15)),
        'return_date' => (rand(0, 1) == 1) ? now()->subDays(rand(1, 10)) : null,
        'fine' => (rand(0, 1) == 1) ? rand(0, 10) * 0.5 : 0.0,
        'status' => (rand(0, 1) == 1) ? 'returned' : 'issued',
        'created_at' => now(),
        'updated_at' => now(),
      ]);
    }

    for ($i = 0; $i < 10; $i++) {
      DB::table('notices')->insert([
        'title' => "Notice Title {$i}",
        'content' => "This is the content for notice number {$i}, informing everyone about something important.",
        'audience' => ['all', 'teachers', 'students', 'parents', 'staff'][rand(0, 4)],
        'start_date' => now()->subDays(rand(1, 10)),
        'end_date' => now()->addDays(rand(5, 15)),
        'is_published' => (rand(0, 1) == 1),
        'created_by' => $adminUser->id,
        'created_at' => now(),
        'updated_at' => now(),
      ]);
    }

    $expenseCategories = [];
    for ($i = 1; $i <= 5; $i++) {
      $expenseCategories[] = DB::table('expense_categories')->insertGetId([
        'name' => "Expense Category {$i}",
        'description' => "Description for expense category {$i}",
        'created_at' => now(),
        'updated_at' => now(),
      ]);
    }

    for ($i = 0; $i < 10; $i++) {
      DB::table('expenses')->insert([
        'title' => "Expense Item {$i}",
        'description' => "Details for expense item {$i}",
        'amount' => rand(100, 1000) + rand(0, 99) / 100,
        'date' => now()->subDays(rand(1, 30)),
        'expense_category_id' => $expenseCategories[$i % count($expenseCategories)],
        'approved_by' => $adminUser->id,
        'created_at' => now(),
        'updated_at' => now(),
      ]);
    }

    $feeStructures = [];
    for ($i = 0; $i < 10; $i++) {
      $feeStructures[] = DB::table('fee_structures')->insertGetId([
        'name' => "Fee Structure {$i}",
        'grade_level_id' => $gradeLevels[$i % count($gradeLevels)],
        'amount' => rand(200, 1000) * 1.0,
        'frequency' => ['monthly', 'quarterly', 'semester', 'annual'][rand(0, 2)],
        'effective_from' => now()->subYears(1),
        'effective_to' => null,
        'description' => 'Standard fee for grade ' . ($i + 1),
        'created_at' => now(),
        'updated_at' => now(),
      ]);
    }

    $timetables = [];
    for ($i = 0; $i < 10; $i++) {
      $timetables[] = DB::table('timetables')->insertGetId([
        'section_id' => $sections[$i % count($sections)],
        'title' => 'Timetable for Section ' . chr(65 + $i),
        'description' => 'Academic year 2025-2026 timetable.',
        'is_active' => true,
        'start_date' => '2025-09-01',
        'end_date' => '2026-06-30',
        'created_at' => now(),
        'updated_at' => now(),
      ]);
    }

    for ($i = 0; $i < 10; $i++) {
      DB::table('attendances')->insert([
        'student_id' => $students[$i % count($students)],
        'course_offering_id' => $courseOfferings[$i % count($courseOfferings)],
        'date' => now()->subDays(rand(0, 60)),
        'status' => ['present', 'absent', 'late', 'excused'][rand(0, 3)],
        'remarks' => null,
        'created_at' => now(),
        'updated_at' => now(),
      ]);
    }

    $exams = [];
    for ($i = 0; $i < 10; $i++) {
      $exams[] = DB::table('exams')->insertGetId([
        'name' => "Exam {$i}",
        'description' => "Exam for Subject {$i}",
        'subject_id' => $subjects[$i % count($subjects)],
        'date' => now()->addDays(rand(1, 60)),
        'total_marks' => 100,
        'passing_marks' => 50,
        'created_at' => now(),
        'updated_at' => now(),
      ]);
    }

    for ($i = 0; $i < 10; $i++) {
      DB::table('grades')->insert([
        'student_id' => $students[$i % count($students)],
        'exam_id' => $exams[$i % count($exams)],
        'marks_obtained' => rand(4000, 9500) / 100,
        'comments' => null,
        'created_at' => now(),
        'updated_at' => now(),
      ]);
    }

    $studentFees = [];
    for ($i = 0; $i < 10; $i++) {
      $studentFees[] = DB::table('student_fees')->insertGetId([
        'student_id' => $students[$i % count($students)],
        'fee_structure_id' => $feeStructures[$i % count($feeStructures)],
        'amount' => rand(100, 500) * 1.0,
        'discount' => (rand(0, 1) == 1) ? rand(0, 20) * 1.0 : 0.0,
        'paid_amount' => (rand(0, 1) == 1) ? rand(0, 400) * 1.0 : 0.0,
        'status' => ['pending', 'partial', 'paid'][rand(0, 2)],
        'due_date' => now()->addDays(rand(1, 30)),
        'remarks' => null,
        'created_at' => now(),
        'updated_at' => now(),
      ]);
    }

    for ($i = 0; $i < 10; $i++) {
      DB::table('payments')->insert([
        'student_fee_id' => $studentFees[$i % count($studentFees)],
        'amount' => rand(50, 300) * 1.0,
        'payment_date' => now()->subDays(rand(0, 10)),
        'payment_method' => ['Cash', 'Bank Transfer', 'Credit Card'][rand(0, 2)],
        'transaction_id' => 'TXN' . strtoupper(uniqid()),
        'remarks' => null,
        'received_by' => $staffUser->id,
        'created_at' => now(),
        'updated_at' => now(),
      ]);
    }
  }
}
