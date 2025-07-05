<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::resources([
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

    Route::post('/students/bulk-delete', [StudentController::class, 'bulkDelete'])->name('students.bulkDelete');
    Route::post('/students/bulk-data', [StudentController::class, 'getBulkData'])->name('students.getBulkData');
    Route::post('/students/bulk-update', [StudentController::class, 'bulkUpdate'])->name('students.bulkUpdate');


    // departments bulk-delete
    Route::post('/departments/bulk-delete', [DepartmentController::class, 'bulkDelete'])->name('departments.bulkDelete');
    Route::post('/departments/bulk-data', [DepartmentController::class, 'getBulkData'])->name('departments.getBulkData');
    Route::post('/departments/bulk-update', [DepartmentController::class, 'bulkUpdate'])->name('departments.bulkUpdate');

    // subjects bulk-delete
    Route::post('/subjects/bulk-delete', [SubjectController::class, 'bulkDelete'])->name('subjects.bulkDelete');
    Route::post('/subjects/bulk-data', [SubjectController::class, 'getBulkData'])->name('subjects.getBulkData');
    Route::post('/subjects/bulk-update', [SubjectController::class, 'bulkUpdate'])->name('subjects.bulkUpdate');

    Route::get('students/{student}/guardians/attach', [StudentGuardianController::class, 'create'])->name('student_guardians.create');
    Route::post('students/{student}/guardians', [StudentGuardianController::class, 'store'])->name('student_guardians.store');
    Route::delete('students/{student}/guardians/{guardian}', [StudentGuardianController::class, 'destroy'])->name('student_guardians.destroy');
});
