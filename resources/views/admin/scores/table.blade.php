
<x-table.table :headers="array_merge(['No', 'Student', 'Gender'], $subjects->pluck('name')->toArray(), [
    'Total points',
    'Average',
    'Rank',
    'Grade',
    'GPA',
    
])" :checkbox="false">
    @if (count($students) > 0)
        @foreach ($students as $student)
            <x-table.tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-indigo-50 dark:hover:bg-gray-700">
                <x-table.td>{{ $student->id }}</x-table.td>
                <x-table.td>{{ $student->name }}</x-table.td>
                <x-table.td>{{ $student->gender }}</x-table.td>

                @foreach ($subjects as $subject)
                    @php
                        $score = $scores->where('student_id', $student->id)->where('subject_id', $subject->id)->first();
                    @endphp
                    <x-table.td>{{ $score->score ?? '-' }}</x-table.td>
                @endforeach

                <x-table.td>{{ $student->total_points ?? 0 }}</x-table.td>
                <x-table.td>{{ $student->average ?? 0 }}</x-table.td>
                <x-table.td>{{ $student->rank ?? '-' }}</x-table.td>
                <x-table.td>{{ $student->grade ?? '-' }}</x-table.td>
                <x-table.td>{{ $student->gpa ?? '-' }}</x-table.td>

                <x-table.td>
                    <button
                        class="btn edit-btn p-2 rounded-full flex justify-center items-center size-6 cursor-pointer text-green-600 dark:text-green-400 hover:bg-green-50 dark:hover:bg-slate-600 transition-colors"
                        data-id="{{ $student->id }}" title="Edit">
                        <span class="btn-content flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </span>
                    </button>
                </x-table.td>
            </x-table.tr>
        @endforeach
    @else
        <tr>
            <td colspan="{{ 3 + $subjects->count() + 6 }}" class="p-4 text-center">
                <x-not-found-data title="student score" />
            </td>
        </tr>
    @endif
</x-table.table>