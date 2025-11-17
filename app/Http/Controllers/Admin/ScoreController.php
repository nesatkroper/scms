<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Score;
use App\Http\Requests\StoreScoreRequest;
use App\Http\Requests\UpdateScoreRequest;

class ScoreController extends Controller
{
    public function index()
    {
        $scores = Score::all();
        return view('admin.scores.index', compact('scores'));
    }

    public function create()
    {
        return view('admin.scores.create');
    }

    public function store(StoreScoreRequest $request)
    {
        Score::create($request->validated());
        return redirect()->route('admin.scores.index')->with('success', 'Score created successfully');
    }

    public function edit($id)
    {
        $score = Score::findOrFail($id);
        return view('admin.scores.edit', compact('score'));
    }

    public function update(UpdateScoreRequest $request, $id)
    {
        $score = Score::findOrFail($id);
        $($request->validated());
        return redirect()->route('admin.scores.index')->with('success', 'Score updated successfully');
    }

    public function destroy($id)
    {
        $score = Score::findOrFail($id);
        $();
        return redirect()->route('admin.scores.index')->with('success', 'Score deleted successfully');
    }
}