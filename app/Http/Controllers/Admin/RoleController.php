<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rule;

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

    $roles = Role::withCount(['permissions', 'users'])
      ->when($search, function ($query) use ($search) {
        $query->where('name', 'LIKE', "%{$search}%");
      })
      ->orderBy('id', 'asc')
      ->paginate(10)
      ->withQueryString();

    return view('admin.roles.index', compact('roles'));
  }


  public function create()
  {
    $permissions = Permission::all();
    return view('admin.roles.create', compact('permissions'));
  }

  public function store(RoleRequest $request)
  {
    try {

      $role = Role::create([
        'name'       => $request->name,
        'guard_name' => 'web',
      ]);

      if ($request->has('permissions')) {
        $role->syncPermissions($request->permissions);
      }

      app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

      return redirect()
        ->route('admin.roles.index')
        ->with('success', 'Role created successfully!');
    } catch (\Exception $e) {

      return redirect()
        ->back()
        ->with('error', 'Error creating role: ' . $e->getMessage())
        ->withInput();
    }
  }

  public function edit(Role $role)
  {
    $permissions = Permission::all();
    return view('admin.roles.edit', compact('role', 'permissions'));
  }

  public function update(RoleRequest $request, Role $role)
  {
    try {

      $role->update([
        'name' => $request->name,
      ]);

      $role->syncPermissions($request->permissions ?? []);

      return redirect()
        ->route('admin.roles.index')
        ->with('success', 'Role updated successfully!');
    } catch (\Exception $e) {

      return redirect()
        ->back()
        ->with('error', 'Error updating role: ' . $e->getMessage())
        ->withInput();
    }
  }

  public function destroy(Role $role)
  {
    if ($role->name === 'admin') {
      return redirect()
        ->back()
        ->with('error', 'Cannot delete the default "admin" role.');
    }

    if ($role->users()->count() > 0) {
      return redirect()
        ->back()
        ->with('error', 'Cannot delete role assigned to users. Unassign users first.');
    }

    try {

      $role->delete();

      return redirect()
        ->route('admin.roles.index')
        ->with('success', 'Role deleted successfully!');
    } catch (\Exception $e) {

      return redirect()
        ->back()
        ->with('error', 'Error deleting role: ' . $e->getMessage());
    }
  }
}
