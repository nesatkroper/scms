<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExpenseCategoryRequest;
use App\Http\Requests\UpdateExpenseCategoryRequest;
use App\Models\ExpenseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ExpenseCategoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 12);
        $viewType = $request->input('view', 'table');
        
        $categories = ExpenseCategory::with('expense')
            ->when($search, function ($query) use ($search) {
                return $query->where('id', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%")
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
                'table' => view('admin.expensecategory.partials.table', compact('categories'))->render(),
                'cards' => view('admin.expensecategory.partials.cardlist', compact('categories'))->render(),
                'pagination' => $categories->links()->toHtml()
            ];

            return response()->json([
                'success' => true,
                'html' => $html,
                'view' => $viewType
            ]);
        }

        return view('admin.expensecategory.index', compact('categories'));
    }

    public function store(StoreExpenseCategoryRequest $request)
    {
        try {
            $category = ExpenseCategory::create($request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Expense category created successfully!',
                'data' => $category
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating Expense category: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show(ExpenseCategory $expensecategory)
    {
        $expensecategory->load('expense');
        return response()->json([
            'success' => true,
            'data' => $expensecategory
        ]);
    }

    public function update(UpdateExpenseCategoryRequest $request, $id)
    {
        try {
            $category = ExpenseCategory::findOrFail($id);
            $category->update($request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Expense category updated successfully',
                'data' => $category->fresh('expense')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating Expense category: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $category = ExpenseCategory::findOrFail($id);
            $category->delete();
            return response()->json([
                'success' => true,
                'message' => 'Expense category deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting Expense category: ' . $e->getMessage()
            ], 500);
        }
    }
}