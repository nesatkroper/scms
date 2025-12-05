@extends('layouts.admin')

@section('title', 'Invoice: ' . $fee->id)

@push('styles')
  <style>
    @media print {

      .sidebar,
      .main-header,
      .main-footer,
      .print\:hidden,
      .admin-toolbar {
        display: none !important;
      }

      body {
        margin: 0;
        padding: 0;
        min-width: initial;
      }

      .content-wrapper,
      .page-wrapper {
        margin-left: 0 !important;
        padding: 0 !important;
        width: 100% !important;
        max-width: 100% !important;
      }

      .invoice-container {
        max-width: 100% !important;
        box-shadow: none !important;
        border: none !important;
        margin: 0 auto;
        padding: 10mm !important;
      }
    }
  </style>

  <style>
    @media print {
      body * {
        visibility: hidden !important;
      }

      .invoice-container,
      .invoice-container * {
        visibility: visible !important;
      }

      .invoice-container {
        position: absolute;
        left: 0;
        top: 0;
        width: 100% !important;
        padding: 10mm !important;
        margin: 0 !important;
        box-shadow: none !important;
        border: none !important;
      }
    }
  </style>

  <style>
    @media print {

      body,
      .invoice-container {
        background: #ffffff !important;
        color: #000000 !important;
      }

      .invoice-container * {
        color: #000000 !important;
      }

      * {
        background: transparent !important;
        box-shadow: none !important;
      }

      table th,
      table td,
      .border,
      .border-t,
      .border-b,
      .border-l,
      .border-r {
        border-color: #000000 !important;
      }

      body * {
        visibility: hidden !important;
      }

      .invoice-container,
      .invoice-container * {
        visibility: visible !important;
      }

      .invoice-container {
        position: absolute;
        left: 0;
        top: 0;
        width: 100% !important;
        padding: 10mm !important;
      }
    }
  </style>
