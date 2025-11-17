<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeacherSubject;
use App\Http\Requests\StoreTeacherSubjectRequest;
use App\Http\Requests\UpdateTeacherSubjectRequest;

class TeacherSubjectController extends Controller
{
    public function index()
    {
        $teacherSubjects = TeacherSubject::all();
        return view('admin.teacher-subjects.index', compact('teacherSubjects'));
    }

    public function create()
    {
        return view('admin.teacher-subjects.create');
    }

    public function store(StoreTeacherSubjectRequest $request)
    {
        TeacherSubject::create($request->validated());
        return redirect()->route('admin.teacher-subjects.index')->with('success', 'TeacherSubject created successfully');
    }

    public function edit($id)
    {
        $teacherSubject = TeacherSubject::findOrFail($id);
        return view('admin.teacher-subjects.edit', compact('teacherSubject'));
    }

    public function update(UpdateTeacherSubjectRequest $request, $id)
    {
        $teacherSubject = TeacherSubject::findOrFail($id);
        $($request->validated());
        return redirect()->route('admin.teacher-subjects.index')->with('success', 'TeacherSubject updated successfully');
    }

    public function destroy($id)
    {
        $teacherSubject = TeacherSubject::findOrFail($id);
        $();
        return redirect()->route('admin.teacher-subjects.index')->with('success', 'TeacherSubject deleted successfully');
    }
}