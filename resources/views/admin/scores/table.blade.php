<table class="w-full text-sm text-left">
    <thead class="bg-gray-50 dark:bg-gray-700/50 text-xs text-gray-700 dark:text-gray-400 uppercase sticky top-0">
        <tr class="text-nowrap">
            <th scope="col" class="px-2 py-3">Student</th>
            @foreach ($subjects as $subject)
                <th scope="col" class="px-2 py-3">{{ $subject->name }} </th>
            @endforeach
            <th scope="col" class="px-2 py-3">Total points</th>
            <th scope="col" class="px-2 py-3">Average</th>
            <th scope="col" class="px-2 py-3">Rank</th>
            <th scope="col" class="px-2 py-3">Grade</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($students as $student)
            <tr
                class="text-nowrap border-b border-gray-200 dark:border-gray-700 hover:bg-indigo-50 dark:hover:bg-gray-700">
                <td class="px-2 py-1 font-medium">{{ $student->name }}</td>
                @foreach ($subjects as $subject)
                    <td class="px-2 py-1">
                        <input type="hidden" name="scores[{{ $student->id }}][{{ $subject->id }}][student_id]"
                            value="{{ $student->id }}">
                        <input type="hidden" name="scores[{{ $student->id }}][{{ $subject->id }}][subject_id]"
                            value="{{ $subject->id }}">

                        <input type="number" name="scores[{{ $student->id }}][{{ $subject->id }}][score]"
                            min="0" max="100"
                            class="score-input w-full min-w-25 px-2 py-0.5 border rounded-md focus:outline focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300"
                            placeholder="0-100 PT" data-student-id="{{ $student->id }}"
                            data-subject-id="{{ $subject->id }}">
                    </td>
                @endforeach
                <td class="px-4 py-2 total" data-student-id="{{ $student->id }}">0</td>
                <td class="px-4 py-2 average" data-student-id="{{ $student->id }}">0</td>
                <td class="px-4 py-2 rank" data-student-id="{{ $student->id }}"></td>
                <td class="px-4 py-2 grade" data-student-id="{{ $student->id }}"></td>
            </tr>
        @endforeach
    </tbody>
</table>
