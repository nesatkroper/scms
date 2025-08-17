<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class RoleController extends BaseController
{
  protected function ModelPermissionName(): string
  {
    return 'role';
  }

  public function index(Request $request)
  {
    $search = $request->input('search');
    $perPage = $request->input('per_page', 10);

    $roles = Role::withCount(['permissions', 'users'])
      ->when($search, function ($query) use ($search) {
        return $query->where('name', 'like', "%{$search}%");
      })
      ->orderBy('id', 'asc')
      ->paginate($perPage)
      ->appends([
        'search' => $search,
        'per_page' => $perPage,
      ]);

    if ($request->ajax()) {
      $html = [
        'table' => view('admin.roles.table', compact('roles'))->render(),
        'pagination' => $roles->links()->toHtml()
      ];

      return response()->json([
        'success' => true,
        'html' => $html
      ]);
    }

    return view('admin.roles.index', compact('roles'));
  }

  public function create()
  {
    $permissions = Permission::all();
    return view('admin.roles.create', compact('permissions'));
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required|string|max:255|unique:roles,name',
      'permissions' => 'nullable|array',
      'permissions.*' => 'exists:permissions,id',
    ]);

    if ($validator->fails()) {
      return redirect()->back()
        ->withErrors($validator)
        ->withInput();
    }

    try {
      $role = Role::create([
        'name' => $request->name,
        'guard_name' => 'web',
      ]);

      if ($request->has('permissions')) {
        $role->syncPermissions($request->permissions);
      }

      return redirect()->route('admin.roles.index')
        ->with('success', 'Role created successfully!');
    } catch (\Exception $e) {
      return redirect()->back()
        ->with('error', 'Error creating role: ' . $e->getMessage());
    }
  }

  public function edit(Role $role)
  {
    $permissions = Permission::all();
    return view('admin.roles.edit', compact('role', 'permissions'));
  }

  public function update(Request $request, Role $role)
  {
    $validator = Validator::make($request->all(), [
      'name' => [
        'required',
        'string',
        'max:255',
        Rule::unique('roles', 'name')->ignore($role->id),
      ],
      'permissions' => 'nullable|array',
      'permissions.*' => 'exists:permissions,id',
    ]);

    if ($validator->fails()) {
      return redirect()->back()
        ->withErrors($validator)
        ->withInput();
    }

    try {
      $role->update([
        'name' => $request->name,
      ]);

      $permissionIds = collect($request->permissions)->map(fn($id) => (int) $id)->toArray();
      $role->syncPermissions($permissionIds);

      return redirect()->route('admin.roles.index')
        ->with('success', 'Role updated successfully!');
    } catch (\Exception $e) {
      return redirect()->back()
        ->with('error', 'Error updating role: ' . $e->getMessage());
    }
  }

  public function destroy(Role $role)
  {
    if ($role->name === 'admin') {
      return redirect()->back()
        ->with('error', 'Cannot delete the default "admin" role.');
    }

    if ($role->users()->count() > 0) {
      return redirect()->back()
        ->with('error', 'Cannot delete role assigned to users. Please unassign users first.');
    }

    try {
      $role->delete();
      return redirect()->route('admin.roles.index')
        ->with('success', 'Role deleted successfully!');
    } catch (\Exception $e) {
      return redirect()->back()
        ->with('error', 'Error deleting role: ' . $e->getMessage());
    }
  }
}
