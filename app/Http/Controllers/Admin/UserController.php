<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
  public function index(Request $request)
  {
    $search = $request->input('search');
    $perPage = $request->input('per_page', 8);
    $roleFilter = $request->input('role_filter');

    $roles = Role::all();


    $users = User::with(['roles', 'department'])
      ->when($search, function ($query) use ($search) {
        return $query->where('name', 'like', "%{$search}%")
          ->orWhere('email', 'like', "%{$search}%")
          ->orWhere('phone', 'like', "%{$search}%");
      })
      ->when($roleFilter, function ($query) use ($roleFilter) {
        return $query->role($roleFilter);
      })
      ->orderBy('created_at', 'desc')
      ->paginate($perPage)
      ->appends([
        'search' => $search,
        'per_page' => $perPage,
        'role_filter' => $roleFilter,
      ]);

    return view('admin.users.index', compact('users', 'roles', 'roleFilter', 'departments'));
  }

  public function create()
  {
    $roles = Role::all();

    return view('admin.users.create', compact('roles', 'departments'));
  }

  public function store(Request $request)
  {
    $validatedData = $request->validate([
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
      'password' => ['required', 'string', 'min:8'],
      'type' => ['required', 'string', Rule::exists('roles', 'name')],
      'phone' => ['nullable', 'string', 'max:255'],
      'address' => ['nullable', 'string'],
      'date_of_birth' => ['nullable', 'date'],
      'gender' => ['nullable', Rule::in(['male', 'female', 'other'])],
      'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
      'nationality' => ['nullable', 'string', 'max:255'],
      'religion' => ['nullable', 'string', 'max:255'],
      'blood_group' => ['nullable', 'string', 'max:10'],
      'department_id' => ['nullable', 'integer', Rule::exists('departments', 'id')],
      'joining_date' => ['nullable', 'date'],
      'qualification' => ['nullable', 'string', 'max:255'],
      'experience' => ['nullable', 'numeric', 'min:0'],
      'specialization' => ['nullable', 'string', 'max:255'],
      'salary' => ['nullable', 'numeric', 'min:0'],
      'cv' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
      'admission_date' => ['nullable', 'date'],
      'occupation' => ['nullable', 'string', 'max:255'],
      'company' => ['nullable', 'string', 'max:255'],
    ]);

    try {
      $avatarPath = public_path('uploads/avatars');
      if (!file_exists($avatarPath)) {
        mkdir($avatarPath, 0755, true);
      }

      $validatedData['avatar'] = null;
      if ($request->hasFile('avatar')) {
        $manager = new ImageManager(new Driver());
        $avatar = $request->file('avatar');
        $avatarName = time() . '-' . date('d-m-Y') . '_user_avatar.' . $avatar->getClientOriginalExtension();

        $image = $manager->read($avatar);
        $image->resize(640, 640);
        $image->save($avatarPath . '/' . $avatarName);

        $validatedData['avatar'] = 'uploads/avatars/' . $avatarName;
      }

      $user = User::create(array_merge($validatedData, [
        'password' => Hash::make($validatedData['password']),
        'avatar' => $validatedData['avatar'],
      ]));

      $user->assignRole($validatedData['type']);

      return redirect()->route('admin.users.index')->with('success', 'User created successfully!');
    } catch (\Exception $e) {
      Log::error('Error creating user: ' . $e->getMessage());
      return back()->withInput()->with('error', 'Error creating user: ' . $e->getMessage());
    }
  }

  public function edit(User $user)
  {
    $user->load('roles');
    $roles = Role::all();

    return view('admin.users.edit', compact('user', 'roles', 'departments'));
  }

  public function update(Request $request, User $user)
  {
    $validatedData = $request->validate([
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
      'password' => ['nullable', 'string', 'min:8'],
      'type' => ['required', 'string', Rule::exists('roles', 'name')],
      'phone' => ['nullable', 'string', 'max:255'],
      'address' => ['nullable', 'string'],
      'date_of_birth' => ['nullable', 'date'],
      'gender' => ['nullable', Rule::in(['male', 'female', 'other'])],
      'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
      'nationality' => ['nullable', 'string', 'max:255'],
      'religion' => ['nullable', 'string', 'max:255'],
      'blood_group' => ['nullable', 'string', 'max:10'],
      'department_id' => ['nullable', 'integer', Rule::exists('departments', 'id')],
      'joining_date' => ['nullable', 'date'],
      'qualification' => ['nullable', 'string', 'max:255'],
      'experience' => ['nullable', 'numeric', 'min:0'],
      'specialization' => ['nullable', 'string', 'max:255'],
      'salary' => ['nullable', 'numeric', 'min:0'],
      'cv' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
      'admission_date' => ['nullable', 'date'],
      'occupation' => ['nullable', 'string', 'max:255'],
      'company' => ['nullable', 'string', 'max:255'],
    ]);

    try {
      $data = $request->only([
        'name',
        'email',
        'phone',
        'address',
        'date_of_birth',
        'gender',
        'nationality',
        'religion',
        'blood_group',
        'department_id',
        'joining_date',
        'qualification',
        'experience',
        'specialization',
        'salary',
        'admission_date',
        'occupation',
        'company',
      ]);

      if ($request->hasFile('avatar')) {
        if ($user->avatar && file_exists(public_path($user->avatar))) {
          unlink(public_path($user->avatar));
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
      } elseif ($request->input('clear_avatar')) {
        if ($user->avatar && file_exists(public_path($user->avatar))) {
          unlink(public_path($user->avatar));
        }
        $data['avatar'] = null;
      }

      if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
      }

      $user->update($data);
      $user->syncRoles($validatedData['type']);

      if ($user->student && ($validatedData['type'] === 'student')) {
        $studentData = [
          'name' => $user->name,
          'email' => $user->email,
          'phone' => $user->phone,
          'gender' => $user->gender,
          'dob' => $user->date_of_birth,
          'photo' => $user->avatar,
        ];
        if (isset($data['avatar'])) {
          $studentData['photo'] = $data['avatar'];
        }
        if ($user->student) {
          $user->student->update($studentData);
        }
      }

      return redirect()->route('admin.users.index')->with('success', 'User updated successfully!');
    } catch (\Exception $e) {
      Log::error('Error updating user: ' . $e->getMessage());
      return back()->withInput()->with('error', 'Error updating user: ' . $e->getMessage());
    }
  }

  public function destroy(User $user)
  {
    try {
      if ($user->avatar && file_exists(public_path($user->avatar))) {
        unlink(public_path($user->avatar));
      }

      $user->delete();

      return redirect()->route('admin.users.index')->with('success', 'User deleted successfully!');
    } catch (\Exception $e) {
      Log::error('Error deleting user: ' . $e->getMessage());
      return back()->with('error', 'Error deleting user: ' . $e->getMessage());
    }
  }
}
