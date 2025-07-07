<table class="w-full text-sm text-left">
    <thead class="bg-gray-50 dark:bg-gray-700/50 text-xs text-gray-700 dark:text-gray-400 uppercase">
        <tr>
            <th class="px-4 py-4">Name</th>
            <th class="px-4 py-4">Gender</th>
            <th class="px-4 py-4">Section</th>
            <th class="px-4 py-4">Admission Date</th>
            <th class="px-4 py-4">Actions</th>
            <th class="px-2 py-4 w-20 flex gap-1.5 items-center">
                <input type="checkbox" id="selectAllCheckbox" class="appearance-none size-4 border-2 border-gray-300 dark:border-gray-600 rounded-sm cursor-pointer checked:bg-indigo-500 checked:border-indigo-500 dark:checked:bg-indigo-600 dark:checked:border-indigo-600">
                <span>All</span>
            </th>
        </tr>
    </thead>
    <tbody>
        @if ($students->count())
            @foreach ($students as $student)
                <tr class="text-nowrap border-b border-gray-200 dark:border-gray-700 hover:bg-indigo-50 dark:hover:bg-gray-700">
                    <td class="px-4 py-2">{{ $student->user->name ?? 'N/A' }}</td>
                    <td class="px-4 py-2">{{ $student->gender ?? 'N/A' }}</td>
                    <td class="px-4 py-2">{{ $student->section->name ?? 'N/A' }}</td>
                    <td class="px-4 py-2">{{ $student->admission_date ? \Carbon\Carbon::parse($student->admission_date)->format('Y-m-d') : 'N/A' }}</td>


                    <td class="px-4 py-2 text-right">
                        <div class="relative">
                            <button class="btn-toggle-dropdown font-medium btn-action text-indigo-600 dark:text-indigo-500 p-1 size-8 flex items-center justify-center border border-indigo-100 dark:border-gray-600 dark:hover:bg-gray-700 hover:bg-indigo-200 rounded-full cursor-pointer transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-8" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zm0 5.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zm0 5.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3z" />
                                </svg>
                            </button>

                            <div class="dropdown-menu hidden w-auto absolute right-0 z-10 mt-2 origin-top-right divide-y divide-gray-100 dark:divide-gray-700 rounded-md bg-white dark:bg-gray-800 shadow-lg ring-1 ring-black/5 dark:ring-gray-700 focus:outline-none" role="menu">
                                <div class="py-1" role="none">
                                    <a href="#" class="edit-btn text-gray-700 dark:text-gray-300 px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors flex items-center gap-2" data-id="{{ $student->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                        </svg>
                                        Edit
                                    </a>

                                    <a href="#" class="detail-btn text-gray-700 dark:text-gray-300 px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors flex items-center gap-2" data-id="{{ $student->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z" clip-rule="evenodd" />
                                        </svg>
                                        Details
                                    </a>

                                    <form action="{{ route('students.destroy', $student) }}" method="POST" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete-btn text-red-600 dark:text-red-400 w-full text-left px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>

                    <td class="px-2 py-2">
                        <input type="checkbox" name="selected_ids[]" value="{{ $student->id }}"
                            class="row-checkbox appearance-none size-4 border-2 border-gray-300 dark:border-gray-600 rounded-sm cursor-pointer checked:bg-indigo-500 checked:border-indigo-500 dark:checked:bg-indigo-600 dark:checked:border-indigo-600">
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="6" class="p-4 text-center text-red-500 dark:text-gray-400">
                    No students found.
                </td>
            </tr>
        @endif
    </tbody>
</table>

<!-- Bulk Actions Bar -->
<div id="bulkActionsBar"
    class="hidden fixed bottom-4 right-[-60px] transform -translate-x-1/2 bg-white dark:bg-gray-800 shadow-lg rounded-lg p-3 border border-gray-200 dark:border-gray-700">
    <div class="flex flex-col items-start gap-1">
        <div class="text-sm text-gray-700 dark:text-gray-300">
            <span id="selectedCount">0</span> records selected
        </div>
        <button id="deselectAll"
            class="px-2 p-1 w-full rounded-md cursor-pointer text-start text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 hover:bg-indigo-50 dark:hover:bg-gray-700 text-sm transition">
            Deselect all
        </button>
        <button id="bulkEditBtn"
            class="px-2 p-1 w-full rounded-md cursor-pointer text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-gray-700 text-sm flex items-center gap-1 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
            </svg>
            Edit
        </button>
        <button id="bulkDeleteBtn"
            class="px-2 p-1 w-full rounded-md cursor-pointer text-red-600 dark:text-red-500 hover:text-red-700 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-gray-700 text-sm flex items-center gap-1 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
            Delete
        </button>
    </div>
</div>
