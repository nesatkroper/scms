<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\SettingController;
use Illuminate\Http\Request;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookIssueController;
use App\Http\Controllers\ClassSubjectController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\FeeStructureController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\GradeLevelController;
use App\Http\Controllers\GradeScaleController;
use App\Http\Controllers\GuardianController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StudentFeeController;
use App\Http\Controllers\StudentGuardianController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TimetableController;
use App\Http\Controllers\TimetableEntryController;
use Illuminate\Support\Facades\Route as r;

r::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


r::apiResources([
    'setting' => SettingController::class,
    'class' => ClassroomController::class
]);



r::prefix('students')->group(function () {
    r::get('/', [StudentController::class, 'index']);
    r::post('/', [StudentController::class, 'store']);
    r::get('/{student}', [StudentController::class, 'show']);
    r::put('/{student}', [StudentController::class, 'update']);
    r::delete('/{student}', [StudentController::class, 'destroy']);
});

r::prefix('books')->group(function () {
    r::get('/', [BookController::class, 'index']);
    r::post('/', [BookController::class, 'store']);
    r::get('/{book}', [BookController::class, 'show']);
    r::post('/{book}', [BookController::class, 'update']);
    r::delete('/{book}', [BookController::class, 'destroy']);
});

r::prefix('settings')->group(function () {
    r::get('/', [SettingController::class, 'index']);
    r::post('/', [SettingController::class, 'store']);
    r::get('/{setting}', [SettingController::class, 'show']);
    r::put('/{setting}', [SettingController::class, 'update']);
    r::delete('/{setting}', [SettingController::class, 'destroy']);
});

r::prefix('classrooms')->group(function () {
    r::get('/', [ClassroomController::class, 'index']);
    r::post('/', [ClassroomController::class, 'store']);
    r::get('/{classroom}', [ClassroomController::class, 'show']);
    r::put('/{classroom}', [ClassroomController::class, 'update']);
    r::delete('/{classroom}', [ClassroomController::class, 'destroy']);
});


r::prefix('events')->group(function () {
    r::get('/', [EventController::class, 'index']);
    r::post('/', [EventController::class, 'store']);
    r::get('/{event}', [EventController::class, 'show']);
    r::put('/{event}', [EventController::class, 'update']);
    r::delete('/{event}', [EventController::class, 'destroy']);
});

r::prefix('grade-levels')->group(function () {
    r::get('/', [GradeLevelController::class, 'index']);
    r::post('/', [GradeLevelController::class, 'store']);
    r::get('/{gradeLevel}', [GradeLevelController::class, 'show']);
    r::put('/{gradeLevel}', [GradeLevelController::class, 'update']);
    r::delete('/{gradeLevel}', [GradeLevelController::class, 'destroy']);
});


r::prefix('grade-scales')->group(function () {
    r::get('/', [GradeScaleController::class, 'index']);
    r::post('/', [GradeScaleController::class, 'store']);
    r::get('/{gradeScale}', [GradeScaleController::class, 'show']);
    r::put('/{gradeScale}', [GradeScaleController::class, 'update']);
    r::delete('/{gradeScale}', [GradeScaleController::class, 'destroy']);
});


r::prefix('departments')->group(function () {
    r::get('/', [DepartmentController::class, 'index']);
    r::post('/', [DepartmentController::class, 'store']);
    r::get('/{department}', [DepartmentController::class, 'show']);
    r::put('/{department}', [DepartmentController::class, 'update']);
    r::delete('/{department}', [DepartmentController::class, 'destroy']);
});


r::prefix('teachers')->group(function () {
    r::get('/', [TeacherController::class, 'index']);
    r::post('/', [TeacherController::class, 'store']);
    r::get('/{teacher}', [TeacherController::class, 'show']);
    r::put('/{teacher}', [TeacherController::class, 'update']);
    r::delete('/{teacher}', [TeacherController::class, 'destroy']);
});


r::prefix('subjects')->group(function () {
    r::get('/', [SubjectController::class, 'index']);
    r::post('/', [SubjectController::class, 'store']);
    r::get('/{subject}', [SubjectController::class, 'show']);
    r::put('/{subject}', [SubjectController::class, 'update']);
    r::delete('/{subject}', [SubjectController::class, 'destroy']);
});


r::prefix('sections')->group(function () {
    r::get('/', [SectionController::class, 'index']);
    r::post('/', [SectionController::class, 'store']);
    r::get('/{section}', [SectionController::class, 'show']);
    r::put('/{section}', [SectionController::class, 'update']);
    r::delete('/{section}', [SectionController::class, 'destroy']);
});


r::prefix('guardians')->group(function () {
    r::get('/', [GuardianController::class, 'index']);
    r::post('/', [GuardianController::class, 'store']);
    r::get('/{guardian}', [GuardianController::class, 'show']);
    r::put('/{guardian}', [GuardianController::class, 'update']);
    r::delete('/{guardian}', [GuardianController::class, 'destroy']);
});


