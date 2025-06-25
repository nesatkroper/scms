<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Http\Resources\PaymentResource;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with(['studentFee', 'receiver'])->paginate(10);
        return PaymentResource::collection($payments);
    }

    public function store(StorePaymentRequest $request)
    {
        $payment = Payment::create($request->validated());
        $payment->load(['studentFee', 'receiver']);
        return new PaymentResource($payment);
    }

    public function show(Payment $payment)
    {
        $payment->load(['studentFee', 'receiver']);
        return new PaymentResource($payment);
    }

    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        $payment->update($request->validated());
        $payment->load(['studentFee', 'receiver']);
        return new PaymentResource($payment);
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
        return response()->json(['message' => 'Payment deleted'], 204);
    }
}
