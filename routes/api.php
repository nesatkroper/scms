<?php

use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\ExamController;
use App\Http\Controllers\Api\ExpenseCategoryController;
use App\Http\Controllers\Api\ExpenseController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\ScoreController;
use App\Http\Controllers\Api\SubjectController;
use App\Http\Controllers\Api\ClassroomController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\FeeController;
use App\Http\Controllers\Api\FeeTypeController;
use App\Http\Controllers\Api\PasswordResetTokenController;
use App\Http\Controllers\Api\ScheduleController;
use App\Http\Controllers\Api\SessionController;
use App\Http\Controllers\Api\StudentCourseController;
use App\Http\Controllers\Api\TeacherSubjectController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;




Route::post('/login', [AuthenticatedSessionController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});

Route::prefix('v1')
  ->as('admin.')
  ->middleware('auth:sanctum')
  ->group(
    function () {


      Route::get('classrooms', [ClassroomController::class, 'index']);
      Route::post('classrooms', [ClassroomController::class, 'store']);
      Route::get('classrooms/{classroom}', [ClassroomController::class, 'show']);
      Route::put('classrooms/{classroom}', [ClassroomController::class, 'update']);
      Route::delete('classrooms/{classroom}', [ClassroomController::class, 'destroy']);


      Route::get('departments', [DepartmentController::class, 'index']);
      Route::post('departments', [DepartmentController::class, 'store']);
      Route::get('departments/{department}', [DepartmentController::class, 'show']);
      Route::put('departments/{department}', [DepartmentController::class, 'update']);
      Route::delete('departments/{department}', [DepartmentController::class, 'destroy']);


      Route::get('users', [UserController::class, 'index']);
      Route::post('users', [UserController::class, 'store']);
      Route::get('users/{user}', [UserController::class, 'show']);
      Route::put('users/{user}', [UserController::class, 'update']);
      Route::delete('users/{user}', [UserController::class, 'destroy']);


      Route::get('password-reset-tokens', [PasswordResetTokenController::class, 'index']);
      Route::post('password-reset-tokens', [PasswordResetTokenController::class, 'store']);
      Route::get('password-reset-tokens/{id}', [PasswordResetTokenController::class, 'show']);
      Route::put('password-reset-tokens/{id}', [PasswordResetTokenController::class, 'update']);
      Route::delete('password-reset-tokens/{id}', [PasswordResetTokenController::class, 'destroy']);


      Route::get('sessions', [SessionController::class, 'index']);
      Route::post('sessions', [SessionController::class, 'store']);
      Route::get('sessions/{session}', [SessionController::class, 'show']);
      Route::put('sessions/{session}', [SessionController::class, 'update']);
      Route::delete('sessions/{session}', [SessionController::class, 'destroy']);


      Route::get('subjects', [SubjectController::class, 'index']);
      Route::post('subjects', [SubjectController::class, 'store']);
      Route::get('subjects/{subject}', [SubjectController::class, 'show']);
      Route::put('subjects/{subject}', [SubjectController::class, 'update']);
      Route::delete('subjects/{subject}', [SubjectController::class, 'destroy']);


      Route::get('student-courses', [StudentCourseController::class, 'index']);
      Route::post('student-courses', [StudentCourseController::class, 'store']);
      Route::get('student-courses/{id}', [StudentCourseController::class, 'show']);
      Route::put('student-courses/{id}', [StudentCourseController::class, 'update']);
      Route::delete('student-courses/{id}', [StudentCourseController::class, 'destroy']);


      Route::get('expense-categories', [ExpenseCategoryController::class, 'index']);
      Route::post('expense-categories', [ExpenseCategoryController::class, 'store']);
      Route::get('expense-categories/{id}', [ExpenseCategoryController::class, 'show']);
      Route::put('expense-categories/{id}', [ExpenseCategoryController::class, 'update']);
      Route::delete('expense-categories/{id}', [ExpenseCategoryController::class, 'destroy']);


      Route::get('expenses', [ExpenseController::class, 'index']);
      Route::post('expenses', [ExpenseController::class, 'store']);
      Route::get('expenses/{expense}', [ExpenseController::class, 'show']);
      Route::put('expenses/{expense}', [ExpenseController::class, 'update']);
      Route::delete('expenses/{expense}', [ExpenseController::class, 'destroy']);


      Route::get('attendances', [AttendanceController::class, 'index']);
      Route::post('attendances', [AttendanceController::class, 'store']);
      Route::get('attendances/{attendance}', [AttendanceController::class, 'show']);
      Route::put('attendances/{attendance}', [AttendanceController::class, 'update']);
      Route::delete('attendances/{attendance}', [AttendanceController::class, 'destroy']);


      Route::get('exams', [ExamController::class, 'index']);
      Route::post('exams', [ExamController::class, 'store']);
      Route::get('exams/{exam}', [ExamController::class, 'show']);
      Route::put('exams/{exam}', [ExamController::class, 'update']);
      Route::delete('exams/{exam}', [ExamController::class, 'destroy']);


      Route::get('fee-types', [FeeTypeController::class, 'index']);
      Route::post('fee-types', [FeeTypeController::class, 'store']);
      Route::get('fee-types/{id}', [FeeTypeController::class, 'show']);
      Route::put('fee-types/{id}', [FeeTypeController::class, 'update']);
      Route::delete('fee-types/{id}', [FeeTypeController::class, 'destroy']);


      Route::get('fees', [FeeController::class, 'index']);
      Route::post('fees', [FeeController::class, 'store']);
      Route::get('fees/{fee}', [FeeController::class, 'show']);
      Route::put('fees/{fee}', [FeeController::class, 'update']);
      Route::delete('fees/{fee}', [FeeController::class, 'destroy']);


      Route::get('payments', [PaymentController::class, 'index']);
      Route::post('payments', [PaymentController::class, 'store']);
      Route::get('payments/{payment}', [PaymentController::class, 'show']);
      Route::put('payments/{payment}', [PaymentController::class, 'update']);
      Route::delete('payments/{payment}', [PaymentController::class, 'destroy']);


      Route::get('scores', [ScoreController::class, 'index']);
      Route::post('scores', [ScoreController::class, 'store']);
      Route::get('scores/{score}', [ScoreController::class, 'show']);
      Route::put('scores/{score}', [ScoreController::class, 'update']);
      Route::delete('scores/{score}', [ScoreController::class, 'destroy']);


      Route::get('teacher-subjects', [TeacherSubjectController::class, 'index']);
      Route::post('teacher-subjects', [TeacherSubjectController::class, 'store']);
      Route::get('teacher-subjects/{id}', [TeacherSubjectController::class, 'show']);
      Route::put('teacher-subjects/{id}', [TeacherSubjectController::class, 'update']);
      Route::delete('teacher-subjects/{id}', [TeacherSubjectController::class, 'destroy']);


      Route::get('schedules', [ScheduleController::class, 'index']);
      Route::post('schedules', [ScheduleController::class, 'store']);
      Route::get('schedules/{schedule}', [ScheduleController::class, 'show']);
      Route::put('schedules/{schedule}', [ScheduleController::class, 'update']);
      Route::delete('schedules/{schedule}', [ScheduleController::class, 'destroy']);
    }
  );
