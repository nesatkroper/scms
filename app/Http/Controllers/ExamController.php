<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExamRequest;
use App\Http\Requests\UpdateExamRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Exam;
use App\Models\Subject;

class ExamController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 12);
        $viewType = $request->input('view', 'table');
        $subjects = Subject::all();
        $exams = Exam::with('subject')
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', "%{$search}%")
                    ->orWhereHas('subject', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    })
                    ->orWhere('date', 'like', "%{$search}%")
                    ->orWhere('total_marks', 'like', "%{$search}%")
                    ->orWhere('passing_marks', 'like', "%{$search}%")
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
                'table' => view('admin.exams.partials.table', compact('exams'))->render(),
                'cards' => view('admin.exams.partials.cardlist', compact('exams'))->render(),
                'pagination' => $exams->links()->toHtml()
            ];

            return response()->json([
                'success' => true,
                'html' => $html,
                'view' => $viewType
            ]);
        }
        return view('admin.exams.index', compact('exams', 'subjects'));
    }

    public function store(StoreExamRequest $request)
    {
        try {
            $exam = Exam::create($request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Exam created successfully!',
                'exam' => $exam->load('subject')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating exam: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show(Exam $exam)
    {
        return response()->json([
            'success' => true,
            'exam' => $exam->load('subject')
        ]);
    }

    public function update(UpdateExamRequest $request, Exam $exam)
    {
        try {
            $exam->update($request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Exam updated successfully',
                'exam' => $exam->fresh('subject')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating exam: ' . $e->getMessage()
            ], 500);
        }

        // try {
        //     $exam->update($request->validated());
        //     return response()->json([
        //         'success' => true,
        //         'message' => 'Exam updated successfully',
        //         'exam' => $exam->load('subject')
        //     ]);
        // } catch (\Exception $e) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Error updating exam: ' . $e->getMessage()
        //     ], 500);
        // }
    }

    public function destroy(Exam $exam)
    {
        try {
            $exam->delete();
            return response()->json([
                'success' => true,
                'message' => 'Exam deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting exam: ' . $e->getMessage()
            ], 500);
        }
    }

    // New methods for bulk operations
    public function getBulkData(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:exams,id'
        ]);

        try {
            $exams = Exam::with('subject')
                ->whereIn('id', $request->ids)
                ->get();

            return response()->json([
                'success' => true,
                'data' => $exams
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error loading exam data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function bulkUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'exams' => 'required|array',
            'exams.*.id' => 'required|exists:exams,id',
            'exams.*.name' => 'required|string|max:255',
            'exams.*.subject_id' => 'required|exists:subjects,id',
            'exams.*.total_marks' => 'required|integer|min:1',
            'exams.*.passing_marks' => 'required|integer|min:0',
            'exams.*.date' => 'required|date',
            'exams.*.description' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
                'message' => 'Validation failed'
            ], 422);
        }

        try {
            $updatedExams = [];

            foreach ($request->exams as $examData) {
                $exam = Exam::find($examData['id']);
                $exam->update($examData);
                $updatedExams[] = $exam->load('subject');
            }

            return response()->json([
                'success' => true,
                'message' => 'Exams updated successfully',
                'exams' => $updatedExams
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating exams: ' . $e->getMessage()
            ], 500);
        }
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:exams,id'
        ]);

        try {
            Exam::whereIn('id', $request->ids)->delete();
            return response()->json([
                'success' => true,
                'message' => 'Selected exams deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting exams: ' . $e->getMessage()
            ], 500);
        }
    }
}
