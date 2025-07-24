<?php

use Illuminate\Support\Facades\Route as R;
use App\Http\Controllers\{
    AuthController,
    AttendanceController,
    BookController,
    BookCategoryController,
    BookIssueController,
    ClassroomController,
    DepartmentController,
    EventController,
    ExamController,
    ExpenseController,
    FeeStructureController,
    GradeController,
    GradeLevelController,
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
    HomeController,
    ScoreController
};
use Illuminate\Support\Facades\Auth;

Auth::routes();

R::get('/', function () {
    return view('welcome');
});
R::get('/test', function () {
    return view('test');
});

R::prefix('/admin')
    ->as('admin.')
    ->middleware('auth')
    ->group(function () {
        R::get('/', [HomeController::class, 'index'])->name('home');

        R::resources([
            'attendances' => AttendanceController::class,
            'bookcategory' => BookCategoryController::class,
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
            'scores' => ScoreController::class

        ]);

        $bulkRoutes = [
            'expenses' => ExpenseController::class,
            'sections' => SectionController::class,
            'bookissues' => BookIssueController::class,
            'bookcategory' => BookCategoryController::class,
            'books' => BookController::class,
            'students' => StudentController::class,
            'guardians' => GuardianController::class,
            'departments' => DepartmentController::class,
            'gradelevels' => GradeLevelController::class,
            'subjects' => SubjectController::class,
            'exams' => ExamController::class,
            'teachers' => TeacherController::class,
        ];

        foreach ($bulkRoutes as $prefix => $controller) {
            R::prefix($prefix)
                ->as($prefix . '.')
                ->group(function () use ($controller) {
                    R::post('/bulk-delete', [$controller, 'bulkDelete'])->name('bulkDelete');
                    R::post('/bulk-data', [$controller, 'getBulkData'])->name('getBulkData');
                    R::post('/bulk-update', [$controller, 'bulkUpdate'])->name('bulkUpdate');
                });
        }

        R::prefix('/students/{student}/guardians')
            ->as('student_guardians.')
            ->middleware('auth')
            ->group(function () {
                R::get('/attach', [StudentGuardianController::class, 'create'])->name('create');
                R::post('/', [StudentGuardianController::class, 'store'])->name('store');
                R::delete('/{guardian}', [StudentGuardianController::class, 'destroy'])->name('destroy');
            });
    });
