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
  ScoreController,
  UserController,
  RoleController,
  ProfileController,
  CourseOfferingController,
  StudentCourseController,
  FeeTypeController,
  FeeController,
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


    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('classrooms', ClassroomController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('exams', ExamController::class);
    Route::resource('expense_categories', ExpenseCategoryController::class);
    Route::resource('expenses', ExpenseController::class);
    Route::resource('fee_types', FeeTypeController::class);
    Route::resource('fees', FeeController::class);
    Route::resource('payments', PaymentController::class);
    Route::resource('sections', SectionController::class);
    Route::resource('students', StudentController::class);
    Route::resource('subjects', SubjectController::class);
    Route::resource('teachers', TeacherController::class);
    Route::resource('course_offerings', CourseOfferingController::class);

    Route::get('/students/profile/{student}', [StudentController::class, 'profile'])->name('students.profile');

    Route::get('/student_courses', [StudentCourseController::class, 'index'])->name('student_courses.index');
    Route::get('/student_courses/create', [StudentCourseController::class, 'create'])->name('student_courses.create');
    Route::post('/student_courses', [StudentCourseController::class, 'store'])->name('student_courses.store');
    Route::get('/student_courses/{student_id}/{course_offering_id}', [StudentCourseController::class, 'show'])->name('student_courses.show');
    Route::get('/student_courses/{student_id}/{course_offering_id}/edit', [StudentCourseController::class, 'edit'])->name('student_courses.edit');
    Route::put('/student_courses/{student_id}/{course_offering_id}', [StudentCourseController::class, 'update'])->name('student_courses.update');
    Route::delete('/student_courses/{student_id}/{course_offering_id}', [StudentCourseController::class, 'destroy'])->name('student_courses.destroy');

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::prefix('scores')->name('scores.')->group(function () {
      Route::get('/', [ScoreController::class, 'index'])->name('index');
      Route::post('/save-all', [ScoreController::class, 'saveAll'])->name('saveAll');
    });

    Route::prefix('attendances')->name('attendances.')->group(function () {
      Route::get('/', [AttendanceController::class, 'index'])->name('index');
      Route::post('/save-all', [AttendanceController::class, 'saveAll'])->name('saveAll');
      Route::get('/{courseOfferingId}/student/{studentId}', [AttendanceController::class, 'show'])->name('show');
    });

    Route::group([], function () {
      Route::prefix('expenses')->name('expenses.')->group(function () {
        Route::post('/bulk-delete', [ExpenseController::class, 'bulkDelete'])->name('bulkDelete');
        Route::post('/bulk-data', [ExpenseController::class, 'getBulkData'])->name('getBulkData');
        Route::post('/bulk-update', [ExpenseController::class, 'bulkUpdate'])->name('bulkUpdate');
      });

      Route::prefix('sections')->name('sections.')->group(function () {
        Route::post('/bulk-delete', [SectionController::class, 'bulkDelete'])->name('bulkDelete');
        Route::post('/bulk-data', [SectionController::class, 'getBulkData'])->name('getBulkData');
        Route::post('/bulk-update', [SectionController::class, 'bulkUpdate'])->name('bulkUpdate');
      });

      Route::prefix('students')->name('students.')->group(function () {
        Route::post('/bulk-delete', [StudentController::class, 'bulkDelete'])->name('bulkDelete');
        Route::post('/bulk-data', [StudentController::class, 'getBulkData'])->name('getBulkData');
        Route::post('/bulk-update', [StudentController::class, 'bulkUpdate'])->name('bulkUpdate');
      });

      Route::prefix('departments')->name('departments.')->group(function () {
        Route::post('/bulk-delete', [DepartmentController::class, 'bulkDelete'])->name('bulkDelete');
        Route::post('/bulk-data', [DepartmentController::class, 'getBulkData'])->name('getBulkData');
        Route::post('/bulk-update', [DepartmentController::class, 'bulkUpdate'])->name('bulkUpdate');
      });

      Route::prefix('subjects')->name('subjects.')->group(function () {
        Route::post('/bulk-delete', [SubjectController::class, 'bulkDelete'])->name('bulkDelete');
        Route::post('/bulk-data', [SubjectController::class, 'getBulkData'])->name('getBulkData');
        Route::post('/bulk-update', [SubjectController::class, 'bulkUpdate'])->name('bulkUpdate');
      });

      Route::prefix('exams')->name('exams.')->group(function () {
        Route::post('/bulk-delete', [ExamController::class, 'bulkDelete'])->name('bulkDelete');
        Route::post('/bulk-data', [ExamController::class, 'getBulkData'])->name('getBulkData');
        Route::post('/bulk-update', [ExamController::class, 'bulkUpdate'])->name('bulkUpdate');
      });

      Route::prefix('teachers')->name('teachers.')->group(function () {
        Route::post('/bulk-delete', [TeacherController::class, 'bulkDelete'])->name('bulkDelete');
        Route::post('/bulk-data', [TeacherController::class, 'getBulkData'])->name('getBulkData');
        Route::post('/bulk-update', [TeacherController::class, 'bulkUpdate'])->name('bulkUpdate');
      });
    });
  });