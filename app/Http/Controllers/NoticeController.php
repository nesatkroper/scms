<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNoticeRequest;
use App\Http\Requests\UpdateNoticeRequest;
use App\Models\Notice;
use App\Models\User; 

class NoticeController extends Controller
{
    public function index()
    {
        $notices = Notice::with('creator')->paginate(10);
        return view('notices.index', compact('notices'));
    }

    public function create()
    {
        $creators = User::all(); 
        return view('notices.create', compact('creators'));
    }

    public function store(StoreNoticeRequest $request)
    {
        $notice = Notice::create($request->validated());
        return redirect()->route('notices.index')->with('success', 'Notice created successfully!');
    }

    public function show(Notice $notice)
    {
        $notice->load('creator');
        return view('notices.show', compact('notice'));
    }

    public function edit(Notice $notice)
    {
        $notice->load('creator');
        $creators = User::all(); 
        return view('notices.edit', compact('notice', 'creators'));
    }

    public function update(UpdateNoticeRequest $request, Notice $notice)
    {
        $notice->update($request->validated());
        return redirect()->route('notices.show', $notice)->with('success', 'Notice updated successfully!');
    }

    public function destroy(Notice $notice)
    {
        $notice->delete();
        return redirect()->route('notices.index')->with('success', 'Notice deleted successfully!');
    }
}