@endpush
@section('content')

  <div
    class="invoice-container max-w-4xl mx-auto p-6 bg-white dark:bg-gray-800 shadow-xl sm:rounded-lg border border-gray-200 dark:border-gray-700">

    <div class="flex items-center justify-between mb-8 border-b pb-4 border-gray-100 dark:border-gray-700/50 print:hidden">
      <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
        <i class="fa-solid fa-file-invoice text-blue-600 dark:text-blue-400"></i>
        Fee Invoice Preview
      </h3>
      <div class="flex gap-2">
        <button onclick="window.print()"
          class="text-nowrap px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors flex items-center gap-1 text-sm font-semibold">
          <i class="fas fa-print"></i> Print Invoice
        </button>
        <a href="{{ route('admin.fees.index', ['fee_type_id' => $fee->feeType->id]) }}"
          class="text-nowrap px-3 py-1 bg-gray-200 text-gray-700 dark:bg-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 transition-colors flex items-center gap-1 text-sm">
          <i class="fas fa-arrow-left text-xs"></i> Back to Detail
        </a>
      </div>
    </div>

    <div class="flex justify-between items-start mb-10">
      <div>
        <h1 class="text-3xl font-extrabold text-blue-800 dark:text-blue-400 mb-1">
          {{ config('app.name') }}
        </h1>
        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $school_address ?? '123 School Lane, City, Country' }}</p>
        <p class="text-sm text-gray-600 dark:text-gray-400">
          {{ $school_contact ?? 'Email: info@school.com | Phone: (123) 456-7890' }}</p>
      </div>

      <div class="text-right">
        <h2 class="text-4xl font-extrabold text-gray-900 dark:text-gray-100 mb-1">INVOICE</h2>
        <p class="text-lg font-semibold text-blue-600 dark:text-blue-400">
          #{{ 'FEE-' . str_pad($fee->id, 5, '0', STR_PAD_LEFT) }}
        </p>
      </div>
    </div>

    <div
      class="grid grid-cols-3 gap-6 text-sm mb-10 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg border-l-4 border-blue-500 dark:border-blue-400">
      <div>
        <h4 class="font-bold uppercase text-gray-700 dark:text-gray-300 mb-1">Bill To:</h4>
        <p class="font-semibold text-gray-900 dark:text-gray-100">{{ $fee->student?->name ?? 'N/A' }}</p>
        <p class="text-gray-600 dark:text-gray-400">Student ID: {{ $fee->student?->student_id ?? 'N/A' }}</p>
        <p class="text-gray-600 dark:text-gray-400">Class/Grade: {{ $fee->student?->class_name ?? 'N/A' }}</p>
      </div>

      <div class="text-center">
        <h4 class="font-bold uppercase text-gray-700 dark:text-gray-300 mb-1">Status:</h4>
        @php
          $statusColor = 'yellow';
          $statusText = strtoupper($fee->status);
          if ($fee->status == 'paid') {
              $statusColor = 'teal';
              $statusText = 'PAID IN FULL';
          } elseif ($fee->status == 'pending' && $fee->due_date && \Carbon\Carbon::parse($fee->due_date)->isPast()) {
              $statusColor = 'red';
              $statusText = 'OVERDUE';
          }
        @endphp
        <span
          class="font-bold px-4 py-1 rounded-full text-md bg-{{ $statusColor }}-100 text-{{ $statusColor }}-700 dark:bg-{{ $statusColor }}-900 dark:text-{{ $statusColor }}-300">
          {{ $statusText }}
        </span>
        @if ($fee->status == 'paid' && $fee->paid_date)
          <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">
            Paid on {{ \Carbon\Carbon::parse($fee->paid_date)->format('M d, Y') }}
          </p>
        @endif
      </div>

      <div class="text-right">
        <h4 class="font-bold uppercase text-gray-700 dark:text-gray-300 mb-1">Dates:</h4>
        <p class="text-gray-900 dark:text-gray-100">
          <span class="font-medium">Issue Date:</span> {{ $fee->created_at->format('M d, Y') }}
        </p>
        <p class="font-semibold text-red-600 dark:text-red-400">
          <span class="font-medium text-gray-700 dark:text-gray-300">Due Date:</span>
          {{ $fee->due_date ? \Carbon\Carbon::parse($fee->due_date)->format('M d, Y') : 'N/A' }}
        </p>
      </div>
    </div>

    <div class="mb-10 overflow-x-auto border border-gray-200 dark:border-gray-700 rounded-lg">
      <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
        <thead class="bg-gray-100 dark:bg-gray-700">
          <tr>
            <th scope="col"
              class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider dark:text-gray-300">
              Fee Description
            </th>
            <th scope="col"
              class="px-6 py-3 text-right text-xs font-bold text-gray-600 uppercase tracking-wider dark:text-gray-300">
              Amount ({{ $currency ?? '$' }})
            </th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
          <tr>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900 dark:text-gray-100">
              {{ $fee->feeType?->name ?? 'Unknown Fee Type' }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-right text-base font-semibold text-gray-900 dark:text-gray-100">
              {{ $currency ?? '$' }}{{ number_format($fee->amount, 2) }}
            </td>
          </tr>
          @php
            $totalPaid = $fee->payments?->sum('amount') ?? 0;
            $balanceDue = $fee->amount - $totalPaid;
          @endphp
          @if ($totalPaid > 0)
            <tr class="bg-teal-50/50 dark:bg-teal-900/30">
              <td class="px-6 py-2 text-sm text-left font-medium text-teal-700 dark:text-teal-300">
                Payments Received
              </td>
              <td class="px-6 py-2 text-sm text-right font-bold text-teal-700 dark:text-teal-300">
                -{{ $currency ?? '$' }}{{ number_format($totalPaid, 2) }}
              </td>
            </tr>
          @endif
        </tbody>
      </table>
    </div>

    <div class="flex flex-col gap-8">

      <div class="md:ml-auto md:w-full space-y-3">

        <div class="flex justify-between">
          <span class="text-base font-semibold text-gray-600 dark:text-gray-400">Total Fee:</span>
          <span class="text-base font-semibold text-gray-800 dark:text-gray-200">
            {{ $currency ?? '$' }}{{ number_format($fee->amount, 2) }}
          </span>
        </div>

        <div
          class="flex justify-between py-3 border-t-2 border-b-2 border-blue-400 dark:border-blue-700/50 bg-blue-50 dark:bg-blue-900/30 p-2 rounded">
          <span class="text-xl font-extrabold text-blue-700 dark:text-blue-300">BALANCE DUE:</span>
          <span class="text-2xl font-extrabold text-blue-700 dark:text-blue-300">
            {{ $currency ?? '$' }}{{ number_format($balanceDue, 2) }}
          </span>
        </div>
      </div>

      <div>
        <h4 class="text-sm font-bold uppercase text-gray-700 dark:text-gray-300 mb-1">Remarks:</h4>
        <p class="text-sm italic text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 p-3 rounded-md min-h-40">
          {{ $fee->remarks ?? 'Please ensure payment is made by the due date.' }}
        </p>
      </div>
    </div>

    <div class="mt-16 pt-8 border-t border-gray-200 dark:border-gray-700/50 text-center">
      <p class="text-lg font-semibold text-gray-800 dark:text-gray-200">
        Thank You!
      </p>
      <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
        Generated by {{ config('app.name') }} - G2 Developer Support on {{ now()->format('M d, Y h:i A') }}
      </p>
    </div>

  </div>

@endsection
