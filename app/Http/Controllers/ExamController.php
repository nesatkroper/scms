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
        $perPage = $request->input('per_page', 10);
        $viewType = $request->input('view', 'table');
        $subjects = Subject::all();
        $exams = Exam::with('subject')
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('subject_id', 'like', "%{$search}%")
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
            $exam->load('subject');
            return response()->json([
                'success' => true,
                'message' => 'Exam created successfully!',
                'exam' => $exam->fresh('subject')
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
        $exam->load('subject');
        return response()->json([
            'success' => true,
            'exam' => $exam->fresh('subject')
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
}
