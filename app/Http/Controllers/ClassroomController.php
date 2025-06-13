<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    public function index()
    {
        try {
            $classroom = Classroom::all();
            if ($classroom->count() == 0)
                return response()->json(['msg', 'Empty item'], 400);
            else
                return response()->json(['msg' => 'success', 'data' => $classroom]);
        } catch (\Exception $e) {
            return response()->json(['msg' => $e->getMessage()], 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $classroom = Classroom::create($request->all());
        return response()->json(['msg' => 'success', 'data' => $classroom], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Classroom $classroom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classroom $classroom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom)
    {
        //
    }
}
