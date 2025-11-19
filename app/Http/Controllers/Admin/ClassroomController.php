<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClassroomRequest;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ClassroomController extends Controller
{
  public function index(Request $request)
  {
    $search = $request->input('search');
    $perPage = $request->input('per_page', 10);

    $classrooms = Classroom::query()
      ->when($search, function ($query) use ($search) {
        return $query->where('name', 'like', "%{$search}%")
          ->orWhere('room_number', 'like', "%{$search}%");
      })
      ->withCount('schedules')
      ->orderBy('created_at', 'desc')
      ->paginate($perPage)
      ->appends([
        'search' => $search,
        'per_page' => $perPage,
      ]);

    return view('admin.classrooms.index', compact('classrooms'));
  }

  public function create()
  {
    return view('admin.classrooms.create');
  }

  public function store(ClassroomRequest $request)
  {
    try {
      Classroom::create($request->validated());
      return redirect()->route('admin.classrooms.index')->with('success', 'Classroom created successfully!');
    } catch (\Exception $e) {
      Log::error('Error creating classroom: ' . $e->getMessage());
      return redirect()->route('admin.classrooms.create')->with('error', 'Error creating classroom.')->withInput();
    }
  }

  public function show(Classroom $classroom)
  {
    $classroom->load(['schedules', 'attendances']);
    return view('admin.classrooms.show', compact('classroom'));
  }

  public function edit(Classroom $classroom)
  {
    return view('admin.classrooms.edit', compact('classroom'));
  }

  public function update(ClassroomRequest $request, Classroom $classroom)
  {
    try {
      $classroom->update($request->validated());
      return redirect()->route('admin.classrooms.index')->with('success', 'Classroom updated successfully');
    } catch (\Exception $e) {
      Log::error('Error updating classroom: ' . $e->getMessage());
      return redirect()->route('admin.classrooms.edit', $classroom)->with('error', 'Error updating classroom.')->withInput();
    }
  }

  public function destroy(Classroom $classroom)
  {
    try {
      $classroom->delete();
      return redirect()->route('admin.classrooms.index')->with('success', 'Classroom deleted successfully');
    } catch (\Exception $e) {
      Log::error('Error deleting classroom: ' . $e->getMessage());
      return redirect()->back()->with('error', 'Error deleting classroom: ' . $e->getMessage());
    }
  }
}
