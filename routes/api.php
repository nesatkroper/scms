<?php

use Illuminate\Support\Facades\Route as R;
use Illuminate\Http\Request;

use App\Http\Controllers\Api\{
  AuthController,
  AttendanceController,
  BookController,
  BookIssueController,
  ClassroomController,
  DepartmentController,
  EventController,
  ExamController,
  ExpenseController,
  FeeStructureController,
  GradeController,
  GuardianController,
  NoticeController,
  PaymentController,
  SectionController,
  StudentController,
  StudentFeeController,
  SubjectController,
  TeacherController,
  TimetableController,
};

R::post('/login', [AuthController::class, 'login']);

R::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});

R::apiResources([
  'classrooms' => ClassroomController::class,
  'books' => BookController::class,
  'events' => EventController::class,
  'departments' => DepartmentController::class,
  'teachers' => TeacherController::class,
  'subjects' => SubjectController::class,
  'sections' => SectionController::class,
  'guardians' => GuardianController::class,
  'book-issues' => BookIssueController::class,
  'notices' => NoticeController::class,
  'expenses' => ExpenseController::class,
  'fee-structures' => FeeStructureController::class,
  'timetables' => TimetableController::class,
  'attendances' => AttendanceController::class,
  'exams' => ExamController::class,
  'grades' => GradeController::class,
  'student-fees' => StudentFeeController::class,
  'payments' => PaymentController::class,
  'students' => StudentController::class,
]);