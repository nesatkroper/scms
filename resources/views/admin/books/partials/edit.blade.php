<!-- Edit Modal -->
<x-modal.modal id="Modaledit" title="Edit Book" svgClass="rounded-md" fill="none" stroke="currentColor" viewBox="0 0 24 24"
    class="rounded-xl w-full max-w-2xl"
    svgPath="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
    <!-- Form Content -->
    <form id="Formedit" method="POST" class="overflow-y-auto max-h-[80vh] needs-validation" novalidate
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="p-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-y-2 gap-x-4">
                <div class="relative flex items-end justify-center">
                    <x-photos.upload2 name="cover_image" icon="ri-upload-cloud-2-fill" rounded="rounded-full" size="xl" />
                </div>
                <div>
                    <!-- Title Field -->
                    <x-fields.input label="Title" name="title" placeholder="Enter book title" required />
                    <!-- Author Field -->
                    <x-fields.input label="Author" name="author" placeholder="Enter author name" required />
                </div>
                <!-- ISBN Field -->
                <x-fields.input :edit="true" label="ISBN" name="isbn" placeholder="Enter ISBN" required />
                <!-- publication_year Field -->
                <x-fields.input :edit="true" type="number" label="Publication Year" name="publication_year"
                    placeholder="Enter publication year" max="{{ date('Y') + 1 }}" required />
                <!-- Publisher Field -->
                <x-fields.input :edit="true" label="Publisher" name="publisher" placeholder="Enter publisher"
                    required />
                <!-- Quantity Field -->
                <x-fields.input :edit="true" type="number" label="Quantity" name="quantity" min="0"
                    placeholder="Enter quantity" required />
                <x-fields.select :edit="true" name="category_id" label="Category" :options="$categories"
                    :value="old('category_id')" required="true" searchable="true" />
            </div>
            <x-fields.textarea :edit="true" label="Description" name="description" rows="2"
                placeholder="Enter description" />
        </div>
        <!-- Form Actions -->
        <x-modal.footer-actions :edit="true" />
    </form>
</x-modal.modal>
