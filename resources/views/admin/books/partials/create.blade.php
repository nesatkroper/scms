<!-- Create Modal -->
<div id="Modalcreate" class="fixed inset-0 z-50 flex items-center justify-center p-4 hidden">
    <div
        class="relative bg-white dark:bg-gray-800 rounded-xl shadow-2xl w-full max-w-2xl transform transition-all duration-300 opacity-0 scale-95 border border-white dark:border-gray-600">
        <!-- Header -->
        <div class="flex justify-between items-center p-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="size-8 rounded-full p-1 bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"
                    viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                        clip-rule="evenodd" />
                </svg>
                Add New Book
            </h3>
            <button id="closeCreateModal"
                class="text-red-400 hover:bg-red-50 dark:hover:bg-gray-700 cursor-pointer rounded-full p-1 hover:text-red-500">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Form Content -->
        <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data" class="py-4">
            @csrf

            <div class="h-[65vh] md:h-auto overflow-y-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-1 sm:gap-4 mb-2">
                    <!-- Title Field -->
                    <div class="mb-2">
                        <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Title <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}"
                            class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                            focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                             dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                            @error('title') border-red-500 @else border-gray-400 @enderror"
                            placeholder="Enter book title" required>

                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Author Field -->
                    <div class="mb-2">
                        <label for="author" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Author <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="author" name="author" value="{{ old('author') }}"
                            class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                            focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                             dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                            @error('author') border-red-500 @else border-gray-400 @enderror"
                            placeholder="Enter author name" required>

                        @error('author')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- ISBN Field -->
                    <div class="mb-2">
                        <label for="isbn" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            ISBN <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="isbn" name="isbn" value="{{ old('isbn') }}"
                            class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                            focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                             dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                            @error('isbn') border-red-500 @else border-gray-400 @enderror"
                            placeholder="Enter ISBN" required>

                        @error('isbn')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Publication Year Field -->
                    <div class="mb-2">
                        <label for="publication_year"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Publication Year <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="publication_year" name="publication_year" min="1900"
                            max="{{ date('Y') + 1 }}" value="{{ old('publication_year') }}"
                            class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                            focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                             dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                            @error('publication_year') border-red-500 @else border-gray-400 @enderror"
                            placeholder="Enter publication year" required>

                        @error('publication_year')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Publisher Field -->
                    <div class="mb-2">
                        <label for="publisher" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Publisher <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="publisher" name="publisher" value="{{ old('publisher') }}"
                            class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                            focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                             dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                            @error('publisher') border-red-500 @else border-gray-400 @enderror"
                            placeholder="Enter publisher" required>

                        @error('publisher')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Quantity Field -->
                    <div class="mb-2">
                        <label for="quantity" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Quantity <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="quantity" name="quantity" min="0"
                            value="{{ old('quantity') }}"
                            class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                            focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                             dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                            @error('quantity') border-red-500 @else border-gray-400 @enderror"
                            placeholder="Enter quantity" required>

                        @error('quantity')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label for="category_id"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Category
                        </label>

                        <div data-name="category_id"
                            class="custom-select relative w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                            focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                             dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                        @error('code') border-red-500 @else border-gray-400 @enderror"
                            placeholder="Enter code" required>
                            <div class="select-header cursor-pointer flex justify-between items-center">
                                <span class="selected-value">
                                    {{ old('category_name', 'Select Category') }}
                                </span>
                                <span class="arrow transition-transform duration-300">▼</span>
                            </div>
                            <div
                                class="select-options absolute z-10 top-full left-0 right-0 max-h-[250px] overflow-y-auto hidden shadow-md rounded-sm bg-slate-50 dark:bg-slate-700 border border-slate-300 dark:border-slate-600">
                                <div class="search-container p-2 sticky top-0 z-1 bg-white dark:bg-slate-700">
                                    <input type="search"
                                        class="search-input text-sm w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                            focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                             dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300"
                                        placeholder="Search department...">
                                </div>
                                <div class="options-container">
                                    @foreach ($categories as $categorie)
                                        <div class=" {{ old('category_id') == $categorie->id ? 'selected' : '' }} 
                                            select-option px-[10px] py-2 cursor-pointer border-b border-slate-200 dark:border-slate-600"
                                            data-value="{{ $categorie->id }}">
                                            {{ $categorie->name }}
                                        </div>
                                    @endforeach
                                </div>
                                <div class="no-results p-2 text-center text-red-500" style="display: none;">No results
                                    found</div>
                            </div>
                        </div>

                        <!-- Hidden input for form submission -->
                        <input type="hidden" name="category_id" id="category_id"
                            value="{{ old('category_id') }}">

                        @error('category_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Cover Image Field -->
                    <div class="mb-2">
                        <label for="cover_image"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Cover Image
                        </label>
                        <input type="file" id="cover_image" name="cover_image" accept="image/*"
                            class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                            focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                             dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                            @error('cover_image') border-red-500 @else border-gray-400 @enderror">

                        @error('cover_image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Description Field (full width) -->
                <div class="mb-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Description
                    </label>
                    <textarea id="description" name="description" rows="3"
                        class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                         dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                        @error('description') border-red-500 @else border-gray-400 @enderror"
                        placeholder="Enter book description">{{ old('description') }}</textarea>

                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end space-x-3 px-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                <button type="button" id="cancelCreateModal"
                    class="px-4 py-2 cursor-pointer border border-red-500 hover:border-red-600 text-red-600 rounded-md flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    Cancel
                </button>
                <button type="submit" id="createSubmitBtn"
                    class="px-4 py-2 cursor-pointer bg-indigo-600 text-white rounded-md hover:bg-indigo-700 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                    Create Book
                </button>
            </div>
        </form>
    </div>
</div>
