<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route ;
use Illuminate\Http\Request;


Route::post('/login', [AuthenticatedSessionController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});

Route::apiResource('classrooms', App\Http\Controllers\Api\ClassroomController::class);
Route::apiResource('departments', App\Http\Controllers\Api\DepartmentController::class);
Route::apiResource('users', App\Http\Controllers\Api\UserController::class);
Route::apiResource('password-reset-tokens', App\Http\Controllers\Api\PasswordResetTokenController::class);
Route::apiResource('sessions', App\Http\Controllers\Api\SessionController::class);
Route::apiResource('subjects', App\Http\Controllers\Api\SubjectController::class);
Route::apiResource('student-courses', App\Http\Controllers\Api\StudentCourseController::class);
Route::apiResource('expense-categories', App\Http\Controllers\Api\ExpenseCategoryController::class);
Route::apiResource('expenses', App\Http\Controllers\Api\ExpenseController::class);
Route::apiResource('attendances', App\Http\Controllers\Api\AttendanceController::class);
Route::apiResource('exams', App\Http\Controllers\Api\ExamController::class);
Route::apiResource('fee-types', App\Http\Controllers\Api\FeeTypeController::class);
Route::apiResource('fees', App\Http\Controllers\Api\FeeController::class);
Route::apiResource('payments', App\Http\Controllers\Api\PaymentController::class);
Route::apiResource('scores', App\Http\Controllers\Api\ScoreController::class);
Route::apiResource('teacher-subjects', App\Http\Controllers\Api\TeacherSubjectController::class);
Route::apiResource('schedules', App\Http\Controllers\Api\ScheduleController::class);
