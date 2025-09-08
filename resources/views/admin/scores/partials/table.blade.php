<table class="w-full text-sm text-left">
    <thead class="bg-gray-50 dark:bg-gray-700/50 text-xs text-gray-700 dark:text-gray-400 uppercase sticky top-0">
        <tr class="text-nowrap">
            <th scope="col" class="px-2 py-3">Student</th>
            <th scope="col" class="px-2 py-3">Gender</th>
            @foreach ($subjects as $subject)
                <th scope="col" class="px-2 py-3">{{ $subject->name }}</th>
            @endforeach
            <th scope="col" class="px-2 py-3">Total points</th>
            <th scope="col" class="px-2 py-3">Average</th>
            <th scope="col" class="px-2 py-3">Rank</th>
            <th scope="col" class="px-2 py-3">Grade</th>
            <th scope="col" class="px-2 py-3">GPA</th>
            <th scope="col" class="px-2 py-3">Action</th>
        </tr>
    </thead>
    <tbody>
        @if (count($students) > 0)
            @foreach ($students as $student)
                <tr
                    class="text-nowrap border-b border-gray-200 dark:border-gray-700 hover:bg-indigo-50 dark:hover:bg-gray-700">
                    <td class="px-2 py-1 font-medium">{{ $student->name }}</td>
                    <td class="px-2 py-1 font-medium">{{ $student->gender }}</td>

                    @foreach ($subjects as $subject)
                        @php
                            $score = $scores
                                ->where('student_id', $student->id)
                                ->where('subject_id', $subject->id)
                                ->first();
                        @endphp
                        <td class="px-2 py-1 text-center">
                            {{ $score->score ?? '-' }}
                        </td>
                    @endforeach

                    <td class="px-4 py-2">{{ $student->total_points ?? 0 }}</td>
                    <td class="px-4 py-2">{{ $student->average ?? 0 }}</td>
                    <td class="px-4 py-2">{{ $student->rank ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $student->grade ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $student->gpa ?? '-' }}</td>
                    <td class="px-4 py-2">
                        <button
                            class="btn edit-btn p-2 rounded-full flex justify-center items-center size-9 cursor-pointer text-green-600 dark:text-green-400 hover:bg-green-50 dark:hover:bg-slate-600 transition-colors"
                            data-id="{{ $student->id }}" title="Edit">
                            <span class="btn-content flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </span>
                        </button>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="12" class="p-4 text-center">
                    <x-not-found-data title="student score" />
                </td>
            </tr>
        @endif
    </tbody>
</table>
