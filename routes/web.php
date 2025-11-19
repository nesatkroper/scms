<?php

use Illuminate\Support\Facades\Route as R;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\{
  AttendanceController,
  BookController,
  BookCategoryController,
  BookIssueController,
  ClassroomController,
  DepartmentController,
  EventController,
  ExamController,
  ExpenseController,
  ExpenseCategoryController,
  FeeStructureController,
  GradeController,
  GradeLevelController,
  GuardianController,
  NoticeController,
  PaymentController,
  SectionController,
  SettingController,
  StudentController,
  StudentFeeController,
  StudentGuardianController,
  SubjectController,
  TeacherController,
  TimetableController,
  TimetableEntryController,
  HomeController,
  PermissionController,
  ScoreController,
  UserController,
  RoleController,
  ProfileController
};


R::get('/home', function () {
  return view('web.home');
})->name('web.home');

R::get('/about-us', function () {
  return view('web.about');
})->name('web.about');
R::get('/contact', function () {
  return view('web.contact');
})->name('web.contact');
R::get('/what-we-do', function () {
  return view('web.whatwedo');
})->name('web.whatwedo');
R::get('/donation', function () {
  return view('web.donation');
})->name('web.donation');
R::get('/', function () {
  return redirect('/home');
});

Auth::routes();

R::get('/', function () {

  if (Auth::check())
    return redirect('/admin/profile');

  return redirect('/login');
});

R::prefix('admin')
  ->as('admin.')
  ->middleware('auth')
  ->group(function () {

    R::get('/', [HomeController::class, 'index'])->name('home');

    R::resources([
      'users' => UserController::class,
      'roles' => RoleController::class,
      'permissions' => PermissionController::class,
      'attendances' => AttendanceController::class,
      'classrooms' => ClassroomController::class,
      'departments' => DepartmentController::class,
      'exams' => ExamController::class,
      'expenses' => ExpenseController::class,
      'expensecategory' => ExpenseCategoryController::class,
      'payments' => PaymentController::class,
      'sections' => SectionController::class,
      'students' => StudentController::class,
      'subjects' => SubjectController::class,
      'teachers' => TeacherController::class,
      'scores' => ScoreController::class,
    ]);

    R::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    R::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    R::get('/students/profile/{student}', [StudentController::class, 'profile'])
      ->name('students.profile');



    $bulkRoutes = [
      'expenses' => ExpenseController::class,
      'sections' => SectionController::class,
      'students' => StudentController::class,
      'departments' => DepartmentController::class,
      'subjects' => SubjectController::class,
      'exams' => ExamController::class,
      'teachers' => TeacherController::class,
    ];

    foreach ($bulkRoutes as $prefix => $controller) {
      R::prefix($prefix)
        ->as($prefix . '.')
        ->group(function () use ($controller) {
          R::post('/bulk-delete', [$controller, 'bulkDelete'])->name('bulkDelete');
          R::post('/bulk-data', [$controller, 'getBulkData'])->name('getBulkData');
          R::post('/bulk-update', [$controller, 'bulkUpdate'])->name('bulkUpdate');
        });
    }
  });
