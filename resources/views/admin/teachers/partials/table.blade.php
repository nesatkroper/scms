<x-table.table :headers="[
    'Teacher',
    'Gender',
    'Experience',
    'Department',
    'Salary',
    'Qualification',
    'Specialization',
    'Joining Date',
]" :checkbox="true">
    @if (count($teachers) > 0)
        @foreach ($teachers as $teacher)
            <tr
                class="text-nowrap border-b border-gray-200 dark:border-gray-700 hover:bg-indigo-50 dark:hover:bg-gray-700">
                <x-table.td class="whitespace-nowrap text-gray-900 dark:text-white">
                    <div class="flex items-center">
                        <img class="detail-btn size-10 rounded-full object-cover cursor-pointer"
                            src="{{ $teacher->photo ? asset($teacher->photo) : 'https://placehold.co/40x40/6366F1/FFFFFF?text=' . substr($teacher->user->name, 0, 1) }}"
                            alt="{{ $teacher->name }} image" data-id="{{ $teacher->id }}">

                        <div class="pl-3">
                            <div class="text-base font-semibold">
                                {{ $teacher->name }}
                            </div>
                            <div class="font-normal text-gray-500 truncate w-[85%]">
                                {{ $teacher->email }}
                            </div>
                        </div>
                    </div>
                </x-table.td>
                <x-table.td>{{ $teacher->gender ?? 'N/A' }}</x-table.td>
                <x-table.td>{{ Str::limit($teacher->experience ?? 'N/A', 20) }} Years</x-table.td>
                <x-table.td>{{ Str::limit($teacher->department->name ?? 'N/A', 20) }}</x-table.td>
                <x-table.td>${{ $teacher->salary }}</x-table.td>
                <x-table.td>{{ Str::limit($teacher->qualification, 20) }}</x-table.td>
                <x-table.td>{{ Str::limit($teacher->specialization, 20) }}</x-table.td>
                <x-table.td>
                    {{ \Carbon\Carbon::parse($teacher->joining_date)->format('Y-m-d') }}
                </x-table.td>
                <x-table.td class="text-right">
                    <x-table.action :id="$teacher->id" />
                </x-table.td>
                <x-table.td class="px-2 py-2">
                    <input type="checkbox" name="selected_ids[]" value="{{ $teacher->id }}"
                        class="row-checkbox appearance-none size-4 
                            border-2 border-gray-300 dark:border-gray-600 rounded-sm cursor-pointer transition-all duration-200 ease-in-out relative
                            checked:bg-indigo-500 dark:checked:bg-indigo-600 checked:border-indigo-500 dark:checked:border-indigo-600
                            hover:border-indigo-400 dark:hover:border-indigo-500 focus:ring-2 focus:ring-indigo-200 dark:focus:ring-indigo-700
                            focus:ring-offset-2 focus:outline-none before:content-[''] before:absolute before:inset-0 before:bg-no-repeat before:bg-center
                            before:bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgc3Ryb2tlPSJ3aGl0ZSIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiPjxwb2x5bGluZSBwb2ludHM9IjIwIDYgOSAxNyA0IDEyIj48L3BvbHlsaW5lPjwvc3ZnPg==')]
                            before:opacity-0 before:transition-opacity before:duration-200 checked:before:opacity-100">
                </x-table.td>
            </tr>
        @endforeach
    @else
        <x-table.no-data :colspan="count([
            'Teacher',
            'Gender',
            'Experience',
            'Department',
            'Salary',
            'Qualification',
            'Specialization',
            'Joining Date',
        ]) + 1" />
    @endif
</x-table.table>
<x-bulkactions />
<x-table.pagination :paginator="$teachers" />