r::prefix('student-guardians')->group(function () {
    r::post('/', [StudentGuardianController::class, 'store']);
    r::delete('/{student}/{guardian}', [StudentGuardianController::class, 'destroy']);
});

r::prefix('class-subjects')->group(function () {
    r::get('/', [ClassSubjectController::class, 'index']);
    r::post('/', [ClassSubjectController::class, 'store']);
    r::get('/{classSubject}', [ClassSubjectController::class, 'show']);
    r::put('/{classSubject}', [ClassSubjectController::class, 'update']);
    r::delete('/{classSubject}', [ClassSubjectController::class, 'destroy']);
});


r::prefix('book-issues')->group(function () {
    r::get('/', [BookIssueController::class, 'index']);
    r::post('/', [BookIssueController::class, 'store']);
    r::get('/{bookIssue}', [BookIssueController::class, 'show']);
    r::put('/{bookIssue}', [BookIssueController::class, 'update']);
    r::delete('/{bookIssue}', [BookIssueController::class, 'destroy']);
});

r::prefix('notices')->group(function () {
    r::get('/', [NoticeController::class, 'index']);
    r::post('/', [NoticeController::class, 'store']);
    r::get('/{notice}', [NoticeController::class, 'show']);
    r::put('/{notice}', [NoticeController::class, 'update']);
    r::delete('/{notice}', [NoticeController::class, 'destroy']);
});

r::prefix('expenses')->group(function () {
    r::get('/', [ExpenseController::class, 'index']);
    r::post('/', [ExpenseController::class, 'store']);
    r::get('/{expense}', [ExpenseController::class, 'show']);
    r::put('/{expense}', [ExpenseController::class, 'update']);
    r::delete('/{expense}', [ExpenseController::class, 'destroy']);
});
r::prefix('fee-structures')->group(function () {
    r::get('/', [FeeStructureController::class, 'index']);
    r::post('/', [FeeStructureController::class, 'store']);
    r::get('/{feeStructure}', [FeeStructureController::class, 'show']);
    r::put('/{feeStructure}', [FeeStructureController::class, 'update']);
    r::delete('/{feeStructure}', [FeeStructureController::class, 'destroy']);
});
r::prefix('timetables')->group(function () {
    r::get('/', [TimetableController::class, 'index']);
    r::post('/', [TimetableController::class, 'store']);
    r::get('/{timetable}', [TimetableController::class, 'show']);
    r::put('/{timetable}', [TimetableController::class, 'update']);
    r::delete('/{timetable}', [TimetableController::class, 'destroy']);
});
r::prefix('timetable-entries')->group(function () {
    r::get('/', [TimetableEntryController::class, 'index']);
    r::post('/', [TimetableEntryController::class, 'store']);
    r::get('/{timetableEntry}', [TimetableEntryController::class, 'show']);
    r::put('/{timetableEntry}', [TimetableEntryController::class, 'update']);
    r::delete('/{timetableEntry}', [TimetableEntryController::class, 'destroy']);
});
r::prefix('attendances')->group(function () {
    r::get('/', [AttendanceController::class, 'index']);
    r::post('/', [AttendanceController::class, 'store']);
    r::get('/{attendance}', [AttendanceController::class, 'show']);
    r::put('/{attendance}', [AttendanceController::class, 'update']);
    r::delete('/{attendance}', [AttendanceController::class, 'destroy']);
});

r::prefix('exams')->group(function () {
    r::get('/', [ExamController::class, 'index']);
    r::post('/', [ExamController::class, 'store']);
    r::get('/{exam}', [ExamController::class, 'show']);
    r::put('/{exam}', [ExamController::class, 'update']);
    r::delete('/{exam}', [ExamController::class, 'destroy']);
});
r::prefix('grades')->group(function () {
    r::get('/', [GradeController::class, 'index']);
    r::post('/', [GradeController::class, 'store']);
    r::get('/{grade}', [GradeController::class, 'show']);
    r::put('/{grade}', [GradeController::class, 'update']);
    r::delete('/{grade}', [GradeController::class, 'destroy']);
});
r::prefix('student-fees')->group(function () {
    r::get('/', [StudentFeeController::class, 'index']);
    r::post('/', [StudentFeeController::class, 'store']);
    r::get('/{studentFee}', [StudentFeeController::class, 'show']);
    r::put('/{studentFee}', [StudentFeeController::class, 'update']);
    r::delete('/{studentFee}', [StudentFeeController::class, 'destroy']);
});
r::prefix('payments')->group(function () {
    r::get('/', [PaymentController::class, 'index']);
    r::post('/', [PaymentController::class, 'store']);
    r::get('/{payment}', [PaymentController::class, 'show']);
    r::put('/{payment}', [PaymentController::class, 'update']);
    r::delete('/{payment}', [PaymentController::class, 'destroy']);
});
