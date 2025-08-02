<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Http\Resources\PaymentResource;
use App\Models\Payment;
use Illuminate\Http\JsonResponse;

class PaymentController extends Controller
{
  public function index(): JsonResponse
  {
    try {
      $payments = Payment::withTrashed()->with(['studentFee', 'receivedBy'])->paginate(10);
      return PaymentResource::collection($payments)->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error retrieving payments: ' . $e->getMessage()], 500);
    }
  }

  public function store(StorePaymentRequest $request): JsonResponse
  {
    try {
      $payment = Payment::create($request->validated());
      return (new PaymentResource($payment))->response()->setStatusCode(201);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error creating payment: ' . $e->getMessage()], 500);
    }
  }

  public function show(Payment $payment): JsonResponse
  {
    try {
      $payment->load(['studentFee', 'receivedBy']);
      return (new PaymentResource($payment))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error retrieving payment: ' . $e->getMessage()], 500);
    }
  }

  public function update(UpdatePaymentRequest $request, Payment $payment): JsonResponse
  {
    try {
      $payment->update($request->validated());
      return (new PaymentResource($payment))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error updating payment: ' . $e->getMessage()], 500);
    }
  }

  public function destroy(Payment $payment): JsonResponse
  {
    try {
      $payment->delete();
      return response()->json(['message' => 'Payment deleted successfully.'], 204);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error deleting payment: ' . $e->getMessage()], 500);
    }
  }

  public function restore(string $id): JsonResponse
  {
    try {
      $payment = Payment::onlyTrashed()->findOrFail($id);
      $payment->restore();
      return (new PaymentResource($payment))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error restoring payment: ' . $e->getMessage()], 500);
    }
  }

  public function forceDelete(string $id): JsonResponse
  {
    try {
      $payment = Payment::onlyTrashed()->findOrFail($id);
      $payment->forceDelete();
      return response()->json(['message' => 'Payment permanently deleted.'], 204);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error permanently deleting payment: ' . $e->getMessage()], 500);
    }
  }
}
