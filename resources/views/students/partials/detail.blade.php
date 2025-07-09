<!-- Detail Student Modal -->
<div id="Modaldetail" class="fixed inset-0 z-50 flex items-center justify-center p-4 hidden">
    <div
        class="relative bg-white dark:bg-gray-800 rounded-xl shadow-2xl w-full max-w-2xl transform transition-all duration-300 opacity-0 scale-95 border border-white dark:border-gray-600">
        <!-- Header -->
        <div class="flex justify-between items-center p-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="size-8 p-1 rounded-full bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"
                    viewBox="0 0 20 20" fill="currentColor">
                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v1h8v-1zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-1a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v1h-3zM4.75 12.094A5.973 5.973 0 004 15v1H1v-1a3 3 0 013.75-2.906z" />
                </svg>
                Student Details
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
            <div class="grid grid-cols-1 md:grid-cols-2 gap-1 sm:gap-4 mb-2">
                <!-- Student ID Field -->
                <div class="mb-2">
                    <label for="detail_student_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Student ID
                    </label>
                    <input type="text" id="detail_student_id" name="detail_student_id"
                        class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                        dark:border-gray-600 dark:text-white border-gray-400"
                        disabled readonly>
                </div>

                <!-- Admission Date Field -->
                <div class="mb-2">
                    <label for="detail_admission_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Admission Date
                    </label>
                    <input type="date" id="detail_admission_date" name="detail_admission_date"
                        class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                        dark:border-gray-600 dark:text-white border-gray-400"
                        disabled readonly>
                </div>

                <!-- Section Field -->
                <div class="mb-2">
                    <label for="detail_section" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Section
                    </label>
                    <input type="text" id="detail_section" name="detail_section"
                        class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                        dark:border-gray-600 dark:text-white border-gray-400"
                        disabled readonly>
                </div>

                <!-- User ID Field -->
                <div class="mb-2">
                    <label for="detail_user_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        User ID
                    </label>
                    <input type="text" id="detail_user_id" name="detail_user_id"
                        class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                        dark:border-gray-600 dark:text-white border-gray-400"
                        disabled readonly>
                </div>

                <!-- Created At Field -->
                <div class="mb-2">
                    <label for="detail_created_at" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Created At
                    </label>
                    <input type="text" id="detail_created_at" name="detail_created_at"
                        class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                        dark:border-gray-600 dark:text-white border-gray-400"
                        disabled readonly>
                </div>

                <!-- Updated At Field -->
                <div class="mb-2">
                    <label for="detail_updated_at" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Last Updated
                    </label>
                    <input type="text" id="detail_updated_at" name="detail_updated_at"
                        class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                        dark:border-gray-600 dark:text-white border-gray-400"
                        disabled readonly>
                </div>
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