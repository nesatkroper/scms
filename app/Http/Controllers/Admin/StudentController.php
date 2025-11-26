<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Models\CourseOffering;
use App\Models\Fee;
use App\Models\FeeType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class StudentController extends Controller
{
  public function index(Request $request)
  {
    $studentRole = Role::where('name', 'student')->first();

    if (!$studentRole) {
      $students = User::where('id', 0);
      return view('admin.students.index', ['students' => $students->paginate(9)]);
    }

    $query = User::role('student')
      ->orderBy('created_at', 'desc')
      ->withCount(['fees', 'attendances', 'courseOfferings']);

    if ($search = $request->input('search')) {
      $query->where(function ($q) use ($search) {
        $q->where('name', 'like', '%' . $search . '%')
          ->orWhere('email', 'like', '%' . $search . '%');
      });
    }

    $students = $query->paginate(9);

    return view('admin.students.index', compact('students'));
  }

  public function feesIndex(User $student)
  {
    $fees = $student->fees()
      ->with(['payments', 'feeType', 'creator'])
      ->latest()
      ->paginate(15);

    return view('admin.students.fees.index', compact('student', 'fees'));
  }

  public function coursesIndex(User $student)
  {
    $courses = $student->courseOfferings()
      ->with(['subject', 'teacher', 'classroom'])
      ->latest('pivot_created_at')
      ->paginate(15);

    return view('admin.students.enrollments.index', compact('student', 'courses'));
  }



  public function create()
  {
    return view('admin.students.create');
  }

  public function createEnrollment(User $student)
  {
    $enrolledIds = $student->courseOfferings()->pluck('course_offering_id');

    $availableCourses = CourseOffering::with('subject', 'teacher')
      ->whereNotIn('id', $enrolledIds)
      ->get();

    return view('admin.students.enrollments.create', compact('student', 'availableCourses'));
  }

  public function createFee(User $student)
  {
    $feeTypes = FeeType::all();

    return view('admin.students.fees.create', compact('student', 'feeTypes'));
  }

  // public function store(StudentRequest $request)
  // {
  //   DB::beginTransaction();
  //   try {
  //     $data = $request->validated();

  //     $defaultPassword = 'password';

  //     if ($request->hasFile('avatar')) {
  //       $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
  //     }

  //     $student = User::create(array_merge($data, [
  //       'password' => bcrypt($defaultPassword),
  //     ]));

  //     $student->assignRole('student');

  //     DB::commit();
  //     return redirect()->route('admin.students.index')->with('success', 'Student created successfully. Default password is: ' . $defaultPassword);
  //   } catch (\Exception $e) {
  //     DB::rollBack();
  //     return redirect()->back()->with('error', 'Failed to create student: ' . $e->getMessage());
  //   }
  // }

  public function store(StudentRequest $request)
  {
    DB::beginTransaction();
    try {
      $data = $request->validated();
      $defaultPassword = 'password';

      $avatarPath = public_path('uploads/avatars');
      if (!file_exists($avatarPath)) {
        mkdir($avatarPath, 0755, true);
      }

      $data['avatar'] = null;
      if ($request->hasFile('avatar')) {
        $manager = new ImageManager(new Driver());
        $avatar = $request->file('avatar');
        $avatarName = time() . '-' . date('d-m-Y') . '_user_avatar.' . $avatar->getClientOriginalExtension();

        $image = $manager->read($avatar);
        $image->resize(640, 640);
        $image->save($avatarPath . '/' . $avatarName);

        $data['avatar'] = 'uploads/avatars/' . $avatarName;
      }

      $student = User::create(array_merge($data, [
        'password' => bcrypt($defaultPassword), // Using bcrypt for consistency with the original StudentController
        'avatar' => $data['avatar'], // Set the processed avatar path
      ]));

      $student->assignRole('student');

      DB::commit();
      return redirect()->route('admin.students.index')->with('success', 'Student created successfully. Default password is: ' . $defaultPassword);
    } catch (\Exception $e) {
      DB::rollBack();
      Log::error('Error creating student: ' . $e->getMessage()); // Use Log::error for consistency
      return redirect()->back()->withInput()->with('error', 'Failed to create student: ' . $e->getMessage());
    }
  }

  public function storeEnrollment(Request $request, User $student)
  {
    $validated = $request->validate([
      'course_offering_id' => [
        'required',
        'exists:course_offerings,id',
        Rule::unique('student_course')->where(function ($query) use ($student) {
          return $query->where('student_id', $student->id);
        }),
      ],
      'grade_final' => 'nullable|string|max:5',
      'status' => 'required|in:active,completed,dropped',
      'payment_status' => 'required|in:paid,pending,waived',
      'remarks' => 'nullable|string|max:255',
    ]);

    try {
      $student->courseOfferings()->attach($validated['course_offering_id'], [
        'grade_final' => $validated['grade_final'],
        'status' => $validated['status'],
        'payment_status' => $validated['payment_status'],
        'remarks' => $validated['remarks'],
        'created_at' => now(),
        'updated_at' => now(),
      ]);

      return redirect()->route('admin.students.courses.index', $student)
        ->with('success', 'Student successfully enrolled in the course offering.');
    } catch (\Exception $e) {
      return back()->withInput()->withErrors(['enrollment' => 'Failed to create enrollment. ' . $e->getMessage()]);
    }
  }

  public function storeFee(Request $request, User $student)
  {
    $validated = $request->validate([
      'fee_type_id' => 'required|exists:fee_types,id',
      'amount' => 'required|numeric|min:0.01',
      'due_date' => 'required|date',
      'status' => 'required|in:Draft,Due,Partial,Paid',
      'description' => 'nullable|string|max:255',
    ]);

    try {
      Fee::create([
        'student_id' => $student->id,
        'fee_type_id' => $validated['fee_type_id'],
        'amount' => $validated['amount'],
        'due_date' => $validated['due_date'],
        'status' => $validated['status'],
        'description' => $validated['description'],
        'created_by_id' => Auth::id(),
      ]);

      return redirect()->route('admin.students.fees.index', $student)
        ->with('success', 'New fee record successfully created.');
    } catch (\Exception $e) {
      return back()->withInput()->withErrors(['fee_creation' => 'Failed to create fee record. ' . $e->getMessage()]);
    }
  }

  public function show(User $student)
  {
    $student = $student->load([
      'fees.feeType',
      'payments.receiver',
      'attendances.courseOffering.subject',
      'scores.exam',
      'courseOfferings.subject',
      'courseOfferings.teacher',
    ]);

    $student = User::withCount(['fees', 'attendances'])
      ->findOrFail($student->id);


    return view('admin.students.show', compact('student'));
  }

  public function edit(User $student)
  {
    if (!$student->hasRole('student')) {
      return redirect()->route('admin.students.index')->with('error', 'User is not a student.');
    }

    return view('admin.students.edit', compact('student'));
  }

  // public function update(StudentRequest $request, User $student)
  // {
  //   if (!$student->hasRole('student')) {
  //     return redirect()->route('admin.students.index')->with('error', 'User is not a student.');
  //   }

  //   DB::beginTransaction();
  //   try {
  //     $data = $request->validated();

  //     if ($request->hasFile('avatar')) {
  //       if ($student->avatar) {
  //         Storage::disk('public')->delete($student->avatar);
  //       }
  //       $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
  //     } else {
  //       unset($data['password']);
  //     }

  //     if (isset($data['password'])) {
  //       $data['password'] = bcrypt($data['password']);
  //     }

  //     $student->update($data);

  //     DB::commit();
  //     return redirect()->route('admin.students.index')->with('success', 'Student updated successfully.');
  //   } catch (\Exception $e) {
  //     DB::rollBack();
  //     return redirect()->back()->with('error', 'Failed to update student: ' . $e->getMessage());
  //   }
  // }

  public function update(StudentRequest $request, User $student)
  {
    if (!$student->hasRole('student')) {
      return redirect()->route('admin.students.index')->with('error', 'User is not a student.');
    }

    DB::beginTransaction();
    try {
      $data = $request->validated();

      if ($request->hasFile('avatar')) {
        if ($student->avatar && file_exists(public_path($student->avatar))) {
          unlink(public_path($student->avatar));
        }

        $avatar = $request->file('avatar');
        $avatarName = time() . '-' . date('d-m-Y') . '_user_avatar.' . $avatar->getClientOriginalExtension();
        $avatarPath = public_path('uploads/avatars');

        if (!file_exists($avatarPath)) {
          mkdir($avatarPath, 0755, true);
        }

        $manager = new ImageManager(new Driver());
        $image = $manager->read($avatar);
        $image->resize(640, 640);
        $image->save($avatarPath . '/' . $avatarName);

        $data['avatar'] = 'uploads/avatars/' . $avatarName;
      } elseif ($request->input('clear_avatar')) { // Added 'clear_avatar' logic for consistency
        if ($student->avatar && file_exists(public_path($student->avatar))) {
          unlink(public_path($student->avatar));
        }
        $data['avatar'] = null;
      } else {

        unset($data['avatar']);
      }

      if (isset($data['password']) && !empty($data['password'])) {
        $data['password'] = bcrypt($data['password']);
      } else {
        unset($data['password']); // Remove password from data if not updating
      }

      $student->update($data);

      DB::commit();
      return redirect()->route('admin.students.index')->with('success', 'Student updated successfully.');
    } catch (\Exception $e) {
      DB::rollBack();
      Log::error('Error updating student: ' . $e->getMessage()); // Use Log::error for consistency
      return redirect()->back()->withInput()->with('error', 'Failed to update student: ' . $e->getMessage());
    }
  }

  // public function destroy(User $student)
  // {
  //   if (!$student->hasRole('student')) {
  //     return redirect()->route('admin.students.index')->with('error', 'User is not a student.');
  //   }

  //   if ($student->avatar) {
  //     Storage::disk('public')->delete($student->avatar);
  //   }

  //   $student->delete();

  //   return redirect()->route('admin.students.index')->with('success', 'Student deleted successfully.');
  // }

  public function destroy(User $student)
  {
    if (!$student->hasRole('student')) {
      return redirect()->route('admin.students.index')->with('error', 'User is not a student.');
    }

    if ($student->avatar && file_exists(public_path($student->avatar))) {
      unlink(public_path($student->avatar));
    }

    $student->delete();

    return redirect()->route('admin.students.index')->with('success', 'Student deleted successfully.');
  }
}