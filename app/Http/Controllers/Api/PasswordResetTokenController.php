<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PasswordResetToken;
use App\Http\Requests\PasswordResetTokenRequest;
use App\Http\Resources\PasswordResetTokenResource;
use Illuminate\Http\Request;

class PasswordResetTokenController extends Controller
{
    public function index()
    {
        $items = PasswordResetToken::all();
        return PasswordResetTokenResource::collection($items);
    }

    public function store(PasswordResetTokenRequest $request)
    {
        $item = PasswordResetToken::create($request->validated());
        return new PasswordResetTokenResource($item);
    }

    public function show($id)
    {
        $item = PasswordResetToken::findOrFail($id);
        return new PasswordResetTokenResource($item);
    }

    public function update(PasswordResetTokenRequest $request, $id)
    {
        $item = PasswordResetToken::findOrFail($id);
        $item->update($request->validated());
        return new PasswordResetTokenResource($item);
    }

    public function destroy($id)
    {
        $item = PasswordResetToken::findOrFail($id);
        $item->delete();
        return response()->json(['message' => 'PasswordResetToken deleted successfully']);
    }
}