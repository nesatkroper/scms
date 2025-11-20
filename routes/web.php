<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\{
  AttendanceController,
  ClassroomController,
  DepartmentController,
  ExamController,
  ExpenseController,
  ExpenseCategoryController,
  PaymentController,
  SectionController,
  StudentController,
  SubjectController,
  TeacherController,
  HomeController,
  PermissionController,
  ScoreController,
  UserController,
  RoleController,
  ProfileController,
  CourseOfferingController,
  StudentCourseController
};



Route::get('/home', fn() => view('web.home'))->name('web.home');
Route::get('/about-us', fn() => view('web.about'))->name('web.about');
Route::get('/contact', fn() => view('web.contact'))->name('web.contact');
Route::get('/what-we-do', fn() => view('web.whatwedo'))->name('web.whatwedo');
Route::get('/donation', fn() => view('web.donation'))->name('web.donation');

Route::get('/', fn() => redirect('/home'));



Auth::routes();

Route::get('/', function () {
  if (Auth::check()) {
    return redirect('/admin/profile');
  }
  return redirect('/login');
});



Route::prefix('admin')
  ->as('admin.')
  ->middleware('auth')
  ->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');


    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');


    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/{role}', [RoleController::class, 'show'])->name('roles.show');
    Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::put('/roles/{role}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');


    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
    Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
    Route::post('/permissions', [PermissionController::class, 'store'])->name('permissions.store');
    Route::get('/permissions/{permission}', [PermissionController::class, 'show'])->name('permissions.show');
    Route::get('/permissions/{permission}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
    Route::put('/permissions/{permission}', [PermissionController::class, 'update'])->name('permissions.update');
    Route::delete('/permissions/{permission}', [PermissionController::class, 'destroy'])->name('permissions.destroy');


    Route::get('/attendances', [AttendanceController::class, 'index'])->name('attendances.index');
    Route::get('/attendances/create', [AttendanceController::class, 'create'])->name('attendances.create');
    Route::post('/attendances', [AttendanceController::class, 'store'])->name('attendances.store');
    Route::get('/attendances/{attendance}', [AttendanceController::class, 'show'])->name('attendances.show');
    Route::get('/attendances/{attendance}/edit', [AttendanceController::class, 'edit'])->name('attendances.edit');
    Route::put('/attendances/{attendance}', [AttendanceController::class, 'update'])->name('attendances.update');
    Route::delete('/attendances/{attendance}', [AttendanceController::class, 'destroy'])->name('attendances.destroy');


    Route::get('/classrooms', [ClassroomController::class, 'index'])->name('classrooms.index');
    Route::get('/classrooms/create', [ClassroomController::class, 'create'])->name('classrooms.create');
    Route::post('/classrooms', [ClassroomController::class, 'store'])->name('classrooms.store');
    Route::get('/classrooms/{classroom}', [ClassroomController::class, 'show'])->name('classrooms.show');
    Route::get('/classrooms/{classroom}/edit', [ClassroomController::class, 'edit'])->name('classrooms.edit');
    Route::put('/classrooms/{classroom}', [ClassroomController::class, 'update'])->name('classrooms.update');
    Route::delete('/classrooms/{classroom}', [ClassroomController::class, 'destroy'])->name('classrooms.destroy');


    Route::get('/departments', [DepartmentController::class, 'index'])->name('departments.index');
    Route::get('/departments/create', [DepartmentController::class, 'create'])->name('departments.create');
    Route::post('/departments', [DepartmentController::class, 'store'])->name('departments.store');
    Route::get('/departments/{department}', [DepartmentController::class, 'show'])->name('departments.show');
    Route::get('/departments/{department}/edit', [DepartmentController::class, 'edit'])->name('departments.edit');
    Route::put('/departments/{department}', [DepartmentController::class, 'update'])->name('departments.update');
    Route::delete('/departments/{department}', [DepartmentController::class, 'destroy'])->name('departments.destroy');


    Route::get('/exams', [ExamController::class, 'index'])->name('exams.index');
    Route::get('/exams/create', [ExamController::class, 'create'])->name('exams.create');
    Route::post('/exams', [ExamController::class, 'store'])->name('exams.store');
    Route::get('/exams/{exam}', [ExamController::class, 'show'])->name('exams.show');
    Route::get('/exams/{exam}/edit', [ExamController::class, 'edit'])->name('exams.edit');
    Route::put('/exams/{exam}', [ExamController::class, 'update'])->name('exams.update');
    Route::delete('/exams/{exam}', [ExamController::class, 'destroy'])->name('exams.destroy');


    Route::get('/expenses', [ExpenseController::class, 'index'])->name('expenses.index');
    Route::get('/expenses/create', [ExpenseController::class, 'create'])->name('expenses.create');
    Route::post('/expenses', [ExpenseController::class, 'store'])->name('expenses.store');
    Route::get('/expenses/{expense}', [ExpenseController::class, 'show'])->name('expenses.show');
    Route::get('/expenses/{expense}/edit', [ExpenseController::class, 'edit'])->name('expenses.edit');
    Route::put('/expenses/{expense}', [ExpenseController::class, 'update'])->name('expenses.update');
    Route::delete('/expenses/{expense}', [ExpenseController::class, 'destroy'])->name('expenses.destroy');


    Route::get('/expensecategory', [ExpenseCategoryController::class, 'index'])->name('expensecategory.index');
    Route::get('/expensecategory/create', [ExpenseCategoryController::class, 'create'])->name('expensecategory.create');
    Route::post('/expensecategory', [ExpenseCategoryController::class, 'store'])->name('expensecategory.store');
    Route::get('/expensecategory/{cat}', [ExpenseCategoryController::class, 'show'])->name('expensecategory.show');
    Route::get('/expensecategory/{cat}/edit', [ExpenseCategoryController::class, 'edit'])->name('expensecategory.edit');
    Route::put('/expensecategory/{cat}', [ExpenseCategoryController::class, 'update'])->name('expensecategory.update');
    Route::delete('/expensecategory/{cat}', [ExpenseCategoryController::class, 'destroy'])->name('expensecategory.destroy');


    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('/payments/create', [PaymentController::class, 'create'])->name('payments.create');
    Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');
    Route::get('/payments/{payment}', [PaymentController::class, 'show'])->name('payments.show');
    Route::get('/payments/{payment}/edit', [PaymentController::class, 'edit'])->name('payments.edit');
    Route::put('/payments/{payment}', [PaymentController::class, 'update'])->name('payments.update');
    Route::delete('/payments/{payment}', [PaymentController::class, 'destroy'])->name('payments.destroy');


    Route::get('/sections', [SectionController::class, 'index'])->name('sections.index');
    Route::get('/sections/create', [SectionController::class, 'create'])->name('sections.create');
    Route::post('/sections', [SectionController::class, 'store'])->name('sections.store');
    Route::get('/sections/{section}', [SectionController::class, 'show'])->name('sections.show');
    Route::get('/sections/{section}/edit', [SectionController::class, 'edit'])->name('sections.edit');
    Route::put('/sections/{section}', [SectionController::class, 'update'])->name('sections.update');
    Route::delete('/sections/{section}', [SectionController::class, 'destroy'])->name('sections.destroy');


    Route::get('/students', [StudentController::class, 'index'])->name('students.index');
    Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
    Route::post('/students', [StudentController::class, 'store'])->name('students.store');
    Route::get('/students/{student}', [StudentController::class, 'show'])->name('students.show');
    Route::get('/students/{student}/edit', [StudentController::class, 'edit'])->name('students.edit');
    Route::put('/students/{student}', [StudentController::class, 'update'])->name('students.update');
    Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');
    Route::get('/students/profile/{student}', [StudentController::class, 'profile'])->name('students.profile');


    Route::get('/subjects', [SubjectController::class, 'index'])->name('subjects.index');
    Route::get('/subjects/create', [SubjectController::class, 'create'])->name('subjects.create');
    Route::post('/subjects', [SubjectController::class, 'store'])->name('subjects.store');
    Route::get('/subjects/{subject}', [SubjectController::class, 'show'])->name('subjects.show');
    Route::get('/subjects/{subject}/edit', [SubjectController::class, 'edit'])->name('subjects.edit');
    Route::put('/subjects/{subject}', [SubjectController::class, 'update'])->name('subjects.update');
    Route::delete('/subjects/{subject}', [SubjectController::class, 'destroy'])->name('subjects.destroy');


    Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');
    Route::get('/teachers/create', [TeacherController::class, 'create'])->name('teachers.create');
    Route::post('/teachers', [TeacherController::class, 'store'])->name('teachers.store');
    Route::get('/teachers/{teacher}', [TeacherController::class, 'show'])->name('teachers.show');
    Route::get('/teachers/{teacher}/edit', [TeacherController::class, 'edit'])->name('teachers.edit');
    Route::put('/teachers/{teacher}', [TeacherController::class, 'update'])->name('teachers.update');
    Route::delete('/teachers/{teacher}', [TeacherController::class, 'destroy'])->name('teachers.destroy');


    Route::get('/course_offerings', [CourseOfferingController::class, 'index'])->name('course_offerings.index');
    Route::get('/course_offerings/create', [CourseOfferingController::class, 'create'])->name('course_offerings.create');
    Route::post('/course_offerings', [CourseOfferingController::class, 'store'])->name('course_offerings.store');
    Route::get('/course_offerings/{course_offering}', [CourseOfferingController::class, 'show'])->name('course_offerings.show');
    Route::get('/course_offerings/{course_offering}/edit', [CourseOfferingController::class, 'edit'])->name('course_offerings.edit');
    Route::put('/course_offerings/{course_offering}', [CourseOfferingController::class, 'update'])->name('course_offerings.update');
    Route::delete('/course_offerings/{course_offering}', [CourseOfferingController::class, 'destroy'])->name('course_offerings.destroy');


    Route::get('/scores', [ScoreController::class, 'index'])->name('scores.index');
    Route::get('/scores/create', [ScoreController::class, 'create'])->name('scores.create');
    Route::get('/scores/filter', [ScoreController::class, 'filterStudents'])->name('scores.filterStudents');
    Route::post('/scores', [ScoreController::class, 'store'])->name('scores.store');
    Route::get('/scores/{score}/edit', [ScoreController::class, 'edit'])->name('scores.edit');
    Route::put('/scores/{score}', [ScoreController::class, 'update'])->name('scores.update');
    Route::delete('/scores/{score}', [ScoreController::class, 'destroy'])->name('scores.destroy');


    Route::get('/student_courses', [StudentCourseController::class, 'index'])->name('student_courses.index');
    Route::get('/student_courses/create', [StudentCourseController::class, 'create'])->name('student_courses.create');
    Route::post('/student_courses', [StudentCourseController::class, 'store'])->name('student_courses.store');
    Route::get('/student_courses/{student_course}', [StudentCourseController::class, 'show'])->name('student_courses.show');
    Route::get('/student_courses/{student_course}/edit', [StudentCourseController::class, 'edit'])->name('student_courses.edit');
    Route::put('/student_courses/{student_course}', [StudentCourseController::class, 'update'])->name('student_courses.update');
    Route::delete('/student_courses/{student_course}', [StudentCourseController::class, 'destroy'])->name('student_courses.destroy');


    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');



    Route::post('/expenses/bulk-delete', [ExpenseController::class, 'bulkDelete'])->name('expenses.bulkDelete');
    Route::post('/expenses/bulk-data', [ExpenseController::class, 'getBulkData'])->name('expenses.getBulkData');
    Route::post('/expenses/bulk-update', [ExpenseController::class, 'bulkUpdate'])->name('expenses.bulkUpdate');

    Route::post('/sections/bulk-delete', [SectionController::class, 'bulkDelete'])->name('sections.bulkDelete');
    Route::post('/sections/bulk-data', [SectionController::class, 'getBulkData'])->name('sections.getBulkData');
    Route::post('/sections/bulk-update', [SectionController::class, 'bulkUpdate'])->name('sections.bulkUpdate');

    Route::post('/students/bulk-delete', [StudentController::class, 'bulkDelete'])->name('students.bulkDelete');
    Route::post('/students/bulk-data', [StudentController::class, 'getBulkData'])->name('students.getBulkData');
    Route::post('/students/bulk-update', [StudentController::class, 'bulkUpdate'])->name('students.bulkUpdate');

    Route::post('/departments/bulk-delete', [DepartmentController::class, 'bulkDelete'])->name('departments.bulkDelete');
    Route::post('/departments/bulk-data', [DepartmentController::class, 'getBulkData'])->name('departments.getBulkData');
    Route::post('/departments/bulk-update', [DepartmentController::class, 'bulkUpdate'])->name('departments.bulkUpdate');

    Route::post('/subjects/bulk-delete', [SubjectController::class, 'bulkDelete'])->name('subjects.bulkDelete');
    Route::post('/subjects/bulk-data', [SubjectController::class, 'getBulkData'])->name('subjects.getBulkData');
    Route::post('/subjects/bulk-update', [SubjectController::class, 'bulkUpdate'])->name('subjects.bulkUpdate');

    Route::post('/exams/bulk-delete', [ExamController::class, 'bulkDelete'])->name('exams.bulkDelete');
    Route::post('/exams/bulk-data', [ExamController::class, 'getBulkData'])->name('exams.getBulkData');
    Route::post('/exams/bulk-update', [ExamController::class, 'bulkUpdate'])->name('exams.bulkUpdate');

    Route::post('/teachers/bulk-delete', [TeacherController::class, 'bulkDelete'])->name('teachers.bulkDelete');
    Route::post('/teachers/bulk-data', [TeacherController::class, 'getBulkData'])->name('teachers.getBulkData');
    Route::post('/teachers/bulk-update', [TeacherController::class, 'bulkUpdate'])->name('teachers.bulkUpdate');
  });
