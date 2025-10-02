{{-- <!-- Edit Modal -->
<x-modal.modal id="Modaledit" title="Edit User Profile" svgClass="rounded-md" fill="none" stroke="currentColor"
    viewBox="0 0 24 24" class="rounded-xl w-full max-w-2xl"
    svgPath="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
    <!-- Form Content -->
    <form action="{{ route('admin.scores.update') }}" method="POST" class="p-4">
        @csrf
        @method('PUT')

        <div class="mb-4 grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label for="exam_id"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Exam</label>
                <select id="exam_id" name="exam_id" required
                    class="w-full px-3 py-1 border rounded-md focus:outline focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value="">Select Exam</option>
                    @foreach ($exams as $exam)
                        <option value="{{ $exam->id }}" {{ $selectedExam->id == $exam->id ? 'selected' : '' }}>
                            {{ $exam->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="semester"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Semester</label>
                <select id="semester" name="semester" required
                    class="w-full px-3 py-1 border rounded-md focus:outline focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value="1" {{ $semester == 1 ? 'selected' : '' }}>Semester 1</option>
                    <option value="2" {{ $semester == 2 ? 'selected' : '' }}>Semester 2</option>
                </select>
            </div>
        </div>

        <div class="h-[65vh] md:h-auto overflow-y-auto">
            <table class="w-full text-sm text-left">
                <thead
                    class="bg-gray-50 dark:bg-gray-700/50 text-xs text-gray-700 dark:text-gray-400 uppercase sticky top-0">
                    <tr class="text-nowrap">
                        <th scope="col" class="px-2 py-3">Student</th>
                        @foreach ($subjects as $subject)
                            <th scope="col" class="px-2 py-3">{{ $subject->name }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr class="text-nowrap border-b border-gray-200 dark:border-gray-700">
                            <td class="px-2 py-1 font-medium">{{ $student->name }}</td>
                            @foreach ($subjects as $subject)
                                @php
                                    $score = $scores
                                        ->where('student_id', $student->id)
                                        ->where('subject_id', $subject->id)
                                        ->first();
                                @endphp
                                <td class="px-2 py-1 text-center">
                                    <input type="number" min="0" max="100"
                                        name="scores[{{ $student->id }}][{{ $subject->id }}][score]"
                                        value="{{ $score->score ?? '' }}"
                                        class="score-input w-16 text-center border rounded px-1 py-1">
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- Form Actions -->
        <x-modal.footer-actions :edit="true" />
    </form>
</x-modal.modal> --}}



<!-- Edit Modal -->
<div id="ModalEdit" class="fixed inset-0 z-50 flex items-center justify-center hidden">
    <div
        class="relative bg-white dark:bg-gray-800 shadow-2xl w-full max-w-full h-full max-h-full transform transition-all duration-300 opacity-0 scale-95 border border-white dark:border-gray-600">

        <!-- Header -->
        <div class="flex justify-between items-center px-4 py-2 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="size-8 rounded-full p-1 bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"
                    viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                        clip-rule="evenodd" />
                </svg>
                Edit Scores
            </h3>
            <button id="closeEditModal"
                class="text-red-400 hover:bg-red-50 dark:hover:bg-gray-700 cursor-pointer rounded-full p-1 hover:text-red-500">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Form Content -->
        <form id="EditForm" action="" method="POST" class="p-4">
            @csrf
            <input type="hidden" id="exam_id_edit" name="exam_id">
            <div class="mb-4 grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label for="semester_edit"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Semester</label>
                    <select id="semester_edit" name="semester" required
                        class="w-full px-3 py-1 border rounded-md focus:outline focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300">
                        <option value="1">Semester 1</option>
                        <option value="2">Semester 2</option>
                    </select>
                </div>
            </div>

            <div class="h-[65vh] md:h-auto overflow-y-auto">
                <div class="mb-2" id="editScoreTableContainer">
                    <!-- Table will be dynamically populated by AJAX -->
                    <div class="text-center py-4 text-gray-500">Loading scores...</div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                <button type="button" id="cancelEditModal"
                    class="px-4 py-2 cursor-pointer border border-red-500 hover:border-red-600 text-red-600 rounded-md flex items-center gap-2">
                    Cancel
                </button>
                <button type="submit"
                    class="px-4 py-2 cursor-pointer bg-indigo-600 text-white rounded-md hover:bg-indigo-700 flex items-center gap-2">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            let editStudentData = {};

            function calculateGrade(average) {
                average = parseFloat(average);
                if (average >= 90) return 'A';
                if (average >= 80) return 'B';
                if (average >= 70) return 'C';
                if (average >= 60) return 'D';
                return 'F';
            }

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
                        return 0.0;
                }
            }

            function updateRanks() {
                const students = Object.keys(editStudentData).map(id => ({
                    id,
                    average: parseFloat(editStudentData[id].average) || 0
                }));

                students.sort((a, b) => b.average - a.average);

                let currentRank = 1;
                students.forEach((student, index) => {
                    if (index > 0 && student.average < students[index - 1].average) {
                        currentRank = index + 1;
                    }
                    $(`#ModalEdit .rank[data-student-id="${student.id}"]`).text(currentRank);
                });
            }

            // Delegate input event because table is loaded via AJAX
            $(document).on('input', '#ModalEdit .score-input', function() {
                const $input = $(this);
                const studentId = $input.data('student-id');
                const subjectId = $input.data('subject-id');

                if (!editStudentData[studentId]) {
                    editStudentData[studentId] = {
                        total: 0,
                        average: 0,
                        subjectCount: 0,
                        scores: {}
                    };
                }

                let value = $input.val().trim();

                if (!/^\d*$/.test(value)) {
                    alert('Only numbers (0-100) are allowed.');
                    $input.val('');
                    return;
                }

                let score = parseFloat(value) || 0;
                score = Math.max(0, Math.min(score, 100));
                $input.val(score);

                editStudentData[studentId].scores[subjectId] = score;

                editStudentData[studentId].total = Object.values(editStudentData[studentId].scores)
                    .reduce((sum, val) => sum + val, 0);
                editStudentData[studentId].subjectCount = Object.keys(editStudentData[studentId].scores)
                    .length;
                editStudentData[studentId].average = (editStudentData[studentId].total / Math.max(
                    editStudentData[studentId].subjectCount, 1)).toFixed(2);

                const grade = calculateGrade(editStudentData[studentId].average);
                const gpa = calculateGPA(grade);

                $(`#ModalEdit .total[data-student-id="${studentId}"]`).text(editStudentData[studentId]
                    .total);
                $(`#ModalEdit .average[data-student-id="${studentId}"]`).text(editStudentData[studentId]
                    .average);
                $(`#ModalEdit .grade[data-student-id="${studentId}"]`).text(grade);
                $(`#ModalEdit .pga[data-student-id="${studentId}"]`).text(gpa.toFixed(2));

                updateRanks();
            });

            // Reset data when modal is closed
            $('#cancelEditModal, #closeEditModal').click(function() {
                $('#ModalEdit').addClass('hidden').removeClass('flex');
                editStudentData = {};
            });
        });
    </script>
@endpush
