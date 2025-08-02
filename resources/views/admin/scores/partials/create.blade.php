<!-- Create Modal -->
<div id="Modalcreate" class="fixed inset-0 z-50 flex items-center justify-center hidden">
    <div
        class="relative bg-white dark:bg-gray-800 shadow-2xl w-full max-w-full h-full transform transition-all duration-300 opacity-0 scale-95 border border-white dark:border-gray-600">
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
                Create New Scores
            </h3>
            <button id="closeCreateModal"
                class="text-red-400 hover:bg-red-50 dark:hover:bg-gray-700 cursor-pointer rounded-full p-1 hover:text-red-500">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Form Content -->
        <form action="{{ route('admin.scores.store') }}" method="POST" class="p-4">
            @csrf

            <div class="mb-4 grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label for="exam_id"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Exam</label>
                    <select id="exam_id" name="exam_id" required
                        class="w-full px-3 py-1 border rounded-md focus:outline focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300">
                        <option value="">Select Exam</option>
                        @foreach ($exams as $exam)
                            <option value="{{ $exam->id }}">{{ $exam->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="semester"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Semester</label>
                    <select id="semester" name="semester" required
                        class="w-full px-3 py-1 border rounded-md focus:outline focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300">
                        <option value="1" {{ $semester == 1 ? 'selected' : '' }}>Semester 1</option>
                        <option value="2" {{ $semester == 2 ? 'selected' : '' }}>Semester 2</option>
                    </select>
                </div>
            </div>

            <div class="h-[65vh] md:h-auto overflow-y-auto">
                <div class="mb-2">
                    <table class="w-full text-sm text-left">
                        <thead
                            class="bg-gray-50 dark:bg-gray-700/50 text-xs text-gray-700 dark:text-gray-400 uppercase sticky top-0">
                            <tr class="text-nowrap">
                                <th scope="col" class="px-4 py-2">Student</th>
                                @foreach ($subjects as $subject)
                                    <th scope="col" class="px-4 py-2">{{ $subject->name }} </th>
                                @endforeach
                                <th scope="col" class="px-4 py-2">Total points</th>
                                <th scope="col" class="px-4 py-2">Average</th>
                                <th scope="col" class="px-4 py-2">Rank</th>
                                <th scope="col" class="px-4 py-2">Grade</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr
                                    class="text-nowrap border-b border-gray-200 dark:border-gray-700 hover:bg-indigo-50 dark:hover:bg-gray-700">
                                    <td class="px-2 py-1 font-medium">{{ $student->name }} ({{ $student->gender }})</td>
                                    @foreach ($subjects as $subject)
                                        <td class="px-2 py-1">
                                            <input type="hidden"
                                                name="scores[{{ $student->id }}][{{ $subject->id }}][student_id]"
                                                value="{{ $student->id }}">
                                            <input type="hidden"
                                                name="scores[{{ $student->id }}][{{ $subject->id }}][subject_id]"
                                                value="{{ $subject->id }}">

                                            <input type="number"
                                                name="scores[{{ $student->id }}][{{ $subject->id }}][score]"
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
                </div>
            </div>
            <!-- Form Actions -->
            <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                <button type="button" id="cancelCreateModal"
                    class="px-4 py-2 cursor-pointer border border-red-500 hover:border-red-600 text-red-600 rounded-md flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    Cancel
                </button>
                <button type="submit" id="createSubmitBtn"
                    class="px-4 py-2 cursor-pointer bg-indigo-600 text-white rounded-md hover:bg-indigo-700 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                    Save Scores
                </button>
            </div>
        </form>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const scoreInputs = document.querySelectorAll('.score-input');
        const studentData = {};

        // Initialize student data
        document.querySelectorAll('[data-student-id]').forEach(row => {
            const studentId = row.dataset.studentId;
            if (!studentData[studentId]) {
                studentData[studentId] = {
                    total: 0,
                    average: 0,
                    subjectCount: 0,
                    scores: {}
                };
            }
        });

        // Update calculations when scores change
        scoreInputs.forEach(input => {
            input.addEventListener('input', function() {
                const studentId = this.dataset.studentId;
                const subjectId = this.dataset.subjectId;
                const score = parseFloat(this.value) || 0;

                // Update student data
                studentData[studentId].scores[subjectId] = score;
                studentData[studentId].total = Object.values(studentData[studentId].scores)
                    .reduce((sum, val) => sum + (val || 0), 0);
                studentData[studentId].subjectCount = Object.keys(studentData[studentId].scores)
                    .filter(k => studentData[studentId].scores[k] > 0).length;
                studentData[studentId].average = studentData[studentId].subjectCount > 0 ?
                    (studentData[studentId].total / studentData[studentId].subjectCount)
                    .toFixed(2) :
                    0;

                // Update UI
                document.querySelector(`.total[data-student-id="${studentId}"]`).textContent =
                    studentData[studentId].total;
                document.querySelector(`.average[data-student-id="${studentId}"]`).textContent =
                    studentData[studentId].average;
                document.querySelector(`.grade[data-student-id="${studentId}"]`).textContent =
                    calculateGrade(studentData[studentId].average);

                // Calculate ranks
                updateRanks();
            });
        });

        // Calculate grade based on average (matches your controller's method)
        function calculateGrade(average) {
            if (average >= 90) return 'A';
            if (average >= 80) return 'B';
            if (average >= 70) return 'C';
            if (average >= 60) return 'D';
            return 'F';
        }

        // Update ranks based on averages
        function updateRanks() {
            const students = Object.keys(studentData).map(id => ({
                id,
                average: parseFloat(studentData[id].average) || 0
            }));

            // Sort students by average (descending)
            students.sort((a, b) => b.average - a.average);

            // Assign ranks (handle ties)
            let currentRank = 1;
            students.forEach((student, index) => {
                if (index > 0 && student.average < students[index - 1].average) {
                    currentRank = index + 1;
                }
                document.querySelector(`.rank[data-student-id="${student.id}"]`).textContent =
                    currentRank;
            });
        }
    });
</script>
