<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentCourseRequest;
use App\Models\StudentCourse;
use App\Models\CourseOffering;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class StudentCourseController extends BaseController
{
  public function __construct()
  {
    parent::__construct();
    $this->applyPermissions();
  }

  protected function ModelPermissionName(): string
  {
    return 'Student-Course';
  }

  public function index(Request $request)
  {
    $search = $request->input('search');
    $courseOfferingId = $request->input('course_offering_id');

    if (! $courseOfferingId) {
      return redirect()->route('admin.course_offerings.index')
        ->with('error', 'Course Offering ID is required.');
    }

    $courseOffering = CourseOffering::with('subject:id,name')->findOrFail($courseOfferingId);

    $query = StudentCourse::query()
      ->with(['student:id,name', 'courseOffering.subject:id,name'])
      ->where('course_offering_id', $courseOfferingId);

    if ($search) {
      $query->where(function ($q) use ($search) {
        $q->where('status', 'like', "%{$search}%")
          ->orWhere('payment_status', 'like', "%{$search}%")
          ->orWhereHas('student', function ($q2) use ($search) {
            $q2->where('name', 'like', "%{$search}%");
          })
          ->orWhereHas('courseOffering.subject', function ($q3) use ($search) {
            $q3->where('name', 'like', "%{$search}%");
          });
      });
    }

    $studentCourses = $query->orderBy('created_at', 'desc')->get();


    return view('admin.student_courses.index', compact('studentCourses', 'courseOffering'));
  }


  public function create(Request $request)
  {
    $courseOfferingId = $request->input('course_offering_id');

    if (! $courseOfferingId) {
      return redirect()->route('admin.course_offerings.index')
        ->with('error', 'Course Offering ID is required.');
    }

    $courseOffering = CourseOffering::with('subject:id,name')->findOrFail($courseOfferingId);

    $enrolledStudentIds = StudentCourse::where('course_offering_id', $courseOfferingId)
      ->pluck('student_id');

    $students = User::role('student')
      ->whereNotIn('id', $enrolledStudentIds)
      ->orderBy('name')
      ->get(['id', 'name']);

    if ($students->isEmpty()) {
      return redirect()->route('admin.student_courses.index', ['course_offering_id' => $courseOfferingId])
        ->with('error', 'All students are already enrolled in this course.');
    }

    $statuses = ['studying', 'suspended', 'dropped', 'completed'];
    $paymentStatuses = ['pending', 'paid', 'overdue', 'free'];

    return view('admin.student_courses.create', compact(
      'students',
      'courseOffering',
      'statuses',
      'paymentStatuses',
      'courseOfferingId'
    ));
  }

  public function store(StudentCourseRequest $request)
  {
    $data = $request->validated();


    $exists = StudentCourse::where('student_id', $data['student_id'])
      ->where('course_offering_id', $data['course_offering_id'])
      ->exists();

    if ($exists) {
      return redirect()->route('admin.student_courses.create', ['course_offering_id' => $data['course_offering_id']])
        ->with('error', 'This student is already enrolled in this course offering.')
        ->withInput();
    }

    try {
      StudentCourse::create($data);

      return redirect()
        ->route('admin.student_courses.index', ['course_offering_id' => $data['course_offering_id']])
        ->with('success', 'Enrollment created successfully!');
    } catch (\Exception $e) {
      Log::error('Error creating StudentCourse: ' . $e->getMessage());
      return redirect()->route('admin.student_courses.create', ['course_offering_id' => $data['course_offering_id']])
        ->with('error', 'Error creating enrollment.')->withInput();
    }
  }

  public function createNewStudent(Request $request)
  {
    $courseOfferingId = $request->input('course_offering_id');

    if (! $courseOfferingId) {
      return redirect()->route('admin.course_offerings.index')->with('error', 'Course Offering ID is required to enroll a new student.');
    }

    $courseOffering = CourseOffering::with('subject:id,name')->findOrFail($courseOfferingId);

    $statuses = ['studying', 'suspended', 'dropped', 'completed'];
    $paymentStatuses = ['pending', 'paid', 'overdue', 'free'];

    return view('admin.student_courses.create_new_student', compact(
      'courseOffering',
      'statuses',
      'paymentStatuses',
      'courseOfferingId'
    ));
  }

  public function storeNewStudent(Request $request)
  {
    $studentData = $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users,email',
      'password' => 'required|string|min:8|confirmed',
      'phone' => 'nullable|string|max:20',
      'address' => 'nullable|string|max:255',
      'date_of_birth' => 'nullable|date',
      'gender' => 'nullable|string|in:male,female,other',
      'admission_date' => 'nullable|date',
      'occupation' => 'nullable|string|max:255',
      'company' => 'nullable|string|max:255',
    ]);

    $enrollmentData = $request->validate([
      'course_offering_id' => 'required|exists:course_offerings,id',
      'grade_final' => 'nullable|numeric|between:0,100',
      'status' => 'required|string|in:studying,suspended,dropped,completed',
      'payment_status' => 'required|string|in:pending,paid,overdue,free',
      'remarks' => 'nullable|string|max:500',
    ]);

    DB::beginTransaction();

    try {
      $student = User::create([
        'name' => $studentData['name'],
        'email' => $studentData['email'],
        'password' => bcrypt($studentData['password']),
        'phone' => $studentData['phone'] ?? null,
        'address' => $studentData['address'] ?? null,
        'date_of_birth' => $studentData['date_of_birth'] ?? null,
        'admission_date' => $studentData['admission_date'] ?? now()->toDateString(),
        'gender' => $studentData['gender'] ?? null,
        'occupation' => $studentData['occupation'] ?? null,
        'company' => $studentData['company'] ?? null,
      ]);

      $student->assignRole('student');

      $exists = StudentCourse::where('student_id', $student->id)
        ->where('course_offering_id', $enrollmentData['course_offering_id'])
        ->exists();

      if ($exists) {
        DB::rollBack();
        return redirect()->back()
          ->with('error', 'This student is already enrolled in this course offering.')
          ->withInput();
      }

      StudentCourse::create([
        'student_id' => $student->id,
        'course_offering_id' => $enrollmentData['course_offering_id'],
        'grade_final' => $enrollmentData['grade_final'] ?? null,
        'status' => $enrollmentData['status'],
        'payment_status' => $enrollmentData['payment_status'],
        'remarks' => $enrollmentData['remarks'] ?? null,
      ]);

      DB::commit();

      return redirect()->route('admin.student_courses.index', ['course_offering_id' => $enrollmentData['course_offering_id']])
        ->with('success', 'New student and enrollment created successfully!');
    } catch (\Exception $e) {
      DB::rollBack();
      Log::error('Error creating new student and enrollment: ' . $e->getMessage());
      return redirect()->back()
        ->with('error', 'Error creating new student and enrollment. Please check the logs.')
        ->withInput();
    }
  }

  public function edit($student_id, $course_offering_id)
  {
    $studentCourse = StudentCourse::where('student_id', $student_id)
      ->where('course_offering_id', $course_offering_id)
      ->firstOrFail();

    $student = User::select('id', 'name')->findOrFail($student_id);

    $courseOffering = CourseOffering::with('subject:id,name')
      ->findOrFail($course_offering_id);

    $statuses = ['studying', 'suspended', 'dropped', 'completed'];
    $paymentStatuses = ['pending', 'paid', 'overdue', 'free'];

    return view('admin.student_courses.edit', compact(
      'studentCourse',
      'student',
      'courseOffering',
      'statuses',
      'paymentStatuses'
    ));
  }

  public function update(StudentCourseRequest $request, $student_id, $course_offering_id)
  {
    $studentCourse = StudentCourse::where('student_id', $student_id)
      ->where('course_offering_id', $course_offering_id)
      ->firstOrFail();

    $safe = collect($request->validated())->except(['student_id', 'course_offering_id'])->toArray();

    try {
      $studentCourse->update($safe);

      return redirect()->route('admin.student_courses.index', ['course_offering_id' => $course_offering_id])
        ->with('success', 'Enrollment updated successfully');
    } catch (\Exception $e) {
      Log::error('Error updating StudentCourse: ' . $e->getMessage());
      return redirect()->back()->with('error', 'Error updating enrollment.')->withInput();
    }
  }

  public function destroy($student_id, $course_offering_id)
  {
    $studentCourse = StudentCourse::where('student_id', $student_id)
      ->where('course_offering_id', $course_offering_id)
      ->firstOrFail();

    $courseOfferingId = $studentCourse->course_offering_id;

    try {
      $studentCourse->delete();

      return redirect()->route('admin.student_courses.index', ['course_offering_id' => $courseOfferingId])
        ->with('success', 'Enrollment deleted successfully');
    } catch (\Exception $e) {
      Log::error('Error deleting StudentCourse: ' . $e->getMessage());
      return redirect()->back()->with('error', 'Error deleting enrollment.');
    }
  }
}
