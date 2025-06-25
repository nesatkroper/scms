<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookIssueRequest;
use App\Http\Requests\UpdateBookIssueRequest;
use App\Models\BookIssue;

class BookIssueController extends Controller
{
    public function index()
    {
        $bookIssues = BookIssue::with(['book', 'user'])->paginate(10);
        return view('bookissues.index', compact('bookIssues'));
    }

    public function create()
    {
        
        return view('bookissues.create');
    }

    public function store(StoreBookIssueRequest $request)
    {
        BookIssue::create($request->validated());
        return redirect()->route('bookissues.index')->with('success', 'Book issue recorded successfully!');
    }

    public function show(BookIssue $bookIssue)
    {
        $bookIssue->load(['book', 'user']);
        return view('bookissues.show', compact('bookIssue'));
    }

    public function edit(BookIssue $bookIssue)
    {
        $bookIssue->load(['book', 'user']);
        
        return view('bookissues.edit', compact('bookIssue'));
    }

    public function update(UpdateBookIssueRequest $request, BookIssue $bookIssue)
    {
        $bookIssue->update($request->validated());
        return redirect()->route('bookissues.show', $bookIssue)->with('success', 'Book issue updated successfully!');
    }

    public function destroy(BookIssue $bookIssue)
    {
        $bookIssue->delete();
        return redirect()->route('bookissues.index')->with('success', 'Book issue deleted successfully!');
    }
}
