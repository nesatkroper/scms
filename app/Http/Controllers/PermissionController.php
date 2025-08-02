<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rule;

class PermissionController extends Controller
{
  public function index()
  {
    $permissions = Permission::paginate(10);
    return view('admin.permissions.index', compact('permissions'));
  }

  public function create()
  {
    return view('admin.permissions.create');
  }

  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required|string|max:255|unique:permissions,name',
    ]);

    Permission::create([
      'name' => $request->name,
      'guard_name' => 'web',
    ]);

    return redirect()->route('admin.permissions.index')
      ->with('success', 'Permission created successfully.');
  }

  public function edit(Permission $permission)
  {
    return view('admin.permissions.edit', compact('permission'));
  }

  public function update(Request $request, Permission $permission)
  {
    $request->validate([
      'name' => [
        'required',
        'string',
        'max:255',
        Rule::unique('permissions', 'name')->ignore($permission->id),
      ],
    ]);

    $permission->update([
      'name' => $request->name,
    ]);

    return redirect()->route('admin.permissions.index')
      ->with('success', 'Permission updated successfully.');
  }

  public function destroy(Permission $permission)
  {
    if ($permission->roles()->count() > 0) {
      return redirect()->route('admin.permissions.index')
        ->with('error', 'Cannot delete permission assigned to roles. Please unassign it first.');
    }

    $permission->delete();

    return redirect()->route('admin.permissions.index')
      ->with('success', 'Permission deleted successfully.');
  }

  public function bulkDestroy(Request $request)
  {
    $request->validate([
      'ids' => 'required|array',
      'ids.*' => 'exists:permissions,id',
    ]);

    $permissionIds = $request->ids;
    $errors = [];

    foreach ($permissionIds as $permissionId) {
      $permission = Permission::find($permissionId);
      if ($permission) {
        if ($permission->roles()->count() > 0) {
          $errors[] = "Permission '{$permission->name}' is assigned to roles and cannot be deleted.";
        } else {
          $permission->delete();
        }
      }
    }

    if (count($errors) > 0) {
      return response()->json(['success' => false, 'message' => 'Some permissions could not be deleted.', 'errors' => $errors], 400);
    }

    return response()->json(['success' => true, 'message' => 'Selected permissions deleted successfully.']);
  }
}
