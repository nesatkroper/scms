    <!-- Detail Department Modal -->
    <div id="Modaldetail" class="fixed inset-0 z-50 flex items-center justify-center p-4 hidden">
        <div
            class="relative bg-white dark:bg-gray-800 rounded-xl shadow-2xl w-full max-w-2xl transform transition-all duration-300 opacity-0 scale-95 border border-white dark:border-gray-600">
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
                    Subject Details
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
            <div class="h-[65vh] md:h-auto p-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-1 sm:gap-4 mb-2">
                    <!-- Name Field -->
                    <div class="mb-2">
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Name
                        </label>
                        <input type="text" id="detail_name" name="detail_name"
                            class="w-full px-4 py-2.5 border rounded-lg bg-gray-50 dark:bg-gray-700 border-gray-200 dark:border-gray-600 text-gray-800 dark:text-gray-200"
                            disabled readonly>
                    </div>

                    <!-- Code Field -->
                    <div class="mb-2">
                        <label for="detail_code"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Code
                        </label>
                        <input type="text" id="detail_code" name="detail_code"
                            class="w-full px-4 py-2.5 border rounded-lg bg-gray-50 dark:bg-gray-700 border-gray-200 dark:border-gray-600 text-gray-800 dark:text-gray-200"
                            disabled readonly>
                    </div>
                    <!-- Department Field -->
                    <div class="mb-2">
                        <label for="detail_depid"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Department
                        </label>
                        <input type="text" id="detail_depid" name="detail_depid"
                            class="w-full px-4 py-2.5 border rounded-lg bg-gray-50 dark:bg-gray-700 border-gray-200 dark:border-gray-600 text-gray-800 dark:text-gray-200"
                            disabled readonly>
                    </div>

                    <!-- Credit Hours Field -->
                    <div class="mb-2">
                        <label for="credit_hours"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Credit hours
                        </label>
                        <input type="number" id="detail_credit_hours" name="credit_hours" disabled readonly
                            class="w-full px-4 py-2.5 border rounded-lg bg-gray-50 dark:bg-gray-700 border-gray-200 dark:border-gray-600 text-gray-800 dark:text-gray-200"
                            disabled readonly>
                    </div>

                </div>
                <div class="mb-2">
                    <label for="detail_updated_at"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Date
                    </label>
                    <input type="date" id="detail_updated_at" name="detail_updated_at" disabled readonly
                        class="w-full px-4 py-2.5 border rounded-lg bg-gray-50 dark:bg-gray-700 border-gray-200 dark:border-gray-600 text-gray-800 dark:text-gray-200"
                        disabled readonly>
                </div>
                <!-- Description Field (full width) -->
                <div class="mb-2">
                    <label for="detail_description"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Description
                    </label>
                    <textarea id="detail_description" name="detail_description" rows="3" disabled readonly
                        class="w-full px-4 py-2.5 border rounded-lg bg-gray-50 dark:bg-gray-700 border-gray-200 dark:border-gray-600 text-gray-800 dark:text-gray-200"
                        disabled readonly></textarea>
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
