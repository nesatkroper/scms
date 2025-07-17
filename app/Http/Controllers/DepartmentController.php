<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10);
        $departments = Department::with(['head', 'teachers', 'subjects'])
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate($perPage)
            ->appends([
                'search' => $search,
                'per_page' => $perPage
            ]);

        if ($request->ajax()) {
            return response()->json([
                'html' => view('admin.departments.partials.table', compact('departments'))->render()
            ]);
        }

        return view('admin.departments.index', compact('departments'));
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

    public function storeMultiple(Request $request)
    {
        $validated = $request->validate([
            'departments' => 'required|array|max:5',
            'departments.*.name' => 'required|string|max:255|unique:departments,name',
            'departments.*.description' => 'nullable|string',
        ]);

        $createdCount = 0;

        foreach ($validated['departments'] as $departmentData) {
            try {
                Department::create($departmentData);
                $createdCount++;
            } catch (\Exception $e) {
                // Log error and continue with next department
                Log::error("Error creating department: " . $e->getMessage());
            }
        }

        return response()->json([
            'message' => "Successfully created $createdCount departments",
            'redirect' => route('admin.departments.index')
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

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');

        if (empty($ids)) {
            return response()->json([
                'success' => false,
                'message' => 'No departments selected'
            ]);
        }

        Department::whereIn('id', $ids)->delete();

        return response()->json([
            'success' => true,
            'message' => count($ids) . ' departments deleted successfully'
        ]);
    }

    public function getBulkData(Request $request)
    {
        $ids = $request->input('ids');

        // Validate maximum 5 departments
        if (count($ids) > 5) {
            return response()->json([
                'success' => false,
                'message' => 'You can only edit up to 5 departments at a time'
            ], 400);
        }

        $departments = Department::whereIn('id', $ids)->get();

        return response()->json([
            'success' => true,
            'data' => $departments
        ]);
    }

    public function bulkUpdate(Request $request)
    {
        $validated = $request->validate([
            'departments' => 'required|array',
            'departments.*.id' => 'required|exists:departments,id',
            'departments.*.name' => 'required|string|max:255',
            'departments.*.description' => 'nullable|string'
        ]);

        $updatedCount = 0;

        foreach ($validated['departments'] as $departmentData) {
            try {
                $department = Department::find($departmentData['id']);
                $department->update([
                    'name' => $departmentData['name'],
                    'description' => $departmentData['description'] ?? null
                ]);
                $updatedCount++;
            } catch (\Exception $e) {
                Log::error("Error updating department: " . $e->getMessage());
                continue;
            }
        }

        return response()->json([
            'success' => true,
            'message' => "Successfully updated $updatedCount departments",
            'redirect' => route('admin.departments.index')
        ]);
    }
}
