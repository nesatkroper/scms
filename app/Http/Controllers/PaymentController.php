<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Models\Payment;
use App\Models\StudentFee; 
use App\Models\User;       

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with(['studentFee', 'receiver'])->paginate(10);
        return view('payments.index', compact('payments'));
    }

    public function create()
    {
        $studentFees = StudentFee::all();
        $receivers = User::all(); 
        return view('payments.create', compact('studentFees', 'receivers'));
    }

    public function store(StorePaymentRequest $request)
    {
        $payment = Payment::create($request->validated());
        return redirect()->route('payments.index')->with('success', 'Payment recorded successfully!');
    }

    public function show(Payment $payment)
    {
        $payment->load(['studentFee', 'receiver']);
        return view('payments.show', compact('payment'));
    }

    public function edit(Payment $payment)
    {
        $payment->load(['studentFee', 'receiver']);
        $studentFees = StudentFee::all();
        $receivers = User::all();
        return view('payments.edit', compact('payment', 'studentFees', 'receivers'));
    }

    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        $payment->update($request->validated());
        return redirect()->route('payments.show', $payment)->with('success', 'Payment updated successfully!');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('payments.index')->with('success', 'Payment deleted successfully!');
    }
}
