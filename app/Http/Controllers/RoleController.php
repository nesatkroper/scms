<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
  public function index()
  {
    $roles = Role::withCount('permissions', 'users')->paginate(10);
    return view('admin.roles.index', compact('roles'));
  }

  public function create()
  {
    $permissions = Permission::all();
    return view('admin.roles.create', compact('permissions'));
  }

  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required|string|max:255|unique:roles,name',
      'permissions' => 'nullable|array',
      'permissions.*' => 'exists:permissions,name',
    ]);

    $role = Role::create([
      'name' => $request->name,
      'guard_name' => 'web',
    ]);

    if ($request->has('permissions')) {
      $role->syncPermissions($request->permissions);
    }

    return redirect()->route('admin.roles.index')
      ->with('success', 'Role created successfully.');
  }

  public function edit(Role $role)
  {
    $permissions = Permission::all();
    $rolePermissions = $role->permissions->pluck('id')->toArray();

    return view('admin.roles.edit', compact('role', 'permissions', 'rolePermissions'));
  }

  public function update(Request $request, Role $role)
  {
    $request->validate([
      'name' => [
        'required',
        'string',
        'max:255',
        Rule::unique('roles', 'name')->ignore($role->id),
      ],
      'permissions' => 'nullable|array',
      'permissions.*' => 'exists:permissions,id',
    ]);

    $role->update([
      'name' => $request->name,
    ]);

    $permissionIds = collect($request->permissions)->map(fn($id) => (int) $id)->toArray();

    $role->syncPermissions($permissionIds);

    return redirect()->route('admin.roles.index')
      ->with('success', 'Role updated successfully.');
  }

  public function destroy(Role $role)
  {
    if ($role->name === 'admin') {
      return redirect()->route('admin.roles.index')
        ->with('error', 'Cannot delete the default "admin" role.');
    }

    if ($role->users()->count() > 0) {
      return redirect()->route('admin.roles.index')
        ->with('error', 'Cannot delete role assigned to users. Please unassign users first.');
    }

    $role->delete();

    return redirect()->route('admin.roles.index')
      ->with('success', 'Role deleted successfully.');
  }
}
