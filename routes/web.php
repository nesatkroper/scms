<?php

use Illuminate\Support\Facades\Route as R;
use App\Http\Controllers\{
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
  GradeLevelController,
  GradeScaleController,
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
  HomeController
};
use Illuminate\Support\Facades\Auth;

Auth::routes();

R::get('/', function () {
  return view('welcome');
});


R::prefix('/admin')
  ->as('admin.')
  ->middleware('auth')
  ->group(function () {
    R::get('/', [HomeController::class, 'index'])->name('home');
    R::get('/home', [HomeController::class, 'index'])->name('home');

    R::resources([
      'attendances' => AttendanceController::class,
      'books' => BookController::class,
      'bookissues' => BookIssueController::class,
      'classrooms' => ClassroomController::class,
      'departments' => DepartmentController::class,
      'events' => EventController::class,
      'exams' => ExamController::class,
      'expenses' => ExpenseController::class,
      'feestructures' => FeeStructureController::class,
      'grades' => GradeController::class,
      'gradelevels' => GradeLevelController::class,
      'gradescales' => GradeScaleController::class,
      'guardians' => GuardianController::class,
      'notices' => NoticeController::class,
      'payments' => PaymentController::class,
      'sections' => SectionController::class,
      'settings' => SettingController::class,
      'students' => StudentController::class,
      'studentfees' => StudentFeeController::class,
      'subjects' => SubjectController::class,
      'teachers' => TeacherController::class,
      'timetables' => TimetableController::class,
      'timetable_entries' => TimetableEntryController::class,
    ]);

    R::prefix('/expenses')
      ->as('expenses.')
      ->middleware('auth')
      ->group(function () {
        R::post('/bulk-delete', [ExpenseController::class, 'bulkDelete'])->name('bulkDelete');
        R::post('/bulk-data', [ExpenseController::class, 'getBulkData'])->name('getBulkData');
        R::post('/bulk-update', [ExpenseController::class, 'bulkUpdate'])->name('bulkUpdate');
      });

    R::prefix('/sections')
      ->as('sections.')
      ->middleware('auth')
      ->group(function () {
        R::post('/bulk-delete', [SectionController::class, 'bulkDelete'])->name('bulkDelete');
        R::post('/bulk-data', [SectionController::class, 'getBulkData'])->name('getBulkData');
        R::post('/bulk-update', [SectionController::class, 'bulkUpdate'])->name('bulkUpdate');
      });

    R::prefix('/bookissues')
      ->as('bookissues.')
      ->middleware('auth')
      ->group(function () {
        R::post('/bulk-delete', [BookIssueController::class, 'bulkDelete'])->name('bulkDelete');
        R::post('/get-bulk-data', [BookIssueController::class, 'getBulkData'])->name('getBulkData');
        R::post('/bulk-update', [BookIssueController::class, 'bulkUpdate'])->name('bulkUpdate');
      });

    R::prefix('/books')
      ->as('books.')
      ->middleware('auth')
      ->group(function () {
        R::post('/bulkDelete', [BookController::class, 'bulkDelete'])->name('bulkDelete');
        R::post('/getBulkData', [BookController::class, 'getBulkData'])->name('getBulkData');
        R::post('/bulkUpdate', [BookController::class, 'bulkUpdate'])->name('bulkUpdate');
      });

    R::prefix('/students')
      ->as('students.')
      ->middleware('auth')
      ->group(function () {
        R::post('/bulk-delete', [StudentController::class, 'bulkDelete'])->name('bulkDelete');
        R::post('/bulk-data', [StudentController::class, 'getBulkData'])->name('getBulkData');
        R::post('/bulk-update', [StudentController::class, 'bulkUpdate'])->name('bulkUpdate');
      });

    R::prefix('/guardians')
      ->as('guardians.')
      ->middleware('auth')
      ->group(function () {
        R::post('/bulk-delete', [GuardianController::class, 'bulkDelete'])->name('bulkDelete');
        R::post('/bulk-data', [GuardianController::class, 'getBulkData'])->name('getBulkData');
        R::post('/bulk-update', [GuardianController::class, 'bulkUpdate'])->name('bulkUpdate');
      });

    R::prefix('/departments')
      ->as('departments.')
      ->middleware('auth')
      ->group(function () {
        R::post('/bulk-delete', [DepartmentController::class, 'bulkDelete'])->name('bulkDelete');
        R::post('/bulk-data', [DepartmentController::class, 'getBulkData'])->name('getBulkData');
        R::post('/bulk-update', [DepartmentController::class, 'bulkUpdate'])->name('bulkUpdate');
      });

    R::prefix('/gradelevels')
      ->as('gradelevels.')
      ->middleware('auth')
      ->group(function () {
        R::post('/bulk-delete', [GradeLevelController::class, 'bulkDelete'])->name('bulkDelete');
        R::post('/bulk-data', [GradeLevelController::class, 'getBulkData'])->name('getBulkData');
        R::post('/bulk-update', [GradeLevelController::class, 'bulkUpdate'])->name('bulkUpdate');
      });

    R::prefix('/subjects')
      ->as('subjects.')
      ->middleware('auth')
      ->group(function () {
        R::post('/bulk-delete', [SubjectController::class, 'bulkDelete'])->name('bulkDelete');
        R::post('/bulk-data', [SubjectController::class, 'getBulkData'])->name('getBulkData');
        R::post('/bulk-update', [SubjectController::class, 'bulkUpdate'])->name('bulkUpdate');
      });

    R::prefix('/teachers')
      ->as('teachers.')
      ->middleware('auth')
      ->group(function () {
        R::post('/bulk-delete', [TeacherController::class, 'bulkDelete'])->name('bulkDelete');
        R::post('/bulk-data', [TeacherController::class, 'getBulkData'])->name('getBulkData');
        R::post('/bulk-update', [TeacherController::class, 'bulkUpdate'])->name('bulkUpdate');
      });

    R::prefix('/students/{student}/guardians')
      ->as('student_guardians.')
      ->middleware('auth')
      ->group(function () {
        R::get('/attach', [StudentGuardianController::class, 'create'])->name('create');
        R::post('/', [StudentGuardianController::class, 'store'])->name('store');
        R::delete('/{guardian}', [StudentGuardianController::class, 'destroy'])->name('destroy');
      });
  });