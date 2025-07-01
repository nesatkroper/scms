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
                'per_page' => $perPage
            ]);

        if ($request->ajax()) {
            return response()->json([
                'html' => view('subjects.partials.table', compact('subjects'))->render()
            ]);
        }

        return view('subjects.index', compact('subjects', 'departments'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('subjects.create', compact('departments'));
    }

    public function store(StoreSubjectRequest $request)
    {
        $subject = Subject::create($request->validated());
        return redirect()->route('subjects.index')->with('success', 'Subject created successfully!');
    }

    public function show(Subject $subject)
    {
        $subject->load('department');
        return response()->json($subject);
    }

    public function edit(Subject $subject)
    {
        $subject->load('department');
        $departments = Department::all();
        return view('subjects.edit', compact('subject', 'departments'));
    }

    public function update(UpdateSubjectRequest $request, Subject $subject)
    {
        $subject->update($request->validated());
        return response()->json([
            'success' => true,
            'message' => 'Subject updated successfully',
            'subject' => $subject->fresh('department')
        ]);
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        return response()->json([
            'success' => true,
            'message' => 'Subject deleted successfully'
        ]);
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');

        if (empty($ids)) {
            return response()->json([
                'success' => false,
                'message' => 'No subjects selected'
            ]);
        }

        Subject::whereIn('id', $ids)->delete();

        return response()->json([
            'success' => true,
            'message' => count($ids) . ' subjects deleted successfully'
        ]);
    }

    public function getBulkData(Request $request)
    {
        $ids = $request->input('ids');

        if (count($ids) > 5) {
            return response()->json([
                'success' => false,
                'message' => 'You can only edit up to 5 subjects at a time'
            ], 400);
        }

        $subjects = Subject::whereIn('id', $ids)->get();

        return response()->json([
            'success' => true,
            'data' => $subjects
        ]);
    }


    public function bulkUpdate(Request $request)
    {
        $validated = $request->validate([
            'subjects' => 'required|array',
            'subjects.*.id' => 'required|exists:subjects,id',
            // 'subjects.*.name' => 'sometimes|string|max:255',
            // 'subjects.*.code' => 'sometimes|string|unique:subjects,code|max:50',
            // 'subjects.*.credit_hours' => 'sometimes|integer|min:1',
            // 'subjects.*.description' => 'nullable|string',
            // 'subjects.*.department_id' => 'nullable|exists:departments,id'
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
            'redirect' => route('subjects.index')
        ]);
    }
}
