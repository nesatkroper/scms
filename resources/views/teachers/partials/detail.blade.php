<!-- Detail Teacher Modal -->
<div id="Modaldetail" class="fixed inset-0 z-50 flex items-center justify-center p-4 hidden">
    <div
        class="relative bg-white dark:bg-gray-800 rounded-xl shadow-2xl w-full max-w-2xl transform transition-all duration-300 opacity-0 scale-95 border border-white dark:border-gray-600">
        <!-- Header -->
        <div class="flex justify-between items-center p-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="size-8 p-1 rounded-full bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"
                    viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838l-2.727 1.17 1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z" />
                    <path d="M3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762z" />
                    <path d="M9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0z" />
                    <path d="M6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                </svg>
                Teacher Details
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
                <!-- Teacher ID Field -->
                <div class="mb-2">
                    <label for="detail_teacher_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Teacher ID
                    </label>
                    <input type="text" id="detail_teacher_id" name="detail_teacher_id"
                        class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                        dark:border-gray-600 dark:text-white border-gray-400"
                        disabled readonly>
                </div>

                <!-- Department Field -->
                <div class="mb-2">
                    <label for="detail_department" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Department
                    </label>
                    <input type="text" id="detail_department" name="detail_department"
                        class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                        dark:border-gray-600 dark:text-white border-gray-400"
                        disabled readonly>
                </div>

                <!-- Joining Date Field -->
                <div class="mb-2">
                    <label for="detail_joining_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Joining Date
                    </label>
                    <input type="date" id="detail_joining_date" name="detail_joining_date"
                        class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                        dark:border-gray-600 dark:text-white border-gray-400"
                        disabled readonly>
                </div>

                <!-- Qualification Field -->
                <div class="mb-2">
                    <label for="detail_qualification" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Qualification
                    </label>
                    <input type="text" id="detail_qualification" name="detail_qualification"
                        class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                        dark:border-gray-600 dark:text-white border-gray-400"
                        disabled readonly>
                </div>

                <!-- Specialization Field -->
                <div class="mb-2">
                    <label for="detail_specialization" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Specialization
                    </label>
                    <input type="text" id="detail_specialization" name="detail_specialization"
                        class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                        dark:border-gray-600 dark:text-white border-gray-400"
                        disabled readonly>
                </div>

                <!-- Salary Field -->
                <div class="mb-2">
                    <label for="detail_salary" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Salary
                    </label>
                    <input type="number" step="0.01" id="detail_salary" name="detail_salary"
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