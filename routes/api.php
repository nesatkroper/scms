<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\Api\{
    AuthController,
    AttendanceController,
    BookController,
    BookIssueController,
    ClassSubjectController,
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
    TimetableEntryController
};

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResources([
        'settings' => SettingController::class,
        'classrooms' => ClassroomController::class,
        'books' => BookController::class,
        'events' => EventController::class,
        'grade-levels' => GradeLevelController::class,
        'grade-scales' => GradeScaleController::class,
        'departments' => DepartmentController::class,
        'teachers' => TeacherController::class,
        'subjects' => SubjectController::class,
        'sections' => SectionController::class,
        'guardians' => GuardianController::class,
        'class-subjects' => ClassSubjectController::class,
        'book-issues' => BookIssueController::class,
        'notices' => NoticeController::class,
        'expenses' => ExpenseController::class,
        'fee-structures' => FeeStructureController::class,
        'timetables' => TimetableController::class,
        'timetable-entries' => TimetableEntryController::class,
        'attendances' => AttendanceController::class,
        'exams' => ExamController::class,
        'grades' => GradeController::class,
        'student-fees' => StudentFeeController::class,
        'payments' => PaymentController::class,
        'students' => StudentController::class,
    ]);

// Route::middleware('auth:sanctum')->group(function () {
//     Route::apiResources([
//         'settings' => SettingController::class,
//         'classrooms' => ClassroomController::class,
//         'books' => BookController::class,
//         'events' => EventController::class,
//         'grade-levels' => GradeLevelController::class,
//         'grade-scales' => GradeScaleController::class,
//         'departments' => DepartmentController::class,
//         'teachers' => TeacherController::class,
//         'subjects' => SubjectController::class,
//         'sections' => SectionController::class,
//         'guardians' => GuardianController::class,
//         'class-subjects' => ClassSubjectController::class,
//         'book-issues' => BookIssueController::class,
//         'notices' => NoticeController::class,
//         'expenses' => ExpenseController::class,
//         'fee-structures' => FeeStructureController::class,
//         'timetables' => TimetableController::class,
//         'timetable-entries' => TimetableEntryController::class,
//         'attendances' => AttendanceController::class,
//         'exams' => ExamController::class,
//         'grades' => GradeController::class,
//         'student-fees' => StudentFeeController::class,
//         'payments' => PaymentController::class,
//         'students' => StudentController::class,
//     ]);

//     Route::prefix('student-guardians')->group(function () {
//         Route::post('/', [StudentGuardianController::class, 'store']);
//         Route::delete('/{student}/{guardian}', [StudentGuardianController::class, 'destroy']);
//     });
// });
