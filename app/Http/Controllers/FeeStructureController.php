<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFeeStructureRequest;
use App\Http\Requests\UpdateFeeStructureRequest;
use App\Http\Resources\FeeStructureResource;
use App\Models\FeeStructure;

class FeeStructureController extends Controller
{
    public function index()
    {
        $feeStructures = FeeStructure::with('gradeLevel')->paginate(10);
        return FeeStructureResource::collection($feeStructures);
    }

    public function store(StoreFeeStructureRequest $request)
    {
        $feeStructure = FeeStructure::create($request->validated());
        $feeStructure->load('gradeLevel');
        return new FeeStructureResource($feeStructure);
    }

    public function show(FeeStructure $feeStructure)
    {
        $feeStructure->load('gradeLevel');
        return new FeeStructureResource($feeStructure);
    }

    public function update(UpdateFeeStructureRequest $request, FeeStructure $feeStructure)
    {
        $feeStructure->update($request->validated());
        $feeStructure->load('gradeLevel');
        return new FeeStructureResource($feeStructure);
    }

    public function destroy(FeeStructure $feeStructure)
    {
        $feeStructure->delete();
        return response()->json(['message' => 'Fee structure deleted'], 204);
    }
}
