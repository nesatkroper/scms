<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFeeStructureRequest;
use App\Http\Requests\UpdateFeeStructureRequest;
use App\Models\FeeStructure;

class FeeStructureController extends Controller
{
    public function index()
    {
        $feeStructures = FeeStructure::with('gradeLevel')->paginate(10);
        return view('feestructures.index', compact('feeStructures'));
    }

    public function create()
    {
        return view('feestructures.create');
    }

    public function store(StoreFeeStructureRequest $request)
    {
        $feeStructure = FeeStructure::create($request->validated());
        $feeStructure->load('gradeLevel');
        return redirect()->route('feestructures.index')->with('success', 'Fee structure added successfully!');
    }

    public function show(FeeStructure $feeStructure)
    {
        $feeStructure->load('gradeLevel');
        return view('feestructures.show', compact('feeStructure'));
    }

    public function edit(FeeStructure $feeStructure)
    {
        $feeStructure->load('gradeLevel');
        return view('feestructures.edit', compact('feeStructure'));
    }

    public function update(UpdateFeeStructureRequest $request, FeeStructure $feeStructure)
    {
        $feeStructure->update($request->validated());
        $feeStructure->load('gradeLevel');
        return redirect()->route('feestructures.show', $feeStructure)->with('success', 'Fee structure updated successfully!');
    }

    public function destroy(FeeStructure $feeStructure)
    {
        $feeStructure->delete();
        return redirect()->route('feestructures.index')->with('success', 'Fee structure deleted successfully!');
    }
}
