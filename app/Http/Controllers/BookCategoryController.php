<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookCategoryRequest;
use App\Http\Requests\UpdateBookCategoryRequest;
use App\Models\BookCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class BookCategoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10);
        $viewType = $request->input('view', 'table');
        
        $categories = BookCategory::with('books')
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
                'table' => view('admin.bookcategory.partials.table', compact('categories'))->render(),
                'cards' => view('admin.bookcategory.partials.cardlist', compact('categories'))->render(),
                'pagination' => $categories->links()->toHtml()
            ];

            return response()->json([
                'success' => true,
                'html' => $html,
                'view' => $viewType
            ]);
        }

        return view('admin.bookcategory.index', compact('categories'));
    }

    public function store(StoreBookCategoryRequest $request)
    {
        try {
            $category = BookCategory::create($request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Book category created successfully!',
                'category' => $category
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating book category: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show(BookCategory $bookcategory)
    {
        $bookcategory->load('books');
        return response()->json([
            'success' => true,
            'category' => $bookcategory
        ]);
    }

    public function update(UpdateBookCategoryRequest $request, $id)
    {
        try {
            $category = BookCategory::findOrFail($id);
            $category->update($request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Book category updated successfully',
                'category' => $category->fresh('books')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating book category: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $category = BookCategory::findOrFail($id);
            $category->delete();
            return response()->json([
                'success' => true,
                'message' => 'Book category deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting book category: ' . $e->getMessage()
            ], 500);
        }
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');

        if (empty($ids)) {
            return response()->json([
                'success' => false,
                'message' => 'No book categories selected'
            ], 400);
        }

        try {
            $count = BookCategory::whereIn('id', $ids)->delete();
            return response()->json([
                'success' => true,
                'message' => $count . ' book categories deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting book categories: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getBulkData(Request $request)
    {
        $ids = $request->input('ids');

        if (empty($ids)) {
            return response()->json([
                'success' => false,
                'message' => 'No book categories selected'
            ], 400);
        }

        if (count($ids) > 5) {
            return response()->json([
                'success' => false,
                'message' => 'You can only edit up to 5 book categories at a time'
            ], 400);
        }

        try {
            $categories = BookCategory::whereIn('id', $ids)->get();
            return response()->json([
                'success' => true,
                'data' => $categories
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching book categories: ' . $e->getMessage()
            ], 500);
        }
    }

    public function bulkUpdate(Request $request)
    {
        $request->validate([
            'book_categories' => 'required|array',
            'book_categories.*.id' => 'required|exists:book_categories,id',
        ]);

        $updatedCount = 0;

        foreach ($request->input('book_categories') as $categoryData) {
            $validator = Validator::make($categoryData, [
                'id' => 'required|exists:book_categories,id',
                'name' => [
                    'sometimes',
                    'string',
                    'max:255',
                    Rule::unique('book_categories', 'name')->ignore($categoryData['id'], 'id'),
                ],
                'description' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                Log::error("Validation failed for book category ID {$categoryData['id']}: " . json_encode($validator->errors()));
                continue;
            }

            try {
                $category = BookCategory::findOrFail($categoryData['id']);
                $category->update($validator->validated());
                $updatedCount++;
            } catch (\Exception $e) {
                Log::error("Error updating book category: " . $e->getMessage());
            }
        }

        return response()->json([
            'success' => true,
            'message' => "Successfully updated $updatedCount book categories",
            'redirect' => route('admin.bookcategory.index')
        ]);
    }
}