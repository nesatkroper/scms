<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubjectRequest;
use App\Models\Subject;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SubjectController extends Controller
{
  public function index(Request $request)
  {
    $search = $request->input('search');
    $perPage = $request->input('per_page', 10);

    $subjects = Subject::with('department')
      ->when($search, function ($query) use ($search) {
        return $query->where('name', 'like', "%{$search}%")
          ->orWhere('code', 'like', "%{$search}%")
          ->orWhere('credit_hours', 'like', "%{$search}%")
          ->orWhereHas('department', function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%");
          });
      })
      ->orderBy('created_at', 'desc')
      ->paginate($perPage)
      ->appends([
        'search' => $search,
        'per_page' => $perPage,
      ]);

    return view('admin.subjects.index', compact('subjects'));
  }

  public function create()
  {
    $departments = Department::all();
    return view('admin.subjects.create', compact('departments'));
  }

  public function store(SubjectRequest $request)
  {
    try {
      Subject::create($request->validated());
      return redirect()->route('admin.subjects.index')->with('success', 'Subject created successfully!');
    } catch (\Exception $e) {
      Log::error('Error creating subject: ' . $e->getMessage());
      return redirect()->route('admin.subjects.create')->with('error', 'Error creating subject.')->withInput();
    }
  }

  public function show(Subject $subject)
  {
    $subject->load('department');
    return view('admin.subjects.show', compact('subject'));
  }

  public function edit(Subject $subject)
  {
    $departments = Department::all();
    return view('admin.subjects.edit', compact('subject', 'departments'));
  }

  public function update(SubjectRequest $request, Subject $subject)
  {
    try {
      $subject->update($request->validated());
      return redirect()->route('admin.subjects.index')->with('success', 'Subject updated successfully');
    } catch (\Exception $e) {
      Log::error('Error updating subject: ' . $e->getMessage());
      return redirect()->route('admin.subjects.edit', $subject)->with('error', 'Error updating subject.')->withInput();
    }
  }

  public function destroy(Subject $subject)
  {
    try {
      $subject->delete();
      return redirect()->route('admin.subjects.index')->with('success', 'Subject deleted successfully');
    } catch (\Exception $e) {
      Log::error('Error deleting subject: ' . $e->getMessage());
      return redirect()->back()->with('error', 'Error deleting subject: ' . $e->getMessage());
    }
  }
}
