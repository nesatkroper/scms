<!-- Create Modal -->
<x-modal.modal id="Modalcreate" title="Create New Score" class="rounded-sm w-full max-w-full h-full max-h-full"
    svgPath="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z">
    <!-- Form Content -->
    <form action="{{ route('admin.scores.store') }}" method="POST" class="p-4">
        @csrf

        <div class="mb-4 grid grid-cols-1 md:grid-cols-4 gap-4">
            <x-fields.select labelclass="text-xs" class="py-1.5" label="Exam" name="exam_id" :options="$exams"
                :value="request('exam_id')" :searchable="true" />

            <x-fields.select id="semester" labelclass="text-xs" class="py-1.5" name="semester" label="Semester"
                :options="['semester1' => '1', 'semester2' => '2']" :value="old('semester1', '1')" />
        </div>

        <div class="h-[65vh] md:h-auto overflow-y-auto">
            <div class="mb-2">
                @include('admin.scores.partials.table', ['scores' => $scores])
            </div>
        </div>
        <!-- Form Actions -->
        <x-modal.footer-actions :create="true" class="pb-0" />
    </form>
</x-modal.modal>
