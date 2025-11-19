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
  CourseOfferingController
};




Route::get('/home', function () {
  return view('web.home');
})->name('web.home');

Route::get('/about-us', function () {
  return view('web.about');
})->name('web.about');
Route::get('/contact', function () {
  return view('web.contact');
})->name('web.contact');
Route::get('/what-we-do', function () {
  return view('web.whatwedo');
})->name('web.whatwedo');
Route::get('/donation', function () {
  return view('web.donation');
})->name('web.donation');
Route::get('/', function () {
  return redirect('/home');
});

Auth::routes();

Route::get('/', function () {

  if (Auth::check())
    return redirect('/admin/profile');

  return redirect('/login');
});





Route::prefix('admin')
  ->as('admin.')
  ->middleware('auth')
  ->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::resources([
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
      // 'scores' => ScoreController::class,
      'course_offerings' => CourseOfferingController::class,
    ]);

    Route::group(['prefix' => 'scores', 'as' => 'scores.'], function () {
      Route::get('/', [ScoreController::class, 'index'])->name('index');
      Route::get('/create', [ScoreController::class, 'create'])->name('create');

      Route::get('/filter', [ScoreController::class, 'filterStudents'])->name('filterStudents');

      Route::post('/', [ScoreController::class, 'store'])->name('store');
      Route::get('/{score}/edit', [ScoreController::class, 'edit'])->name('edit');
      Route::put('/{score}', [ScoreController::class, 'update'])->name('update');
      Route::delete('/{score}', [ScoreController::class, 'destroy'])->name('destroy');
    });

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/students/profile/{student}', [StudentController::class, 'profile'])
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
      Route::prefix($prefix)
        ->as($prefix . '.')
        ->group(function () use ($controller) {
          Route::post('/bulk-delete', [$controller, 'bulkDelete'])->name('bulkDelete');
          Route::post('/bulk-data', [$controller, 'getBulkData'])->name('getBulkData');
          Route::post('/bulk-update', [$controller, 'bulkUpdate'])->name('bulkUpdate');
        });
    }
  });
