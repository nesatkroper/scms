    <!-- Detail Department Modal -->
    <div id="detailDepartmentModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 hidden">
        <div
            class="relative bg-white dark:bg-gray-800 rounded-xl shadow-2xl w-full max-w-md transform transition-all duration-300 opacity-0 scale-95 border border-white dark:border-gray-600">
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
                    Department Details
                </h3>
                <button id="closeDetailModal"
                    class="text-red-400 hover:bg-red-50 dark:hover:bg-gray-700 cursor-pointer rounded-full p-1 hover:text-red-500">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Content -->
            <div class="p-4 px-6">
                <div class="mb-4">
                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Department Name</h4>
                    <p id="detail_name" class="mt-1 text-sm text-gray-900 dark:text-gray-200"></p>
                </div>

                <div class="mb-4">
                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Description</h4>
                    <p id="detail_description" class="mt-1 text-sm text-gray-900 dark:text-gray-200"></p>
                </div>

                <div class="mb-4">
                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Created At</h4>
                    <p id="detail_created_at" class="mt-1 text-sm text-gray-900 dark:text-gray-200"></p>
                </div>

                <div class="mb-4">
                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Last Updated</h4>
                    <p id="detail_updated_at" class="mt-1 text-sm text-gray-900 dark:text-gray-200"></p>
                </div>
            </div>

            <!-- Footer -->
            <div class="flex justify-end space-x-3 p-4 border-t border-gray-200 dark:border-gray-700">
                <button type="button" id="closeDetailModalBtn"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 flex items-center gap-2">
                    Close
                </button>
            </div>
        </div>
    </div>
