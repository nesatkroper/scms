<!-- Edit Modal -->
<div id="Modaledit" class="fixed inset-0 z-50 flex items-center justify-center p-4 hidden">
    <div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-2xl w-full max-w-2xl transform transition-all duration-300 opacity-0 scale-95 border border-white dark:border-gray-600">
        <!-- Header -->
        <div class="flex justify-between items-center p-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="size-8 p-1 rounded-full bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"
                    viewBox="0 0 20 20" fill="currentColor">
                    <path
                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                </svg>
                Edit Expense
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
                <!-- Title Field -->
                <div class="mb-2">
                    <label for="edit_title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Title <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="edit_title" name="title" value="{{ old('title') }}"
                        class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                            focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                             dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                        @error('title') border-red-500 @else border-gray-400 @enderror"
                        placeholder="Enter title" required>

                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Amount Field -->
                <div class="mb-2">
                    <label for="edit_amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Amount <span class="text-red-500">*</span>
                    </label>
                    <input type="number" step="0.01" id="edit_amount" name="amount" value="{{ old('amount') }}"
                        class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                            focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                             dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                        @error('amount') border-red-500 @else border-gray-400 @enderror"
                        placeholder="Enter amount" required>
                    <p class="error mt-1 text-sm text-red-600"></p>
                </div>
                
                <!-- Category Field -->
                <div class="mb-2">
                    <label for="edit_category" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Category <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="edit_category" name="category" value="{{ old('category') }}"
                        class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                            focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                             dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                        @error('category') border-red-500 @else border-gray-400 @enderror"
                        placeholder="Enter category" required>

                    @error('category')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Date Field -->
                <div class="mb-2">
                    <label for="edit_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Date <span class="text-red-500">*</span>
                    </label>
                    <input type="date" id="edit_date" name="date" value="{{ old('date') }}"
                        class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                            focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                             dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                        @error('date') border-red-500 @else border-gray-400 @enderror"
                        required>
                    <p class="error mt-1 text-sm text-red-600"></p>
                </div>
            </div>
            
            <!-- Approved By Field -->
            <div class="mb-2">
                <label for="edit_approved_by" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Approved by
                </label>
                <select id="edit_approved_by" name="approved_by"
                    class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                         dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                    @error('approved_by') border-red-500 @else border-gray-400 @enderror">
                    <option value="">Select approver</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('approved_by') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>

                @error('approved_by')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Description Field -->
            <div class="mb-2">
                <label for="edit_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Description
                </label>
                <textarea id="edit_description" name="description" rows="3"
                    class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                            focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                             dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                    @error('description') border-red-500 @else border-gray-400 @enderror"
                    placeholder="Enter description">{{ old('description') }}</textarea>

                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
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
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                            fill="currentColor">
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