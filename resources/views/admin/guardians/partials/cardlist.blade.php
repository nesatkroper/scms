@if (count($guardians) > 0)
    @foreach ($guardians as $guardian)
        <div
            class="bg-white dark:bg-slate-800 rounded-lg shadow border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-lg">
            <!-- Profile Image -->
            <div class="h-48 flex justify-center items-center">
                @if ($guardian->photo)
                    <a title="{{ $guardian->name }}" class="detail-btn cursor-grab" data-id="{{ $guardian->id }}">
                        <img src="{{ asset($guardian->photo) }}" alt="{{ $guardian->name }}"
                            class="w-[160px] h-[160px] m-auto object-cover rounded-full border-4 border-slate-100 dark:border-slate-600">
                    </a>
                @else
                    <div
                        class="w-[160px] h-[160px] rounded-full border-4 border-slate-100 dark:border-slate-600 bg-gray-100 dark:bg-gray-700 flex items-center justify-center">
                        <button class="detail-btn cursor-grab" data-id="{{ $guardian->id }}">
                            <span class="btn-content">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-16 w-16 text-gray-400 dark:text-gray-500" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </span>
                        </button>
                    </div>
                @endif
            </div>

            <div class="p-4">
                <div class="flex justify-between items-start">
                    <div>
                        <h4 class="font-bold text-lg text-gray-800 dark:text-gray-200">
                            {{ $guardian->name }}
                        </h4>
                        <span class="text-sm text-indigo-600 dark:text-indigo-400">{{ $guardian->relation }}</span>
                    </div>
                    <div class="flex items-center gap-1">
                        <button
                            class="btn detail-btn p-2 flex items-center justify-center rounded-full size-8 cursor-pointer text-indigo-500 hover:bg-indigo-100 dark:hover:bg-gray-900 transition-colors"
                            data-id="{{ $guardian->id }}">
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

                <div class="mt-3 text-sm text-gray-600 dark:text-gray-400">
                    <div class="flex items-center gap-2 mb-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <span>{{ $guardian->phone ?: 'Not specified' }}</span>
                    </div>
                    <div class="flex items-center gap-2 mb-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span>{{ $guardian->email ?: 'Not specified' }}</span>
                    </div>
                    <div class="flex items-center gap-2 mb-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span>{{ $guardian->occupation ?: 'Not specified' }}</span>
                    </div>
                    <div class="flex items-center gap-2 mb-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        <span>{{ $guardian->company ?: 'Not specified' }}</span>
                    </div>
                </div>

                <div class="flex justify-end gap-2 mt-4">
                    <button
                        class="btn edit-btn p-2 flex items-center justify-center rounded-full size-8 cursor-pointer text-green-500 hover:bg-gray-100 dark:hover:bg-gray-900 transition-colors"
                        data-id="{{ $guardian->id }}">
                        <span class="btn-content">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linecap="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </span>
                    </button>
                    <button
                        class="delete-btn p-2 flex items-center justify-center rounded-full size-8 cursor-pointer text-red-500 hover:bg-red-100 dark:hover:bg-gray-900 transition-colors"
                        data-id="{{ $guardian->id }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linecap="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    @endforeach
@else
    <x-not-found-data title="guardians" />
@endif
