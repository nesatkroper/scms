<!-- Detail Modal -->
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
                Department Details
            </h3>
            <x-button.btnclose id="closeDetailModal" />
        </div>
        <!-- Content -->
        <div class="h-[65vh] md:h-auto p-4 overflow-y-auto">
            <!-- Name Field -->
            <x-fields.input :detail="true" label="Department Name" name="name" />
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-2">
                <!-- Created At Field -->
                <x-fields.input type="date" :detail="true" label="Department Name" name="created_at" />
                <!-- Updated At Field -->
                <x-fields.input type="date" :detail="true" label="Department Name" name="updated_at" />
            </div>
            <!-- Description Field -->
            <x-fields.textarea :detail="true" label="Description" name="description" />
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
