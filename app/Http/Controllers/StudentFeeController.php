<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentFeeRequest;
use App\Http\Requests\UpdateStudentFeeRequest;
use App\Models\StudentFee;
use App\Models\Student;    
use App\Models\FeeStructure; 

class StudentFeeController extends Controller
{
    public function index()
    {
        $studentFees = StudentFee::with(['student', 'feeStructure'])->paginate(10);
        return view('studentfees.index', compact('studentFees'));
    }

    public function create()
    {
        $students = Student::all();
        $feeStructures = FeeStructure::all();
        return view('studentfees.create', compact('students', 'feeStructures'));
    }

    public function store(StoreStudentFeeRequest $request)
    {
        $studentFee = StudentFee::create($request->validated());
        return redirect()->route('studentfees.index')->with('success', 'Student fee created successfully!');
    }

    public function show(StudentFee $studentFee)
    {
        $studentFee->load(['student', 'feeStructure']);
        return view('studentfees.show', compact('studentFee'));
    }

    public function edit(StudentFee $studentFee)
    {
        $studentFee->load(['student', 'feeStructure']);
        $students = Student::all();
        $feeStructures = FeeStructure::all();
        return view('studentfees.edit', compact('studentFee', 'students', 'feeStructures'));
    }

    public function update(UpdateStudentFeeRequest $request, StudentFee $studentFee)
    {
        $studentFee->update($request->validated());
        return redirect()->route('studentfees.show', $studentFee)->with('success', 'Student fee updated successfully!');
    }

    public function destroy(StudentFee $studentFee)
    {
        $studentFee->delete();
        return redirect()->route('studentfees.index')->with('success', 'Student fee deleted successfully!');
    }
}
