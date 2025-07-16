<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSectionRequest;
use App\Http\Requests\UpdateSectionRequest;
use App\Http\Resources\SectionResource;
use App\Models\Section;
use Illuminate\Http\JsonResponse;

class SectionController extends Controller
{
  public function index(): JsonResponse
  {
    try {
      $sections = Section::withTrashed()->with(['gradeLevel', 'teacher'])->paginate(10);
      return SectionResource::collection($sections)->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error retrieving sections: ' . $e->getMessage()], 500);
    }
  }

  public function store(StoreSectionRequest $request): JsonResponse
  {
    try {
      $section = Section::create($request->validated());
      return (new SectionResource($section))->response()->setStatusCode(201);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error creating section: ' . $e->getMessage()], 500);
    }
  }

  public function show(Section $section): JsonResponse
  {
    try {
      $section->load(['gradeLevel', 'teacher']);
      return (new SectionResource($section))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error retrieving section: ' . $e->getMessage()], 500);
    }
  }

  public function update(UpdateSectionRequest $request, Section $section): JsonResponse
  {
    try {
      $section->update($request->validated());
      return (new SectionResource($section))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error updating section: ' . $e->getMessage()], 500);
    }
  }

  public function destroy(Section $section): JsonResponse
  {
    try {
      $section->delete();
      return response()->json(['message' => 'Section deleted successfully.'], 204);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error deleting section: ' . $e->getMessage()], 500);
    }
  }

  public function restore(string $id): JsonResponse
  {
    try {
      $section = Section::onlyTrashed()->findOrFail($id);
      $section->restore();
      return (new SectionResource($section))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error restoring section: ' . $e->getMessage()], 500);
    }
  }

  public function forceDelete(string $id): JsonResponse
  {
    try {
      $section = Section::onlyTrashed()->findOrFail($id);
      $section->forceDelete();
      return response()->json(['message' => 'Section permanently deleted.'], 204);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error permanently deleting section: ' . $e->getMessage()], 500);
    }
  }
}
