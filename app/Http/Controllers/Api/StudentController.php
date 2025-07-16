<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
  public function index(): JsonResponse
  {
    try {
      $students = Student::withTrashed()->with(['gradeLevel', 'user'])->paginate(10);
      return StudentResource::collection($students)->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error retrieving students: ' . $e->getMessage()], 500);
    }
  }

  public function store(StoreStudentRequest $request): JsonResponse
  {
    DB::beginTransaction();
    try {
      $student = Student::create($request->validated());

      if ($request->has('guardians')) {
        $guardiansToAttach = [];
        foreach ($request->input('guardians') as $guardianData) {
          $guardiansToAttach[$guardianData['guardian_id']] = ['relation_to_student' => $guardianData['relation_to_student'] ?? null];
        }
        $student->guardians()->attach($guardiansToAttach);
      }

      if ($request->has('course_offerings')) {
        $coursesToAttach = [];
        foreach ($request->input('course_offerings') as $courseData) {
          $coursesToAttach[$courseData['course_offering_id']] = ['grade_final' => $courseData['grade_final'] ?? null];
        }
        $student->courseOfferings()->attach($coursesToAttach);
      }

      DB::commit();
      return (new StudentResource($student->load(['guardians', 'courseOfferings'])))->response()->setStatusCode(201);
    } catch (\Exception $e) {
      DB::rollBack();
      return response()->json(['message' => 'Error creating student: ' . $e->getMessage()], 500);
    }
  }

  public function show(Student $student): JsonResponse
  {
    try {
      $student->load(['gradeLevel', 'user', 'guardians', 'courseOfferings']);
      return (new StudentResource($student))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error retrieving student: ' . $e->getMessage()], 500);
    }
  }

  public function update(UpdateStudentRequest $request, Student $student): JsonResponse
  {
    DB::beginTransaction();
    try {
      $student->update($request->validated());

      if ($request->has('guardians')) {
        $guardiansToSync = [];
        foreach ($request->input('guardians') as $guardianData) {
          $guardiansToSync[$guardianData['guardian_id']] = ['relation_to_student' => $guardianData['relation_to_student'] ?? null];
        }
        $student->guardians()->sync($guardiansToSync);
      }

      if ($request->has('course_offerings')) {
        $coursesToSync = [];
        foreach ($request->input('course_offerings') as $courseData) {
          $coursesToSync[$courseData['course_offering_id']] = ['grade_final' => $courseData['grade_final'] ?? null];
        }
        $student->courseOfferings()->sync($coursesToSync);
      }

      DB::commit();
      return (new StudentResource($student->load(['guardians', 'courseOfferings'])))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      DB::rollBack();
      return response()->json(['message' => 'Error updating student: ' . $e->getMessage()], 500);
    }
  }

  public function destroy(Student $student): JsonResponse
  {
    DB::beginTransaction();
    try {
      $student->guardians()->detach();  // Detach pivot relationships
      $student->courseOfferings()->detach();
      $student->delete();  // Soft delete
      DB::commit();
      return response()->json(['message' => 'Student deleted successfully.'], 204);
    } catch (\Exception $e) {
      DB::rollBack();
      return response()->json(['message' => 'Error deleting student: ' . $e->getMessage()], 500);
    }
  }

  public function restore(string $id): JsonResponse
  {
    try {
      $student = Student::onlyTrashed()->findOrFail($id);
      $student->restore();
      return (new StudentResource($student))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error restoring student: ' . $e->getMessage()], 500);
    }
  }

  public function forceDelete(string $id): JsonResponse
  {
    DB::beginTransaction();
    try {
      $student = Student::onlyTrashed()->findOrFail($id);
      $student->guardians()->detach();
      $student->courseOfferings()->detach();
      $student->forceDelete();
      DB::commit();
      return response()->json(['message' => 'Student permanently deleted.'], 204);
    } catch (\Exception $e) {
      DB::rollBack();
      return response()->json(['message' => 'Error permanently deleting student: ' . $e->getMessage()], 500);
    }
  }
}
