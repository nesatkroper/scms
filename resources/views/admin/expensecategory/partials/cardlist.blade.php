@if (count($categories) > 0)
    @foreach ($categories as $categorie)
        <div
            class="bg-white dark:bg-slate-800 rounded-lg shadow-md border border-gray-200 dark:border-gray-700 overflow-hidden transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
            <!-- Card Header -->
            <div class="p-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-slate-700">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="font-bold text-lg text-gray-800 dark:text-gray-100 truncate">
                            {{ Str::limit($categorie->name, 20??'No description available' ) }}</h3>
                    </div>
                    <div class="flex items-center space-x-1">
                        <button
                            class="btn detail-btn p-2 flex items-center justify-center rounded-full size-8 cursor-pointer text-indigo-500 hover:bg-indigo-100 dark:hover:bg-gray-900 transition-colors"
                            data-id="{{ $categorie->id }}">
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
            </div>

            <!-- Card Body -->
            <div class="p-4">
                <div class="space-y-3">
                    <div class="flex items-center gap-3 text-sm">
                        <div class="p-2 rounded-lg bg-indigo-50 dark:bg-slate-700 text-indigo-600 dark:text-indigo-300">

                            📚
                        </div>
                        <div>
                            <p class="font-medium text-gray-700 dark:text-gray-200">
                                {{ $categorie->books?->count() ?? 0 }} books
                            </p>
                        </div>
                    </div>
                    <!-- Description -->
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Description</p>
                        <p class="text-sm text-gray-600 dark:text-gray-300 line-clamp-3">
                            {{ $categorie->description ?? 'No description available' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Card Footer - Action Buttons -->
            <div
                class="px-4 py-3 bg-gray-50 dark:bg-slate-700 border-t border-gray-200 dark:border-gray-600 flex justify-end space-x-2">
                <button
                    class="btn edit-btn cursor-pointer px-3 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-md transition-colors"
                    data-id="{{ $categorie->id }}">
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
                    data-id="{{ $categorie->id }}">
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
   <x-not-found-data title="category" />
@endif
