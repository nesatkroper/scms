<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Session;
use App\Http\Requests\SessionRequest;
use App\Http\Resources\SessionResource;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function index()
    {
        $items = Session::all();
        return SessionResource::collection($items);
    }

    public function store(SessionRequest $request)
    {
        $item = Session::create($request->validated());
        return new SessionResource($item);
    }

    public function show($id)
    {
        $item = Session::findOrFail($id);
        return new SessionResource($item);
    }

    public function update(SessionRequest $request, $id)
    {
        $item = Session::findOrFail($id);
        $item->update($request->validated());
        return new SessionResource($item);
    }

    public function destroy($id)
    {
        $item = Session::findOrFail($id);
        $item->delete();
        return response()->json(['message' => 'Session deleted successfully']);
    }
}