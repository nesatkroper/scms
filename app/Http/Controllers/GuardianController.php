<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGuardianRequest;
use App\Http\Requests\UpdateGuardianRequest;
use App\Models\Guardian;

class GuardianController extends Controller
{
    public function index()
    {
        $guardians = Guardian::with('students')->paginate(10);
        return view('guardians.index', compact('guardians'));
    }

    public function create()
    {
        return view('guardians.create');
    }

    public function store(StoreGuardianRequest $request)
    {
        $guardian = Guardian::create($request->validated());
        $guardian->load('students');
        return redirect()->route('guardians.index')->with('success', 'Guardian added successfully!');
    }

    public function show(Guardian $guardian)
    {
        $guardian->load('students');
        return view('guardians.show', compact('guardian'));
    }

    public function edit(Guardian $guardian)
    {
        $guardian->load('students');
        return view('guardians.edit', compact('guardian'));
    }

    public function update(UpdateGuardianRequest $request, Guardian $guardian)
    {
        $guardian->update($request->validated());
        $guardian->load('students');
        return redirect()->route('guardians.show', $guardian)->with('success', 'Guardian updated successfully!');
    }

    public function destroy(Guardian $guardian)
    {
        $guardian->delete();
        return redirect()->route('guardians.index')->with('success', 'Guardian deleted successfully!');
    }
}
