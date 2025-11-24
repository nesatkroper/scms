<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends BaseController
{
  public function __construct()
  {
    parent::__construct();
    $this->applyPermissions();
  }

  protected function ModelPermissionName(): string
  {
    return 'Role';
  }

  public function index(Request $request)
  {
    $search = $request->input('search');
    $perPage = $request->input('per_page', 10);

    $roles = Role::query()
      ->when($search, function ($query) use ($search) {
        $query->where('name', 'like', "%{$search}%");
      })
      ->orderBy('created_at', 'desc')
      ->paginate($perPage)
      ->appends([
        'search' => $search,
        'per_page' => $perPage,
      ]);

    return view('admin.roles.index', compact('roles'));
  }

  public function create()
  {
    $permissions = Permission::orderBy('name')->get(['id', 'name']);

    return view('admin.roles.create', compact('permissions'));
  }

  public function store(RoleRequest $request)
  {
    try {
      $role = Role::create(['name' => $request->name]);

      if ($request->has('permissions')) {
        $role->syncPermissions($request->permissions);
      }

      return redirect()->route('admin.roles.index')->with('success', 'Role created and permissions assigned successfully!');
    } catch (\Exception $e) {
      Log::error('Error creating Role: ' . $e->getMessage());
      return redirect()->back()->with('error', 'Error creating role.')->withInput();
    }
  }

  public function edit(Role $role)
  {
    $permissions = Permission::orderBy('name')->get(['id', 'name']);
    $rolePermissions = $role->permissions->pluck('id')->toArray();

    return view('admin.roles.edit', compact('role', 'permissions', 'rolePermissions'));
  }

  public function update(RoleRequest $request, Role $role)
  {
    try {
      $role->update(['name' => $request->name]);

      $role->syncPermissions($request->permissions ?? []);

      return redirect()->route('admin.roles.index')->with('success', 'Role updated and permissions synced successfully!');
    } catch (\Exception $e) {
      Log::error('Error updating Role: ' . $e->getMessage());
      return redirect()->back()->with('error', 'Error updating role.')->withInput();
    }
  }

  public function destroy(Role $role)
  {
    try {
      $role->delete();
      return redirect()->route('admin.roles.index')->with('success', 'Role deleted successfully');
    } catch (\Exception $e) {
      Log::error('Error deleting Role: ' . $e->getMessage());
      return redirect()->back()->with('error', 'Error deleting role: ' . $e->getMessage());
    }
  }
}
