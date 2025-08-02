<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSectionRequest;
use App\Http\Requests\UpdateSectionRequest;
use Illuminate\Support\Facades\Log;
use App\Models\Section;
use App\Models\GradeLevel;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SectionController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10);
        $viewType = $request->input('view', 'table');
        $gradeLevels = GradeLevel::all();
        $teachers = Teacher::all();

        $sections = Section::with(['gradeLevel', 'teacher'])
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', "%{$search}%")
                    ->orWhereHas('gradeLevel', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('teacher', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
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
                'table' => view('admin.sections.partials.table', compact('sections'))->render(),
                'cards' => view('admin.sections.partials.cardlist', compact('sections'))->render(),
                'pagination' => $sections->links()->toHtml()
            ];

            return response()->json([
                'success' => true,
                'html' => $html,
                'view' => $viewType
            ]);
        }

        return view('admin.sections.index', compact('sections', 'gradeLevels', 'teachers'));
    }

    public function store(StoreSectionRequest $request)
    {
        try {
            $section = Section::create($request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Section created successfully!',
                'section' => $section->fresh(['gradeLevel', 'teacher'])
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating section: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show(Section $section)
    {
        $section->load(['gradeLevel', 'teacher']);
        return response()->json([
            'success' => true,
            'section' => $section
        ]);
    }

    public function update(UpdateSectionRequest $request, Section $section)
    {
        try {
            $section->update($request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Section updated successfully',
                'section' => $section->fresh(['gradeLevel', 'teacher'])
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating section: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $section = Section::findOrFail($id);
            $section->delete();
            return response()->json([
                'success' => true,
                'message' => 'Section deleted successfully',
                'section' => $section->fresh(['gradeLevel', 'teacher'])
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting section: ' . $e->getMessage()
            ], 500);
        }
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');

        if (empty($ids)) {
            return response()->json([
                'success' => false,
                'message' => 'No sections selected'
            ], 400);
        }

        try {
            $count = Section::whereIn('id', $ids)->delete();
            return response()->json([
                'success' => true,
                'message' => $count . ' sections deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting sections: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getBulkData(Request $request)
    {
        $ids = $request->input('ids');

        if (empty($ids)) {
            return response()->json([
                'success' => false,
                'message' => 'No sections selected'
            ], 400);
        }

        if (count($ids) > 5) {
            return response()->json([
                'success' => false,
                'message' => 'You can only edit up to 5 sections at a time'
            ], 400);
        }

        try {
            $sections = Section::whereIn('id', $ids)->get();
            return response()->json([
                'success' => true,
                'data' => $sections
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching sections: ' . $e->getMessage()
            ], 500);
        }
    }

    public function bulkUpdate(Request $request)
    {
        $request->validate([
            'sections' => 'required|array',
            'sections.*.id' => 'required|exists:sections,id',
        ]);

        $updatedCount = 0;

        foreach ($request->input('sections') as $sectionData) {
            $validator = Validator::make($sectionData, [
                'id' => 'required|exists:sections,id',
                'name' => 'unique:sections,name,except,id|string|max:255',
                'grade_level_id' => 'required|exists:grade_levels,id',
                'teacher_id' => 'nullable|exists:teachers,id',
            ]);

            if ($validator->fails()) {
                Log::error("Validation failed for section ID {$sectionData['id']}: " . json_encode($validator->errors()));
                continue; // Skip invalid
            }

            try {
                $section = Section::findOrFail($sectionData['id']);
                $section->update($validator->validated());
                $updatedCount++;
            } catch (\Exception $e) {
                Log::error("Error updating section: " . $e->getMessage());
            }
        }

        return response()->json([
            'success' => true,
            'message' => "Successfully updated $updatedCount sections",
            'redirect' => route('admin.sections.index')
        ]);
    }
}
