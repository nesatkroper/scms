<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use App\Models\BookCategory;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10);
        $viewType = $request->input('view', 'table');
        $categories = BookCategory::where('name', 'like', "%{$search}%")->get();
        $books = Book::when($search, function ($query) use ($search) {
            return $query->where('title', 'like', "%{$search}%")
                ->orWhere('author', 'like', "%{$search}%")
                ->orWhere('isbn', 'like', "%{$search}%")
                ->orWhere('publisher', 'like', "%{$search}%")
                ->orWhere('category_id', 'like', "%{$search}%");
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
                'table' => view('admin.books.partials.table', compact('books'))->render(),
                'cards' => view('admin.books.partials.cardlist', compact('books'))->render(),
                'pagination' => $books->links()->toHtml()
            ];

            return response()->json([
                'success' => true,
                'html' => $html,
                'view' => $viewType
            ]);
        }

        return view('admin.books.index', compact('books', 'categories'));
    }

    public function create()
    {
        return view('admin.books.create');
    }

    public function store(StoreBookRequest $request)
    {
        try {
            $data = $request->validated();

            if ($request->hasFile('cover_image')) {
                $data['cover_image'] = $request->file('cover_image')->store('books', 'public');
            }

            $book = Book::create($data);

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Book added successfully!',
                    'data' => $book
                ]);
            }

            return redirect()->route('admin.books.index')->with('success', 'Book added successfully!');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error adding book: ' . $e->getMessage()
                ], 500);
            }

            return back()->with('error', 'Error adding book: ' . $e->getMessage());
        }
    }

    public function show(Book $book)
    {
        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'data' => $book
            ]);
        }
        return view('admin.books.show', compact('book'));
    }

    public function update(UpdateBookRequest $request, Book $book)
    {
        try {
            $data = $request->validated();

            if ($request->hasFile('cover_image')) {
                // Delete old cover if exists
                if ($book->cover_image) {
                    Storage::disk('public')->delete($book->cover_image);
                }
                $data['cover_image'] = $request->file('cover_image')->store('books', 'public');
            } elseif (isset($data['cover_image_removed']) && $data['cover_image_removed']) {
                if ($book->cover_image) {
                    Storage::disk('public')->delete($book->cover_image);
                    $data['cover_image'] = null;
                }
            }

            $book->update($data);

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Book updated successfully!',
                    'book' => $book
                ]);
            }

            return redirect()->route('books.show', $book)->with('success', 'Book updated successfully!');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error updating book: ' . $e->getMessage()
                ], 500);
            }

            return back()->with('error', 'Error updating book: ' . $e->getMessage());
        }
    }

    public function destroy(Book $book)
    {
        try {
            if ($book->cover_image) {
                Storage::disk('public')->delete($book->cover_image);
            }

            $book->delete();

            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Book deleted successfully!'
                ]);
            }

            return redirect()->route('books.index')->with('success', 'Book deleted successfully!');
        } catch (\Exception $e) {
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error deleting book: ' . $e->getMessage()
                ], 500);
            }

            return back()->with('error', 'Error deleting book: ' . $e->getMessage());
        }
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');

        if (empty($ids)) {
            return response()->json([
                'success' => false,
                'message' => 'No books selected'
            ], 400);
        }

        try {
            $books = Book::whereIn('id', $ids)->get();
            foreach ($books as $book) {
                if ($book->cover_image) {
                    Storage::disk('public')->delete($book->cover_image);
                }
            }

            $count = Book::whereIn('id', $ids)->delete();
            return response()->json([
                'success' => true,
                'message' => $count . ' books deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting books: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getBulkData(Request $request)
    {
        $ids = $request->input('ids');

        if (empty($ids)) {
            return response()->json([
                'success' => false,
                'message' => 'No books selected'
            ], 400);
        }

        if (count($ids) > 5) {
            return response()->json([
                'success' => false,
                'message' => 'You can only edit up to 5 books at a time'
            ], 400);
        }

        try {
            $books = Book::whereIn('id', $ids)->get();
            return response()->json([
                'success' => true,
                'data' => $books
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching books: ' . $e->getMessage()
            ], 500);
        }
    }

    public function bulkUpdate(Request $request)
    {
        $request->validate([
            'books' => 'required|array',
            'books.*.id' => 'required|exists:books,id',
        ]);

        $updatedCount = 0;

        foreach ($request->input('books') as $bookData) {
            $validator = Validator::make($bookData, [
                'id' => 'required|exists:books,id',
                'title' => 'sometimes|string|max:255',
                'author' => 'sometimes|string|max:255',
                'isbn' => [
                    'sometimes',
                    'string',
                    'max:20',
                    Rule::unique('books', 'isbn')->ignore($bookData['id']),
                ],
                'publication_year' => 'sometimes|digits:4|integer|min:1900|max:' . (date('Y') + 1),
                'publisher' => 'sometimes|string|max:255',
                'quantity' => 'sometimes|integer|min:0',
                'description' => 'nullable|string',
                'category' => 'sometimes|string|max:255'
            ]);

            if ($validator->fails()) {
                Log::error("Validation failed for book ID {$bookData['id']}: " . json_encode($validator->errors()));
                continue;
            }

            try {
                $book = Book::findOrFail($bookData['id']);
                $book->update($validator->validated());
                $updatedCount++;
            } catch (\Exception $e) {
                Log::error("Error updating book: " . $e->getMessage());
            }
        }

        return response()->json([
            'success' => true,
            'message' => "Successfully updated $updatedCount books",
            'redirect' => route('admin.books.index')
        ]);
    }
}
