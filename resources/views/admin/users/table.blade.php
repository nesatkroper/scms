<x-table.table :headers="['User', 'Role', 'Email', 'Phone', 'Joining Date', 'Gender']" :checkbox="false">
    @if (count($users) > 0)
        @foreach ($users as $user)
            <x-table.tr>
                <x-table.td class="whitespace-nowrap text-gray-900 dark:text-white">
                    <div class="flex items-center">
                        @if ($user->avatar)
                            <img class="size-10 rounded-full object-cover" src="{{ asset($user->avatar) }}"
                                alt="{{ $user->name }} image">
                        @else
                            <div
                                class="w-10 h-10 rounded-full flex items-center justify-center bg-indigo-600 text-white font-bold cursor-default select-none">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        @endif
                        <div class="pl-3">
                            <div class="text-base font-semibold">
                                {{ $user->name }}
                            </div>
                            <div class="font-normal text-gray-500 truncate w-[85%]">
                                {{ $user->email }}
                            </div>
                        </div>
                    </div>
                </x-table.td>
                <x-table.td>
                    @php
                        $role = strtolower($user->roles->first()?->name ?? 'N/A'); // lowercase for comparison
                        $bg = 'bg-gray-100 dark:bg-gray-700';
                        $text = 'text-gray-800 dark:text-gray-300';

                        if ($role === 'student') {
                            $bg = 'bg-blue-100 dark:bg-blue-900';
                            $text = 'text-blue-800 dark:text-blue-300';
                        } elseif ($role === 'admin') {
                            $bg = 'bg-red-100 dark:bg-red-900';
                            $text = 'text-red-800 dark:text-red-300';
                        } elseif ($role === 'teacher') {
                            $bg = 'bg-green-100 dark:bg-green-900';
                            $text = 'text-green-800 dark:text-green-300';
                        } else {
                            // anything else
                            $bg = 'bg-gray-100 dark:bg-gray-700';
                            $text = 'text-gray-800 dark:text-gray-300';
                        }
                    @endphp

                    <span class="px-2 capitalize py-1 text-xs font-medium rounded-full {{ $bg }} {{ $text }}">
                        {{ $role }}
                    </span>
                </x-table.td>
                <x-table.td>{{ $user->email }}</x-table.td>
                <x-table.td>{{ $user->phone ?? 'N/A' }}</x-table.td>
                {{-- <x-table.td>{{ $user->department?->name ?? 'N/A' }}</x-table.td> --}}
                <x-table.td>
                    {{ $user->admission_date ? \Carbon\Carbon::parse($user->admission_date)->format('M d, Y') : 'N/A' }}
                </x-table.td>
                <x-table.td>
                    <span
                        class="px-2 py-1 bg-gray-100 text-gray-800 text-xs font-medium rounded-full dark:bg-gray-700 dark:text-gray-300 capitalize">
                        {{ $user->gender ?? 'N/A' }}
                    </span>
                </x-table.td>
                <x-table.td class="text-right">
                    <div class="flex justify-center items-center gap-2">

                        <!-- Edit Button -->
                        <a href="{{ route('admin.users.edit', $user->id) }}" title="Edit Id({{ $user->id }})"
                            class="p-2 rounded-full bg-indigo-100 text-indigo-600 
              hover:bg-indigo-200 hover:text-indigo-700 
              dark:bg-indigo-900 dark:text-indigo-300 
              dark:hover:bg-indigo-800 dark:hover:text-white 
              transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path
                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                            </svg>
                        </a>

                        <!-- Delete Button -->
                        <button title="Delete Id({{ $user->id }})"
                            class="cursor-pointer p-2 rounded-full bg-red-100 text-red-600 
               hover:bg-red-200 hover:text-red-700 
               dark:bg-red-900 dark:text-red-300 
               dark:hover:bg-red-800 dark:hover:text-white 
               transition delete-btn"
                            data-id="{{ $user->id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>

                    </div>

                </x-table.td>
                {{-- <x-table.td class="px-2 py-2">
                    <x-fields.checkbox id="" name="selected_ids[]" class="row-checkbox"
                        value="{{ $user->id }}" />
                </x-table.td> --}}
            </x-table.tr>
        @endforeach
    @else
        <tr>
            <td colspan="9" class="p-4 text-center">
                <x-not-found-data title="users" />
            </td>
        </tr>
    @endif
</x-table.table>
{{-- <x-bulkactions /> --}}
