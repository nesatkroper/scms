<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentCourseRequest;
use App\Models\StudentCourse;
use App\Models\CourseOffering;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StudentCourseController extends Controller
{
  public function index(Request $request)
  {
    $search = $request->input('search');
    $courseOfferingId = $request->input('course_offering_id');

    $courseOffering = CourseOffering::findOrFail($courseOfferingId);

    $studentCourses = StudentCourse::query()
      ->with(['student:id,name', 'courseOffering.subject:id,name'])
      ->when($search, function ($query) use ($search) {
        $query->where('status', 'like', "%{$search}%")
          ->orWhere('payment_status', 'like', "%{$search}%")
          ->orWhereHas('student', function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%");
          })
          ->orWhereHas('courseOffering.subject', function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%");
          });
      })
      ->when($courseOfferingId, function ($query) use ($courseOfferingId) {
        $query->where('course_offering_id', $courseOfferingId);
      })
      ->orderBy('created_at', 'desc')
      ->get();

    return view('admin.student_courses.index', compact('studentCourses', 'courseOffering'));
  }


  public function create(Request $request)
  {
    $students = User::role('student')->orderBy('name')->get(['id', 'name']);

    if ($students->isEmpty()) {
      return redirect()->route('admin.students.create')
        ->with('error', 'No students found. Please create a student first.');
    }

    $courseOfferingId = $request->input('course_offering_id');
    $courseOffering = null;

    if ($courseOfferingId) {
      $courseOffering = CourseOffering::with('subject:id,name')->findOrFail($courseOfferingId);
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
    $exists = StudentCourse::where('student_id', $request->student_id)
      ->where('course_offering_id', $request->course_offering_id)
      ->exists();

    if ($exists) {
      return redirect()->route('admin.student_courses.create', ['course_offering_id' => $request->course_offering_id])
        ->with('error', 'This student is already enrolled in this course offering.')
        ->withInput();
    }

    try {
      StudentCourse::create($request->validated());
      return redirect()->route('admin.student_courses.index', ['course_offering_id' => $request->course_offering_id])->with('success', 'Enrollment created successfully!');
    } catch (\Exception $e) {
      Log::error('Error creating StudentCourse: ' . $e->getMessage());
      return redirect()->route('admin.student_courses.create', ['course_offering_id' => $request->course_offering_id])->with('error', 'Error creating enrollment.')->withInput();
    }
  }


  public function edit($student_id, $course_offering_id)
  {
    $studentCourse = StudentCourse::where('student_id', $student_id)
      ->where('course_offering_id', $course_offering_id)
      ->firstOrFail();

    $student = User::findOrFail($student_id, ['id', 'name']);
    $courseOffering = CourseOffering::with('subject:id,name')->findOrFail($course_offering_id);


    $statuses = ['studying', 'suspended', 'dropped', 'completed'];
    $paymentStatuses = ['pending', 'paid', 'overdue', 'free'];

    return view('admin.student_courses.edit', compact('studentCourse', 'student', 'courseOffering', 'statuses', 'paymentStatuses'));
  }

  public function update(StudentCourseRequest $request, $student_id, $course_offering_id)
  {
    $studentCourse = StudentCourse::where('student_id', $student_id)
      ->where('course_offering_id', $course_offering_id)
      ->firstOrFail();

    $studentCourse->update($request->validated());
    return redirect()->route('admin.student_courses.index', ['course_offering_id' => $course_offering_id])->with('success', 'Enrollment updated successfully');
  }

  public function destroy($student_id, $course_offering_id)
  {
    $studentCourse = StudentCourse::where('student_id', $student_id)
      ->where('course_offering_id', $course_offering_id)
      ->firstOrFail();

    $courseOfferingId = $studentCourse->course_offering_id;
    $studentCourse->delete();
    return redirect()->route('admin.student_courses.index', ['course_offering_id' => $courseOfferingId])->with('success', 'Enrollment deleted successfully');
  }
}