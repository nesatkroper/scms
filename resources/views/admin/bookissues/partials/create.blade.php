<!-- Book Issues Modal -->
<div id="Modalcreate" class="fixed inset-0 z-50 flex items-center justify-center p-4 hidden">
    <div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-2xl w-full max-w-2xl transform transition-all duration-300 opacity-0 scale-95 border border-white dark:border-gray-600">
        <!-- Header -->
        <div class="flex justify-between items-center p-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" 
                     class="size-8 rounded-full p-1 bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900" 
                     viewBox="0 0 20 20" fill="currentColor">
                    <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z" />
                </svg>
                Book Issue Record
            </h3>
            <button id="closeBookIssuesModal"
                class="text-red-400 hover:bg-red-50 dark:hover:bg-gray-700 cursor-pointer rounded-full p-1 hover:text-red-500">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Form Content -->
        <form action="{{ route('admin.bookissues.store') }}" method="POST" class="py-4">
            @csrf

            <div class="h-[65vh] md:h-auto overflow-y-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-1 sm:gap-4 mb-2">
                    <!-- Book Selection -->
                    <div class="mb-2">
                        <label for="book_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Book <span class="text-red-500">*</span>
                        </label>
                        <select id="book_id" name="book_id" required
                            class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                            focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                            dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                            @error('book_id') border-red-500 @else border-gray-400 @enderror">
                            <option value="">Select a Book</option>
                            @foreach($books as $book)
                                <option value="{{ $book->id }}" {{ old('book_id') == $book->id ? 'selected' : '' }}>
                                    {{ $book->title }} ({{ $book->isbn }})
                                </option>
                            @endforeach
                        </select>
                        @error('book_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- User Selection -->
                    <div class="mb-2">
                        <label for="user_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            User <span class="text-red-500">*</span>
                        </label>
                        <select id="user_id" name="user_id" required
                            class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                            focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                            dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                            @error('user_id') border-red-500 @else border-gray-400 @enderror">
                            <option value="">Select a User</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} ({{ $user->email }})
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Issue Date -->
                    <div class="mb-2">
                        <label for="issue_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Issue Date <span class="text-red-500">*</span>
                        </label>
                        <input type="date" id="issue_date" name="issue_date" value="{{ old('issue_date', date('Y-m-d')) }}" required
                            class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                            focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                            dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                            @error('issue_date') border-red-500 @else border-gray-400 @enderror">
                        @error('issue_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Due Date -->
                    <div class="mb-2">
                        <label for="due_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Due Date <span class="text-red-500">*</span>
                        </label>
                        <input type="date" id="due_date" name="due_date" 
                               value="{{ old('due_date', date('Y-m-d', strtotime('+14 days'))) }}" required
                            class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                            focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                            dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                            @error('due_date') border-red-500 @else border-gray-400 @enderror">
                        @error('due_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Return Date (optional) -->
                    <div class="mb-2">
                        <label for="return_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Return Date
                        </label>
                        <input type="date" id="return_date" name="return_date" value="{{ old('return_date') }}"
                            class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                            focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                            dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                            @error('return_date') border-red-500 @else border-gray-400 @enderror">
                        @error('return_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Fine Amount -->
                    <div class="mb-2">
                        <label for="fine" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Fine Amount
                        </label>
                        <input type="number" id="fine" name="fine" min="0" step="0.01" value="{{ old('fine', 0) }}"
                            class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                            focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                            dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                            @error('fine') border-red-500 @else border-gray-400 @enderror"
                            placeholder="Enter fine amount if applicable">
                        @error('fine')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="mb-2">
                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <select id="status" name="status" required
                            class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                            focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                            dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                            @error('status') border-red-500 @else border-gray-400 @enderror">
                            <option value="issued" {{ old('status', 'issued') == 'issued' ? 'selected' : '' }}>Issued</option>
                            <option value="returned" {{ old('status') == 'returned' ? 'selected' : '' }}>Returned</option>
                            <option value="overdue" {{ old('status') == 'overdue' ? 'selected' : '' }}>Overdue</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            
            <!-- Form Actions -->
            <div class="flex justify-end space-x-3 px-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                <button type="button" id="cancelBookIssuesModal"
                    class="px-4 py-2 cursor-pointer border border-red-500 hover:border-red-600 text-red-600 rounded-md flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    Cancel
                </button>
                <button type="submit" id="bookIssuesSubmitBtn"
                    class="px-4 py-2 cursor-pointer bg-indigo-600 text-white rounded-md hover:bg-indigo-700 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                    Save Record
                </button>
            </div>
        </form>
    </div>
</div>