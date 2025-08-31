<x-modal.modal id="Modaledit" title="Edit Exam" class="rounded-xl w-full max-w-2xl"
    svgPath="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
    <form id="Formedit" method="POST" class="p-5 needs-validation" novalidate>
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-2">
            <!-- Name -->
            <x-fields.input :edit="true" label="Exam Name" name="name" placeholder="Enter exam name" :required="true" />
            <!-- Subject -->
            <x-fields.select :edit="true" name="subject_id" label="Subject" :options="$subjects" :required="true" :searchable="true" />
            <!-- Total Marks -->
            <x-fields.input type="number" :edit="true" label="Total Marks" name="total_marks" min="1" placeholder="Enter total marks" :required="true" />
            <!-- Passing Marks -->
            <x-fields.input type="number" :edit="true" label="Passing Marks" name="passing_marks" min="0" placeholder="Enter passing marks" :required="true" />
            <!-- Date -->
            <x-fields.input type="date" :edit="true" label="Exam Date" name="date" :required="true" />
        </div>
        <!-- Description (full width) -->
        <x-fields.textarea :edit="true" label="Description" name="description" placeholder="Enter exam description" />
        <!-- Footer Actions -->
        <x-modal.footer-actions :edit="true" />
    </form>
</x-modal.modal>
