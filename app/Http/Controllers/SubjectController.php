<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use Illuminate\Support\Facades\Log;
use App\Models\Subject;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SubjectController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10);
        $viewType = $request->input('view', 'table');
        $departments = Department::all();

        $subjects = Subject::with('department')
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%")
                    ->orWhere('credit_hours', 'like', "%{$search}%")
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
                'table' => view('admin.subjects.partials.table', compact('subjects'))->render(),
                'cards' => view('admin.subjects.partials.cardlist', compact('subjects'))->render(),
                'pagination' => $subjects->links()->toHtml()
            ];

            return response()->json([
                'success' => true,
                'html' => $html,
                'view' => $viewType
            ]);
        }

        return view('admin.subjects.index', compact('subjects', 'departments'));
    }

    public function store(StoreSubjectRequest $request)
    {
        try {
            $subject = Subject::create($request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Subject created successfully!',
                'subject' => $subject
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating subject: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show(Subject $subject)
    {
        $subject->load('department');
        return response()->json([
            'success' => true,
            'subject' => $subject
        ]);
    }

    public function update(UpdateSubjectRequest $request, Subject $subject)
    {
        try {
            $subject->update($request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Subject updated successfully',
                'subject' => $subject->fresh('department')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating subject: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Subject $subject)
    {
        try {
            $subject->delete();
            return response()->json([
                'success' => true,
                'message' => 'Subject deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting subject: ' . $e->getMessage()
            ], 500);
        }
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');

        if (empty($ids)) {
            return response()->json([
                'success' => false,
                'message' => 'No subjects selected'
            ], 400);
        }

        try {
            $count = Subject::whereIn('id', $ids)->delete();
            return response()->json([
                'success' => true,
                'message' => $count . ' subjects deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting subjects: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getBulkData(Request $request)
    {
        $ids = $request->input('ids');

        if (empty($ids)) {
            return response()->json([
                'success' => false,
                'message' => 'No subjects selected'
            ], 400);
        }

        if (count($ids) > 5) {
            return response()->json([
                'success' => false,
                'message' => 'You can only edit up to 5 subjects at a time'
            ], 400);
        }

        try {
            $subjects = Subject::whereIn('id', $ids)->get();
            return response()->json([
                'success' => true,
                'data' => $subjects
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching subjects: ' . $e->getMessage()
            ], 500);
        }
    }

    public function bulkUpdate(Request $request)
    {
        $request->validate([
            'subjects' => 'required|array',
            'subjects.*.id' => 'required|exists:subjects,id',
        ]);

        $updatedCount = 0;

        foreach ($request->input('subjects') as $subjectData) {
            $validator = Validator::make($subjectData, [
                'id' => 'required|exists:subjects,id',
                'name' => 'sometimes|string|max:255',
                'code' => [
                    'sometimes',
                    'string',
                    'max:50',
                    Rule::unique('subjects', 'code')->ignore($subjectData['id'], 'id'),
                ],
                'credit_hours' => 'sometimes|integer|min:1',
                'description' => 'nullable|string',
                'department_id' => 'nullable|exists:departments,id',
            ]);

            if ($validator->fails()) {
                Log::error("Validation failed for subject ID {$subjectData['id']}: " . json_encode($validator->errors()));
                continue; // Skip invalid
            }

            try {
                $subject = Subject::findOrFail($subjectData['id']);
                $subject->update($validator->validated());
                $updatedCount++;
            } catch (\Exception $e) {
                Log::error("Error updating subject: " . $e->getMessage());
            }
        }

        return response()->json([
            'success' => true,
            'message' => "Successfully updated $updatedCount subjects",
            'redirect' => route('admin.subjects.index')
        ]);
    }
}
