<x-modal.modal id="Modaldetail" title="Book Category Details" class="rounded-xl w-full max-w-xl"
    svgPath="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z">
    <!-- Content -->
    <div class="h-[65vh] md:h-auto p-4 overflow-y-auto">
        <!-- Name Field -->
        <x-fields.input :detail="true" label="Category Name" name="name" />
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-2">
            <!-- Created At Field -->
            <x-fields.input type="date" :detail="true" label="Category Name" name="created_at" />
            <!-- Updated At Field -->
            <x-fields.input type="date" :detail="true" label="Category Name" name="updated_at" />
        </div>
        <!-- Description Field -->
        <x-fields.textarea :detail="true" label="Description" name="description" />
    </div>
    <!-- Form Actions -->
    <x-modal.footer-actions :detail="true"/>
</x-modal.modal>
