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
        $viewType = $request->input('view', 'table');
        $departments = Department::with(['head', 'teachers', 'subjects'])
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate($perPage)
            ->appends([
                'search' => $search,
                'per_page' => $perPage,
                'view' => $viewType
            ]);

        if ($request->ajax()) {
            $html = [
                'html' => view('admin.departments.partials.table', compact('departments'))->render(),
                'cards' => view('admin.departments.partials.cardlist', compact('departments'))->render(),
                'pagination' => $departments->links()->toHtml()
            ];

            return response()->json([
                'success' => true,
                'html' => $html,
                'view' => $viewType
            ]);
        }

        return view('admin.departments.index', compact('departments'));
    }

    public function store(StoreDepartmentRequest $request)
    {
        try {
            $department = Department::create($request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Department created successfully!',
                'data' => $department
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating department: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show(Department $department)
    {
        $department->load(['head', 'teachers', 'subjects']);

        return response()->json([
            'success' => true,
            'data' => $department,
        ]);
    }

    public function update(UpdateDepartmentRequest $request, $id)
    {
        try {
            $department = Department::findOrFail($id);
            $department->update($request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Department updated successfully',
                'data' => $department->fresh('head', 'teachers', 'subjects')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating department: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $category = Department::findOrFail($id);
            $category->delete();
            return response()->json([
                'success' => true,
                'message' => 'Department deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting department: ' . $e->getMessage()
            ], 500);
        }
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
