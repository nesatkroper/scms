@if (count($subjects) > 0)
    @foreach ($subjects as $subject)
        <div
            class="bg-white dark:bg-slate-800 rounded-lg shadow border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-lg">
            <!-- Header -->
            <div class="px-4 py-2 bg-slate-50 dark:bg-slate-700 border-b border-gray-100 dark:border-slate-700">
                <div class="flex justify-between items-start gap-2">
                    <div>
                        <h4 class="font-bold text-lg text-gray-800 dark:text-gray-200">{{ $subject->name }}</h4>
                    </div>
                    <button
                        class="btn detail-btn p-2 flex items-center justify-center rounded-full size-8 cursor-pointer text-indigo-500 hover:bg-indigo-100 dark:hover:bg-gray-900 transition-colors"
                        data-id="{{ $subject->id }}">
                        <span class="btn-content">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linecap="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linecap="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </span>
                    </button>
                </div>
            </div>

            <!-- Details -->
            <div class="p-4 space-y-3">
                <!-- G -->
                <div class="flex items-center gap-3 text-sm">
                    <div class="p-2 rounded-lg bg-blue-50 dark:bg-slate-700 text-blue-600 dark:text-blue-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M17 20h5v-2a3 3 0 00-3-3h-2a3 3 0 00-3 3v2h5zM7 20H2v-2a3 3 0 013-3h2a3 3 0 013 3v2H7zM10 10a3 3 0 100-6 3 3 0 000 6z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400">code</p>
                        <p class="font-medium text-gray-700 dark:text-gray-200">

                            <span class="text-sm text-indigo-600 dark:text-indigo-400">{{ $subject->code }}</span>
                        </p>
                    </div>
                </div>
                <div class="flex items-center gap-3 text-sm">
                    <div class="p-2 rounded-lg bg-purple-50 dark:bg-slate-700 text-purple-600 dark:text-purple-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linecap="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Department</p>
                        <p class="text-sm text-indigo-600 dark:text-indigo-400">
                            <span>{{ $subject->department?->name ?? 'No Department' }}</span>
                        </p>
                    </div>
                </div>
                <div class="flex items-center gap-3 text-sm">
                    <div class="p-2 rounded-lg bg-purple-50 dark:bg-slate-700 text-purple-600 dark:text-purple-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linecap="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Credit Hours</p>
                        <p class="font-medium text-gray-700 dark:text-gray-200">
                            <span>{{ $subject->credit_hours }}</span>
                        </p>
                    </div>
                </div>

            </div>

            <!-- Footer with actions -->
            <div
                class="px-4 py-2 bg-gray-50 dark:bg-slate-700/50 border-t border-gray-100 dark:border-slate-700 flex justify-end gap-2">
                <button
                    class="btn edit-btn p-2 rounded-full flex justify-center items-center size-9 cursor-pointer text-green-600 dark:text-green-400 hover:bg-green-50 dark:hover:bg-slate-600 transition-colors"
                    data-id="{{ $subject->id }}" title="Edit">
                    <span class="btn-content flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </span>
                </button>
                <button
                    class="delete-btn p-2 rounded-full flex justify-center items-center size-9 cursor-pointer text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-slate-600 transition-colors"
                    data-id="{{ $subject->id }}" title="Delete">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </button>
            </div>
        </div>
    @endforeach
@else
    <div class="col-span-full py-12 text-center">
        <div
            class="max-w-md mx-auto p-6 bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700">
            <div class="mx-auto h-16 w-16 rounded-full bg-red-50 dark:bg-slate-700 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-400 dark:text-red-500" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h3 class="mt-4 text-lg font-medium text-red-500 dark:text-red-500">No Sections Found</h3>
            <p class="mt-1 text-sm text-red-500 dark:text-red-500">Create your first section to get started</p>
        </div>

    </div>
@endif
