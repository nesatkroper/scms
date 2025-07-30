<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
  public function index(): \Illuminate\View\View
  {
    $users = User::paginate(10);

    return view('admin.users.index', compact('users'));
  }

  public function create(): \Illuminate\View\View
  {
    return view('users.create');
  }

  public function store(Request $request): \Illuminate\Http\RedirectResponse
  {
    $request->validate([
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
      'password' => ['required', 'string', 'min:8', 'confirmed'],
      'type' => ['required', Rule::in(['admin', 'teacher', 'student', 'parent', 'staff'])],
      'phone' => ['nullable', 'string', 'max:255'],
      'address' => ['nullable', 'string'],
      'date_of_birth' => ['nullable', 'date'],
      'gender' => ['nullable', Rule::in(['male', 'female', 'other'])],
      'avatar' => ['nullable', 'string', 'max:2048'],
    ]);

    User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password),
      'type' => $request->type,
      'phone' => $request->phone,
      'address' => $request->address,
      'date_of_birth' => $request->date_of_birth,
      'gender' => $request->gender,
      'avatar' => $request->avatar,
      'email_verified_at' => null,
    ]);

    return redirect()->route('users.index')->with('success', 'User created successfully!');
  }

  public function show(User $user): \Illuminate\View\View
  {
    return view('users.show', compact('user'));
  }

  public function edit(User $user): \Illuminate\View\View
  {
    return view('users.edit', compact('user'));
  }

  public function update(Request $request, User $user): \Illuminate\Http\RedirectResponse
  {
    $request->validate([
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
      'password' => ['nullable', 'string', 'min:8', 'confirmed'],
      'type' => ['required', Rule::in(['admin', 'teacher', 'student', 'parent', 'staff'])],
      'phone' => ['nullable', 'string', 'max:255'],
      'address' => ['nullable', 'string'],
      'date_of_birth' => ['nullable', 'date'],
      'gender' => ['nullable', Rule::in(['male', 'female', 'other'])],
      'avatar' => ['nullable', 'string', 'max:2048'],
    ]);

    $data = $request->only([
      'name',
      'email',
      'type',
      'phone',
      'address',
      'date_of_birth',
      'gender',
      'avatar'
    ]);

    if ($request->filled('password')) {
      $data['password'] = Hash::make($request->password);
    }

    $user->update($data);

    return redirect()->route('users.show', $user)->with('success', 'User updated successfully!');
  }

  public function destroy(User $user): \Illuminate\Http\RedirectResponse
  {
    $user->delete();

    return redirect()->route('users.index')->with('success', 'User deleted successfully!');
  }
}