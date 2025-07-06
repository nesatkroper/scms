<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGradeLevelRequest;
use App\Http\Requests\UpdateGradeLevelRequest;
use App\Models\GradeLevel;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class GradeLevelController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10);
        $viewType = $request->input('view', 'table');
        $gradelevels = GradeLevel::with('sections')
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate($perPage)
            ->appends([
                'search' => $search,
                'per_page' => $perPage,
                'view' => $viewType
            ]);

        if ($request->ajax()) {
            $html = [
                'table' => view('gradelevels.partials.table', compact('gradelevels'))->render(),
                'cards' => view('gradelevels.partials.cardlist', compact('gradelevels'))->render(),
                'pagination' => $gradelevels->links()->toHtml()
            ];

            return response()->json([
                'success' => true,
                'html' => $html,
                'view' => $viewType
            ]);
        }

        return view('gradelevels.index', compact('gradelevels'));
    }


    public function create()
    {
        return view('gradelevels.create');
    }

    public function store(StoreGradeLevelRequest $request)
    {
        // $gradeLevel = GradeLevel::create($request->validated());
        // $gradeLevel->load('sections');
        // return redirect()->route('gradelevels.index')->with('success', 'Grade level added successfully!');

        try {
            $gradelevel = GradeLevel::create($request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Grade level created successfully!',
                'gradelevel' => $gradelevel
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating grade level: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show(GradeLevel $gradelevel)
    {
        $gradelevel->load('sections');
        // return view('gradelevels.show', compact('gradeLevel'));
        return response()->json([
            'success' => true,
            'gradeLevel' => $gradelevel
        ]);
    }

    // public function edit(GradeLevel $gradelevel)
    // {
    //     // $gradeLevel->load('sections');
    //     // return view('gradelevels.edit', compact('gradeLevel'));

    //     $gradelevel->load('sections');
    //     return response()->json([
    //         'success' => true,
    //         'gradeLevel' => $gradelevel
    //     ]);
    // }

    public function update(UpdateGradeLevelRequest $request, GradeLevel $gradeLevel)
    {
        // $gradeLevel->update($request->validated());
        // $gradeLevel->load('sections');
        // return redirect()->route('gradelevels.show', $gradeLevel)->with('success', 'Grade level updated successfully!');

        try {
            $gradeLevel->update($request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Grade level updated successfully',
                'gradeLevel' => $gradeLevel->fresh()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating grade level: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy(GradeLevel $gradeLevel)
    {
        // $gradeLevel->delete();
        // return redirect()->route('gradelevels.index')->with('success', 'Grade level deleted successfully!');

        try {
            $gradeLevel->delete();
            return response()->json([
                'success' => true,
                'message' => 'Grade level deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting grade level: ' . $e->getMessage()
            ], 500);
        }
    }
}
