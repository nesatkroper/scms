<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 5); // Default to 4 if not specified

        $departments = Department::with(['head', 'teachers', 'subjects'])
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->paginate($perPage)
            ->appends([
                'search' => $search,
                'per_page' => $perPage
            ]);

        if ($request->ajax()) {
            return response()->json([
                'html' => view('departments.partials.table', compact('departments'))->render()
            ]);
        }

        return view('departments.index', compact('departments'));
    }

    public function store(StoreDepartmentRequest $request)
    {
        $department = Department::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Department created successfully',
            'department' => $department
        ]);
    }

    public function show(Department $department)
    {
        $department->load(['head', 'teachers', 'subjects']);

        return response()->json([
            'department' => $department,
            'created_at' => $department->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $department->updated_at->format('Y-m-d H:i:s')
        ]);
    }

    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        $department->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Department updated successfully',
            'department' => $department
        ]);
    }

    public function destroy(Department $department)
    {
        $department->delete();

        return response()->json([
            'success' => true,
            'message' => 'Department deleted successfully'
        ]);
    }
}
