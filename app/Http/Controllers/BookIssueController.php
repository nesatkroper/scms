<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookIssueRequest;
use App\Http\Requests\UpdateBookIssueRequest;
use App\Http\Resources\BookIssueResource;
use App\Models\BookIssue;

class BookIssueController extends Controller
{
    public function index()
    {
        $bookIssues = BookIssue::with(['book', 'user'])->paginate(10);
        return BookIssueResource::collection($bookIssues);
    }

    public function store(StoreBookIssueRequest $request)
    {
        $bookIssue = BookIssue::create($request->validated());
        $bookIssue->load(['book', 'user']);
        return new BookIssueResource($bookIssue);
    }

    public function show(BookIssue $bookIssue)
    {
        $bookIssue->load(['book', 'user']);
        return new BookIssueResource($bookIssue);
    }

    public function update(UpdateBookIssueRequest $request, BookIssue $bookIssue)
    {
        $bookIssue->update($request->validated());
        $bookIssue->load(['book', 'user']);
        return new BookIssueResource($bookIssue);
    }

    public function destroy(BookIssue $bookIssue)
    {
        $bookIssue->delete();
        return response()->json(['message' => 'Book issue deleted'], 204);
    }
}
