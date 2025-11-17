<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $items = User::all();
        return UserResource::collection($items);
    }

    public function store(UserRequest $request)
    {
        $item = User::create($request->validated());
        return new UserResource($item);
    }

    public function show($id)
    {
        $item = User::findOrFail($id);
        return new UserResource($item);
    }

    public function update(UserRequest $request, $id)
    {
        $item = User::findOrFail($id);
        $item->update($request->validated());
        return new UserResource($item);
    }

    public function destroy($id)
    {
        $item = User::findOrFail($id);
        $item->delete();
        return response()->json(['message' => 'User deleted successfully']);
    }
}