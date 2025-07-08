<table class="w-full text-sm text-left">
    <thead class="bg-gray-50 dark:bg-gray-700/50 text-xs text-gray-700 dark:text-gray-400 uppercase">
        <tr class="text-nowrap">
            <th scope="col" class="px-4 py-4">Id</th>
            <th scope="col" class="px-4 py-4">Name</th>
            <th scope="col" class="px-4 py-4">Code</th>
            <th scope="col" class="px-4 py-4">Description</th>
            <th scope="col" class="px-4 py-4">Date</th>
            <th scope="col" class="px-4 py-4">Actions</th>
            <th scope="col" class="px-2 py-4 w-20 flex gap-1.5 items-center">
                <input type="checkbox" id="selectAllCheckbox"
                    class="appearance-none size-4 
                    border-2 border-gray-300 dark:border-gray-600 rounded-sm cursor-pointer transition-all duration-200 
                    ease-in-out relative checked:bg-indigo-500 dark:checked:bg-indigo-600
                    checked:border-indigo-500 dark:checked:border-indigo-600 hover:border-indigo-400 dark:hover:border-indigo-500
                    focus:ring-2 focus:ring-indigo-200 dark:focus:ring-indigo-700 focus:ring-offset-2 focus:outline-none before:content-['']
                    before:absolute before:inset-0 before:bg-no-repeat before:bg-center
                    before:bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgc3Ryb2tlPSJ3aGl0ZSIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiPjxwb2x5bGluZSBwb2ludHM9IjIwIDYgOSAxNyA0IDEyIj48L3BvbHlsaW5lPjwvc3ZnPg==')]
                    before:opacity-0 before:transition-opacity before:duration-200 checked:before:opacity-100">
                <span>All</span>
            </th>
        </tr>
    </thead>
    <tbody>
        @if (count($gradelevels) > 0)
            @foreach ($gradelevels as $gradelevel)
                <tr
                    class="text-nowrap border-b border-gray-200 dark:border-gray-700 hover:bg-indigo-50 dark:hover:bg-gray-700">
                    <td class="px-4 py-2">{{ $gradelevel->id }}</td>
                    <td class="px-4 py-2">{{ $gradelevel->name }}</td>
                    <td class="px-4 py-2">{{ $gradelevel->code }}</td>
                    <td class="px-4 py-2">{{ Str::limit($gradelevel->description, 30) }}</td>
                    <td class="px-4 py-2">
                        {{ $gradelevel->created_at->format('Y-m-d') }}
                    </td>

                    <td class="px-4 py-2 text-right">
                        <div class="relative">
                            <button
                                class="btn-toggle-dropdown btn-action font-medium text-indigo-600 dark:text-indigo-500 p-1 size-8 flex items-center justify-center 
                                border border-indigo-100 dark:border-gray-600 dark:hover:bg-gray-700 hover:bg-indigo-200 rounded-full cursor-pointer transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-8" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zm0 5.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zm0 5.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3z" />
                                </svg>
                            </button>

                            <!-- Dropdown Menu -->
                            <div class="dropdown-menu hidden absolute w-auto right-0 z-10 mt-2 origin-top-right divide-y divide-gray-100 dark:divide-gray-700 rounded-md bg-white dark:bg-gray-800 shadow-lg ring-1 ring-black/5 dark:ring-gray-700 focus:outline-none"
                                role="menu">
                                <div class="py-1" role="none">
                                    <a href="#" title="Edit Id({{ $gradelevel->id }})"
                                        class="edit-btn text-gray-700 dark:text-gray-300 px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors flex items-center gap-2"
                                        data-id="{{ $gradelevel->id }}">
                                        <span class="btn-content flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path
                                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                            </svg>
                                            Edit
                                        </span>
                                    </a>
                                    <a href="#" title="Details Id({{ $gradelevel->id }})"
                                        class="text-gray-700 dark:text-gray-300 px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors flex items-center gap-2 detail-btn"
                                        data-id="{{ $gradelevel->id }}">
                                        <span class="btn-content flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Details
                                        </span>
                                    </a>
                                    <button href="#" title="Delete Id({{ $gradelevel->id }})"
                                        class="delete-btn text-red-600 dark:text-red-400 w-full text-left px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors flex items-center gap-2"
                                        data-id="{{ $gradelevel->id }}">
                                        <span class="btn-content flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Delete
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-2 py-2">
                        <input type="checkbox" name="selected_ids[]" value="{{ $gradelevel->id }}"
                            class="row-checkbox appearance-none size-4 
                            border-2 border-gray-300 dark:border-gray-600 rounded-sm cursor-pointer transition-all duration-200 ease-in-out relative
                            checked:bg-indigo-500 dark:checked:bg-indigo-600 checked:border-indigo-500 dark:checked:border-indigo-600
                            hover:border-indigo-400 dark:hover:border-indigo-500 focus:ring-2 focus:ring-indigo-200 dark:focus:ring-indigo-700
                            focus:ring-offset-2 focus:outline-none before:content-[''] before:absolute before:inset-0 before:bg-no-repeat before:bg-center
                            before:bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgc3Ryb2tlPSJ3aGl0ZSIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiPjxwb2x5bGluZSBwb2ludHM9IjIwIDYgOSAxNyA0IDEyIj48L3BvbHlsaW5lPjwvc3ZnPg==')]
                            before:opacity-0 before:transition-opacity before:duration-200 checked:before:opacity-100">
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="12" class="p-4 text-center">
                    <div class="col-span-full py-12 text-center">
                        <div
                            class="max-w-md mx-auto p-6 bg-white dark:bg-slate-800 rounded-lg shadow border border-gray-200 dark:border-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-12 w-12 mx-auto text-red-400 dark:text-red-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h3 class="mt-4 text-lg font-medium text-red-500 dark:text-red-500">No data Found</h3>
                            <p class="mt-2 text-sm text-red-500 dark:text-red-500">Create your first data to get started
                            </p>
                        </div>
                    </div>
                </td>

            </tr>
        @endif
    </tbody>
</table>

<!-- Bulk Actions Bar -->
<div id="bulkActionsBar"
    class="hidden fixed bottom-4 right-[-60px] transform -translate-x-1/2 bg-white dark:bg-gray-800 shadow-lg rounded-lg p-3 border border-gray-200 dark:border-gray-700">
    <div class="flex flex-col items-start gap-1">
        <!-- Count Display -->
        <div class="text-sm text-gray-700 dark:text-gray-300">
            <span id="selectedCount">0</span> records selected
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
