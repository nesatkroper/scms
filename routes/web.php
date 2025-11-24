<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\{
  AttendanceController,
  ClassroomController,
  ExamController,
  ExpenseController,
  ExpenseCategoryController,
  PaymentController,
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
  NotificationController,
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


Route::get('/lang/{locale}', function ($locale) {
  if (! in_array($locale, ['en', 'km',]))
    abort(400);

  app()->setLocale($locale);
  session()->put('locale', $locale);
  return back();
})->name('lang.switch');



Route::prefix('admin')
  ->as('admin.')
  ->middleware('auth')
  ->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('deshboard');

    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('classrooms', ClassroomController::class);
    Route::resource('exams', ExamController::class);
    Route::resource('expense_categories', ExpenseCategoryController::class);
    Route::resource('expenses', ExpenseController::class);
    Route::resource('fee_types', FeeTypeController::class);
    Route::resource('fees', FeeController::class);
    Route::resource('payments', PaymentController::class);
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

    Route::prefix('student-courses')->as('student_courses.')->group(function () {
      Route::get('/create-new-student', [StudentCourseController::class, 'createNewStudent'])->name('create.new_student');
      Route::post('/store-new-student', [StudentCourseController::class, 'storeNewStudent'])->name('store.new_student');
    });

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

    Route::get('notifications', [App\Http\Controllers\Admin\NotificationController::class, 'index'])->name('notifications.index');
    Route::post('notifications/{id}/read', [App\Http\Controllers\Admin\NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('notifications/read-all', [App\Http\Controllers\Admin\NotificationController::class, 'markAllAsRead'])->name('notifications.readAll');


    Route::post('expenses/{expense}/approve', [App\Http\Controllers\Admin\ExpenseController::class, 'approve'])->name('expenses.approve');


    Route::prefix('students')->name('students.')->group(function () {
      Route::post('/bulk-delete', [StudentController::class, 'bulkDelete'])->name('bulkDelete');
      Route::post('/bulk-data', [StudentController::class, 'getBulkData'])->name('getBulkData');
      Route::post('/bulk-update', [StudentController::class, 'bulkUpdate'])->name('bulkUpdate');
    });

    Route::prefix('teachers')->name('teachers.')->group(function () {
      Route::post('/bulk-delete', [TeacherController::class, 'bulkDelete'])->name('bulkDelete');
      Route::post('/bulk-data', [TeacherController::class, 'getBulkData'])->name('getBulkData');
      Route::post('/bulk-update', [TeacherController::class, 'bulkUpdate'])->name('bulkUpdate');
    });
  });
