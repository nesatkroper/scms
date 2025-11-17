<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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
  return redirect('/home');   // 👈 redirect main domain to website home
});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/
Auth::routes();

Route::get('/', function () {

  if (Auth::check())
    return redirect('/admin/profile');

  return redirect('/login');
});



// Admin routes generated automatically
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('classrooms', Admin\ClassroomController::class);
    Route::resource('departments', Admin\DepartmentController::class);
    Route::resource('users', Admin\UserController::class);
    Route::resource('subjects', Admin\SubjectController::class);
    Route::resource('expense-categories', Admin\ExpenseCategoryController::class);
    Route::resource('expenses', Admin\ExpenseController::class);
    Route::resource('attendances', Admin\AttendanceController::class);
    Route::resource('exams', Admin\ExamController::class);
    Route::resource('fee-types', Admin\FeeTypeController::class);
    Route::resource('fees', Admin\FeeController::class);
    Route::resource('payments', Admin\PaymentController::class);
    Route::resource('scores', Admin\ScoreController::class);
    Route::resource('teacher-subjects', Admin\TeacherSubjectController::class);
    Route::resource('schedules', Admin\ScheduleController::class);
});
