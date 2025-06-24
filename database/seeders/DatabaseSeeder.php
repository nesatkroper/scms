<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User; // Assuming you have a User model for created_by and received_by fields

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Important: Truncate tables to avoid duplicate entries on re-seeding
        // Truncate in reverse order of creation (child tables first, then parent tables)
        // This implicitly handles foreign key constraints for SQLite.

        DB::table('payments')->truncate();
        DB::table('student_fees')->truncate();
        DB::table('grades')->truncate();
        DB::table('exams')->truncate();
        DB::table('attendances')->truncate();
        DB::table('timetable_entries')->truncate();
        DB::table('timetables')->truncate();
        DB::table('class_subjects')->truncate(); // Added
        DB::table('book_issues')->truncate();
        DB::table('student_guardian')->truncate();
        DB::table('students')->truncate();
        DB::table('guardians')->truncate();
        DB::table('sections')->truncate();
        DB::table('teachers')->truncate();
        DB::table('subjects')->truncate();
        // Handle 'departments' last as 'teachers' has a foreign key to it,
        // and 'departments' itself might have 'head_id' pointing to 'teachers'.
        // For 'departments', if head_id is nullable, it's fine.
        // If not nullable, you need to set head_id to null before truncating teachers.
        // Or, simpler, ensure migrate:fresh --seed is used.

        // Nullify head_id in departments before truncating teachers if it's not done via migrate:fresh
        DB::table('departments')->update(['head_id' => null]);

        DB::table('departments')->truncate();

        DB::table('grade_levels')->truncate();
        DB::table('grade_scales')->truncate();
        DB::table('events')->truncate();
        DB::table('books')->truncate();
        DB::table('classrooms')->truncate();
        DB::table('settings')->truncate();

        // Truncate users table last if you are seeding users within this seeder
        DB::table('users')->truncate();

        // Seed Users (if not already seeded by Laravel's default UserSeeder)
        // You'll need at least one user to assign as 'created_by' or 'received_by'
        $user1 = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('password'), // Change this in production
            ]
        );
        $user2 = User::firstOrCreate(
            ['email' => 'staff@example.com'],
            [
                'name' => 'Staff User',
                'password' => bcrypt('password'),
            ]
        );

        // Seed Settings
        DB::table('settings')->insert([
            ['key' => 'school_name', 'value' => 'Awesome Academy', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'school_address', 'value' => '123 Main St, Anytown', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'contact_email', 'value' => 'info@awesomeacademy.com', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Seed Classrooms
        DB::table('classrooms')->insert([
            ['name' => 'Science Lab A', 'room_number' => 'L-101', 'capacity' => 30, 'facilities' => 'Equipped with microscopes, Bunsen burners.', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Art Studio', 'room_number' => 'A-205', 'capacity' => 20, 'facilities' => 'Easel, pottery wheel, painting supplies.', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Main Auditorium', 'room_number' => 'AUD-001', 'capacity' => 200, 'facilities' => 'Stage, sound system, projector.', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Math Classroom', 'room_number' => 'C-301', 'capacity' => 35, 'facilities' => null, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Seed Books
        DB::table('books')->insert([
            [
                'title' => 'The Great Gatsby',
                'author' => 'F. Scott Fitzgerald',
                'isbn' => '9780743273565',
                'publication_year' => 1925,
                'publisher' => 'Scribner',
                'quantity' => 10,
                'description' => 'A novel illustrating the Jazz Age in America.',
                'category' => 'Fiction',
                'cover_image' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Sapiens: A Brief History of Humankind',
                'author' => 'Yuval Noah Harari',
                'isbn' => '9780062316097',
                'publication_year' => 2014,
                'publisher' => 'Harper Perennial',
                'quantity' => 7,
                'description' => 'A brief history of humankind from the Stone Age to the twenty-first century.',
                'category' => 'Non-Fiction',
                'cover_image' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Calculus: Early Transcendentals',
                'author' => 'James Stewart',
                'isbn' => '9781305266728',
                'publication_year' => 2015,
                'publisher' => 'Cengage Learning',
                'quantity' => 15,
                'description' => 'Standard textbook for calculus courses.',
                'category' => 'Mathematics',
                'cover_image' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        // Seed Events
        DB::table('events')->insert([
            [
                'title' => 'Annual Sports Day',
                'description' => 'Our annual sports day featuring various athletic competitions.',
                'date' => '2025-09-15',
                'start_time' => '09:00:00',
                'end_time' => '16:00:00',
                'location' => 'School Ground',
                'type' => 'sports',
                'is_holiday' => false,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Parent-Teacher Conference',
                'description' => 'An opportunity for parents to discuss student progress with teachers.',
                'date' => '2025-10-20',
                'start_time' => '17:00:00',
                'end_time' => '20:00:00',
                'location' => 'School Hall',
                'type' => 'academic',
                'is_holiday' => false,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Winter Holiday',
                'description' => 'School closed for winter break.',
                'date' => '2025-12-24',
                'start_time' => '00:00:00',
                'end_time' => '23:59:59',
                'location' => null,
                'type' => 'holiday',
                'is_holiday' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        // Seed GradeLevels
        DB::table('grade_levels')->insert([
            ['name' => 'Kindergarten', 'code' => 'KG', 'description' => 'Early childhood education.', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Grade 1', 'code' => 'G1', 'description' => 'First year of primary school.', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Grade 12', 'code' => 'G12', 'description' => 'Final year of high school.', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Seed GradeScales
        DB::table('grade_scales')->insert([
            ['name' => 'A+', 'min_percentage' => 90.00, 'max_percentage' => 100.00, 'gpa' => 4.00, 'description' => 'Excellent performance.', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'A', 'min_percentage' => 85.00, 'max_percentage' => 89.99, 'gpa' => 3.70, 'description' => 'Very good performance.', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'B+', 'min_percentage' => 80.00, 'max_percentage' => 84.99, 'gpa' => 3.30, 'description' => 'Good performance.', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'F', 'min_percentage' => 0.00, 'max_percentage' => 49.99, 'gpa' => 0.00, 'description' => 'Fail.', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Seed Departments
        // Insert departments without a head_id first, then update later
        $mathDepartmentId = DB::table('departments')->insertGetId([
            'name' => 'Mathematics Department',
            'description' => 'Department focused on mathematics studies.',
            'head_id' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $scienceDepartmentId = DB::table('departments')->insertGetId([
            'name' => 'Science Department',
            'description' => 'Department focused on science studies (Physics, Chemistry, Biology).',
            'head_id' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $artsDepartmentId = DB::table('departments')->insertGetId([
            'name' => 'Arts Department',
            'description' => 'Department focused on visual and performing arts.',
            'head_id' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Seed Teachers (requires users and departments)
        $teacher1 = DB::table('teachers')->insertGetId([
            'user_id' => $user1->id,
            'teacher_id' => 'TCH001',
            'department_id' => $mathDepartmentId,
            'joining_date' => '2020-08-15',
            'qualification' => 'Ph.D. in Mathematics',
            'specialization' => 'Algebra, Geometry',
            'salary' => 60000.00,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $teacher2 = DB::table('teachers')->insertGetId([
            'user_id' => $user2->id,
            'teacher_id' => 'TCH002',
            'department_id' => $scienceDepartmentId,
            'joining_date' => '2021-09-01',
            'qualification' => 'M.Sc. in Physics',
            'specialization' => 'Quantum Physics',
            'salary' => 55000.00,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Update Department Heads
        DB::table('departments')
            ->where('id', $mathDepartmentId)
            ->update(['head_id' => $teacher1]);

        DB::table('departments')
            ->where('id', $scienceDepartmentId)
            ->update(['head_id' => $teacher2]);

        // Seed Subjects (requires departments)
        $algebraSubjectId = DB::table('subjects')->insertGetId([
            'name' => 'Algebra I',
            'code' => 'MATH101',
            'department_id' => $mathDepartmentId,
            'description' => 'Introduction to basic algebra concepts.',
            'credit_hours' => 3,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $physicsSubjectId = DB::table('subjects')->insertGetId([
            'name' => 'Physics I',
            'code' => 'SCI101',
            'department_id' => $scienceDepartmentId,
            'description' => 'Introduction to classical mechanics.',
            'credit_hours' => 4,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('subjects')->insert([
            ['name' => 'Art History', 'code' => 'ART201', 'department_id' => $artsDepartmentId, 'description' => 'Survey of major art movements.', 'credit_hours' => 3, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Seed Sections (requires grade_levels and teachers)
        $grade1 = DB::table('grade_levels')->where('code', 'G1')->first();
        $grade12 = DB::table('grade_levels')->where('code', 'G12')->first();

        $section1 = DB::table('sections')->insertGetId([
            'name' => '1A',
            'grade_level_id' => $grade1->id,
            'teacher_id' => $teacher1,
            'capacity' => 25,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $section2 = DB::table('sections')->insertGetId([
            'name' => '12B',
            'grade_level_id' => $grade12->id,
            'teacher_id' => $teacher2,
            'capacity' => 30,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Seed Guardians (requires users)
        $guardian1_user = User::firstOrCreate(
            ['email' => 'parent1@example.com'],
            [
                'name' => 'Parent One',
                'password' => bcrypt('password'),
            ]
        );
        $guardian2_user = User::firstOrCreate(
            ['email' => 'parent2@example.com'],
            [
                'name' => 'Parent Two',
                'password' => bcrypt('password'),
            ]
        );

        $guardian1_id = DB::table('guardians')->insertGetId([
            'user_id' => $guardian1_user->id,
            'occupation' => 'Software Engineer',
            'company' => 'Tech Solutions Inc.',
            'relation' => 'Father',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $guardian2_id = DB::table('guardians')->insertGetId([
            'user_id' => $guardian2_user->id,
            'occupation' => 'Doctor',
            'company' => 'City Hospital',
            'relation' => 'Mother',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Seed Students (requires users and sections)
        $student1_user = User::firstOrCreate(
            ['email' => 'student1@example.com'],
            [
                'name' => 'Alice Smith',
                'password' => bcrypt('password'),
            ]
        );
        $student2_user = User::firstOrCreate(
            ['email' => 'student2@example.com'],
            [
                'name' => 'Bob Johnson',
                'password' => bcrypt('password'),
            ]
        );

        $student1_id = DB::table('students')->insertGetId([
            'user_id' => $student1_user->id,
            'student_id' => 'STD001',
            'admission_date' => '2024-09-01',
            'section_id' => $section1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $student2_id = DB::table('students')->insertGetId([
            'user_id' => $student2_user->id,
            'student_id' => 'STD002',
            'admission_date' => '2023-09-01',
            'section_id' => $section2,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Seed StudentGuardian pivot table
        DB::table('student_guardian')->insert([
            ['student_id' => $student1_id, 'guardian_id' => $guardian1_id],
            ['student_id' => $student2_id, 'guardian_id' => $guardian2_id],
        ]);

        // Seed ClassSubjects (requires sections, subjects, teachers)
        $classSubject1 = DB::table('class_subjects')->insertGetId([
            'section_id' => $section1,
            'subject_id' => $algebraSubjectId, // Algebra I for 1A
            'teacher_id' => $teacher1,
            'room' => 'C-301',
            'start_time' => '09:00:00',
            'end_time' => '10:00:00',
            'day' => 'monday',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $classSubject2 = DB::table('class_subjects')->insertGetId([
            'section_id' => $section2,
            'subject_id' => $physicsSubjectId,
            'teacher_id' => $teacher2,
            'room' => 'L-101',
            'start_time' => '11:00:00',
            'end_time' => '12:00:00',
            'day' => 'tuesday',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Seed BookIssues (requires books, users)
        $book1 = DB::table('books')->where('isbn', '9780743273565')->first();
        $book2 = DB::table('books')->where('isbn', '9780062316097')->first();

        DB::table('book_issues')->insert([
            [
                'book_id' => $book1->id,
                'user_id' => $student1_user->id,
                'issue_date' => '2025-06-01',
                'due_date' => '2025-06-15',
                'return_date' => null,
                'fine' => 0.00,
                'status' => 'issued',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'book_id' => $book2->id,
                'user_id' => $teacher1, // Corrected: this should be the user_id of the teacher, not the teacher's ID from the teachers table.
                'issue_date' => '2025-05-20',
                'due_date' => '2025-06-20',
                'return_date' => '2025-06-18',
                'fine' => 0.00,
                'status' => 'returned',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        // Seed Notices (requires users)
        DB::table('notices')->insert([
            [
                'title' => 'School Reopening',
                'content' => 'All students are kindly informed that the school will reopen on September 1st, 2025.',
                'audience' => 'all',
                'start_date' => '2025-08-20',
                'end_date' => '2025-09-05',
                'is_published' => true,
                'created_by' => $user1->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Faculty Meeting',
                'content' => 'Mandatory faculty meeting on Friday at 3 PM in the staff room.',
                'audience' => 'teachers',
                'start_date' => '2025-06-25',
                'end_date' => '2025-06-28',
                'is_published' => true,
                'created_by' => $user1->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        // Seed Expenses (requires users)
        DB::table('expenses')->insert([
            [
                'title' => 'Office Supplies',
                'description' => 'Purchase of pens, paper, and other office necessities.',
                'amount' => 250.75,
                'date' => '2025-06-10',
                'category' => 'Administration',
                'approved_by' => $user1->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Electricity Bill',
                'description' => 'Monthly electricity bill for the school building.',
                'amount' => 1200.00,
                'date' => '2025-06-20',
                'category' => 'Utilities',
                'approved_by' => $user1->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        // Seed FeeStructures (requires grade_levels)
        DB::table('fee_structures')->insert([
            [
                'name' => 'Tuition Fee - Grade 1',
                'grade_level_id' => $grade1->id,
                'amount' => 500.00,
                'frequency' => 'monthly',
                'effective_from' => '2024-09-01',
                'effective_to' => null,
                'description' => 'Monthly tuition fee for Grade 1 students.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Annual Exam Fee - Grade 12',
                'grade_level_id' => $grade12->id,
                'amount' => 150.00,
                'frequency' => 'annual',
                'effective_from' => '2024-09-01',
                'effective_to' => null,
                'description' => 'Annual examination fee for Grade 12 students.',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        // Seed Timetables (requires sections)
        $timetable1 = DB::table('timetables')->insertGetId([
            'section_id' => $section1,
            'title' => 'Grade 1A - Semester 1 Timetable',
            'description' => 'Regular timetable for Grade 1A students for the first semester.',
            'is_active' => true,
            'start_date' => '2024-09-01',
            'end_date' => '2025-01-31',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Seed TimetableEntries (requires timetables, class_subjects)
        DB::table('timetable_entries')->insert([
            [
                'timetable_id' => $timetable1,
                'class_subject_id' => $classSubject1, // Algebra I for 1A
                'start_time' => '09:00:00',
                'end_time' => '10:00:00',
                'day' => 'monday',
                'room' => 'C-301',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        // Seed Exams (requires subjects)
        $exam1 = DB::table('exams')->insertGetId([
            'name' => 'Midterm - Algebra I',
            'description' => 'Midterm examination for Algebra I.',
            'subject_id' => $algebraSubjectId,
            'date' => '2025-11-10',
            'total_marks' => 100,
            'passing_marks' => 50,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Seed Grades (requires students, exams)
        DB::table('grades')->insert([
            [
                'student_id' => $student1_id,
                'exam_id' => $exam1,
                'marks_obtained' => 85.50,
                'comments' => 'Good performance.',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        // Seed StudentFees (requires students, fee_structures)
        $tuitionFeeGrade1 = DB::table('fee_structures')->where('name', 'Tuition Fee - Grade 1')->first();

        $studentFee1 = DB::table('student_fees')->insertGetId([
            'student_id' => $student1_id,
            'fee_structure_id' => $tuitionFeeGrade1->id,
            'amount' => 500.00,
            'discount' => 0.00,
            'paid_amount' => 250.00,
            'status' => 'partial',
            'due_date' => '2025-07-01',
            'remarks' => 'Partial payment received.',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Seed Payments (requires student_fees, users)
        DB::table('payments')->insert([
            [
                'student_fee_id' => $studentFee1,
                'amount' => 250.00,
                'payment_date' => '2025-06-20',
                'payment_method' => 'Bank Transfer',
                'transaction_id' => 'TXN12345',
                'remarks' => 'First installment.',
                'received_by' => $user2->id, // Staff user
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

    }
}
