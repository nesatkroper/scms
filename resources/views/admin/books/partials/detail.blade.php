<!-- Detail Modal -->
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
                Guardian Details
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
            <!-- Photo -->
            <div class="mb-4 flex justify-center">
                <div id="detailPhoto" class="h-48 w-48 bg-gray-100 dark:bg-gray-700 flex items-center justify-center rounded-full overflow-hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-1 sm:gap-4 mb-2">
                <!-- Name Field -->
                <div class="mb-2">
                    <label for="detail_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Name
                    </label>
                    <input type="text" id="detail_name" readonly
                        class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                        dark:border-gray-500 dark:text-white border-slate-300 bg-slate-100">
                </div>

                <!-- Phone Field -->
                <div class="mb-2">
                    <label for="detail_phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Phone
                    </label>
                    <input type="text" id="detail_phone" readonly
                        class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                        dark:border-gray-500 dark:text-white border-slate-300 bg-slate-100">
                </div>

                <!-- Email Field -->
                <div class="mb-2">
                    <label for="detail_email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Email
                    </label>
                    <input type="text" id="detail_email" readonly
                        class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                        dark:border-gray-500 dark:text-white border-slate-300 bg-slate-100">
                </div>

                <!-- Address Field -->
                <div class="mb-2">
                    <label for="detail_address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Address
                    </label>
                    <input type="text" id="detail_address" readonly
                        class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                        dark:border-gray-500 dark:text-white border-slate-300 bg-slate-100">
                </div>

                <!-- Occupation Field -->
                <div class="mb-2">
                    <label for="detail_occupation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Occupation
                    </label>
                    <input type="text" id="detail_occupation" readonly
                        class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                        dark:border-gray-500 dark:text-white border-slate-300 bg-slate-100">
                </div>

                <!-- Company Field -->
                <div class="mb-2">
                    <label for="detail_company" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Company
                    </label>
                    <input type="text" id="detail_company" readonly
                        class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                        dark:border-gray-500 dark:text-white border-slate-300 bg-slate-100">
                </div>

                <!-- Relation Field -->
                <div class="mb-2">
                    <label for="detail_relation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Relation
                    </label>
                    <input type="text" id="detail_relation" readonly
                        class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                        dark:border-gray-500 dark:text-white border-slate-300 bg-slate-100">
                </div>

                <!-- Created At Field -->
                <div class="mb-2">
                    <label for="detail_created_at" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Date Added
                    </label>
                    <input type="date" id="detail_created_at" disabled readonly
                        class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                        dark:border-gray-500 dark:text-white border-slate-300 bg-slate-100">
                </div>
            </div>

            <!-- Associated Students -->
            <div class="mb-2">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Associated Students
                </label>
                <div id="detail_students" class="w-full px-3 py-2 border rounded-md dark:bg-gray-700
                    dark:border-gray-500 dark:text-white border-slate-300 bg-slate-100">
                    <p class="text-gray-500 dark:text-gray-400">No associated students</p>
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