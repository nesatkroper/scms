<table class="w-full text-sm text-left">
    <thead class="bg-gray-50 dark:bg-gray-700/50 text-xs text-gray-700 dark:text-gray-400 uppercase">
        <tr>
            <th scope="col" class="px-6 py-3">Name</th>
            <th scope="col" class="px-6 py-3">Description</th>
            <th scope="col" class="px-6 py-3">Date</th>
            <th scope="col" class="px-6 py-3">Actions</th>
        </tr>
    </thead>
    <tbody>
        @if (count($departments) > 0)
            @foreach ($departments as $department)
                <tr class="border-b border-gray-200 dark:border-gray-700">
                    <td class="px-4 py-4">{{ $department->name }}</td>
                    <td class="px-4 py-4">{{ Str::limit($department->description, 50) }}</td>
                    <td class="px-4 py-4">
                        {{ \Carbon\Carbon::parse($department->created_at)->format('Y-m-d') }}
                    </td>
                    <td class="px-4 py-4 text-right">
                        <div class="relative">
                            <button
                                class="font-medium btn-action text-indigo-600 dark:text-indigo-700 p-1 size-8 flex items-center justify-center 
                                border border-indigo-100  dark:border-gray-600 dark:hover:bg-gray-700 hover:bg-indigo-200 rounded-full cursor-pointer transition-colors"
                                data-id="{{ $department->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-8" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zm0 5.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zm0 5.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3z" />
                                </svg>
                            </button>

                            <!-- Dropdown Menu -->
                            <div id="dropdown-{{ $department->id }}"
                                class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white dark:bg-gray-800 shadow-lg hidden 
                                transition-all duration-200 transform opacity-0 scale-95 border border-gray-200 dark:border-gray-700">
                                <div class="py-1" role="none">
                                    <a href="#"
                                        class="text-gray-700 dark:text-gray-300 px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors flex items-center gap-2 edit-btn"
                                        data-id="{{ $department->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path
                                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                        </svg>
                                        Edit
                                    </a>
                                    <a href="#"
                                        class="text-gray-700 dark:text-gray-300 px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors flex items-center gap-2 detail-btn"
                                        data-id="{{ $department->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Details
                                    </a>
                                    <form action="{{ route('departments.destroy', $department->id) }}" method="POST"
                                        class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            class="text-red-600 dark:text-red-400 w-full text-left px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors flex items-center gap-2 delete-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="4" class="p-4 text-center text-red-500 dark:text-gray-400">
                    No departments found.
                </td>
            </tr>
        @endif
    </tbody>
</table>
