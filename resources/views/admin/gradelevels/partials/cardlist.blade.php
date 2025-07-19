@if (count($gradelevels) > 0)
    @foreach ($gradelevels as $gradelevel)
        <div
            class="bg-white dark:bg-slate-800 rounded-lg shadow-md border border-gray-200 dark:border-gray-700 overflow-hidden transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
            <!-- Card Header -->
            <div class="p-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-slate-700">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="font-bold text-lg text-gray-800 dark:text-gray-100 truncate">
                            {{ $gradelevel->name }}</h3>
                        <span
                            class="inline-block px-2 py-1 text-xs font-semibold rounded-full bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200">
                            {{ $gradelevel->code }}
                        </span>
                    </div>
                    <div class="flex items-center space-x-1">
                        <button
                            class="btn detail-btn p-2 flex items-center justify-center rounded-full size-8 cursor-pointer text-indigo-500 hover:bg-indigo-100 dark:hover:bg-gray-900 transition-colors"
                            data-id="{{ $gradelevel->id }}">
                            <span class="btn-content">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linecap="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linecap="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Card Body -->
            <div class="p-4">
                <div class="space-y-3">
                    <!-- Department Info -->
                    <div class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 mt-0.5 text-gray-500 dark:text-gray-400 flex-shrink-0" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        <div class="ml-2">
                            <p class="text-xs text-gray-500 dark:text-gray-400">Department</p>
                            <p class="text-sm font-medium text-gray-700 dark:text-gray-200">
                                {{ $gradelevel->department?->name ?? 'Not assigned' }}
                            </p>
                        </div>
                    </div>

                    <!-- Credit Hours -->
                    <div class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 mt-0.5 text-gray-500 dark:text-gray-400 flex-shrink-0" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div class="ml-2">
                            <p class="text-xs text-gray-500 dark:text-gray-400">Credit Hours</p>
                            <p class="text-sm font-medium text-gray-700 dark:text-gray-200">
                                {{ $gradelevel->credit_hours ?? '0' }}
                            </p>
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Description</p>
                        <p class="text-sm text-gray-600 dark:text-gray-300 line-clamp-3">
                            {{ $gradelevel->description ?? 'No description available' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Card Footer - Action Buttons -->
            <div
                class="px-4 py-3 bg-gray-50 dark:bg-slate-700 border-t border-gray-200 dark:border-gray-600 flex justify-end space-x-2">
                <button
                    class="btn edit-btn cursor-pointer px-3 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-md transition-colors"
                    data-id="{{ $gradelevel->id }}">
                    <span class="btn-content flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit
                    </span>
                </button>
                <button
                    class="delete-btn cursor-pointer px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-md transition-colors flex items-center"
                    data-id="{{ $gradelevel->id }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    Delete
                </button>
            </div>
        </div>
    @endforeach
@else
    <div class="col-span-full py-12 text-center">
        <div
            class="max-w-md mx-auto p-6 bg-white dark:bg-slate-800 rounded-lg shadow border border-gray-200 dark:border-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-red-400 dark:text-red-500"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h3 class="mt-4 text-lg font-medium text-red-500 dark:text-red-500">No data Found</h3>
            <p class="mt-2 text-sm text-red-500 dark:text-red-500">Create your first data to get started</p>
        </div>
    </div>
@endif
