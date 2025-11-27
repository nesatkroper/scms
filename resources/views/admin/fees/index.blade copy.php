@extends('layouts.admin')

@section('title', 'Fees List')

@section('content')

  <div
    class="box px-2 py-4 md:p-4 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm mb-10">
    <h3 class="text-lg mb-3 font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
      <svg class="size-8 p-1 rounded-full bg-green-50 text-green-600 dark:text-green-50 dark:bg-green-900"
        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
        stroke-linecap="round" stroke-linejoin="round">
        <line x1="12" y1="1" x2="12" y2="23"></line>
        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
      </svg>
      Fees List of - {{ $selectedFeeType->name ?? 'All' }}
    </h3>

    @if (session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
      </div>
    @endif
    @if (session('error'))
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('error') }}</span>
      </div>
    @endif

    <form action="{{ route('admin.fees.index', ['fee_type_id' => $feeTypeId]) }}" method="GET">
      <input type="hidden" name="fee_type_id" value="{{ $feeTypeId }}">
      <div
        class="p-2 flex gap-2 justify-between items-center border rounded-md border-gray-200 dark:border-gray-700 bg-violet-50 dark:bg-slate-800">
        <a href="{{ route('admin.fees.create', ['fee_type_id' => $feeTypeId]) }}"
          class="lg:col-span-1 text-nowrap px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 cursor-pointer transition-colors flex items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
              d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
              clip-rule="evenodd" />
          </svg>
          Create New Fee
        </a>

        <div class="lg:col-span-2 xl:col-span-3 flex items-center mt-3 lg:mt-0 gap-2 flex">
          <select name="status"
            class="border border-gray-300 dark:border-gray-500 dark:bg-gray-700 text-sm rounded-lg py-1.5 px-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 text-gray-800 dark:text-gray-100">
            <option value="">All Statuses</option>
            @foreach ($statuses as $s)
              <option value="{{ $s }}" @selected(request('status') == $s) class="capitalize">{{ $s }}
              </option>
            @endforeach
          </select>

          <div class="relative w-full flex-grow">
            <input type="search" name="search" id="searchInput"
              placeholder="Search by remarks, amount, student name/email..."
              class="w-full border border-gray-300 dark:border-gray-500 dark:bg-gray-700 text-sm rounded-lg pl-8 pr-2 py-1.5 focus:outline-none focus:ring-2 focus:ring-indigo-500 text-gray-800 dark:text-gray-100"
              value="{{ request('search') }}">
            <i class="fas fa-search absolute left-2.5 top-2.5 text-gray-400 text-xs"></i>
          </div>

          <button type="submit"
            class="p-2 h-8 w-8 flex items-center justify-center cursor-pointer bg-indigo-600 dark:bg-indigo-700 hover:bg-indigo-700 dark:hover:bg-indigo-600 rounded-md transition-colors text-white"
            title="Search">
            <i class="fas fa-search text-white text-xs"></i>
          </button>

          <a href="{{ route('admin.fees.index', ['fee_type_id' => $feeTypeId]) }}" id="resetSearch"
            class="p-2 h-8 w-8 flex items-center justify-center cursor-pointer bg-indigo-100 dark:bg-indigo-700 hover:bg-gray-300 dark:hover:bg-indigo-600 rounded-md transition-colors"
            title="Reset Filters">
            <svg class="h-5 w-5 text-indigo-600 dark:text-gray-300" fill="none" stroke="currentColor"
              viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 4v5h.582m15.356-2A8.98 8.98 0 0020 12a9 9 0 11-8-9.98l-7.9 7.9M2 12h2"></path>
            </svg>
          </a>
        </div>
      </div>
    </form>

    <div id="CardContainer" class="my-5 grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-4"
      x-data="paymentsModal()">
      @forelse ($fees as $fee)
        <div
          class="bg-white dark:bg-slate-800 rounded-lg shadow border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-lg transition-shadow duration-300">
          <div class="px-4 py-2 bg-slate-50 dark:bg-slate-700 border-b border-gray-100 dark:border-slate-700">
            <div class="flex justify-between items-start gap-2">
              <div>
                <h4 class="font-bold text-lg text-gray-800 dark:text-gray-200 capitalize">
                  {{ $fee->student->name ?? 'Student Deleted' }} -
                  ${{ number_format($fee->amount, 2) }}
                </h4>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                  Category: <span
                    class="font-semibold text-indigo-600 dark:text-indigo-400 capitalize">{{ $fee->feeType->name ?? 'Fee Type Deleted' }}</span>
                </p>
              </div>
              <a href="{{ route('admin.fees.show', ['fee' => $fee->id, 'fee_type_id' => $fee->fee_type_id]) }}"
                class="btn p-2 flex items-center justify-center rounded-full size-8 cursor-pointer text-blue-500 hover:bg-blue-100 dark:hover:bg-gray-900 transition-colors"
                title="View Details">
                <span class="btn-content">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                  </svg>
                </span>
              </a>
            </div>
          </div>

          <div class="p-4 space-y-3">
            <div class="flex items-center gap-3 text-sm">
              <div class="p-2 rounded-lg bg-red-50 dark:bg-slate-700 text-red-600 dark:text-red-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
              </div>
              <div>
                <p class="text-xs text-gray-500 dark:text-gray-400">Due Date</p>
                <p class="font-medium text-gray-700 dark:text-gray-200">
                  {{ $fee->due_date ? \Carbon\Carbon::parse($fee->due_date)->format('F jS, Y') : 'N/A' }}
                </p>
              </div>
            </div>

            <div class="flex items-center gap-3 text-sm">
              <div class="p-2 rounded-lg bg-blue-50 dark:bg-slate-700 text-blue-600 dark:text-blue-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 002.944 12c.328 1.488.844 2.936 1.551 4.316l-3.35 3.35a1 1 0 001.414 1.414l3.35-3.35c1.38 0.707 2.828 1.223 4.316 1.551a11.955 11.955 0 01-8.618-3.04A12.02 12.02 0 0012 21.056c1.488-.328 2.936-.844 4.316-1.551l3.35 3.35a1 1 0 001.414-1.414l-3.35-3.35c0.707-1.38 1.223-2.828 1.551-4.316a12.02 12.02 0 00.001-8.168z" />
                </svg>
              </div>
              <div>
                <p class="text-xs text-gray-500 dark:text-gray-400">Status</p>
                <p class="font-medium text-gray-700 dark:text-gray-200 capitalize">
                  <span
                    class="@if ($fee->status == 'paid') text-green-600 dark:text-green-400 @elseif ($fee->status == 'partially_paid') text-yellow-600 dark:text-yellow-400 @else text-red-600 dark:text-red-400 @endif font-bold">
                    {{ str_replace('_', ' ', $fee->status) }}
                  </span>
                </p>
              </div>
            </div>
          </div>

          <div
            class="px-4 py-2 bg-gray-50 dark:bg-slate-700/50 border-t border-gray-100 dark:border-slate-700 flex justify-between gap-2">

            <a href="#"
              @click.prevent="openModal({{ $fee }}, {{ $fee->feeType }},{{ $fee->student }}, '{{ route('admin.payments.store') }}')"
              {{-- Pass fee ID for context --}}
              class="btn p-2 rounded-full flex justify-center items-center cursor-pointer text-green-600 dark:text-green-400 hover:bg-green-50 dark:hover:bg-slate-600 transition-colors"
              title="Add Payment">
              <span class="btn-content flex items-center justify-center">
                <i class="fa-solid fa-money-bill-transfer me-2"></i>
                Add Payment
              </span>
            </a>

            <div class="flex">
              <a href="{{ route('admin.fees.edit', ['fee' => $fee->id, 'fee_type_id' => $fee->fee_type_id]) }}"
                class="btn p-2 rounded-full flex justify-center items-center cursor-pointer text-yellow-600 dark:text-yellow-400 hover:bg-yellow-50 dark:hover:bg-slate-600 transition-colors"
                title="Edit">
                <span class="btn-content flex items-center justify-center">
                  <i class="fa-solid fa-pen-to-square me-2"></i>
                  Edit
                </span>
              </a>

              <form action="{{ route('admin.fees.destroy', $fee->id) }}" method="POST"
                onsubmit="return confirm('Are you sure you want to delete this fee record?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                  class="delete-btn p-2 rounded-full flex justify-center items-center cursor-pointer text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-slate-600 transition-colors"
                  title="Delete">
                  <i class="fa-regular fa-trash-can me-2"></i>
                  Delete
                </button>
              </form>
            </div>
          </div>
        </div>
      @empty
        <div class="col-span-full py-12 text-center">
          <div
            class="max-w-md mx-auto p-6 bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700">
            <div class="mx-auto h-16 w-16 rounded-full bg-red-50 dark:bg-slate-700 flex items-center justify-center">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-400 dark:text-red-500" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                  d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <h3 class="mt-4 text-lg font-medium text-red-500 dark:text-red-500">No Fee Records Found</h3>
            <p class="mt-1 text-sm text-red-500 dark:text-red-500">Create your first fee record to begin tracking student
              payments.</p>
          </div>
        </div>
      @endforelse

      {{-- This modal requires Alpine.js and Tailwind CSS --}}
      <div x-show="isOpen" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto"
        aria-labelledby="modal-title" role="dialog" aria-modal="true">

        <div class="fixed inset-0 transition-opacity" style="background-color: rgba(0, 0, 0, 0.7);"
          @click="closeModal()"></div>

        {{-- Modal Panel --}}
        <div class="flex items-center justify-center min-h-screen px-4 py-6 text-center sm:p-0">
          <div x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="relative inline-block align-middle bg-white dark:bg-gray-800 rounded-xl text-left shadow-2xl transform transition-all sm:my-8 sm:max-w-lg sm:w-full">

            <form :action="actionUrl" method="POST">
              @csrf
              {{-- Hidden Fee ID --}}
              <input type="hidden" name="fee_id" :value="feeId">

              <template x-if="isEdit">
                @method('PUT')
              </template>

              {{-- Modal Header --}}
              <div class="px-6 py-4 bg-indigo-600 dark:bg-indigo-900 rounded-t-xl flex items-center justify-between">
                <h3 class="text-xl font-semibold text-white" id="modal-title" x-text="modalTitle"></h3>
                <p class="text-sm text-indigo-200 dark:text-indigo-400 font-medium" x-text="'Fee ID: ' + feeId"></p>
              </div>

              {{-- Modal Body - Form Fields --}}
              <div class="px-6 py-6 space-y-5">

                {{-- Field Group: Amount & Date --}}
                <div class="grid grid-cols-2 gap-4">

                  {{-- Amount Field --}}
                  <div>
                    <label for="amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                      Amount Paid ($) <span class="text-red-500">*</span>
                    </label>
                    <input type="number" step="0.01" min="0.01" id="amount" name="amount"
                      x-model="formData.amount" required
                      class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-lg shadow-sm p-2.5 text-gray-900 dark:text-gray-100 focus:ring-indigo-500 focus:border-indigo-500 text-base transition duration-150">
                  </div>

                  {{-- Payment Date Field --}}
                  <div>
                    <label for="payment_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                      Payment Date <span class="text-red-500">*</span>
                    </label>
                    <input type="date" id="payment_date" name="payment_date" x-model="formData.payment_date"
                      required
                      class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-lg shadow-sm p-2.5 text-gray-900 dark:text-gray-100 focus:ring-indigo-500 focus:border-indigo-500 text-base transition duration-150">
                  </div>
                </div>

                {{-- Field Group: Method & Transaction ID --}}
                <div class="grid grid-cols-2 gap-4">

                  {{-- Payment Method Field --}}
                  <div>
                    <label for="payment_method" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                      Payment Method
                    </label>
                    <select id="payment_method" name="payment_method" x-model="formData.payment_method"
                      class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-lg shadow-sm p-2.5 text-gray-900 dark:text-gray-100 focus:ring-indigo-500 focus:border-indigo-500 text-base transition duration-150">
                      <option value="Cash">Cash</option>
                      <option value="Bank Transfer">Bank Transfer</option>
                      <option value="Card">Card</option>
                      <option value="Mobile Payment">Mobile Payment</option>
                      <option value="Other">Other</option>
                    </select>
                  </div>

                  {{-- Transaction ID Field --}}
                  <div>
                    <label for="transaction_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                      Transaction ID <span class="text-gray-500 text-xs">(Optional)</span>
                    </label>
                    <input type="text" id="transaction_id" name="transaction_id" x-model="formData.transaction_id"
                      class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-lg shadow-sm p-2.5 text-gray-900 dark:text-gray-100 focus:ring-indigo-500 focus:border-indigo-500 text-base transition duration-150">
                  </div>
                </div>

                {{-- Remarks Field --}}
                <div>
                  <label for="remarks" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Remarks <span class="text-gray-500 text-xs">(Optional)</span>
                  </label>
                  <textarea id="remarks" name="remarks" x-model="formData.remarks" rows="3"
                    class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-lg shadow-sm p-2.5 text-gray-900 dark:text-gray-100 focus:ring-indigo-500 focus:border-indigo-500 text-base transition duration-150"></textarea>
                </div>
              </div>

              {{-- Modal Footer - Actions --}}
              <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 rounded-b-xl flex justify-end gap-3">
                <button type="button" @click="closeModal()"
                  class="inline-flex justify-center rounded-lg border border-gray-300 dark:border-gray-600 shadow-sm px-4 py-2 text-base font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm transition duration-150">
                  Cancel
                </button>
                <button type="submit"
                  class="inline-flex justify-center rounded-lg border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm transition duration-150"
                  x-text="isEdit ? 'Update Payment' : 'Save Payment'">
                </button>
              </div>
            </form>

          </div>
        </div>
      </div>

      <script>
        document.addEventListener('alpine:init', () => {
          Alpine.data('paymentsModal', () => ({
            // Modal state
            isOpen: false,
            isEdit: false,
            modalTitle: 'Add New Payment',
            actionUrl: '{{ route('admin.payments.store') }}', // Default to store route

            // Data passed from the button
            feeId: null,
            paymentId: null, // For update actions

            // Form data
            formData: {
              amount: '',
              payment_date: new Date().toISOString().substring(0, 10), // Default to today
              payment_method: 'Cash',
              transaction_id: '',
              remarks: '',
            },

            // Opens the modal for C(reate)
            openModal(fee, feeType, student, storeRoute) {
              this.feeId = fee.id;
              this.isEdit = false;
              this.modalTitle = `${feeType.name} Payment for ${student.name}`;
              this.actionUrl = storeRoute;

              // Reset form data for creation
              this.formData = {
                amount: '',
                payment_date: new Date().toISOString().substring(0, 10),
                payment_method: 'Cash',
                transaction_id: '',
                remarks: '',
              };

              this.isOpen = true;
            },

            closeModal() {
              this.isOpen = false;
            }
          }));
        });
      </script>

      {{-- @include('admin.fees.payment-modal') --}}
    </div>

    <div class="mt-6">
      {{ $fees->links() }}
    </div>
  </div>
@endsection
