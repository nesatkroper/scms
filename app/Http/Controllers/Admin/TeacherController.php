<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Models\ExpenseCategory;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class TeacherController extends BaseController
{

  public function __construct()
  {
    parent::__construct();
    $this->applyPermissions();
  }

  protected function ModelPermissionName(): string
  {
    return 'Teacher';
  }
  public function index(Request $request)
  {
    $search = $request->input('search');
    $perPage = $request->input('per_page', 12);
    $viewType = $request->input('view', 'grid');

    $teachers = User::role('teacher')
      ->when($search, function ($query) use ($search) {
        return $query->where('name', 'like', "%{$search}%")
          ->orWhere('email', 'like', "%{$search}%")
          ->orWhere('qualification', 'like', "%{$search}%")
          ->orWhere('specialization', 'like', "%{$search}%");
      })
      ->orderBy('created_at', 'desc')
      ->paginate($perPage)
      ->appends($request->all());

    return view('admin.teachers.index', compact('teachers'));
  }

  public function create()
  {
    return view('admin.teachers.create');
  }

  public function store(StoreTeacherRequest $request)
  {
    try {
      $validated = $request->validated();

      // Handle photo upload
      if ($request->hasFile('avatar')) {
        $avatar = $request->file('avatar');
        $photoName = time() . '-' . date('d-m-Y') . '_add_' . $avatar->getClientOriginalName();
        $avatar->move(public_path('uploads/teacher'), $photoName);
        $validated['avatar'] = 'uploads/teacher/' . $photoName;
      }

      // Handle CV upload
      if ($request->hasFile('cv')) {
        $cv = $request->file('cv');
        $cvName = time() . '-' . date('d-m-Y') . '_add_' . $cv->getClientOriginalName();
        $cv->move(public_path('uploads/cv'), $cvName);
        $validated['cv'] = 'uploads/cv/' . $cvName;
      }

      // Set default password
      $validated['password'] = Hash::make($validated['password'] ?? 'password');

      $teacher = User::create($validated);
      $teacher->assignRole('teacher');

      return redirect()->route('admin.teachers.index')->with('success', 'Teacher created successfully 🎅!');
    } catch (\Exception $e) {
      Log::error('Teacher Store Error: ' . $e->getMessage());
      return back()->withInput()->with('error', 'Error creating teacher: ' . $e->getMessage());
    }
  }

  public function show(User $teacher)
  {
    if (!$teacher->hasRole('teacher')) {
      abort(404);
    }
    
    $teacher->load(['teachingCourses.subject', 'teachingCourses.classroom']);
    
    return view('admin.teachers.show', compact('teacher'));
  }

  public function edit(User $teacher)
  {
    if (!$teacher->hasRole('teacher')) {
      abort(404);
    }
    return view('admin.teachers.edit', compact('teacher'));
  }

  public function update(UpdateTeacherRequest $request, User $teacher)
  {
    try {
      if (!$teacher->hasRole('teacher')) {
        abort(404);
      }

      $data = $request->validated();

      // Handle photo upload
      if ($request->hasFile('avatar')) {
        if ($teacher->avatar && file_exists(public_path($teacher->avatar))) {
          unlink(public_path($teacher->avatar));
        }
        $avatar = $request->file('avatar');
        $photoName = time() . '-' . date('d-m-Y') . '_ed_' . $avatar->getClientOriginalName();
        $avatar->move(public_path('uploads/teacher'), $photoName);
        $data['avatar'] = 'uploads/teacher/' . $photoName;
      }

      // Handle CV upload
      if ($request->hasFile('cv')) {
        if ($teacher->cv && file_exists(public_path($teacher->cv))) {
          unlink(public_path($teacher->cv));
        }
        $cv = $request->file('cv');
        $cvName = time() . '-' . date('d-m-Y') . '_ed_' . $cv->getClientOriginalName();
        $cv->move(public_path('uploads/cv'), $cvName);
        $data['cv'] = 'uploads/cv/' . $cvName;
      }

      if (isset($data['password']) && !empty($data['password'])) {
        $data['password'] = Hash::make($data['password']);
      } else {
        unset($data['password']);
      }

      $teacher->update($data);

      return redirect()->route('admin.teachers.index')->with('success', 'Teacher updated successfully 🎅');
    } catch (\Exception $e) {
      Log::error('Teacher Update Error: ' . $e->getMessage());
      return back()->withInput()->with('error', 'Error updating teacher: ' . $e->getMessage());
    }
  }

  public function destroy(User $teacher)
  {
    try {
      if (!$teacher->hasRole('teacher')) {
        abort(404);
      }

      if ($teacher->avatar && file_exists(public_path($teacher->avatar))) {
        unlink(public_path($teacher->avatar));
      }
      if ($teacher->cv && file_exists(public_path($teacher->cv))) {
        unlink(public_path($teacher->cv));
      }

      $teacher->delete();

      return redirect()->route('admin.teachers.index')->with('success', 'Teacher deleted successfully');
    } catch (\Exception $e) {
      return back()->with('error', 'Error deleting teacher: ' . $e->getMessage());
    }
  }

  public function bulkDelete(Request $request)
  {
    $ids = $request->input('ids');

    if (empty($ids)) {
      return response()->json([
        'success' => false,
        'message' => 'No teachers selected'
      ], 400);
    }

    try {
      $teachers = User::role('teacher')->whereIn('id', $ids)->get();

      foreach ($teachers as $teacher) {
        // Delete associated files
        if ($teacher->avatar) {
          $photoPath = public_path($teacher->avatar);
          if (file_exists($photoPath)) {
            unlink($photoPath);
          }
        }
        if ($teacher->cv) {
          $cvPath = public_path($teacher->cv);
          if (file_exists($cvPath)) {
            unlink($cvPath);
          }
        }
        $teacher->delete();
      }

      return response()->json([
        'success' => true,
        'message' => count($teachers) . ' teachers deleted successfully'
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'success' => false,
        'message' => 'Error deleting teachers: ' . $e->getMessage()
      ], 500);
    }
  }

  public function getBulkData(Request $request)
  {
    $ids = $request->input('ids');

    if (empty($ids)) {
      return response()->json([
        'success' => false,
        'message' => 'No teachers selected'
      ], 400);
    }

    if (count($ids) > 5) {
      return response()->json([
        'success' => false,
        'message' => 'You can only edit up to 5 teachers at a time'
      ], 400);
    }

    try {
      $teachers = User::role('teacher')->whereIn('id', $ids)->get();
      return response()->json([
        'success' => true,
        'data' => $teachers
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'success' => false,
        'message' => 'Error fetching teachers: ' . $e->getMessage()
      ], 500);
    }
  }

  public function bulkUpdate(Request $request)
  {
    $request->validate([
      'teachers' => 'required|array',
      'teachers.*.id' => 'required|exists:users,id',
    ]);

    $updatedCount = 0;

    foreach ($request->input('teachers') as $teacherData) {
      $validator = Validator::make($teacherData, [
        'id' => 'required|exists:users,id',
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $teacherData['id'],
        'gender' => 'required|in:male,female',
        'date_of_birth' => 'required|date',
        'joining_date' => 'required|date',
        'qualification' => 'required|string|max:255',
        'experience' => 'nullable|integer|min:0|max:60',
        'phone' => ['nullable', 'string', 'max:20', 'regex:/^(?:\+855|0)\s?(?:\d{2,3})(?:\s?\d{3})(?:\s?\d{3})$/'],
        'address' => 'nullable|string',
        'specialization' => 'nullable|string',
        'salary' => 'nullable|numeric|min:0',
        'blood_group' => 'nullable|string|max:10',
        'nationality' => 'nullable|string|max:255',
        'religion' => 'nullable|string|max:255',
      ]);

      if ($validator->fails()) {
        Log::error("Validation failed for teacher ID {$teacherData['id']}: " . json_encode($validator->errors()));
        continue;
      }

      try {
        $teacher = User::findOrFail($teacherData['id']);
        // Ensure we're only updating teachers
        if ($teacher->hasRole('teacher')) {
          $teacher->update($validator->validated());
          $updatedCount++;
        }
      } catch (\Exception $e) {
        Log::error("Error updating teacher: " . $e->getMessage());
      }
    }

    return response()->json([
      'success' => true,
      'message' => "Successfully updated $updatedCount teachers",
      'redirect' => route('admin.teachers.index')
    ]);
  }
}
