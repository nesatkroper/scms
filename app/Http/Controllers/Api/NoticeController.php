<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNoticeRequest;
use App\Http\Requests\UpdateNoticeRequest;
use App\Http\Resources\NoticeResource;
use App\Models\Notice;

class NoticeController extends Controller
{
    public function index()
    {
        $notices = Notice::with('creator')->paginate(10);
        return NoticeResource::collection($notices);
    }

    public function store(StoreNoticeRequest $request)
    {
        $notice = Notice::create($request->validated());
        $notice->load('creator');
        return new NoticeResource($notice);
    }

    public function show(Notice $notice)
    {
        $notice->load('creator');
        return new NoticeResource($notice);
    }

    public function update(UpdateNoticeRequest $request, Notice $notice)
    {
        $notice->update($request->validated());
        $notice->load('creator');
        return new NoticeResource($notice);
    }

    public function destroy(Notice $notice)
    {
        $notice->delete();
        return response()->json(['message' => 'Notice deleted'], 204);
    }
}