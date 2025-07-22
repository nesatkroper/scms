<!-- Edit Teacher Modal -->
<div id="Modaledit" class="fixed inset-0 z-50 flex items-center justify-center p-4 hidden">
    <div
        class="relative bg-white dark:bg-gray-800 rounded-xl shadow-2xl w-full max-w-2xl transform transition-all duration-300 opacity-0 scale-95 border border-white dark:border-gray-600">
        <!-- Header -->
        <div class="flex justify-between items-center p-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="size-8 p-1 rounded-full bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"
                    viewBox="0 0 20 20" fill="currentColor">
                    <path
                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                </svg>
                Edit Teacher
            </h3>
            <button id="closeEditModal"
                class="text-red-400 hover:bg-red-50 dark:hover:bg-gray-700 cursor-pointer rounded-full p-1 hover:text-red-500">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Form Content -->
        <form id="Formedit" method="POST" class="p-4">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-1 sm:gap-4 mb-2">
                <!-- Teacher ID Field -->
                <div class="mb-2">
                    <label for="edit_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="edit_name" name="name"
                        class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white
                        @error('name') border-red-500 @else border-gray-400 @enderror"
                        placeholder="Enter name" required>

                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Department Field -->
                <div class="mb-2">
                    <label for="edit_depid" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Department <span class="text-red-500">*</span>
                    </label>
                    <select id="edit_depid" name="department_id"
                        class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white
                        @error('department_id') border-red-500 @else border-gray-400 @enderror" required>
                        <option value="">Select department</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}"
                                {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                {{ $department->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('department_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Joining Date Field -->
                <div class="mb-2">
                    <label for="edit_joining_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Joining Date <span class="text-red-500">*</span>
                    </label>
                    <input type="date" id="edit_joining_date" name="joining_date" value="{{ old('joining_date') }}"
                        class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white
                        @error('joining_date') border-red-500 @else border-gray-400 @enderror"
                        required>

                    @error('joining_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Qualification Field -->
                <div class="mb-2">
                    <label for="edit_qualification" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Qualification <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="edit_qualification" name="qualification" value="{{ old('qualification') }}"
                        class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white
                        @error('qualification') border-red-500 @else border-gray-400 @enderror"
                        placeholder="Enter qualification" required>

                    @error('qualification')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Specialization Field -->
                <div class="mb-2">
                    <label for="edit_specialization" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Specialization
                    </label>
                    <input type="text" id="edit_specialization" name="specialization" value="{{ old('specialization') }}"
                        class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white
                        @error('specialization') border-red-500 @else border-gray-400 @enderror"
                        placeholder="Enter specialization">

                    @error('specialization')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Salary Field -->
                <div class="mb-2">
                    <label for="edit_salary" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Salary
                    </label>
                    <input type="number" step="0.01" id="edit_salary" name="salary" value="{{ old('salary') }}"
                        class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white
                        @error('salary') border-red-500 @else border-gray-400 @enderror"
                        placeholder="Enter salary">

                    @error('salary')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                <button type="button" id="cancelEditModal"
                    class="px-4 py-2 cursor-pointer border border-red-500 hover:text-white hover:bg-red-600 text-red-500 rounded-md flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    Cancel
                </button>
                <button type="submit" id="saveEditBtn"
                    class="px-4 py-2 cursor-pointer bg-indigo-600 text-white rounded-md hover:bg-indigo-700 flex items-center gap-2">
                    <span class="btn-content flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        Save Changes
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>