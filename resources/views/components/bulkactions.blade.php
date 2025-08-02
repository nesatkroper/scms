<!-- Bulk Actions Bar -->
<div id="bulkActionsBar"
    class="hidden fixed bottom-4 right-[-60px] transform -translate-x-1/2 bg-white dark:bg-gray-800 shadow-lg rounded-lg p-3 border border-gray-200 dark:border-gray-700">
    <div class="flex flex-col items-start gap-1">
        <!-- Count Display -->
        <div class="text-sm text-gray-700 dark:text-gray-300">
            <span id="selectedCount">0</span> students selected
        </div>

        <!-- Deselect All -->
        <button id="deselectAll"
            class="px-2 p-1 w-full rounded-md cursor-pointer text-start text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 hover:bg-indigo-50 dark:hover:bg-gray-700 text-sm transition">
            Deselect all
        </button>

        <!-- Edit Button -->
        <button id="bulkEditBtn"
            class="px-2 p-1 w-full rounded-md cursor-pointer text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-gray-700 text-sm flex items-center gap-1 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                <path
                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
            </svg>
            Edit
        </button>

        <!-- Delete Button -->
        <button id="bulkDeleteBtn"
            class="px-2 p-1 w-full rounded-md cursor-pointer text-red-600 dark:text-red-500 hover:text-red-700 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-gray-700 text-sm flex items-center gap-1 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                    clip-rule="evenodd" />
            </svg>
            Delete
        </button>
    </div>
</div>
