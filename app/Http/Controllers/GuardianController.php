<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGuardianRequest;
use App\Http\Requests\UpdateGuardianRequest;
use App\Http\Resources\GuardianResource;
use App\Models\Guardian;

class GuardianController extends Controller
{
    public function index()
    {
        $guardians = Guardian::with('students')->paginate(10);
        return GuardianResource::collection($guardians);
    }

    public function store(StoreGuardianRequest $request)
    {
        $guardian = Guardian::create($request->validated());
        $guardian->load('students');
        return new GuardianResource($guardian);
    }

    public function show(Guardian $guardian)
    {
        $guardian->load('students');
        return new GuardianResource($guardian);
    }

    public function update(UpdateGuardianRequest $request, Guardian $guardian)
    {
        $guardian->update($request->validated());
        $guardian->load('students');
        return new GuardianResource($guardian);
    }

    public function destroy(Guardian $guardian)
    {
        $guardian->delete();
        return response()->json(['message' => 'Guardian deleted'], 204);
    }
}
