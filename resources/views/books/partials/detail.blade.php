<!-- Detail Book Modal -->
<div id="Modaldetail" class="fixed inset-0 z-50 flex items-center justify-center p-4 hidden">
    <div class="relative h-full bg-white dark:bg-gray-800 rounded-xl shadow-2xl w-full max-w-2xl transform transition-all duration-300 opacity-0 scale-95 border border-white dark:border-gray-600">
        <!-- Header -->
        <div class="flex justify-between items-center p-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="size-8 p-1 rounded-full bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"
                    viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z"
                        clip-rule="evenodd" />
                </svg>
                Book Details
            </h3>
            <button id="closeDetailModal"
                class="text-red-400 hover:bg-red-50 dark:hover:bg-gray-700 cursor-pointer rounded-full p-1 hover:text-red-500">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        
        <!-- Content -->
        <div class="h-[65vh] md:h-[75vh] p-4 overflow-y-auto">
            <!-- Cover Image -->
            <div class="mb-4 flex justify-center">
                <div id="detailCoverImage" class="h-48 w-32 bg-gray-100 dark:bg-gray-700 flex items-center justify-center rounded-md overflow-hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-1 sm:gap-4 mb-2">
                <!-- Title Field -->
                <div class="mb-2">
                    <label for="detail_title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Title
                    </label>
                    <input type="text" id="detail_title" name="detail_title"
                        class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                        dark:border-gray-500 dark:text-white border-slate-300 bg-slate-100"
                        disabled readonly>
                </div>

                <!-- Author Field -->
                <div class="mb-2">
                    <label for="detail_author" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Author
                    </label>
                    <input type="text" id="detail_author" name="detail_author"
                        class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                        dark:border-gray-500 dark:text-white border-slate-300 bg-slate-100"
                        disabled readonly>
                </div>

                <!-- ISBN Field -->
                <div class="mb-2">
                    <label for="detail_isbn" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        ISBN
                    </label>
                    <input type="text" id="detail_isbn" name="detail_isbn"
                        class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                        dark:border-gray-500 dark:text-white border-slate-300 bg-slate-100"
                        disabled readonly>
                </div>

                <!-- Publication Year Field -->
                <div class="mb-2">
                    <label for="detail_publication_year" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Publication Year
                    </label>
                    <input type="text" id="detail_publication_year" name="detail_publication_year"
                        class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                        dark:border-gray-500 dark:text-white border-slate-300 bg-slate-100"
                        disabled readonly>
                </div>

                <!-- Publisher Field -->
                <div class="mb-2">
                    <label for="detail_publisher" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Publisher
                    </label>
                    <input type="text" id="detail_publisher" name="detail_publisher"
                        class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                        dark:border-gray-500 dark:text-white border-slate-300 bg-slate-100"
                        disabled readonly>
                </div>

                <!-- Quantity Field -->
                <div class="mb-2">
                    <label for="detail_quantity" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Quantity Available
                    </label>
                    <input type="text" id="detail_quantity" name="detail_quantity"
                        class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                        dark:border-gray-500 dark:text-white border-slate-300 bg-slate-100"
                        disabled readonly>
                </div>

                <!-- Category Field -->
                <div class="mb-2">
                    <label for="detail_category" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Category
                    </label>
                    <input type="text" id="detail_category" name="detail_category"
                        class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                        dark:border-gray-500 dark:text-white border-slate-300 bg-slate-100"
                        disabled readonly>
                </div>

                <!-- Created At Field -->
                <div class="mb-2">
                    <label for="detail_created_at" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Date Added
                    </label>
                    <input type="date" id="detail_created_at" name="detail_created_at" disabled readonly
                        class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                        dark:border-gray-500 dark:text-white border-slate-300 bg-slate-100">
                </div>
            </div>

            <!-- Description Field (full width) -->
            <div class="mb-2">
                <label for="detail_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Description
                </label>
                <textarea id="detail_description" name="detail_description" rows="3" disabled readonly
                    class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                    focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                    dark:border-gray-500 dark:text-white border-slate-300 bg-slate-100"></textarea>
            </div>
        </div>

        <!-- Footer -->
        <div class="flex justify-end space-x-3 p-4 border-t border-gray-200 dark:border-gray-700">
            <button type="button" id="closeDetailModalBtn"
                class="px-4 py-2 cursor-pointer bg-indigo-600 text-white rounded-md hover:bg-indigo-700 flex items-center gap-2">
                Close
            </button>
        </div>
    </div>
</div>