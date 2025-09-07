<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
  public function index(Request $request)
  {
    $search = $request->input('search');
    $perPage = $request->input('per_page', 10);
    $roles = Role::all();

    $users = User::with('roles')
      ->when($search, function ($query) use ($search) {
        return $query->where('name', 'like', "%{$search}%")
          ->orWhere('email', 'like', "%{$search}%")
          ->orWhere('phone', 'like', "%{$search}%");
      })
      ->orderBy('created_at', 'desc')
      ->paginate($perPage)
      ->appends([
        'search' => $search,
        'per_page' => $perPage
      ]);

    if ($request->ajax()) {
      $html = [
        'table' => view('admin.users.partials.table', compact('users'))->render(),
        'pagination' => $users->links()->toHtml()
      ];

      return response()->json([
        'success' => true,
        'html' => $html
      ]);
    }

    return view('admin.users.index', compact('users', 'roles'));
  }

  public function store(Request $request)
  {
    $validatedData = $request->validate([
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
      'password' => ['required', 'string', 'min:8', 'confirmed'],
      'type' => ['required', 'string', Rule::exists('roles', 'name')],
      'phone' => ['nullable', 'string', 'max:255'],
      'address' => ['nullable', 'string'],
      'date_of_birth' => ['nullable', 'date'],
      'gender' => ['nullable', Rule::in(['male', 'female', 'other'])],
      'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
    ]);

    try {
      $avatarPath = public_path('photos/avatars');
      if (!file_exists($avatarPath)) {
        mkdir($avatarPath, 0755, true);
      }

      if ($request->hasFile('avatar')) {
        $manager = new ImageManager(new Driver());
        $avatar = $request->file('avatar');
        $avatarName = time() . '-' . date('d-m-Y') . '_user_avatar.' . $avatar->getClientOriginalExtension();

        // Resize and save
        $image = $manager->read($avatar);
        $image->resize(640, 640);
        $image->save($avatarPath . '/' . $avatarName);

        $validatedData['avatar'] = 'photos/avatars/' . $avatarName;
      }

      $user = User::create([
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'password' => Hash::make($validatedData['password']),
        'phone' => $validatedData['phone'],
        'address' => $validatedData['address'],
        'date_of_birth' => $validatedData['date_of_birth'],
        'gender' => $validatedData['gender'],
        'avatar' => $validatedData['avatar'] ?? null,
      ]);

      $user->assignRole($validatedData['type']);

      return response()->json([
        'success' => true,
        'message' => 'User created successfully!',
        'user' => $user
      ]);
    } catch (\Exception $e) {
      Log::error('Error creating user: ' . $e->getMessage());
      return response()->json([
        'success' => false,
        'message' => 'Error creating user: ' . $e->getMessage()
      ], 500);
    }
  }

  public function show(User $user)
  {
    $user->load('roles');
    return response()->json([
      'success' => true,
      'user' => $user
    ]);
  }

  public function update(Request $request, User $user)
  {
    $validatedData = $request->validate([
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
      'password' => ['nullable', 'string', 'min:8', 'confirmed'],
      'type' => ['required', 'string', Rule::exists('roles', 'name')],
      'phone' => ['nullable', 'string', 'max:255'],
      'address' => ['nullable', 'string'],
      'date_of_birth' => ['nullable', 'date'],
      'gender' => ['nullable', Rule::in(['male', 'female', 'other'])],
      'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
    ]);

    try {
      $data = $request->only([
        'name',
        'email',
        'phone',
        'address',
        'date_of_birth',
        'gender',
      ]);

      // Handle avatar upload
      if ($request->hasFile('avatar')) {
        // Delete old avatar if exists
        if ($user->avatar && file_exists(public_path($user->avatar))) {
          unlink(public_path($user->avatar));
        }

        $avatar = $request->file('avatar');
        $avatarName = time() . '-' . date('d-m-Y') . '_user_avatar.' . $avatar->getClientOriginalExtension();
        $avatarPath = public_path('photos/avatars');

        if (!file_exists($avatarPath)) {
          mkdir($avatarPath, 0755, true);
        }

        // Resize and save
        $manager = new ImageManager(new Driver());
        $image = $manager->read($avatar);
        $image->resize(640, 640);
        $image->save($avatarPath . '/' . $avatarName);

        $data['avatar'] = 'photos/avatars/' . $avatarName;
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
      // =========
      if ($user->studen && ($validatedData['type'] === 'student')) {
        $user->student->update([
          'name' => $user->name,
          'email' => $user->email,
          'phone' => $user->phone,
          'gender' => $user->gender,
          'dob' => $user->date_of_birth,
          'photo' => $user->avatar,
        ]);
        if (isset($data['avatar'])) {
          $studentData['photo'] = $data['avatar'];
        }
        if ($user->student) {
          $user->student->update($studentData);
        }
      }
      // =========
      return response()->json([
        'success' => true,
        'message' => 'User updated successfully!',
        'user' => $user->fresh('roles')
      ]);
    } catch (\Exception $e) {
      Log::error('Error updating user: ' . $e->getMessage());
      return response()->json([
        'success' => false,
        'message' => 'Error updating user: ' . $e->getMessage()
      ], 500);
    }
  }

  public function destroy(User $user)
  {
    try {
      // Delete avatar if exists
      if ($user->avatar && file_exists(public_path($user->avatar))) {
        unlink(public_path($user->avatar));
      }

      $user->delete();

      return response()->json([
        'success' => true,
        'message' => 'User deleted successfully!'
      ]);
    } catch (\Exception $e) {
      Log::error('Error deleting user: ' . $e->getMessage());
      return response()->json([
        'success' => false,
        'message' => 'Error deleting user: ' . $e->getMessage()
      ], 500);
    }
  }
}
