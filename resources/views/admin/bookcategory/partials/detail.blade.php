<!-- Book Category Detail Modal -->
<div id="Modaldetail" class="fixed inset-0 z-50 flex items-center justify-center p-4 hidden">
    <div
        class="relative bg-white dark:bg-gray-800 rounded-xl shadow-2xl w-full max-w-2xl transform transition-all duration-300 opacity-0 scale-95 border border-gray-100 dark:border-gray-700">
        <!-- Header -->
        <div class="flex justify-between items-center p-4 border-b border-gray-100 dark:border-gray-700">
            <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 flex items-center gap-3">
                <div class="p-2 rounded-lg bg-indigo-50 dark:bg-indigo-900/20 text-indigo-600 dark:text-indigo-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                Book Category Details
            </h3>
            <button id="closeDetailModal"
                class="text-red-400 hover:bg-red-50 dark:hover:bg-gray-700 cursor-pointer rounded-full p-1 hover:text-red-500">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <!-- Content -->
        <div class="h-[65vh] md:h-auto p-4 overflow-y-auto">
            <!-- Name Field -->
            <div class="mb-2">
                <label for="detail_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Category Name
                </label>
                <input type="text" id="detail_name" name="detail_name"
                    class="w-full px-4 py-2.5 border rounded-lg bg-gray-50 dark:bg-gray-700 border-gray-200 dark:border-gray-600 text-gray-800 dark:text-gray-200"
                    disabled readonly>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-2">
                <!-- Created At Field -->
                <div class="mb-2">
                    <label for="detail_created_at"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Created Date
                    </label>
                    <input type="text" id="detail_created_at" name="detail_created_at"
                        class="w-full px-4 py-2.5 border rounded-lg bg-gray-50 dark:bg-gray-700 border-gray-200 dark:border-gray-600 text-gray-800 dark:text-gray-200"
                        disabled readonly>
                </div>

                <!-- Updated At Field -->
                <div class="mb-2">
                    <label for="detail_updated_at"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Last Updated
                    </label>
                    <input type="text" id="detail_updated_at" name="detail_updated_at"
                        class="w-full px-4 py-2.5 border rounded-lg bg-gray-50 dark:bg-gray-700 border-gray-200 dark:border-gray-600 text-gray-800 dark:text-gray-200"
                        disabled readonly>
                </div>
            </div>

            <!-- Description Field -->
            <div>
                <label for="detail_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Description
                </label>
                <textarea id="detail_description" name="detail_description" rows="4"
                    class="w-full px-4 py-2.5 border rounded-lg bg-gray-50 dark:bg-gray-700 border-gray-200 dark:border-gray-600 text-gray-800 dark:text-gray-200"
                    disabled readonly></textarea>
            </div>
        </div>

        <!-- Footer -->
        <div class="flex justify-end p-5 border-t border-gray-100 dark:border-gray-700">
            
            <button type="button" id="closeDetailModalBtn"
                class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition-colors">
                Close
            </button>
        </div>
    </div>
</div>
