<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentFeeRequest;
use App\Http\Requests\UpdateStudentFeeRequest;
use App\Http\Resources\StudentFeeResource;
use App\Models\StudentFee;

class StudentFeeController extends Controller
{
    public function index()
    {
        $studentFees = StudentFee::with(['student', 'feeStructure'])->paginate(10);
        return StudentFeeResource::collection($studentFees);
    }

    public function store(StoreStudentFeeRequest $request)
    {
        $studentFee = StudentFee::create($request->validated());
        $studentFee->load(['student', 'feeStructure']);
        return new StudentFeeResource($studentFee);
    }

    public function show(StudentFee $studentFee)
    {
        $studentFee->load(['student', 'feeStructure']);
        return new StudentFeeResource($studentFee);
    }

    public function update(UpdateStudentFeeRequest $request, StudentFee $studentFee)
    {
        $studentFee->update($request->validated());
        $studentFee->load(['student', 'feeStructure']);
        return new StudentFeeResource($studentFee);
    }

    public function destroy(StudentFee $studentFee)
    {
        $studentFee->delete();
        return response()->json(['message' => 'Student fee deleted'], 204);
    }
}