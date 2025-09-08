<table class="w-full text-sm text-left">
    <thead class="bg-gray-50 dark:bg-gray-700/50 text-xs text-gray-700 dark:text-gray-400 uppercase sticky top-0">
        <tr class="text-nowrap">
            <th scope="col" class="px-2 py-3">Student</th>
            <th scope="col" class="px-2 py-3">Gender</th>
            @foreach ($subjects as $subject)
                <th scope="col" class="px-2 py-3">{{ $subject->name }} </th>
            @endforeach
            <th scope="col" class="px-2 py-3">Total points</th>
            <th scope="col" class="px-2 py-3">Average</th>
            <th scope="col" class="px-2 py-3">Rank</th>
            <th scope="col" class="px-2 py-3">Grade</th>
            <th scope="col" class="px-2 py-3">GPA</th>
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
                        <td class="px-2 py-1">
                            <input type="hidden" name="scores[{{ $student->id }}][{{ $subject->id }}][student_id]"
                                value="{{ $student->id }}">
                            <input type="hidden" name="scores[{{ $student->id }}][{{ $subject->id }}][subject_id]"
                                value="{{ $subject->id }}">

                            <input type="number" name="scores[{{ $student->id }}][{{ $subject->id }}][score]"
                                min="0" max="100"
                                class="score-input w-full min-w-25 px-2 py-0.5 border rounded-md focus:outline focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300"
                                placeholder="{{ $subject->exams->first()?->passing_marks ?? 0 }}-{{ $subject->exams->first()?->total_marks ?? 0 }} PT"
                                data-student-id="{{ $student->id }}" data-subject-id="{{ $subject->id }}"
                                data-passing-marks="{{ $subject->exams->first()?->passing_marks ?? 0 }}"
                                data-total-marks="{{ $subject->exams->first()?->total_marks ?? 0 }}">
                        </td>
                    @endforeach
                    <td class="px-4 py-2 total" data-student-id="{{ $student->id }}">0</td>
                    <td class="px-4 py-2 average" data-student-id="{{ $student->id }}">0.00</td>
                    <td class="px-4 py-2 rank" data-student-id="{{ $student->id }}">1</td>
                    <td class="px-4 py-2 grade" data-student-id="{{ $student->id }}">0.00</td>
                    <td class="px-4 py-2 pga" data-student-id="{{ $student->id }}">0.00</td>
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

