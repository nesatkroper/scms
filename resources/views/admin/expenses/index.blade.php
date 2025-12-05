@extends('layouts.admin')

@section('title', 'Expense Ledger')

@section('content')

  <div
    class="box px-2 py-4 md:p-4 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm mb-10">
    <h3 class="text-lg mb-3 font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
      <svg class="size-8 p-1 rounded-full bg-red-50 text-red-600 dark:text-red-50 dark:bg-red-900"
        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round"
          d="M12 6v12m-3-2.818l-.511-.274a.75.75 0 01-.152-.962L9.423 6.326m-3.1 8.783L7.33 12m10.237 2.818l.511-.274a.75.75 0 00.152-.962l-1.423-2.618M18.8 12L16.67 9.177M5 12h14" />
      </svg>
      Expense for
      {{-- {{ $expense->category->name }} --}}
    </h3>

    {{-- Success/Error Messages --}}
    @if (session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        {{ session('success') }}
      </div>
    @endif
    @if (session('error'))
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        {{ session('error') }}
      </div>
    @endif

    {{-- Search Form --}}
    <form action="{{ route('admin.expenses.index') }}" method="GET">
      <div
        class="p-2 md:flex gap-2 justify-between items-center border rounded-md border-gray-200 dark:border-gray-700 bg-red-50 dark:bg-slate-800">
        <a href="{{ route('admin.expenses.create', ['category_id' => request('category_id')]) }}"
          class="text-nowrap px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 cursor-pointer transition-colors flex items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
              d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
              clip-rule="evenodd" />
          </svg>
          Record New Expense
        </a>

        <div class="flex items-center mt-3 md:mt-0 gap-2">
          <div class="relative w-full">
            <input type="search" name="search" id="searchInput"
              placeholder="Search by title, description, or category..."
              class="w-full border border-gray-300 dark:border-gray-500 dark:bg-gray-700 text-sm rounded-lg pl-8 pr-2 py-1.5
                       focus:outline-none focus:ring-2 focus:ring-red-500 text-gray-800 dark:text-gray-100"
              value="{{ request('search') }}">
            <i class="fas fa-search absolute left-2.5 top-2.5 text-gray-400 text-xs"></i>
          </div>

          <button type="submit"
            class="p-2 h-8 w-8 flex items-center justify-center cursor-pointer bg-red-600 dark:bg-red-700 hover:bg-red-700 dark:hover:bg-red-600 rounded-md transition-colors text-white"
            title="Search">
            <i class="fas fa-search text-white text-xs"></i>
          </button>
          <a href="{{ route('admin.expenses.index') }}" id="resetSearch"
            class="p-2 h-8 w-8 flex items-center justify-center cursor-pointer bg-indigo-100 dark:bg-indigo-700 hover:bg-gray-300 dark:hover:bg-indigo-600 rounded-md transition-colors dark:text-white"
            style="margin-top: 0 !important" title="Reset Search">
            <i class="fa-solid fa-arrow-rotate-right"></i>
          </a>
        </div>
      </div>
    </form>

    {{-- Expense Cards --}}
    <div id="CardContainer" class="my-5 grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-4">
      @forelse($expenses as $expense)
        <div
          class="bg-white dark:bg-slate-800 rounded-lg shadow border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-lg transition-shadow duration-300">

          {{-- Header: Title & Amount --}}
          <div class="px-4 py-3 bg-red-50 dark:bg-slate-700 border-b border-gray-100 dark:border-slate-700">
            <div class="flex justify-between items-center gap-2">
              <h4 class="font-bold text-lg text-red-600 dark:text-red-400">
                {{ $expense->title }}
              </h4>
              <span class="text-2xl font-extrabold text-red-700 dark:text-red-300">
                ${{ number_format($expense->amount, 2) }}
              </span>
            </div>
            <p class="text-sm text-gray-700 dark:text-gray-300 mt-1 font-semibold flex items-center gap-1">
              Category:
              <span class="text-red-600 dark:text-red-400">{{ $expense->category?->name ?? 'N/A' }}</span>
            </p>
          </div>

          {{-- Details --}}
          <div class="p-4 space-y-2 text-sm text-gray-700 dark:text-gray-300">
            {{-- Expense Date --}}
            <p
              class="flex items-center gap-1 font-medium text-gray-600 dark:text-gray-400 border-b border-gray-100 dark:border-gray-700/50 py-1">
              <i class="fa-solid fa-calendar-alt text-blue-500"></i>
              Date:
              <span class="font-semibold text-gray-800 dark:text-gray-200">
                {{ $expense->date ? \Carbon\Carbon::parse($expense->date)->format('M d, Y') : 'N/A' }}
              </span>
            </p>

            <p
              class="flex items-center gap-1 font-medium text-gray-600 dark:text-gray-400 border-b border-gray-100 dark:border-gray-700/50 py-1">
              <i class="fa-solid fa-user-edit text-green-500"></i>
              Recorded By:
              <span class="font-semibold text-gray-800 dark:text-gray-200">
                {{ $expense->creator?->name ?? 'Unknown' }}
              </span>
            </p>

            {{-- Approver Status --}}
            <p class="flex justify-between items-center">
              <span class="font-medium text-gray-600 dark:text-gray-400 flex items-center gap-1">
                <i class="fa-solid fa-check-circle text-teal-500"></i>
                Approval:
              </span>
              @if ($expense->approved_by)
                <span
                  class="font-bold px-2 py-0.5 rounded-full text-xs bg-teal-100 text-teal-700 dark:bg-teal-900 dark:text-teal-300">
                  Approved by - {{ $expense?->approver?->name }}
                </span>
              @else
                <span
                  class="font-bold px-2 py-0.5 rounded-full text-xs bg-yellow-100 text-yellow-700 dark:bg-yellow-900 dark:text-yellow-300">
                  Pending
                </span>
              @endif
            </p>

            {{-- Description/Remarks --}}
            @if ($expense->description)
              <div class="pt-2 border-t border-gray-100 dark:border-gray-700/50">
                <span class="font-medium text-gray-600 dark:text-gray-400 flex items-center gap-1 mb-1">
                  <i class="fa-solid fa-file-alt text-orange-500"></i>
                  Notes:
                </span>
                <p class="text-xs italic text-gray-500 dark:text-gray-400 bg-gray-50 dark:bg-gray-700 p-2 rounded-md">
                  {{ Str::limit($expense->description, 100) }}
                </p>
              </div>
            @endif
          </div>

          {{-- Actions --}}
          <div
            class="px-4 py-1 bg-gray-50 dark:bg-slate-700/50 border-t border-gray-100 dark:border-slate-700 flex justify-end gap-2">
            <a href="{{ route('admin.expenses.show', $expense->id) }}"
              class="btn p-2 rounded-full flex justify-center items-center cursor-pointer text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-slate-600 transition-colors"
              title="Edit Expense">
              <span class="btn-content flex items-center justify-center">
                <i class="fa-solid fa-eye me-2"></i>
                {{-- Show --}}
              </span>
            </a>

            <a href="{{ route('admin.expenses.edit', $expense->id) }}"
              class="btn p-2 rounded-full flex justify-center items-center cursor-pointer text-yellow-600 dark:text-yellow-400 hover:bg-yellow-50 dark:hover:bg-slate-600 transition-colors"
              title="Edit Expense">
              <span class="btn-content flex items-center justify-center">
                <i class="fa-solid fa-pen-to-square me-2"></i>
                {{-- Edit --}}
              </span>
            </a>

            {{-- <form action="{{ route('admin.expenses.destroy', $expense->id) }}" method="POST"
              onsubmit="return confirm('Are you sure you want to delete this expense record?');">
              @csrf
              @method('DELETE')
              <button type="submit"
                class="delete-btn p-2 rounded-full flex justify-center items-center cursor-pointer text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-slate-600 transition-colors"
                title="Delete Expense">
                <i class="fa-regular fa-trash-can me-2"></i>
                Delete
              </button>
            </form> --}}
          </div>
        </div>
      @empty
        <div
          class="col-span-full p-6 text-center text-gray-500 dark:text-gray-400 bg-gray-50 dark:bg-gray-700 rounded-lg">
          No expense records found. Click "Record New Expense" to start.
        </div>
      @endforelse
    </div>

    {{-- Pagination Links --}}
    <div class="mt-6">
      {{ $expenses->links() }}
    </div>

  </div>

@endsection
