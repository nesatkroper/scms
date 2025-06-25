<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Http\Resources\ExpenseResource;
use App\Models\Expense;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::with('approver')->paginate(10);
        return ExpenseResource::collection($expenses);
    }

    public function store(StoreExpenseRequest $request)
    {
        $expense = Expense::create($request->validated());
        $expense->load('approver');
        return new ExpenseResource($expense);
    }

    public function show(Expense $expense)
    {
        $expense->load('approver');
        return new ExpenseResource($expense);
    }

    public function update(UpdateExpenseRequest $request, Expense $expense)
    {
        $expense->update($request->validated());
        $expense->load('approver');
        return new ExpenseResource($expense);
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();
        return response()->json(['message' => 'Expense deleted'], 204);
    }
}