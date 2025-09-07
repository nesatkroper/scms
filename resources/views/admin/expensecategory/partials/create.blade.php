<x-modal.modal id="Modalcreate" title="Create New Expense Category" class="rounded-xl w-full max-w-md"
    svgPath="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z">

    <form action="{{ route('admin.expensecategory.store') }}" method="POST" class="p-4 needs-validation" novalidate>
        @csrf
        <div class="h-[65vh] md:h-auto">
            <div class="grid grid-cols-1 gap-x-4 gap-y-2 mb-2">
                <!-- Name Field -->
                <x-fields.input label="Name" name="name" placeholder="Enter name" :required="true" />
                <!-- Description Field -->
                <x-fields.textarea label="Description" name="description" placeholder="Enter description" />
            </div>
        </div>
        <!-- Form Actions -->
        <x-modal.footer-actions :create="true" class="pb-0 px-0"/>
    </form>
</x-modal.modal>
