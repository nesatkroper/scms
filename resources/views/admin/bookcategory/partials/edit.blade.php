<!-- Edit Book Category Modal -->
<x-modal.modal id="Modaledit" title="Edit Book Category" svgClass="rounded-md" fill="none" stroke="currentColor" viewBox="0 0 24 24"
    class="rounded-xl w-full max-w-md"
    svgPath="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
    <!-- Form Content -->
    <form id="Formedit" method="POST" class="p-5 needs-validation" novalidate>
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 gap-x-4 gap-y-2 mb-2">
            <!-- Name Field -->
            <x-fields.input :edit="true" label="Name" name="name" placeholder="Enter name"
                :required="true" />
            <!-- Description Field -->
            <x-fields.textarea :edit="true" label="Description" name="description"
                placeholder="Enter description" />
        </div>
        <!-- Form Actions -->
        <x-modal.footer-actions :edit="true" class="pb-0 px-0" />
    </form>
</x-modal.modal>
