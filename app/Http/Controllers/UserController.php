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

class UserController extends Controller
{
  public function index(): \Illuminate\View\View
  {
    $users = User::paginate(10);
    $roles = Role::all();

    return view('admin.users.index', compact('users', 'roles'));
  }

  public function create(): \Illuminate\View\View
  {
    $roles = Role::all();
    return view('admin.users.index', compact('roles'));
  }

  public function store(Request $request): \Illuminate\Http\JsonResponse
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

    $manager = new ImageManager(new Driver());

    if ($request->hasFile('avatar')) {
      $image = $manager->read($request->file('avatar'));
      $image->resize(640, 640);

      $fileName = time() . '_user_avatar.' . $request->file('avatar')->getClientOriginalExtension();
      $dir = public_path('avatars');

      if (!File::isDirectory($dir)) {
        File::makeDirectory($dir, 0755, true, true);
      }

      $image->save($dir . '/' . $fileName);
      $validatedData['avatar'] = 'avatars/' . $fileName;
    } else {
      $validatedData['avatar'] = null;
    }

    $user = User::create([
      'name' => $validatedData['name'],
      'email' => $validatedData['email'],
      'password' => Hash::make($validatedData['password']),
      'phone' => $validatedData['phone'],
      'address' => $validatedData['address'],
      'date_of_birth' => $validatedData['date_of_birth'],
      'gender' => $validatedData['gender'],
      'avatar' => $validatedData['avatar'],
      'email_verified_at' => null,
    ]);

    $user->assignRole($validatedData['type']);

    return response()->json(['success' => true, 'message' => 'User created successfully!']);
  }

  public function show(User $user): \Illuminate\Http\JsonResponse
  {
    return response()->json(['success' => true, 'user' => $user->load('roles')]);
  }

  public function edit(User $user): \Illuminate\View\View
  {
    $roles = Role::all();
    return view('admin.users.index', compact('user', 'roles'));
  }

  public function update(Request $request, User $user): \Illuminate\Http\JsonResponse
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

    $data = $request->only([
      'name',
      'email',
      'phone',
      'address',
      'date_of_birth',
      'gender',
    ]);

    $manager = new ImageManager(new Driver());

    if ($request->hasFile('avatar')) {
      if ($user->avatar && File::exists(public_path($user->avatar))) {
        File::delete(public_path($user->avatar));
      }

      $image = $manager->read($request->file('avatar'));
      $image->resize(640, 640);

      $fileName = time() . '_user_avatar.' . $request->file('avatar')->getClientOriginalExtension();
      $dir = public_path('avatars');
      if (!File::isDirectory($dir)) {
        File::makeDirectory($dir, 0755, true, true);
      }
      $image->save($dir . '/' . $fileName);
      $data['avatar'] = 'avatars/' . $fileName;
    } elseif ($request->input('clear_avatar')) {
      if ($user->avatar && File::exists(public_path($user->avatar))) {
        File::delete(public_path($user->avatar));
      }
      $data['avatar'] = null;
    } else {
      $data['avatar'] = $user->avatar;
    }

    if ($request->filled('password')) {
      $data['password'] = Hash::make($request->password);
    }

    $user->update($data);

    $user->syncRoles($validatedData['type']);

    return response()->json(['success' => true, 'message' => 'User updated successfully!']);
  }

  public function destroy(User $user): \Illuminate\Http\JsonResponse
  {
    if ($user->avatar && File::exists(public_path($user->avatar))) {
      File::delete(public_path($user->avatar));
    }

    $user->delete();

    return response()->json(['success' => true, 'message' => 'User deleted successfully!']);
  }
}
