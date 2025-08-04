<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGradeLevelRequest;
use App\Http\Requests\UpdateGradeLevelRequest;
use App\Models\GradeLevel;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class GradeLevelController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10);
        $viewType = $request->input('view', 'table');
        $gradelevels = GradeLevel::when($search, function ($query) use ($search) {
            return $query->where('id', 'like', "%{$search}%")
                ->orWhere('name', 'like', "%{$search}%")
                ->orWhere('code', 'like', "%{$search}%")
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
                'table' => view('admin.gradelevels.partials.table', compact('gradelevels'))->render(),
                'cards' => view('admin.gradelevels.partials.cardlist', compact('gradelevels'))->render(),
                'pagination' => $gradelevels->links()->toHtml()
            ];

            return response()->json([
                'success' => true,
                'html' => $html,
                'view' => $viewType
            ]);
        }

        return view('admin.gradelevels.index', compact('gradelevels'));
    }

    public function store(StoreGradeLevelRequest $request)
    {
        try {
            $gradelevel = GradeLevel::create($request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Grade level created successfully!',
                'gradelevel' => $gradelevel
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating grade level: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show(GradeLevel $gradelevel)
    {
        return response()->json([
            'success' => true,
            'gradeLevel' => $gradelevel
        ]);
    }

    public function update(UpdateGradeLevelRequest $request, $id)
    {
        try {
            $gradeLevel = GradeLevel::findOrFail($id);
            $gradeLevel->update($request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Grade level updated successfully',
                'gradeLevel' => $gradeLevel->fresh()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating grade level: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $gradeLevel = GradeLevel::findOrFail($id);
            $gradeLevel->delete();
            return response()->json([
                'success' => true,
                'message' => 'Grade level deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting grade level: ' . $e->getMessage()
            ], 500);
        }
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');

        if (empty($ids)) {
            return response()->json([
                'success' => false,
                'message' => 'No grade levels selected'
            ], 400);
        }

        try {
            $count = GradeLevel::whereIn('id', $ids)->delete();
            return response()->json([
                'success' => true,
                'message' => $count . ' grade levels deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting grade levels: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getBulkData(Request $request)
    {
        $ids = $request->input('ids');

        if (empty($ids)) {
            return response()->json([
                'success' => false,
                'message' => 'No grade levels selected'
            ], 400);
        }

        if (count($ids) > 5) {
            return response()->json([
                'success' => false,
                'message' => 'You can only edit up to 5 grade levels at a time'
            ], 400);
        }

        try {
            $gradeLevels = GradeLevel::whereIn('id', $ids)->get();
            return response()->json([
                'success' => true,
                'data' => $gradeLevels
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching grade levels: ' . $e->getMessage()
            ], 500);
        }
    }

    public function bulkUpdate(Request $request)
    {
        $request->validate([
            'grade_levels' => 'required|array',
            'grade_levels.*.id' => 'required|exists:grade_levels,id',
        ]);

        $updatedCount = 0;

        foreach ($request->input('grade_levels') as $gradeLevelData) {
            $validator = Validator::make($gradeLevelData, [
                'id' => 'required|exists:grade_levels,id',
                'name' => 'sometimes|string|max:255',
                'code' => [
                    'sometimes',
                    'string',
                    'max:50',
                    Rule::unique('grade_levels', 'code')->ignore($gradeLevelData['id'], 'id'),
                ],
                'description' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                Log::error("Validation failed for grade level ID {$gradeLevelData['id']}: " . json_encode($validator->errors()));
                continue; // Skip invalid
            }

            try {
                $gradeLevel = GradeLevel::findOrFail($gradeLevelData['id']);
                $gradeLevel->update($validator->validated());
                $updatedCount++;
            } catch (\Exception $e) {
                Log::error("Error updating grade level: " . $e->getMessage());
            }
        }

        return response()->json([
            'success' => true,
            'message' => "Successfully updated $updatedCount grade levels",
            'redirect' => route('admin.gradelevels.index')
        ]);
    }
}
