@extends('layouts.admin')

@section('title', 'Expense Details: ' . $expense->title)

@section('content')

  <div
    class="box px-2 py-4 md:p-6 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm mx-auto">

    <div class="flex items-center justify-between mb-6 border-b pb-4 border-gray-100 dark:border-gray-700/50">
      <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
        <svg class="size-8 p-1 rounded-full bg-red-50 text-red-600 dark:text-red-50 dark:bg-red-900"
          xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M12 6v12m-3-2.818l-.511-.274a.75.75 0 01-.152-.962L9.423 6.326m-3.1 8.783L7.33 12m10.237 2.818l.511-.274a.75.75 0 00.152-.962l-1.423-2.618M18.8 12L16.67 9.177M5 12h14" />
        </svg>
        Expense Details
      </h3>
      {{-- Back Button --}}
      <a href="{{ route('admin.expenses.index') }}"
        class="text-nowrap px-3 py-1 bg-gray-200 text-gray-700 dark:bg-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 transition-colors flex items-center gap-1 text-sm">
        <i class="fas fa-arrow-left text-xs"></i> Back to Ledger
      </a>
    </div>

    {{-- Main Detail Card --}}
    <div class="bg-red-50 dark:bg-slate-700/30 rounded-lg p-6 space-y-4">
      {{-- Title & Amount --}}
      <div class="flex justify-between items-center pb-4 border-b border-gray-200 dark:border-gray-700">
        <h2 class="text-2xl font-extrabold text-red-700 dark:text-red-300">
          {{ $expense->title ?? 'N/A' }}
        </h2>
        <span class="text-3xl font-extrabold text-red-700 dark:text-red-300">
          ${{ number_format($expense->amount, 2) }}
        </span>
      </div>

      {{-- Key Metadata --}}
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
        <p class="detail-item">
          <span class="font-medium text-gray-600 dark:text-gray-400 flex items-center gap-1">
            <i class="fa-solid fa-tag text-red-500"></i> Category:
          </span>
          <span class="font-semibold text-gray-800 dark:text-gray-200 block mt-1">
            {{ $expense->category?->name ?? 'N/A' }}
          </span>
        </p>
        <p class="detail-item">
          <span class="font-medium text-gray-600 dark:text-gray-400 flex items-center gap-1">
            <i class="fa-solid fa-calendar-alt text-blue-500"></i> Expense Date:
          </span>
          <span class="font-semibold text-gray-800 dark:text-gray-200 block mt-1">
            {{ $expense->date ? \Carbon\Carbon::parse($expense->date)->format('M d, Y') : 'N/A' }}
          </span>
        </p>
        <p class="detail-item">
          <span class="font-medium text-gray-600 dark:text-gray-400 flex items-center gap-1">
            <i class="fa-solid fa-user-edit text-green-500"></i> Recorded By:
          </span>
          <span class="font-semibold text-gray-800 dark:text-gray-200 block mt-1">
            {{ $expense->creator?->name ?? 'Unknown' }}
          </span>
        </p>
        <p class="detail-item">
          <span class="font-medium text-gray-600 dark:text-gray-400 flex items-center gap-1">
            <i class="fa-solid fa-clock text-orange-500"></i> Recorded At:
          </span>
          <span class="font-semibold text-gray-800 dark:text-gray-200 block mt-1">
            {{ $expense->created_at->format('M d, Y h:i A') }}
          </span>
        </p>
      </div>

      {{-- Approval Status --}}
      <div class="pt-4 border-t border-gray-200 dark:border-gray-700/50">
        <span class="font-medium text-gray-600 dark:text-gray-400 flex items-center gap-1 mb-1">
          <i class="fa-solid fa-check-circle text-teal-500"></i> Approval Status:
        </span>
        <p class="text-sm">
          @if ($expense->approved_by)
            <span
              class="font-bold px-3 py-1 rounded-full text-xs bg-teal-100 text-teal-700 dark:bg-teal-900 dark:text-teal-300">
              Approved by {{ $expense?->approver?->name }} on
              {{ $expense->approved_at ? \Carbon\Carbon::parse($expense->approved_at)->format('M d, Y') : 'N/A' }}
            </span>
          @else
            <span
              class="font-bold px-3 py-1 rounded-full text-xs bg-yellow-100 text-yellow-700 dark:bg-yellow-900 dark:text-yellow-300">
              Pending Approval
            </span>
          @endif
        </p>
      </div>

      {{-- Description --}}
      @if ($expense->description)
        <div class="pt-4 border-t border-gray-200 dark:border-gray-700/50">
          <span class="font-medium text-gray-600 dark:text-gray-400 flex items-center gap-1 mb-1">
            <i class="fa-solid fa-file-alt text-orange-500"></i> Description / Remarks:
          </span>
          <p class="text-sm italic text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 p-3 rounded-md">
            {{ $expense->description }}
          </p>
        </div>
      @endif
    </div>

    {{-- Action Buttons --}}
    <div class="mt-6 flex justify-end gap-3">

      @unless ($expense->approved_by)
        {{-- 🟢 ADDED: Approval Button (Only visible if NOT approved) --}}
        {{-- You would use Spatie middleware here to restrict this view to 'admin' or 'staff' --}}
        <form action="{{ route('admin.expenses.approve', $expense->id) }}" method="POST"
          onsubmit="return confirm('Are you sure you want to approve this expense?');">
          @csrf
          {{-- Using POST method is standard for state changes --}}
          <button type="submit"
            class="p-2 px-4 rounded-lg flex justify-center items-center cursor-pointer bg-teal-600 text-white hover:bg-teal-700 transition-colors"
            title="Approve Expense">
            <i class="fa-solid fa-thumbs-up mr-2"></i>
            Approve Expense
          </button>
        </form>
      @endunless

      <a href="{{ route('admin.expenses.edit', $expense->id) }}"
        class="btn p-2 px-4 rounded-lg flex justify-center items-center cursor-pointer bg-yellow-500 text-white hover:bg-yellow-600 transition-colors"
        title="Edit Expense">
        <i class="fa-solid fa-pen-to-square mr-2"></i>
        Edit Expense
      </a>

      <form action="{{ route('admin.expenses.destroy', $expense->id) }}" method="POST"
        onsubmit="return confirm('Are you sure you want to permanently delete this expense record?');">
        @csrf
        @method('DELETE')
        <button type="submit"
          class="delete-btn p-2 px-4 rounded-lg flex justify-center items-center cursor-pointer bg-red-600 text-white hover:bg-red-700 transition-colors"
          title="Delete Expense">
          <i class="fa-regular fa-trash-can mr-2"></i>
          Delete
        </button>
      </form>
    </div>

  </div>

@endsection
