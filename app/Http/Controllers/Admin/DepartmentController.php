<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10);

        $departments = Department::with('head')
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->withCount(['subjects', 'users'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage)
            ->appends([
                'search' => $search,
                'per_page' => $perPage,
            ]);

        return view('admin.departments.index', compact('departments'));
    }

    public function create()
    {
        $potentialHeads = User::whereHas('roles', fn ($q) => $q->where('name', 'teacher'))
            ->orWhereHas('roles', fn ($q) => $q->where('name', 'admin'))
            ->get(['id', 'name']);

        return view('admin.departments.create', compact('potentialHeads'));
    }

    public function store(DepartmentRequest $request)
    {
        try {
            Department::create($request->validated());
            return redirect()->route('admin.departments.index')->with('success', 'Department created successfully!');
        } catch (\Exception $e) {
            Log::error('Error creating department: ' . $e->getMessage());
            return redirect()->route('admin.departments.create')->with('error', 'Error creating department.')->withInput();
        }
    }

    public function show(Department $department)
    {
        $department->load(['head', 'subjects', 'teachers', 'students']);
        return view('admin.departments.show', compact('department'));
    }

    public function edit(Department $department)
    {
        $potentialHeads = User::whereHas('roles', fn ($q) => $q->where('name', 'teacher'))
            ->orWhereHas('roles', fn ($q) => $q->where('name', 'admin'))
            ->get(['id', 'name']);

        return view('admin.departments.edit', compact('department', 'potentialHeads'));
    }

    public function update(DepartmentRequest $request, Department $department)
    {
        try {
            $department->update($request->validated());
            return redirect()->route('admin.departments.index')->with('success', 'Department updated successfully');
        } catch (\Exception $e) {
            Log::error('Error updating department: ' . $e->getMessage());
            return redirect()->route('admin.departments.edit', $department)->with('error', 'Error updating department.')->withInput();
        }
    }

    public function destroy(Department $department)
    {
        try {
            $department->delete();
            return redirect()->route('admin.departments.index')->with('success', 'Department deleted successfully');
        } catch (\Exception $e) {
            Log::error('Error deleting department: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error deleting department: ' . $e->getMessage());
        }
    }
}
