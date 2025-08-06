<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookIssueRequest;
use App\Http\Requests\UpdateBookIssueRequest;
use App\Models\BookIssue;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class BookIssueController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10);
        $viewType = $request->input('view', 'table');
        $books = Book::all();
        $users = User::all();
        $bookIssues = BookIssue::with(['book', 'user'])
            ->when($search, function ($query) use ($search) {
                return $query->whereHas('book', function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%");
                })
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    })
                    ->orWhere('status', 'like', "%{$search}%");
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
                'table' => view('admin.bookissues.partials.table', compact('bookIssues'))->render(),
                'cards' => view('admin.bookissues.partials.cardlist', compact('bookIssues'))->render(),
                'pagination' => $bookIssues->links()->toHtml()
            ];

            return response()->json([
                'success' => true,
                'html' => $html,
                'view' => $viewType
            ]);
        }

        return view('admin.bookissues.index', compact('bookIssues', 'books', 'users'));
    }

    public function store(StoreBookIssueRequest $request)
    {
        try {
            $bookIssue = BookIssue::create($request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Book issue created successfully!',
                'bookIssue' => $bookIssue->load(['book', 'user'])
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating book issue: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show(BookIssue $bookIssue)
    {
        $bookIssue->load(['book', 'user']);
        return response()->json([
            'success' => true,
            'bookIssue' => $bookIssue
        ]);
    }

    public function update(UpdateBookIssueRequest $request, BookIssue $bookIssue)
    {
        try {
            $bookIssue->update($request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Book issue updated successfully',
                'bookIssue' => $bookIssue->fresh(['book', 'user'])
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating book issue: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy(BookIssue $bookIssue)
    {
        try {
            $bookIssue->delete();
            return response()->json([
                'success' => true,
                'message' => 'Book issue deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting book issue: ' . $e->getMessage()
            ], 500);
        }
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');

        if (empty($ids)) {
            return response()->json([
                'success' => false,
                'message' => 'No book issues selected'
            ], 400);
        }

        try {
            $count = BookIssue::whereIn('id', $ids)->delete();
            return response()->json([
                'success' => true,
                'message' => $count . ' book issues deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting book issues: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getBulkData(Request $request)
    {
        $ids = $request->input('ids');

        if (empty($ids)) {
            return response()->json([
                'success' => false,
                'message' => 'No book issues selected'
            ], 400);
        }

        if (count($ids) > 5) {
            return response()->json([
                'success' => false,
                'message' => 'You can only edit up to 5 book issues at a time'
            ], 400);
        }

        try {
            $bookIssues = BookIssue::with(['book', 'user'])->whereIn('id', $ids)->get();
            return response()->json([
                'success' => true,
                'data' => $bookIssues
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching book issues: ' . $e->getMessage()
            ], 500);
        }
    }

    public function bulkUpdate(Request $request)
    {
        $request->validate([
            'book_issues' => 'required|array',
            'book_issues.*.id' => 'required|exists:book_issues,id',
        ]);

        $updatedCount = 0;

        foreach ($request->input('book_issues') as $bookIssueData) {
            $validator = Validator::make($bookIssueData, [
                'id' => 'required|exists:book_issues,id',
                'issue_date' => 'required|date',
                'due_date' => 'required|date',
                'return_date' => 'nullable|date',
                'fine' => 'nullable|numeric',
                'status' => 'required|in:issued,returned,overdue'
            ]);

            if ($validator->fails()) {
                Log::error("Validation failed for book issue ID {$bookIssueData['id']}: "
                    . json_encode($validator->errors()));
                continue;
            }

            try {
                $bookIssue = BookIssue::findOrFail($bookIssueData['id']);
                $bookIssue->update($validator->validated());
                $updatedCount++;
            } catch (\Exception $e) {
                Log::error("Error updating book issue: " . $e->getMessage());
            }
        }

        return response()->json([
            'success' => true,
            'message' => "Successfully updated $updatedCount book issues",
            'redirect' => route('admin.bookissues.index')
        ]);
    }
}
