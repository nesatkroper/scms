<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class PermissionController extends BaseController
{
  protected function ModelPermissionName(): string
  {
    return 'permissions';
  }

  public function index(Request $request)
  {
    $search = $request->input('search');
    $perPage = $request->input('per_page', 10);

    $permissions = Permission::withCount('roles')
      ->when($search, function ($query) use ($search) {
        return $query->where('name', 'like', "%{$search}%");
      })
      ->orderBy('id', 'desc')
      ->paginate($perPage)
      ->appends([
        'search' => $search,
        'per_page' => $perPage,
      ]);

    if ($request->ajax()) {
      $html = [
        'table' => view('admin.permissions.partials.table', compact('permissions'))->render(),
        'pagination' => $permissions->links()->toHtml()
      ];

      return response()->json([
        'success' => true,
        'html' => $html,
      ]);
    }

    return view('admin.permissions.index', compact('permissions'));
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required|string|max:255|unique:permissions,name',
    ]);

    if ($validator->fails()) {
      return response()->json([
        'success' => false,
        'errors' => $validator->errors(),
        'message' => 'Validation failed'
      ], 422);
    }

    try {
      $permission = Permission::create([
        'name' => $request->name,
        'guard_name' => 'web',
      ]);

      return response()->json([
        'success' => true,
        'message' => 'Permission created successfully!',
        'permission' => $permission->loadCount('roles')
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'success' => false,
        'message' => 'Error creating permission: ' . $e->getMessage()
      ], 500);
    }
  }

  public function show(Permission $permission)
  {
    return response()->json([
      'success' => true,
      'permission' => $permission->load('roles'),
      'roles' => Role::all()
    ]);
  }

  public function update(Request $request, Permission $permission)
  {
    $validator = Validator::make($request->all(), [
      'name' => [
        'required',
        'string',
        'max:255',
        Rule::unique('permissions', 'name')->ignore($permission->id),
      ],
    ]);

    if ($validator->fails()) {
      return response()->json([
        'success' => false,
        'errors' => $validator->errors(),
        'message' => 'Validation failed'
      ], 422);
    }

    try {
      $permission->update([
        'name' => $request->name,
      ]);

      return response()->json([
        'success' => true,
        'message' => 'Permission updated successfully',
        'permission' => $permission->loadCount('roles')
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'success' => false,
        'message' => 'Error updating permission: ' . $e->getMessage()
      ], 500);
    }
  }

  public function destroy(Permission $permission)
  {
    if ($permission->roles()->count() > 0) {
      return response()->json([
        'success' => false,
        'message' => 'Cannot delete permission assigned to roles. Please unassign it first.'
      ], 403);
    }

    try {
      $permission->delete();
      return response()->json([
        'success' => true,
        'message' => 'Permission deleted successfully'
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'success' => false,
        'message' => 'Error deleting permission: ' . $e->getMessage()
      ], 500);
    }
  }

  public function bulkDestroy(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'ids' => 'required|array',
      'ids.*' => 'exists:permissions,id',
    ]);

    if ($validator->fails()) {
      return response()->json([
        'success' => false,
        'errors' => $validator->errors(),
        'message' => 'Validation failed'
      ], 422);
    }

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
      return response()->json([
        'success' => false,
        'message' => 'Some permissions could not be deleted.',
        'errors' => $errors
      ], 400);
    }

    return response()->json(['success' => true, 'message' => 'Selected permissions deleted successfully.']);
  }
}
