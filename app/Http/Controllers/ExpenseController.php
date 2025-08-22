<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10);
        $viewType = $request->input('view', 'table');
        $users = User::all();
        $expenseCategory = ExpenseCategory::all();
        $expenses = Expense::with('approver')
            ->when($search, function ($query) use ($search) {
                return $query->where('id', 'like', "%{$search}%")
                    ->orWhere('title', 'like', "%{$search}%")
                    ->orWhere('amount', 'like', "%{$search}%")
                    ->orWhere('date', 'like', "%{$search}%")
                    ->orWhere('expense_category_id', 'like', "%{$search}%")
                    ->orWhere('approved_by', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate($perPage)
            ->appends([
                'search' => $search,
                'per_page' => $perPage,
                'view' => $viewType
            ]);

        if ($request->ajax()) {
            $html = [
                'table' => view('admin.expenses.partials.table', compact('expenses'))->render(),
                'cards' => view('admin.expenses.partials.cardlist', compact('expenses'))->render(),
                'pagination' => $expenses->links()->toHtml()
            ];

            return response()->json([
                'success' => true,
                'html' => $html,
                'view' => $viewType
            ]);
        }

        return view('admin.expenses.index', compact('expenses', 'users'));
    }

    public function store(StoreExpenseRequest $request)
    {
        try {
            $expense = Expense::create($request->validated());
            $expense->load('approver');
            return response()->json([
                'success' => true,
                'message' => 'Expense added successfully!',
                'expense' => $expense
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating expense: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show(Expense $expense)
    {
        $expense->load('approver');
        return response()->json([
            'success' => true,
            'expenses' => $expense,
        ]);
    }

    public function edit(Expense $expense)
    {
        $expense->load('approver');
        return view('admin.expenses.edit', compact('expense'));
    }

    public function update(UpdateExpenseRequest $request, $id)
    {
        try {
            $expense = Expense::findOrFail($id);
            $expense->update($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Expense updated successfully!',
                'expense' => $expense->fresh('approver')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating expense: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $expense = Expense::findOrFail($id);
            $expense->delete();
            return response()->json([
                'success' => true,
                'message' => 'Expense deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting expense: ' . $e->getMessage()
            ], 500);
        }
    }
}
