<x-table.table :headers="array_merge(['No', 'Student', 'Gender'], $subjects->pluck('name')->toArray(), [
    'Total points',
    'Average',
    'Rank',
    'Grade',
    'GPA',
])" :checkbox="false" :action="false">
    @if (count($students) > 0)
        @foreach ($students as $student)
            <x-table.tr
                class="text-nowrap border-b border-gray-200 dark:border-gray-700 hover:bg-indigo-50 dark:hover:bg-gray-700">

                <x-table.td class="font-medium">{{ $loop->iteration }}</x-table.td>
                <x-table.td class="font-medium">{{ $student->name }}</x-table.td>
                <x-table.td class="font-medium">{{ $student->gender }}</x-table.td>

                @foreach ($subjects as $subject)
                    <td class="px-2 py-1">
                        <input type="hidden" name="scores[{{ $student->id }}][{{ $subject->id }}][student_id]"
                            value="{{ $student->id }}">
                        <input type="hidden" name="scores[{{ $student->id }}][{{ $subject->id }}][subject_id]"
                            value="{{ $subject->id }}">

                        <input type="number" name="scores[{{ $student->id }}][{{ $subject->id }}][score]"
                            min="0" max="100"
                            class="score-input w-full min-w-25 px-2 py-0.5 border rounded-md 
                                      focus:outline focus:outline-white focus:ring-2 focus:ring-indigo-500 
                                      focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 
                                      dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 
                                      border-slate-300"
                            placeholder="{{ $subject->exams->first()?->passing_marks ?? 0 }}-{{ $subject->exams->first()?->total_marks ?? 0 }} PT"
                            data-student-id="{{ $student->id }}" data-subject-id="{{ $subject->id }}"
                            data-passing-marks="{{ $subject->exams->first()?->passing_marks ?? 0 }}"
                            data-total-marks="{{ $subject->exams->first()?->total_marks ?? 0 }}">
                    </td>
                @endforeach
                <td class="p-2 total" data-student-id="{{ $student->id }}">0</td>
                <td class="p-2 average" data-student-id="{{ $student->id }}">0.00</td>
                <td class="p-2 rank" data-student-id="{{ $student->id }}">1</td>
                <td class="p-2 grade" data-student-id="{{ $student->id }}">0.00</td>
                <td class="p-2 pga" data-student-id="{{ $student->id }}">0.00</td>
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


@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Core Configuration
            const studentData = {};
            // Initialize student data
            $('[data-student-id]').each(function() {
                const studentId = $(this).data('student-id');
                if (!studentData[studentId]) {
                    studentData[studentId] = {
                        total: 0,
                        average: 0,
                        subjectCount: 0,
                        scores: {}
                    };
                }
            });
            // Prevent invalid keys
            $('.score-input').on('keydown', function(e) {
                if (["e", "E", "+", "-"].includes(e.key)) {
                    e.preventDefault();
                    ShowTaskMessage('error', 'Symbols (+, -, e) are not allowed.');
                }
            });
            $('.score-input').on('input', function() {
                const $input = $(this);
                const studentId = $input.data('student-id');
                const subjectId = $input.data('subject-id');
                // const score = parseFloat($input.val()) || 0;
                let value = $input.val().trim();

                // Allow only digits
                if (!/^\d*$/.test(value)) {
                    ShowTaskMessage('error', 'Only numbers (0-100) are allowed.');
                    $input.val('');
                    return;
                }

                let score = parseFloat(value);
                if (isNaN(score)) score = 0;
                // Range validation
                if (score < 0) {
                    ShowTaskMessage('error', 'Score cannot be less than 0.');
                    $input.val(0);
                    score = 0;
                } else if (score > 100) {
                    ShowTaskMessage('error', 'Score cannot be greater than 100.');
                    $input.val(100);
                    score = 100;
                }
                // Update student data
                studentData[studentId].scores[subjectId] = score;

                studentData[studentId].total = Object.values(studentData[studentId].scores)
                    .reduce((sum, val) => sum + (val || 0), 0);

                studentData[studentId].subjectCount = Object.keys(studentData[studentId].scores).length;
                // studentData[studentId].subjectCount = Object.keys(studentData[studentId].scores)
                //     .filter(k => studentData[studentId].scores[k] > 0).length;

                studentData[studentId].average = studentData[studentId].subjectCount > 0 ?
                    (studentData[studentId].total / studentData[studentId].subjectCount).toFixed(2) :
                    0;
                studentData[studentId].average = (studentData[studentId].total / Math.max(studentData[
                    studentId].subjectCount, 1)).toFixed(2);
                const grade = calculateGrade(studentData[studentId].average);
                const gpa = calculateGPA(grade);

                // Update UI
                $(`.total[data-student-id="${studentId}"]`).text(studentData[studentId].total);
                $(`.average[data-student-id="${studentId}"]`).text(studentData[studentId].average);
                $(`.grade[data-student-id="${studentId}"]`).text(grade);
                $(`.pga[data-student-id="${studentId}"]`).text(gpa.toFixed(2)); // Update GPA column

                // Update ranks
                updateRanks();
            });

            // Calculate grade based on average
            function calculateGrade(average) {
                average = parseFloat(average);
                if (average >= 90) return 'A';
                if (average >= 80) return 'B';
                if (average >= 70) return 'C';
                if (average >= 60) return 'D';
                return 'F';
            }
            // Calculate GPA based on grade
            function calculateGPA(grade) {
                switch (grade) {
                    case 'A':
                        return 4.0;
                    case 'B':
                        return 3.0;
                    case 'C':
                        return 2.0;
                    case 'D':
                        return 1.0;
                    default:
                        return 0.0; // F or others
                }
            }
            // Update ranks based on averages
            function updateRanks() {
                const students = Object.keys(studentData).map(id => ({
                    id,
                    average: parseFloat(studentData[id].average) || 0
                }));

                students.sort((a, b) => b.average - a.average);

                let currentRank = 1;
                students.forEach((student, index) => {
                    if (index > 0 && student.average < students[index - 1].average) {
                        currentRank = index + 1;
                    }
                    $(`.rank[data-student-id="${student.id}"]`).text(currentRank);
                });
            }

        });
    </script>
@endpush
