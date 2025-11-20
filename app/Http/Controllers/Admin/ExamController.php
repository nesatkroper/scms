<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExamRequest;
use App\Models\Exam;
use App\Models\CourseOffering;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ExamController extends Controller
{
  public function index(Request $request)
  {
    $search = $request->input('search');
    $perPage = $request->input('per_page', 10);

    $exams = Exam::query()
      ->with(['courseOffering'])
      ->when($search, function ($query) use ($search) {
        return $query->where('type', 'like', "%{$search}%")
          ->orWhere('description', 'like', "%{$search}%")
          ->orWhereHas('courseOffering', function ($q) use ($search) {
            $q->where('time_slot', 'like', "%{$search}%")
              ->orWhereHas('subject', function ($s) use ($search) {
                $s->where('name', 'like', "%{$search}%");
              });
          });
      })
      ->orderBy('date', 'desc')
      ->paginate($perPage)
      ->appends([
        'search' => $search,
        'per_page' => $perPage,
      ]);

    return view('admin.exams.index', compact('exams'));
  }

  public function create()
  {
    $courseOfferings = CourseOffering::with(['subject', 'teacher', 'classroom'])->get();

    return view('admin.exams.create', compact('courseOfferings'));
  }

  public function store(ExamRequest $request)
  {
    try {
      Exam::create($request->validated());
      return redirect()->route('admin.exams.index')->with('success', 'Exam created successfully!');
    } catch (\Exception $e) {
      Log::error('Error creating Exam: ' . $e->getMessage());
      return redirect()->route('admin.exams.create')->with('error', 'Error creating exam.')->withInput();
    }
  }

  public function show(Exam $exam)
  {
    $exam->load(['courseOffering', 'scores']);
    return view('admin.exams.show', compact('exam'));
  }

  public function edit(Exam $exam)
  {
    $courseOfferings = CourseOffering::with(['subject', 'teacher', 'classroom'])->get();

    return view('admin.exams.edit', compact('exam', 'courseOfferings'));
  }

  public function update(ExamRequest $request, Exam $exam)
  {
    try {
      $exam->update($request->validated());
      return redirect()->route('admin.exams.index')->with('success', 'Exam updated successfully');
    } catch (\Exception $e) {
      Log::error('Error updating Exam: ' . $e->getMessage());
      return redirect()->route('admin.exams.edit', $exam)->with('error', 'Error updating exam.')->withInput();
    }
  }

  public function destroy(Exam $exam)
  {
    try {
      $exam->delete();
      return redirect()->route('admin.exams.index')->with('success', 'Exam deleted successfully');
    } catch (\Exception $e) {
      Log::error('Error deleting Exam: ' . $e->getMessage());
      return redirect()->back()->with('error', 'Error deleting exam: ' . $e->getMessage());
    }
  }
}
