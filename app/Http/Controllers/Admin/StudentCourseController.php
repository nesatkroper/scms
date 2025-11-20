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
    $perPage = $request->input('per_page', 10);

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
      ->orderBy('created_at', 'desc')
      ->paginate($perPage)
      ->appends($request->query());

    return view('admin.student_courses.index', compact('studentCourses'));
  }

  public function create()
  {
    $students = User::role('student')->orderBy('name')->get(['id', 'name']);
    $courseOfferings = CourseOffering::with('subject:id,name,code')->get();

    return view('admin.student_courses.create', compact('students', 'courseOfferings'));
  }

  public function store(StudentCourseRequest $request)
  {
    $exists = StudentCourse::where('student_id', $request->student_id)
      ->where('course_offering_id', $request->course_offering_id)
      ->exists();

    if ($exists) {
      return redirect()->route('admin.student_courses.create')
        ->with('error', 'This student is already enrolled in this course offering.')
        ->withInput();
    }

    try {
      StudentCourse::create($request->validated());
      return redirect()->route('admin.student_courses.index')->with('success', 'Enrollment created successfully!');
    } catch (\Exception $e) {
      Log::error('Error creating StudentCourse: ' . $e->getMessage());
      return redirect()->route('admin.student_courses.create')->with('error', 'Error creating enrollment.')->withInput();
    }
  }

  public function show(StudentCourse $studentCourse)
  {
    $studentCourse->load(['student', 'courseOffering.subject', 'courseOffering.teacher']);
    return view('admin.student_courses.show', compact('studentCourse'));
  }

  public function edit(StudentCourse $studentCourse)
  {
    $studentCourse->load(['student:id,name', 'courseOffering.subject:id,name,code']);

    $statuses = ['studying', 'suspended', 'dropped', 'completed'];
    $paymentStatuses = ['pending', 'paid', 'overdue', 'free'];

    return view('admin.student_courses.edit', compact('studentCourse', 'statuses', 'paymentStatuses'));
  }

  public function update(StudentCourseRequest $request, StudentCourse $studentCourse)
  {
    try {
      $studentCourse->update($request->validated());
      return redirect()->route('admin.student_courses.index')->with('success', 'Enrollment updated successfully');
    } catch (\Exception $e) {
      Log::error('Error updating StudentCourse: ' . $e->getMessage());
      return redirect()->route('admin.student_courses.edit', $studentCourse)->with('error', 'Error updating enrollment.')->withInput();
    }
  }

  public function destroy(StudentCourse $studentCourse)
  {
    try {
      $studentCourse->delete();
      return redirect()->route('admin.student_courses.index')->with('success', 'Enrollment deleted successfully');
    } catch (\Exception $e) {
      Log::error('Error deleting StudentCourse: ' . $e->getMessage());
      return redirect()->back()->with('error', 'Error deleting enrollment: ' . $e->getMessage());
    }
  }
}
