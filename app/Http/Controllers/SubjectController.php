<?php

namespace AppHttp\Controllers;

use AppHttpRequests\StoreSubjectRequest;
use AppHttpRequests\UpdateSubjectRequest;
use AppModels\Subject;
use AppModels\Department; 

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::with('department')->paginate(10);
        return view('subjects.index', compact('subjects'));
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
        return view('subjects.show', compact('subject'));
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
        return redirect()->route('subjects.show', $subject)->with('success', 'Subject updated successfully!');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('subjects.index')->with('success', 'Subject deleted successfully!');
    }
}
