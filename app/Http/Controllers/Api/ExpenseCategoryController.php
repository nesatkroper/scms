<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ExpenseCategory;
use App\Http\Requests\ExpenseCategoryRequest;
use App\Http\Resources\ExpenseCategoryResource;
use Illuminate\Http\Request;

class ExpenseCategoryController extends Controller
{
    public function index()
    {
        $items = ExpenseCategory::all();
        return ExpenseCategoryResource::collection($items);
    }

    public function store(ExpenseCategoryRequest $request)
    {
        $item = ExpenseCategory::create($request->validated());
        return new ExpenseCategoryResource($item);
    }

    public function show($id)
    {
        $item = ExpenseCategory::findOrFail($id);
        return new ExpenseCategoryResource($item);
    }

    public function update(ExpenseCategoryRequest $request, $id)
    {
        $item = ExpenseCategory::findOrFail($id);
        $item->update($request->validated());
        return new ExpenseCategoryResource($item);
    }

    public function destroy($id)
    {
        $item = ExpenseCategory::findOrFail($id);
        $item->delete();
        return response()->json(['message' => 'ExpenseCategory deleted successfully']);
    }
}