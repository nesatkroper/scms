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
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10);
        $viewType = $request->input('view', 'table');

        $gradeScales = GradeScale::when($search, function ($query) use ($search) {
            return $query->where('id', 'like', "%{$search}%")
                ->orWhere('name', 'like', "%{$search}%")
                ->orWhere('min_percentage', 'like', "%{$search}%")
                ->orWhere('max_percentage', 'like', "%{$search}%")
                ->orWhere('gpa', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        })
            ->orderBy('min_percentage', 'asc')
            ->paginate($perPage)
            ->appends([
                'search' => $search,
                'per_page' => $perPage,
                'view' => $viewType
            ]);

        if ($request->ajax()) {
            $html = [
                'table' => view('gradescales.partials.table', compact('gradeScales'))->render(),
                'cards' => view('gradescales.partials.cardlist', compact('gradeScales'))->render(),
                'pagination' => $gradeScales->links()->toHtml()
            ];

            return response()->json([
                'success' => true,
                'html' => $html,
                'view' => $viewType
            ]);
        }

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

    public function edit(GradeScale $gradeScale, $id)
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
