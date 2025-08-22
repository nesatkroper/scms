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
            <x-table.tr>
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
                    <x-fields.checkbox id="" name="selected_ids[]" class="row-checkbox"
                        value="{{ $teacher->id }}" />
                </x-table.td>
            </x-table.tr>
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
