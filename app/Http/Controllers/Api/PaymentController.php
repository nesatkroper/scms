<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Http\Requests\PaymentRequest;
use App\Http\Resources\PaymentResource;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $items = Payment::all();
        return PaymentResource::collection($items);
    }

    public function store(PaymentRequest $request)
    {
        $item = Payment::create($request->validated());
        return new PaymentResource($item);
    }

    public function show($id)
    {
        $item = Payment::findOrFail($id);
        return new PaymentResource($item);
    }

    public function update(PaymentRequest $request, $id)
    {
        $item = Payment::findOrFail($id);
        $item->update($request->validated());
        return new PaymentResource($item);
    }

    public function destroy($id)
    {
        $item = Payment::findOrFail($id);
        $item->delete();
        return response()->json(['message' => 'Payment deleted successfully']);
    }
}