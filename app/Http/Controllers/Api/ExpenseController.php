<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Http\Requests\ExpenseRequest;
use App\Http\Resources\ExpenseResource;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index()
    {
        $items = Expense::all();
        return ExpenseResource::collection($items);
    }

    public function store(ExpenseRequest $request)
    {
        $item = Expense::create($request->validated());
        return new ExpenseResource($item);
    }

    public function show($id)
    {
        $item = Expense::findOrFail($id);
        return new ExpenseResource($item);
    }

    public function update(ExpenseRequest $request, $id)
    {
        $item = Expense::findOrFail($id);
        $item->update($request->validated());
        return new ExpenseResource($item);
    }

    public function destroy($id)
    {
        $item = Expense::findOrFail($id);
        $item->delete();
        return response()->json(['message' => 'Expense deleted successfully']);
    }
}