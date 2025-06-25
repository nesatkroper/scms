<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Http\Resources\SubjectResource;
use App\Models\Subject;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::with('department')->paginate(10);
        return SubjectResource::collection($subjects);
    }

    public function store(StoreSubjectRequest $request)
    {
        $subject = Subject::create($request->validated());
        $subject->load('department');
        return new SubjectResource($subject);
    }

    public function show(Subject $subject)
    {
        $subject->load('department');
        return new SubjectResource($subject);
    }

    public function update(UpdateSubjectRequest $request, Subject $subject)
    {
        $subject->update($request->validated());
        $subject->load('department');
        return new SubjectResource($subject);
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        return response()->json(['message' => 'Subject deleted'], 204);
    }
}