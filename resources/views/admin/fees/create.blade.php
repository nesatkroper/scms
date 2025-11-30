@extends('layouts.admin')
@section('title', 'Create New Fee Record')
@section('content')

    <div
        class="box px-4 py-6 md:p-8 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">

        <div class="flex justify-between items-center mb-6 border-b pb-4 border-gray-200 dark:border-gray-700">
            <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="size-8 rounded-full p-1 bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <line x1="12" y1="1" x2="12" y2="23"></line>
                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                </svg>
                Create New Fee Record
            </h3>
            <a href="{{ route('admin.fees.index') }}"
                class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600 transition-colors">
                Back to List
            </a>
        </div>

        {{-- Error Message Display --}}
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        {{-- Form submits to the store method --}}
        <form action="{{ route('admin.fees.store') }}" method="POST" id="createForm" class="p-0">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">

                {{-- 1. Student Field --}}
                {{-- <div>
          <label for="student_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            Student <span class="text-red-500">*</span>
          </label>
          <select id="student_id" name="student_id"
            class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                         dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                    @error('student_id') border-red-500 @else border-gray-400 @enderror"
            required>
            <option value="">Select a Student</option>
            @foreach ($students as $student)
              <option value="{{ $student->id }}" @selected(old('student_id') == $student->id)>
                {{ $student->name }} ({{ $student->email }})
              </option>
            @endforeach
          </select>
          @error('student_id')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div> --}}
                {{-- <x-fields.select  name="student" label="Student" :required="true" :options="$students" placeholder="Choose student"  searchable="true"/> --}}

                <div x-data="studentSelect()" class="relative">
                    <label for="student_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Student <span class="text-red-500">*</span>
                    </label>

                    <!-- Trigger -->
                    <div @click="open = !open"
                        class="w-full px-3 py-2 border rounded-md cursor-pointer bg-white dark:bg-gray-700
                border-slate-300 dark:border-gray-600 text-gray-900 dark:text-white flex justify-between items-center">

                        <span x-text="selectedName || 'Select a Student'"></span>
                        <span class="text-gray-500">▼</span>
                    </div>

                    <!-- Dropdown -->
                    <div x-show="open" @click.outside="open = false"
                        class="absolute z-50 mt-1 w-full bg-white dark:bg-gray-700 border border-slate-300 dark:border-gray-600 
                rounded-md shadow-lg max-h-60 overflow-y-auto">

                        <!-- Search Field -->
                        <div class="p-2 border-b border-slate-200 dark:border-gray-600">
                            <input x-model="search" type="text" placeholder="Search student..."
                                class="w-full px-3 py-2 rounded-md border border-slate-300 dark:border-gray-600 
                          bg-white dark:bg-gray-800 text-sm text-gray-800 dark:text-white">
                        </div>

                        <!-- Options -->
                        <template x-for="student in filtered" :key="student.id">
                            <div @click="selectStudent(student)"
                                class="px-3 py-2 cursor-pointer hover:bg-indigo-50 dark:hover:bg-gray-600">
                                <span x-text="student.name"></span>
                                <span class="text-gray-500" x-text="'(' + student.email + ')'"></span>
                            </div>
                        </template>

                        <!-- No Results -->
                        <div x-show="filtered.length === 0" class="px-3 py-2 text-red-500 text-center">
                            No results found
                        </div>
                    </div>

                    <!-- Hidden input (REAL value submitted to backend) -->
                    <input type="hidden" name="student_id" x-model="selectedId" />

                    @error('student_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- 2. Fee Type Field --}}
                <div>
                    <label for="fee_type_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Fee Type <span class="text-red-500">*</span>
                    </label>
                    <select id="fee_type_id" name="fee_type_id"
                        class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                         dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                    @error('fee_type_id') border-red-500 @else border-gray-400 @enderror"
                        required>
                        <option value="">Select Fee Type</option>
                        @foreach ($feeTypes as $feeType)
                            <option value="{{ $feeType->id }}" @selected(old('fee_type_id') == $feeType->id)>
                                {{ $feeType->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('fee_type_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- 3. Amount Field --}}
                <div>
                    <label for="amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Amount ($) <span class="text-red-500">*</span>
                    </label>
                    <input type="number" step="0.01" min="0" id="amount" name="amount"
                        value="{{ old('amount') }}"
                        class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                         dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                    @error('amount') border-red-500 @else border-gray-400 @enderror"
                        placeholder="e.g., 500.00" required>
                    @error('amount')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- 4. Due Date Field --}}
                <div>
                    <label for="due_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Due Date (Optional)
                    </label>
                    <input type="date" id="due_date" name="due_date" value="{{ old('due_date') }}"
                        class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                         dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                    @error('due_date') border-red-500 @else border-gray-400 @enderror">
                    @error('due_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            {{-- 6. Remarks Field --}}
            <div class="mb-6">
                <label for="remarks" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Remarks (Optional)
                </label>
                <textarea id="remarks" name="remarks" rows="3"
                    class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                         dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                @error('remarks') border-red-500 @else border-gray-400 @enderror"
                    placeholder="Any specific notes regarding this fee, payment plan details, etc.">{{ old('remarks') }}</textarea>

                @error('remarks')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                <a href="{{ route('admin.fees.index') }}"
                    class="px-4 py-2 cursor-pointer border border-red-500 hover:border-red-600 text-red-600 rounded-md flex items-center gap-2 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    Cancel
                </a>
                <button type="submit"
                    class="px-4 py-2 cursor-pointer bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 flex items-center gap-2 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Create Fee Record
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        function studentSelect() {
        return {
            open: false,
            search: "",
            selectedId: "{{ old('student_id') }}",
            selectedName: "",

            students: @json($students->map(fn($s) => [
                'id' => $s->id,
                'name' => $s->name,
                'email' => $s->email
            ])),

            get filtered() {
                return this.students.filter(s =>
                    s.name.toLowerCase().includes(this.search.toLowerCase()) ||
                    s.email.toLowerCase().includes(this.search.toLowerCase())
                );
            },

            selectStudent(student) {
                this.selectedId = student.id;
                this.selectedName = student.name + " (" + student.email + ")";
                this.open = false;
            },

            init() {
                // Pre-select old value for validation error
                const found = this.students.find(s => s.id == this.selectedId);
                if (found) {
                    this.selectedName = found.name + " (" + found.email + ")";
                }
            }
        };
    }
    </script>
@endpush
