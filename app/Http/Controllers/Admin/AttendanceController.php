<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\CourseOffering;
use App\Models\User;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
  public function index(Request $request)
  {
    $courseOfferingId = $request->input('course_offering_id');
    $search = $request->input('search');
    $date = $request->input('date', date('Y-m-d'));

    $courseOffering = CourseOffering::with('students')->findOrFail($courseOfferingId);

    $studentsQuery = $courseOffering->students();

    if ($search) {
      $studentsQuery = $studentsQuery->where(function ($q) use ($search) {
        $q->where('name', 'like', "%{$search}%")
          ->orWhere('email', 'like', "%{$search}%");
      });
    }

    $students = $studentsQuery->with([
      'attendances' => function ($q) use ($courseOfferingId, $date) {
        $q->where('course_offering_id', $courseOfferingId)
          ->where('date', $date);
      }
    ])->get();

    return view('admin.attendance.index', compact('students', 'courseOffering', 'date'));
  }

  public function show($courseOfferingId, $studentId)
  {
    $courseOffering = CourseOffering::findOrFail($courseOfferingId);
    $student = User::findOrFail($studentId);

    $attendances = Attendance::where('student_id', $studentId)
      ->where('course_offering_id', $courseOfferingId)
      ->orderBy('date', 'desc')
      ->get();

    return view('admin.attendance.show', compact('student', 'courseOffering', 'attendances'));
  }

  public function saveAll(Request $request)
  {
    $courseOfferingId = $request->course_offering_id;
    $date = $request->date ?? date('Y-m-d');

    $courseOffering = CourseOffering::with('students')->findOrFail($courseOfferingId);

    foreach ($courseOffering->students as $student) {
      $status = $request->input("status_{$student->id}", 'absent');
      $remarks = $request->input("remarks_{$student->id}");

      Attendance::updateOrCreate(
        [
          'student_id' => $student->id,
          'course_offering_id' => $courseOfferingId,
          'date' => $date,
        ],
        [
          'classroom_id' => $courseOffering->classroom_id,
          'status' => $status,
          'remarks' => $remarks,
        ]
      );
    }

    return back()->with('success', 'Attendance saved successfully!');
  }
}