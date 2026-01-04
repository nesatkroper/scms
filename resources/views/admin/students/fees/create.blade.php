@extends('layouts.admin')
@section('title', 'Create Fee for: ' . $student->name)
@section('content')

  <div class="mb-6 flex justify-between items-center">
    <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 flex items-center gap-2">
      <svg class="size-8 rounded-full p-1 bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"
        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
        stroke-linecap="round" stroke-linejoin="round">
        <path d="M12 20h0v-4a4 4 0 0 0-4-4H4a4 4 0 0 0-4 4v4h24v-4a4 4 0 0 0-4-4H12z" />
        <circle cx="12" cy="7" r="4" />
      </svg>
      {{ __('message.create_fee_record_for') }}: {{ $student->name }}
    </h3>
  </div>

  <div
    class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 max-w-xl mx-auto">

    <form action="{{ route('admin.students.fees.store', $student) }}" method="POST">
      @csrf

      <div class="space-y-6">

        {{-- Fee Type Selection --}}
        <div>
          <label for="fee_type_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
            {{ __('message.fee_category_(type)') }}
          </label>
          <select id="fee_type_id" name="fee_type_id" required
            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
            <option value="">-- Select Fee Type --</option>
            @foreach ($feeTypes as $feeType)
              <option value="{{ $feeType->id }}" {{ old('fee_type_id') == $feeType->id ? 'selected' : '' }}>
                {{ $feeType->name }}
              </option>
            @endforeach
          </select>
          @error('fee_type_id')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- Amount --}}
        <div>
          <label for="amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
            {{ __('message.amount_($)') }}
          </label>
          <input type="number" step="0.01" min="0.01" name="amount" id="amount" value="{{ old('amount') }}"
            required
            class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
          @error('amount')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- Due Date --}}
        <div>
          <label for="due_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
            {{ __('message.due_date') }}
          </label>
          <input type="date" name="due_date" id="due_date"
            value="{{ old('due_date', now()->addDays(30)->toDateString()) }}" required
            class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
          @error('due_date')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- Status --}}
        <div>
          <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
            {{ __('message.initial_status') }}
          </label>
          <select id="status" name="status" required
            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
            {{-- Defaulting to Due or Draft is common practice --}}
            @foreach (['Draft', 'Due', 'Partial', 'Paid'] as $s)
              <option value="{{ $s }}" {{ old('status', 'Due') == $s ? 'selected' : '' }}>
                {{ ucfirst($s) }}
              </option>
            @endforeach
          </select>
          @error('status')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- Description --}}
        <div>
          <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
            {{ __('message.description_(optional)') }}
          </label>
          <textarea name="description" id="description" rows="3"
            class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">{{ old('description') }}</textarea>
          @error('description')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>
      </div>

      <div class="mt-8 flex justify-end space-x-3">
        <a href="{{ route('admin.students.fees.index', $student) }}"
          class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 transition-colors">
          {{ __('message.cancel') }}
        </a>
        <button type="submit"
          class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors">
          {{ __('message.create_fee_record') }}
        </button>
      </div>
    </form>
  </div>
@endsection
