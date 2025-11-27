@extends('layouts.admin')

@section('title', 'Fee Details: ' . $fee->feeType?->name)

@section('content')

  <div
    class="box px-2 py-4 md:p-6 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm mx-auto">

    <div class="flex items-center justify-between mb-6 border-b pb-4 border-gray-100 dark:border-gray-700/50">
      <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
        <i class="fa-solid fa-money-check-dollar text-2xl text-blue-600 dark:text-blue-400"></i>
        Fee Details
      </h3>
      {{-- Back Button --}}
      <a href="{{ route('admin.fees.index', ['fee_type_id' => $fee->fee_type_id]) }}"
        class="text-nowrap px-3 py-1 bg-gray-200 text-gray-700 dark:bg-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 transition-colors flex items-center gap-1 text-sm">
        <i class="fas fa-arrow-left text-xs"></i> Back to Fee Ledger
      </a>
    </div>

    {{-- Main Detail Card --}}
    <div class="bg-blue-50 dark:bg-slate-700/30 rounded-lg p-6 space-y-4">
      {{-- Fee Type & Amount --}}
      <div class="flex justify-between items-center pb-4 border-b border-gray-200 dark:border-gray-700">
        <h2 class="text-2xl font-extrabold text-blue-700 dark:text-blue-300">
          {{ $fee->feeType?->name ?? 'Unknown Fee' }}
        </h2>
        <span class="text-3xl font-extrabold text-blue-700 dark:text-blue-300">
          ${{ number_format($fee->amount, 2) }}
        </span>
      </div>

      {{-- Key Metadata --}}
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
        <p class="detail-item">
          <span class="font-medium text-gray-600 dark:text-gray-400 flex items-center gap-1">
            <i class="fa-solid fa-user-graduate text-blue-500"></i> Student:
          </span>
          <span class="font-semibold text-gray-800 dark:text-gray-200 block mt-1">
            {{ $fee->student?->name ?? 'N/A' }}
          </span>
        </p>
        <p class="detail-item">
          <span class="font-medium text-gray-600 dark:text-gray-400 flex items-center gap-1">
            <i class="fa-solid fa-calendar-times text-red-500"></i> Due Date:
          </span>
          <span class="font-semibold text-gray-800 dark:text-gray-200 block mt-1">
            {{ $fee->due_date ? \Carbon\Carbon::parse($fee->due_date)->format('M d, Y') : 'N/A' }}
          </span>
        </p>
        <p class="detail-item">
          <span class="font-medium text-gray-600 dark:text-gray-400 flex items-center gap-1">
            <i class="fa-solid fa-user-tie text-green-500"></i> Recorded By:
          </span>
          <span class="font-semibold text-gray-800 dark:text-gray-200 block mt-1">
            {{ $fee->creator?->name ?? 'Unknown' }}
          </span>
        </p>
        <p class="detail-item">
          <span class="font-medium text-gray-600 dark:text-gray-400 flex items-center gap-1">
            <i class="fa-solid fa-clock text-orange-500"></i> Created At:
          </span>
          <span class="font-semibold text-gray-800 dark:text-gray-200 block mt-1">
            {{ $fee->created_at->format('M d, Y h:i A') }}
          </span>
        </p>
      </div>

      {{-- Payment Status --}}
      <div class="pt-4 border-t border-gray-200 dark:border-gray-700/50">
        <span class="font-medium text-gray-600 dark:text-gray-400 flex items-center gap-1 mb-1">
          <i class="fa-solid fa-hand-holding-dollar text-teal-500"></i> Payment Status:
        </span>
        <p class="text-sm">
          @if ($fee->status == 'paid')
            <span
              class="font-bold px-3 py-1 rounded-full text-xs bg-teal-100 text-teal-700 dark:bg-teal-900 dark:text-teal-300">
              Paid on {{ $fee->paid_date ? \Carbon\Carbon::parse($fee->paid_date)->format('M d, Y') : 'N/A' }}
            </span>
          @elseif ($fee->status == 'pending' && $fee->due_date && $fee->due_date->isPast())
            <span
              class="font-bold px-3 py-1 rounded-full text-xs bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-300">
              Overdue
            </span>
          @else
            <span
              class="font-bold px-3 py-1 rounded-full text-xs bg-yellow-100 text-yellow-700 dark:bg-yellow-900 dark:text-yellow-300">
              {{ ucfirst($fee->status) }}
            </span>
          @endif
        </p>
      </div>

      {{-- Payments History (Optional, based on payments() relationship) --}}
      @if ($fee->payments->count() > 0)
        <div class="pt-4 border-t border-gray-200 dark:border-gray-700/50">
          <span class="font-medium text-gray-600 dark:text-gray-400 flex items-center gap-1 mb-1">
            <i class="fa-solid fa-receipt text-indigo-500"></i> Payments Received:
          </span>
          <ul class="space-y-1">
            @foreach ($fee->payments as $payment)
              <li class="text-xs text-gray-600 dark:text-gray-400">
                - ${{ number_format($payment->amount, 2) }} on {{ $payment->payment_date->format('M d, Y') }}
                ({{ $payment->method }})
              </li>
            @endforeach
          </ul>
        </div>
      @endif

      {{-- Remarks --}}
      @if ($fee->remarks)
        <div class="pt-4 border-t border-gray-200 dark:border-gray-700/50">
          <span class="font-medium text-gray-600 dark:text-gray-400 flex items-center gap-1 mb-1">
            <i class="fa-solid fa-file-alt text-orange-500"></i> Remarks:
          </span>
          <p class="text-sm italic text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 p-3 rounded-md">
            {{ $fee->remarks }}
          </p>
        </div>
      @endif
    </div>

    {{-- Action Buttons --}}
    <div class="mt-6 flex justify-end gap-3">

      @if ($fee->status != 'paid')
        {{-- Action to Mark as Paid --}}
        {{-- You need to create a route and controller method for this, e.g., fees.markPaid --}}
        <form action="{{ route('admin.fees.markPaid', $fee->id) }}" method="POST"
          onsubmit="return confirm('Confirm marking this fee as paid in full?');">
          @csrf
          <button type="submit"
            class="p-2 px-4 rounded-lg flex justify-center items-center cursor-pointer bg-teal-600 text-white hover:bg-teal-700 transition-colors"
            title="Mark as Paid">
            <i class="fa-solid fa-check-to-slot mr-2"></i>
            Mark as Paid
          </button>
        </form>
      @endif

      <a href="{{ route('admin.fees.edit', $fee->id) }}"
        class="btn p-2 px-4 rounded-lg flex justify-center items-center cursor-pointer bg-yellow-500 text-white hover:bg-yellow-600 transition-colors"
        title="Edit Fee Record">
        <i class="fa-solid fa-pen-to-square mr-2"></i>
        Edit Record
      </a>

      <form action="{{ route('admin.fees.destroy', $fee->id) }}" method="POST"
        onsubmit="return confirm('Are you sure you want to permanently delete this fee record?');">
        @csrf
        @method('DELETE')
        <button type="submit"
          class="delete-btn p-2 px-4 rounded-lg flex justify-center items-center cursor-pointer bg-red-600 text-white hover:bg-red-700 transition-colors"
          title="Delete Fee Record">
          <i class="fa-regular fa-trash-can mr-2"></i>
          Delete
        </button>
      </form>
    </div>

  </div>

@endsection
