<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGradeScaleRequest;
use App\Http\Requests\UpdateGradeScaleRequest;
use App\Models\GradeScale;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class GradeScaleController extends Controller
{
  public function index()
  {
    $gradeScales = GradeScale::paginate(10);
    return view('gradescales.index', compact('gradeScales'));
  }

  public function create()
  {
    return view('gradescales.create');
  }

  public function store(StoreGradeScaleRequest $request)
  {
    $gradeScale = GradeScale::create($request->validated());
    return redirect()->route('gradescales.index')->with('success', 'Grade scale added successfully!');
  }

  public function show(GradeScale $gradeScale)
  {
    return view('gradescales.show', compact('gradeScale'));
  }

  public function edit(GradeScale $gradeScale)
  {
    return view('gradescales.edit', compact('gradeScale'));
  }

  public function update(UpdateGradeScaleRequest $request, GradeScale $gradeScale)
  {
    $gradeScale->update($request->validated());
    return redirect()->route('gradescales.show', $gradeScale)->with('success', 'Grade scale updated successfully!');
  }

  public function destroy(GradeScale $gradeScale)
  {
    $gradeScale->delete();
    return redirect()->route('gradescales.index')->with('success', 'Grade scale deleted successfully!');
  }
}
