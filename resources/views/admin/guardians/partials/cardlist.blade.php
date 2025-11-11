@if (count($guardians) > 0)
    @foreach ($guardians as $guardian)
        <div
            class="bg-white dark:bg-slate-800 rounded-lg shadow border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-lg">
            <!-- Profile Image -->
            <div class="h-48 flex justify-center items-center">
                @if ($guardian->avatar)
                    <a title="{{ $guardian->name }}" class="detail-btn cursor-grab" data-id="{{ $guardian->id }}">
                        <img src="{{ asset($guardian->avatar) }}" alt="{{ $guardian->name }}"
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
                        <span
                            class="inline-block capitalize mt-1 px-3 py-1 text-xs rounded-full bg-indigo-100
                 text-indigo-800 dark:bg-indigo-900/50 dark:text-indigo-200">
                            {{ $guardian->gender }}
                        </span>
                    </div>
                </div>

                <div class="space-y-2 text-sm mt-3">
                    <x-info.item position="left" label="Email" icon="ri-mail-line"
                        name="{{ $guardian->email ?? 'Not provided' }}" />
                    <x-info.item position="left" label="Phone" icon="ri-phone-line"
                        name="{{ $guardian->phone ?? 'Not provided' }}" />
                    <x-info.item position="left" label="Occupation" icon="ri-briefcase-4-fill"
                        name="${{ $guardian->occupation }}" />
                    <x-info.item position="left" label="Company" icon="ri-community-line"
                        name="${{ $guardian->company }}" />
                </div>
                <div class="flex pt-3 justify-between">
                    <button
                        class="btn detail-btn p-2 flex items-center justify-center rounded-full size-8 cursor-pointer text-indigo-500 hover:bg-indigo-100 dark:hover:bg-gray-900 transition-colors"
                        data-id="{{ $guardian->id }}">
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
                    <div class="flex gap-2">
                        <button
                            class="btn edit-btn p-2 flex items-center justify-center rounded-full size-8 cursor-pointer text-green-500 hover:bg-gray-100 dark:hover:bg-gray-900 transition-colors"
                            data-id="{{ $guardian->id }}">
                            <span class="btn-content">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
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
        </div>
    @endforeach
@else
    <x-not-found-data title="guardians" />
@endif
