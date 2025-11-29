<?php

use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\ExamController;
use App\Http\Controllers\Api\ExpenseCategoryController;
use App\Http\Controllers\Api\ExpenseController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\ScoreController;
use App\Http\Controllers\Api\SubjectController;
use App\Http\Controllers\Api\ClassroomController;
use App\Http\Controllers\Api\FeeController;
use App\Http\Controllers\Api\FeeTypeController;
use App\Http\Controllers\Api\PasswordResetTokenController;
use App\Http\Controllers\Api\StudentCourseController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;




Route::post('/login', [AuthenticatedSessionController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});

Route::prefix('v1')

  ->middleware('auth:sanctum')
  ->group(
    function () {

      Route::prefix('admin')
        ->as('admin.')
        ->group(function () {

          Route::prefix('classrooms')
            ->group(function () {
              Route::get('/', [ClassroomController::class, 'index']);
              Route::post('/', [ClassroomController::class, 'store']);
              Route::get('/{classroom}', [ClassroomController::class, 'show']);
              Route::put('/{classroom}', [ClassroomController::class, 'update']);
              Route::delete('/{classroom}', [ClassroomController::class, 'destroy']);
            });

          Route::prefix('users')
            ->group(function () {
              Route::get('/', [UserController::class, 'index']);
              Route::post('/', [UserController::class, 'store']);
              Route::get('/{user}', [UserController::class, 'show']);
              Route::put('/{user}', [UserController::class, 'update']);
              Route::delete('/{user}', [UserController::class, 'destroy']);
            });

          Route::prefix('password-reset-tokens')
            ->group(function () {
              Route::get('/', [PasswordResetTokenController::class, 'index']);
              Route::post('/', [PasswordResetTokenController::class, 'store']);
              Route::get('/{id}', [PasswordResetTokenController::class, 'show']);
              Route::put('/{id}', [PasswordResetTokenController::class, 'update']);
              Route::delete('/{id}', [PasswordResetTokenController::class, 'destroy']);
            });

          Route::prefix('subjects')
            ->group(function () {
              Route::get('/', [SubjectController::class, 'index']);
              Route::post('/', [SubjectController::class, 'store']);
              Route::get('/{subject}', [SubjectController::class, 'show']);
              Route::put('/{subject}', [SubjectController::class, 'update']);
              Route::delete('/{subject}', [SubjectController::class, 'destroy']);
            });

          Route::prefix('enrollments')
            ->group(function () {
              Route::get('/', [StudentCourseController::class, 'index']);
              Route::post('/', [StudentCourseController::class, 'store']);
              Route::get('/{id}', [StudentCourseController::class, 'show']);
              Route::put('/{id}', [StudentCourseController::class, 'update']);
              Route::delete('/{id}', [StudentCourseController::class, 'destroy']);
            });

          Route::prefix('')
            ->group(function () {
              Route::get('expense-categories', [ExpenseCategoryController::class, 'index']);
              Route::post('expense-categories', [ExpenseCategoryController::class, 'store']);
              Route::get('expense-categories/{id}', [ExpenseCategoryController::class, 'show']);
              Route::put('expense-categories/{id}', [ExpenseCategoryController::class, 'update']);
              Route::delete('expense-categories/{id}', [ExpenseCategoryController::class, 'destroy']);
            });

          Route::prefix('expenses')
            ->group(function () {
              Route::get('/', [ExpenseController::class, 'index']);
              Route::post('/', [ExpenseController::class, 'store']);
              Route::get('/{expense}', [ExpenseController::class, 'show']);
              Route::put('/{expense}', [ExpenseController::class, 'update']);
              Route::delete('/{expense}', [ExpenseController::class, 'destroy']);
            });

          Route::prefix('attendances')
            ->group(function () {
              Route::get('/', [AttendanceController::class, 'index']);
              Route::post('/', [AttendanceController::class, 'store']);
              Route::get('/{attendance}', [AttendanceController::class, 'show']);
              Route::put('/{attendance}', [AttendanceController::class, 'update']);
              Route::delete('/{attendance}', [AttendanceController::class, 'destroy']);
            });

          Route::prefix('exams')
            ->group(function () {
              Route::get('/', [ExamController::class, 'index']);
              Route::post('/', [ExamController::class, 'store']);
              Route::get('/{exam}', [ExamController::class, 'show']);
              Route::put('/{exam}', [ExamController::class, 'update']);
              Route::delete('/{exam}', [ExamController::class, 'destroy']);
            });

          Route::prefix('fee-types')
            ->group(function () {
              Route::get('/', [FeeTypeController::class, 'index']);
              Route::post('/', [FeeTypeController::class, 'store']);
              Route::get('/{id}', [FeeTypeController::class, 'show']);
              Route::put('/{id}', [FeeTypeController::class, 'update']);
              Route::delete('/{id}', [FeeTypeController::class, 'destroy']);
            });

          Route::prefix('fees')
            ->group(function () {
              Route::get('/', [FeeController::class, 'index']);
              Route::post('/', [FeeController::class, 'store']);
              Route::get('/{fee}', [FeeController::class, 'show']);
              Route::put('/{fee}', [FeeController::class, 'update']);
              Route::delete('/{fee}', [FeeController::class, 'destroy']);
            });

          Route::prefix('payments')
            ->group(function () {
              Route::get('/', [PaymentController::class, 'index']);
              Route::post('/', [PaymentController::class, 'store']);
              Route::get('/{payment}', [PaymentController::class, 'show']);
              Route::put('/{payment}', [PaymentController::class, 'update']);
              Route::delete('/{payment}', [PaymentController::class, 'destroy']);
            });

          Route::prefix('scores')
            ->group(function () {
              Route::get('/', [ScoreController::class, 'index']);
              Route::post('/', [ScoreController::class, 'store']);
              Route::get('/{score}', [ScoreController::class, 'show']);
              Route::put('/{score}', [ScoreController::class, 'update']);
              Route::delete('/{score}', [ScoreController::class, 'destroy']);
            });
        });
    }
  );
