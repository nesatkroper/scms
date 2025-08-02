<!-- Edit Book Modal -->
<div id="Modaledit" class="fixed inset-0 z-50 flex items-center justify-center p-4 hidden">
    <div
        class="relative h-full bg-white dark:bg-gray-800 rounded-xl shadow-2xl w-full max-w-3xl transform transition-all duration-300 opacity-0 scale-95 border border-gray-100 dark:border-gray-700">
        <!-- Header -->
        <div class="flex justify-between items-center p-4 border-b border-gray-100 dark:border-gray-700">
            <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 flex items-center gap-3">
                <div class="p-2 rounded-lg bg-indigo-50 dark:bg-indigo-900/20 text-indigo-600 dark:text-indigo-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </div>
                Edit Book
            </h3>
            <button id="closeEditModal"
                class="text-red-400 hover:bg-red-50 dark:hover:bg-gray-700 cursor-pointer rounded-full p-1 hover:text-red-500">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Form Content -->
        <form id="Formedit" method="POST" class="py-4" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="h-[65vh] md:h-[75vh] px-4 overflow-y-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-1 sm:gap-4 mb-2">
                    <div>
                        <label for="edit_title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Title <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="edit_title" name="title"
                            class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                            focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                            dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                            @error('title') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror"
                            placeholder="Enter book title" required>
                        @error('title')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Author Field -->
                    <div>
                        <label for="edit_author"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Author <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="edit_author" name="author"
                            class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                            focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                            dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                            @error('author') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror"
                            placeholder="Enter author name" required>
                        @error('author')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- ISBN Field -->
                    <div>
                        <label for="edit_isbn" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            ISBN
                        </label>
                        <input type="text" id="edit_isbn" name="isbn"
                            class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                            focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                            dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                            @error('isbn') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror"
                            placeholder="Enter ISBN number">
                        @error('isbn')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category Field -->
                    <div>
                        <label for="edit_category_id"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Category <span class="text-red-500">*</span>
                        </label>
                        <select id="edit_category_id" name="category_id"
                            class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                            focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                            dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                            @error('category_id') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror"
                            required>
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Published Year Field -->
                    <div>
                        <label for="edit_publication_year"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Published Year
                        </label>
                        <input type="number" id="edit_publication_year" name="publication_year" min="1900"
                            max="{{ date('Y') }}"
                            class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                            focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                            dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                            @error('publication_year') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror"
                            placeholder="Enter published year">
                        @error('publication_year')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Publisher Field -->
                    <div>
                        <label for="edit_publisher"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Publisher
                        </label>
                        <input type="text" id="edit_publisher" name="publisher"
                            class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                            focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                            dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                            @error('publisher') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror"
                            placeholder="Enter publisher">
                        @error('publisher')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Quantity Field -->
                    <div>
                        <label for="edit_quantity"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Quantity <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="edit_quantity" name="quantity" min="0"
                            class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                            focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                            dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                            @error('quantity') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror"
                            placeholder="Enter quantity" required>
                        @error('quantity')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Cover Image Field -->
                    <div class="">
                        <label for="edit_cover_image"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Cover Image
                        </label>
                        <input type="file" id="edit_cover_image" name="cover_image" accept="image/*"
                            class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                        dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                        @error('cover_image') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror">
                        @error('cover_image')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <div id="current-cover-container" class="mt-2 hidden">
                            <p class="text-sm text-gray-500 dark:text-gray-400">Current Cover:</p>
                            <img id="current-cover-image" src=""
                                class="mt-1 h-32 object-contain rounded border border-gray-200 dark:border-gray-600">
                            <div class="flex items-center mt-2">
                                <input type="checkbox" name="remove_cover_image" id="remove_cover_image"
                                    class="mr-2 appearance-none size-4 border-2 border-gray-300 dark:border-gray-600 rounded-sm cursor-pointer transition-all duration-200 ease-in-out relative checked:bg-indigo-500 dark:checked:bg-indigo-600 checked:border-indigo-500 dark:checked:border-indigo-600 hover:border-indigo-400 dark:hover:border-indigo-500 focus:ring-2 focus:ring-indigo-200 dark:focus:ring-indigo-700 focus:ring-offset-2 focus:outline-none before:content-[''] before:absolute before:inset-0 before:bg-no-repeat before:bg-center before:bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgc3Ryb2tlPSJ3aGl0ZSIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiPjxwb2x5bGluZSBwb2ludHM9IjIwIDYgOSAxNyA0IDEyIj48L3BvbHlsaW5lPjwvc3ZnPg==')] before:opacity-0 before:transition-opacity before:duration-200 checked:before:opacity-100">
                                <label for="remove_cover_image" class="text-sm text-gray-600 dark:text-gray-300">
                                    Remove cover image
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Description Field -->
                <div class="mt-4">
                    <label for="edit_description"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Description
                    </label>
                    <textarea id="edit_description" name="description" rows="3"
                        class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                        dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                        @error('description') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror"
                        placeholder="Enter book description"></textarea>
                    @error('description')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
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
