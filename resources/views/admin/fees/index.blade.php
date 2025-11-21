@extends('layouts.admin')

@section('title', 'Fees List')

@section('content')

  <div
    class="box px-2 py-4 md:p-4 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">
    <h3 class="text-lg mb-3 font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
      {{-- Icon for Fees (using a dollar sign/finance theme) --}}
      <svg class="size-8 p-1 rounded-full bg-green-50 text-green-600 dark:text-green-50 dark:bg-green-900"
        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
        stroke-linecap="round" stroke-linejoin="round">
        <line x1="12" y1="1" x2="12" y2="23"></line>
        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
      </svg>
      Fees List
    </h3>

    {{-- Success/Error Messages --}}
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

    <form action="{{ route('admin.fees.index') }}" method="GET">
      <div
        class="p-2 md:grid grid-cols-1 lg:grid-cols-3 xl:grid-cols-4 gap-2 justify-between items-center border rounded-md border-gray-200 dark:border-gray-700 bg-violet-50 dark:bg-slate-800">

        {{-- Create Button (Redirects to Create Page) --}}
        <a href="{{ route('admin.fees.create') }}"
          class="lg:col-span-1 text-nowrap px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 cursor-pointer transition-colors flex items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
              d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
              clip-rule="evenodd" />
          </svg>
          Create New Fee
        </a>

        {{-- Filters and Search --}}
        <div class="lg:col-span-2 xl:col-span-3 flex items-center mt-3 lg:mt-0 gap-2 flex-wrap">

          {{-- Fee Type Filter --}}
          <select name="fee_type_id"
            class="border border-gray-300 dark:border-gray-500 dark:bg-gray-700 text-sm rounded-lg py-1.5 px-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 text-gray-800 dark:text-gray-100">
            <option value="">All Fee Types</option>
            @foreach ($feeTypes as $type)
              <option value="{{ $type->id }}" @selected(request('fee_type_id') == $type->id)>{{ $type->name }}</option>
            @endforeach
          </select>

          {{-- Status Filter --}}
          <select name="status"
            class="border border-gray-300 dark:border-gray-500 dark:bg-gray-700 text-sm rounded-lg py-1.5 px-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 text-gray-800 dark:text-gray-100">
            <option value="">All Statuses</option>
            @foreach ($statuses as $s)
              <option value="{{ $s }}" @selected(request('status') == $s) class="capitalize">{{ $s }}
              </option>
            @endforeach
          </select>

          {{-- Search Input --}}
          <div class="relative w-full flex-grow">
            <input type="search" name="search" id="searchInput"
              placeholder="Search by remarks, amount, student name/email..."
              class="w-full border border-gray-300 dark:border-gray-500 dark:bg-gray-700 text-sm rounded-lg pl-8 pr-2 py-1.5
                                focus:outline-none focus:ring-2 focus:ring-indigo-500 text-gray-800 dark:text-gray-100"
              value="{{ request('search') }}">
            <i class="fas fa-search absolute left-2.5 top-2.5 text-gray-400 text-xs"></i>
          </div>

          {{-- Search Button --}}
          <button type="submit"
            class="p-2 h-8 w-8 flex items-center justify-center cursor-pointer bg-indigo-600 dark:bg-indigo-700 hover:bg-indigo-700 dark:hover:bg-indigo-600 rounded-md transition-colors text-white"
            title="Search">
            <i class="fas fa-search text-white text-xs"></i>
          </button>

          {{-- Reset Button --}}
          <a href="{{ route('admin.fees.index') }}" id="resetSearch"
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

    {{-- Fee Cards --}}
    <div id="CardContainer" class="my-5 grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-4">
      @forelse ($fees as $fee)
        <div
          class="bg-white dark:bg-slate-800 rounded-lg shadow border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-lg transition-shadow duration-300">

          <div class="px-4 py-2 bg-slate-50 dark:bg-slate-700 border-b border-gray-100 dark:border-slate-700">
            <div class="flex justify-between items-start gap-2">
              <div>
                {{-- Main Fee Type and Student Name --}}
                <h4 class="font-bold text-lg text-gray-800 dark:text-gray-200 capitalize">
                  {{ $fee->feeType->name ?? 'Deleted Type' }}
                </h4>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                  Student: <span
                    class="font-semibold text-indigo-600 dark:text-indigo-400 capitalize">{{ $fee->student->name ?? 'Student Deleted' }}</span>
                </p>
              </div>

              {{-- Detail Button (Redirects to Show Page) --}}
              <a href="{{ route('admin.fees.show', $fee->id) }}"
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
            {{-- Fee Amount --}}
            <div class="flex items-center gap-3 text-sm">
              <div class="p-2 rounded-lg bg-green-50 dark:bg-slate-700 text-green-600 dark:text-green-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
              </div>
              <div>
                <p class="text-xs text-gray-500 dark:text-gray-400">Amount Due</p>
                <p class="font-medium text-gray-700 dark:text-gray-200">
                  <span
                    class="text-green-600 dark:text-green-400 font-bold">${{ number_format($fee->amount, 2) }}</span>
                </p>
              </div>
            </div>

            {{-- Due Date --}}
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

            {{-- Status --}}
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
                    class="
                                        @if ($fee->status == 'paid') text-green-600 dark:text-green-400
                                        @elseif ($fee->status == 'partially_paid') text-yellow-600 dark:text-yellow-400
                                        @else text-red-600 dark:text-red-400 @endif
                                        font-bold">
                    {{ str_replace('_', ' ', $fee->status) }}
                  </span>
                </p>
              </div>
            </div>
          </div>

          {{-- Actions (View Payments Link + Edit Link + Delete Form) --}}
          <div
            class="px-4 py-2 bg-gray-50 dark:bg-slate-700/50 border-t border-gray-100 dark:border-slate-700 flex justify-between gap-2">

            <a href="{{ route('admin.payments.index', ['fee_id' => $fee->id]) }}"
              class="btn p-2 rounded-full flex justify-center items-center cursor-pointer text-green-600 dark:text-green-400 hover:bg-green-50 dark:hover:bg-slate-600 transition-colors"
              title="View Payments">
              <span class="btn-content flex items-center justify-center">
                <i class="fa-solid fa-money-bill-transfer me-2"></i>
                Payments
              </span>
            </a>

            <div class="flex">
              {{-- Edit Button (Redirects to Edit Page) --}}
              <a href="{{ route('admin.fees.edit', $fee->id) }}"
                class="btn p-2 rounded-full flex justify-center items-center cursor-pointer text-yellow-600 dark:text-yellow-400 hover:bg-yellow-50 dark:hover:bg-slate-600 transition-colors"
                title="Edit">
                <span class="btn-content flex items-center justify-center">
                  <i class="fa-solid fa-pen-to-square me-2"></i>
                  Edit
                </span>
              </a>

              {{-- Delete Button (Full form submission) --}}
              <form action="{{ route('admin.fees.destroy', $fee->id) }}" method="POST"
                onsubmit="return confirm('Are you sure you want to delete this fee record? This action cannot be undone.');">
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
    </div>

    {{-- Pagination Links --}}
    <div class="mt-6">
      {{ $fees->links() }}
    </div>

  </div>
@endsection
