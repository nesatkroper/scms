<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
  public function index(Request $request)
  {
    $studentRole = Role::where('name', 'student')->first();

    if (!$studentRole) {
      $students = User::where('id', 0);
      return view('admin.students.index', ['students' => $students->paginate(8)]);
    }

    $query = User::role('student')
      ->orderBy('created_at', 'desc')
      ->withCount(['fees', 'attendances']);

    if ($search = $request->input('search')) {
      $query->where(function ($q) use ($search) {
        $q->where('name', 'like', '%' . $search . '%')
          ->orWhere('email', 'like', '%' . $search . '%');
      });
    }

    $students = $query->paginate(8);

    return view('admin.students.index', compact('students'));
  }

  public function create()
  {
    return view('admin.students.create');
  }

  public function store(StudentRequest $request)
  {
    DB::beginTransaction();
    try {
      $data = $request->validated();

      $defaultPassword = 'password';

      if ($request->hasFile('avatar')) {
        $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
      }

      $student = User::create(array_merge($data, [
        'password' => bcrypt($defaultPassword),
      ]));

      $student->assignRole('student');

      DB::commit();
      return redirect()->route('admin.students.index')->with('success', 'Student created successfully. Default password is: ' . $defaultPassword);
    } catch (\Exception $e) {
      DB::rollBack();
      return redirect()->back()->with('error', 'Failed to create student: ' . $e->getMessage());
    }
  }

  public function show(User $student)
  {
    return view('admin.students.show', compact('student'));
  }


  public function edit(User $student)
  {
    if (!$student->hasRole('student')) {
      return redirect()->route('admin.students.index')->with('error', 'User is not a student.');
    }

    return view('admin.students.edit', compact('student'));
  }

  public function update(StudentRequest $request, User $student)
  {
    if (!$student->hasRole('student')) {
      return redirect()->route('admin.students.index')->with('error', 'User is not a student.');
    }

    DB::beginTransaction();
    try {
      $data = $request->validated();

      if ($request->hasFile('avatar')) {
        if ($student->avatar) {
          Storage::disk('public')->delete($student->avatar);
        }
        $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
      } else {
        unset($data['password']);
      }

      if (isset($data['password'])) {
        $data['password'] = bcrypt($data['password']);
      }

      $student->update($data);

      DB::commit();
      return redirect()->route('admin.students.index')->with('success', 'Student updated successfully.');
    } catch (\Exception $e) {
      DB::rollBack();
      return redirect()->back()->with('error', 'Failed to update student: ' . $e->getMessage());
    }
  }

  public function destroy(User $student)
  {
    if (!$student->hasRole('student')) {
      return redirect()->route('admin.students.index')->with('error', 'User is not a student.');
    }

    if ($student->avatar) {
      Storage::disk('public')->delete($student->avatar);
    }

    $student->delete();

    return redirect()->route('admin.students.index')->with('success', 'Student deleted successfully.');
  }
}
