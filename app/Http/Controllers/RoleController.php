<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
  public function index(Request $request)
  {
    $search = $request->input('search');
    $perPage = $request->input('per_page', 10);

    $roles = Role::withCount(['permissions', 'users'])
      ->when($search, function ($query) use ($search) {
        return $query->where('name', 'like', "%{$search}%");
      })
      ->orderBy('created_at', 'desc')
      ->paginate($perPage)
      ->appends([
        'search' => $search,
        'per_page' => $perPage,
      ]);

    if ($request->ajax()) {
      $html = [
        'table' => view('admin.roles.partials.table', compact('roles'))->render(),
        'pagination' => $roles->links()->toHtml()
      ];

      return response()->json([
        'success' => true,
        'html' => $html,
      ]);
    }

    return view('admin.roles.index', compact('roles'));
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required|string|max:255|unique:roles,name',
      'permissions' => 'nullable|array',
      'permissions.*' => 'exists:permissions,id',
    ]);

    if ($validator->fails()) {
      return response()->json([
        'success' => false,
        'errors' => $validator->errors(),
        'message' => 'Validation failed'
      ], 422);
    }

    try {
      $role = Role::create([
        'name' => $request->name,
        'guard_name' => 'web',
      ]);

      if ($request->has('permissions')) {
        $role->syncPermissions($request->permissions);
      }

      return response()->json([
        'success' => true,
        'message' => 'Role created successfully!',
        'role' => $role->loadCount(['permissions', 'users'])
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'success' => false,
        'message' => 'Error creating role: ' . $e->getMessage()
      ], 500);
    }
  }

  public function show(Role $role)
  {
    return response()->json([
      'success' => true,
      'role' => $role->load(['permissions']),
      'permissions' => Permission::all()
    ]);
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
      return response()->json([
        'success' => false,
        'errors' => $validator->errors(),
        'message' => 'Validation failed'
      ], 422);
    }

    try {
      $role->update([
        'name' => $request->name,
      ]);

      $permissionIds = collect($request->permissions)->map(fn($id) => (int) $id)->toArray();
      $role->syncPermissions($permissionIds);

      return response()->json([
        'success' => true,
        'message' => 'Role updated successfully',
        'role' => $role->loadCount(['permissions', 'users'])
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'success' => false,
        'message' => 'Error updating role: ' . $e->getMessage()
      ], 500);
    }
  }

  public function destroy(Role $role)
  {
    if ($role->name === 'admin') {
      return response()->json([
        'success' => false,
        'message' => 'Cannot delete the default "admin" role.'
      ], 403);
    }

    if ($role->users()->count() > 0) {
      return response()->json([
        'success' => false,
        'message' => 'Cannot delete role assigned to users. Please unassign users first.'
      ], 403);
    }

    try {
      $role->delete();
      return response()->json([
        'success' => true,
        'message' => 'Role deleted successfully'
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'success' => false,
        'message' => 'Error deleting role: ' . $e->getMessage()
      ], 500);
    }
  }
}
