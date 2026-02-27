<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\EnrollmentRequest;
use App\Models\Enrollment;
use App\Models\CourseOffering;
use App\Models\User;
use App\Notifications\NewCourseEnrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class EnrollmentController extends BaseController
{
  public function __construct()
  {
    parent::__construct();
    $this->applyPermissions();
  }

  protected function ModelPermissionName(): string
  {
    return 'Enrollment';
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

    $query = Enrollment::query()
      ->with(['student:id,name', 'courseOffering.subject:id,name', 'fee'])
      ->where('course_offering_id', $courseOfferingId);

    if ($search) {
      $query->where(function ($q) use ($search) {
        $q->where('status', 'like', "%{$search}%")
          ->orWhereHas('student', function ($q2) use ($search) {
            $q2->where('name', 'like', "%{$search}%");
          })
          ->orWhereHas('courseOffering.subject', function ($q3) use ($search) {
            $q3->where('name', 'like', "%{$search}%");
          });
      });
    }

    $enrollments = $query->orderBy('created_at', 'desc')->get();

    return view('admin.enrollments.index', compact('enrollments', 'courseOffering'));
  }


  public function create(Request $request)
  {
    $courseOfferingId = $request->input('course_offering_id');

    if (! $courseOfferingId) {
      return redirect()->route('admin.course_offerings.index')
        ->with('error', 'Course Offering ID is required.');
    }

    $courseOffering = CourseOffering::with('subject:id,name')->findOrFail($courseOfferingId);

    $enrolledStudentIds = Enrollment::where('course_offering_id', $courseOfferingId)
      ->pluck('student_id');

    $students = User::role('student')
      ->whereNotIn('id', $enrolledStudentIds)
      ->orderBy('name')
      ->get(['id', 'name']);

    if ($students->isEmpty()) {
      return redirect()->route('admin.enrollments.index', ['course_offering_id' => $courseOfferingId])
        ->with('error', 'All students are already enrolled in this course.');
    }

    $statuses = ['studying', 'suspended', 'dropped', 'completed'];
    $paymentStatuses = ['pending', 'paid', 'overdue', 'free'];

    return view('admin.enrollments.create', compact(
      'students',
      'courseOffering',
      'statuses',
      'paymentStatuses',
      'courseOfferingId'
    ));
  }

  public function store(EnrollmentRequest $request)
  {
    $data = $request->validated();

    $exists = Enrollment::where('student_id', $data['student_id'])
      ->where('course_offering_id', $data['course_offering_id'])
      ->exists();

    if ($exists) {
      return back()
        ->with('error', 'This student is already enrolled in this course offering.')
        ->withInput();
    }

    DB::beginTransaction();

    try {
      $enrollment = Enrollment::create([
        'student_id'        => $data['student_id'],
        'course_offering_id' => $data['course_offering_id'],
        'status'            => $data['status'] ?? 'active',
        'remarks'           => $data['remarks'] ?? null,
      ]);

      $notifiableUsers = User::role(['admin', 'staff'])->get();
      Notification::send($notifiableUsers, new NewCourseEnrollment($enrollment));

      $type_id = $enrollment->fee->feeType->id;

      DB::commit();

      return redirect()
        ->route('admin.fees.index', ['fee_type_id' => $type_id])
        ->with('success', 'Enrollment & fee created successfully!');
    } catch (\Exception $e) {
      DB::rollBack();
      Log::error('Error creating enrollment: ' . $e->getMessage());

      return back()->with('error', 'Error creating enrollment.' . $e->getMessage())->withInput();
    }
  }


  public function show($student_id, $course_offering_id)
  {
    return redirect()->route('admin.enrollments.certificate', [$student_id, $course_offering_id]);
  }

  public function edit($student_id, $course_offering_id)
  {
    $enrollment = Enrollment::where('student_id', $student_id)
      ->where('course_offering_id', $course_offering_id)
      ->firstOrFail();

    $student = User::select('id', 'name')->findOrFail($student_id);

    $courseOffering = CourseOffering::with('subject:id,name')
      ->findOrFail($course_offering_id);

    $statuses = ['studying', 'suspended', 'dropped', 'completed'];
    $paymentStatuses = ['pending', 'paid', 'overdue', 'free'];

    return view('admin.enrollments.edit', compact(
      'enrollment',
      'student',
      'courseOffering',
      'statuses',
      'paymentStatuses'
    ));
  }

  public function update(EnrollmentRequest $request, $student_id, $course_offering_id)
  {
    $enrollment = Enrollment::where('student_id', $student_id)
      ->where('course_offering_id', $course_offering_id)
      ->firstOrFail();

    // Only update fields allowed
    $safe = collect($request->validated())
      ->except(['student_id', 'course_offering_id'])
      ->toArray();

    try {
      $enrollment->update($safe);

      return redirect()->route('admin.enrollments.index', [
        'course_offering_id' => $course_offering_id
      ])->with('success', 'Enrollment updated successfully.');
    } catch (\Exception $e) {
      return redirect()->back()->with('error', 'Error updating enrollment: ' . $e->getMessage())
        ->withInput();
    }
  }

  public function showCertificate($student_id, $course_offering_id)
  {
    $enrollment = Enrollment::where('student_id', $student_id)
      ->where('course_offering_id', $course_offering_id)
      ->with(['student', 'courseOffering.subject', 'courseOffering.teacher'])
      ->firstOrFail();

    // Convert images to Base64 for a smooth "Capture" experience in the browser
    $images = [];
    $imageFiles = [
      'frame' => public_path('assets/images/frame.png'),
      'logo'  => public_path('assets/images/scms.png'),
      'stamp' => public_path('assets/images/stamp.png'),
    ];

    foreach ($imageFiles as $key => $filePath) {
      if (file_exists($filePath)) {
        $images[$key] = 'data:image/png;base64,' . base64_encode(file_get_contents($filePath));
      } else {
        $images[$key] = null;
      }
    }

    // Pre-fetch QR code as Base64
    $qrUrl = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=" . urlencode(route('admin.enrollments.certificate', [$enrollment->student_id, $enrollment->course_offering_id]));
    try {
      $qrContent = @file_get_contents($qrUrl);
      $images['qr'] = $qrContent ? 'data:image/png;base64,' . base64_encode($qrContent) : null;
    } catch (\Exception $e) {
      $images['qr'] = null;
    }

    // Convert student avatar to Base64
    $avatarUrl = null;
    if ($enrollment->student->avatar) {
      $avatarPath = public_path('storage/' . $enrollment->student->avatar);
      if (file_exists($avatarPath)) {
        $avatarUrl = 'data:image/' . pathinfo($avatarPath, PATHINFO_EXTENSION) . ';base64,' . base64_encode(file_get_contents($avatarPath));
      }
    }
    $images['avatar_url'] = $avatarUrl;

    return view('admin.enrollments.certificate', [
      'enrollment' => $enrollment,
      'is_pdf'     => false,
      'b64Images'  => $images
    ]);
  }

  public function bulkCertificate($course_offering_id)
  {
    $enrollments = Enrollment::where('course_offering_id', $course_offering_id)
      ->with(['student', 'courseOffering.subject', 'courseOffering.teacher'])
      ->get();

    if ($enrollments->isEmpty()) {
      return back()->with('error', 'No students enrolled in this course.');
    }

    // Base images
    $images = [];
    $imageFiles = [
      'frame' => public_path('assets/images/frame.png'),
      'logo'  => public_path('assets/images/scms.png'),
      'stamp' => public_path('assets/images/stamp.png'),
    ];

    foreach ($imageFiles as $key => $filePath) {
      if (file_exists($filePath)) {
        $images[$key] = 'data:image/png;base64,' . base64_encode(file_get_contents($filePath));
      } else {
        $images[$key] = null;
      }
    }

    return view('admin.enrollments.bulk_certificate', [
      'enrollments' => $enrollments,
      'b64Images'   => $images
    ]);
  }

  public function generateSingleCertificate($student_id, $course_offering_id)
  {
    try {
      set_time_limit(120);
      ini_set('memory_limit', '512M');
      Log::info("Starting PDF generation for Student: {$student_id}, Offering: {$course_offering_id}");

      $enrollment = Enrollment::where('student_id', $student_id)
        ->where('course_offering_id', $course_offering_id)
        ->with(['student', 'courseOffering.subject', 'courseOffering.teacher'])
        ->firstOrFail();

      $directory = public_path('uploads/certificates');
      if (! file_exists($directory)) {
        mkdir($directory, 0755, true);
      }

      Log::info("Preparing QR Code...");
      $qrUrl = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=" . urlencode(route('admin.enrollments.certificate', [$enrollment->student_id, $enrollment->course_offering_id]));
      try {
        $qrContent = @file_get_contents($qrUrl);
        $qrBase64 = $qrContent ? 'data:image/png;base64,' . base64_encode($qrContent) : null;
      } catch (\Exception $e) {
        $qrBase64 = null;
      }

      Log::info("Loading PDF view...");
      $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.enrollments.certificate_pdf', [
        'enrollment' => $enrollment,
        'is_pdf'     => true,
        'qrBase64'   => $qrBase64
      ]);

      $pdf->setPaper('a4', 'landscape')
        ->setOptions([
          'isHtml5ParserEnabled' => true,
          'isRemoteEnabled'      => false, // Important: keep false for stability
          'defaultFont'          => 'sans-serif',
          'tempDir'              => storage_path('app'),
        ]);

      $filename = 'cert_' . $student_id . '_' . $course_offering_id . '.pdf';
      $path = 'uploads/certificates/' . $filename;

      Log::info("Saving PDF to: " . public_path($path));
      $pdf->save(public_path($path));
      Log::info("PDF saved successfully.");

      $enrollment->update(['certificate' => $path]);

      return back()->with('success', 'Certificate generated and saved successfully.');
    } catch (\Exception $e) {
      Log::error("Failed to generate certificate: " . $e->getMessage());
      return "Error: " . $e->getMessage();
    } catch (\Throwable $t) {
      Log::error("Critical error in PDF generation: " . $t->getMessage());
      return "Critical Error: " . $t->getMessage();
    }
  }

  public function generateImageCertificate(Request $request, $student_id, $course_offering_id)
  {
    $request->validate([
      'image' => 'required|string',
    ]);

    $enrollment = Enrollment::where('student_id', $student_id)
      ->where('course_offering_id', $course_offering_id)
      ->firstOrFail();

    $directory = public_path('uploads/certificates');
    if (! file_exists($directory)) {
      mkdir($directory, 0755, true);
    }

    try {
      $imageData = $request->input('image');
      $imageData = str_replace('data:image/png;base64,', '', $imageData);
      $imageData = str_replace(' ', '+', $imageData);
      $imageBinary = base64_decode($imageData);

      $filename = 'cert_' . $student_id . '_' . $course_offering_id . '.png';
      $path = 'uploads/certificates/' . $filename;

      file_put_contents(public_path($path), $imageBinary);

      $enrollment->update(['certificate' => $path]);

      return response()->json([
        'success' => true,
        'message' => 'Certificate image saved successfully.',
        'url'     => asset($path)
      ]);
    } catch (\Exception $e) {
      Log::error("Failed to save certificate image: " . $e->getMessage());
      return response()->json([
        'success' => false,
        'message' => 'Failed to save image: ' . $e->getMessage()
      ], 500);
    }
  }

  public function destroy($student_id, $course_offering_id)
  {
    $enrollment = Enrollment::where('student_id', $student_id)
      ->where('course_offering_id', $course_offering_id)
      ->firstOrFail();

    $courseOfferingId = $enrollment->course_offering_id;

    try {
      $enrollment->delete();

      return redirect()->route('admin.enrollments.index', ['course_offering_id' => $courseOfferingId])
        ->with('success', 'Enrollment deleted successfully');
    } catch (\Exception $e) {
      Log::error('Error deleting Enrollment: ' . $e->getMessage());
      return redirect()->back()->with('error', 'Error deleting enrollment.');
    }
  }
}
