<?php


namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClassSubjectRequest;
use App\Http\Requests\UpdateClassSubjectRequest;
use App\Http\Resources\ClassSubjectResource;
use App\Models\ClassSubject;

class ClassSubjectController extends Controller
{
    public function index()
    {
        $classSubjects = ClassSubject::with(['section', 'subject', 'teacher'])->paginate(10);
        return ClassSubjectResource::collection($classSubjects);
    }

    public function store(StoreClassSubjectRequest $request)
    {
        $classSubject = ClassSubject::create($request->validated());
        $classSubject->load(['section', 'subject', 'teacher']);
        return new ClassSubjectResource($classSubject);
    }

    public function show(ClassSubject $classSubject)
    {
        $classSubject->load(['section', 'subject', 'teacher']);
        return new ClassSubjectResource($classSubject);
    }

    public function update(UpdateClassSubjectRequest $request, ClassSubject $classSubject)
    {
        $classSubject->update($request->validated());
        $classSubject->load(['section', 'subject', 'teacher']);
        return new ClassSubjectResource($classSubject);
    }

    public function destroy(ClassSubject $classSubject)
    {
        $classSubject->delete();
        return response()->json(['message' => 'Class subject deleted'], 204);
    }
}