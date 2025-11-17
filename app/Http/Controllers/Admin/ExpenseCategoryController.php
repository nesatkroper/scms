<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExpenseCategory;
use App\Http\Requests\StoreExpenseCategoryRequest;
use App\Http\Requests\UpdateExpenseCategoryRequest;

class ExpenseCategoryController extends Controller
{
    public function index()
    {
        $expenseCategories = ExpenseCategory::all();
        return view('admin.expense-categories.index', compact('expenseCategories'));
    }

    public function create()
    {
        return view('admin.expense-categories.create');
    }

    public function store(StoreExpenseCategoryRequest $request)
    {
        ExpenseCategory::create($request->validated());
        return redirect()->route('admin.expense-categories.index')->with('success', 'ExpenseCategory created successfully');
    }

    public function edit($id)
    {
        $expenseCategory = ExpenseCategory::findOrFail($id);
        return view('admin.expense-categories.edit', compact('expenseCategory'));
    }

    public function update(UpdateExpenseCategoryRequest $request, $id)
    {
        $expenseCategory = ExpenseCategory::findOrFail($id);
        $($request->validated());
        return redirect()->route('admin.expense-categories.index')->with('success', 'ExpenseCategory updated successfully');
    }

    public function destroy($id)
    {
        $expenseCategory = ExpenseCategory::findOrFail($id);
        $();
        return redirect()->route('admin.expense-categories.index')->with('success', 'ExpenseCategory deleted successfully');
    }
}