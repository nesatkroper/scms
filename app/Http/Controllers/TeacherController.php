<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Models\Teacher;
use App\Models\Department; 

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::with('department')->paginate(10);
        return view('teachers.index', compact('teachers'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('teachers.create', compact('departments'));
    }

    public function store(StoreTeacherRequest $request)
    {
        $teacher = Teacher::create($request->validated());
        return redirect()->route('teachers.index')->with('success', 'Teacher created successfully!');
    }

    public function show(Teacher $teacher)
    {
        $teacher->load('department');
        return view('teachers.show', compact('teacher'));
    }

    public function edit(Teacher $teacher)
    {
        $teacher->load('department');
        $departments = Department::all();
        return view('teachers.edit', compact('teacher', 'departments'));
    }

    public function update(UpdateTeacherRequest $request, Teacher $teacher)
    {
        $teacher->update($request->validated());
        return redirect()->route('teachers.show', $teacher)->with('success', 'Teacher updated successfully!');
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return redirect()->route('teachers.index')->with('success', 'Teacher deleted successfully!');
    }
}
