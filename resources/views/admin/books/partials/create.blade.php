<x-modal.modal id="Modalcreate" title="Create New Book" class="rounded-xl w-full max-w-2xl"
    svgPath="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z">
    <form action="{{ route('admin.books.store') }}" method="POST" class="needs-validation overflow-y-auto max-h-[80vh]"
        enctype="multipart/form-data" novalidate>
        @csrf
        <div>
            <div class="p-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-2 gap-x-4">
                    <div class="relative flex items-end justify-center">
                        <div>
                            <x-photos.upload2 name="cover_image" icon="ri-upload-cloud-2-fill" rounded="rounded-full" size="xl" />
                        </div>
                    </div>
                    <div>
                        <!-- Title Field -->
                        <x-fields.input label="Title" name="title" placeholder="Enter book title" required />
                        <!-- Author Field -->
                        <x-fields.input label="Author" name="author" placeholder="Enter author name" required />
                    </div>
                    <!-- ISBN Field -->
                    <x-fields.input label="ISBN" name="isbn" placeholder="Enter ISBN" required />
                    <!-- publication_year Field -->
                    <x-fields.input type="number" label="Publication Year" name="publication_year"
                        placeholder="Enter publication year" max="{{ date('Y') + 1 }}" required />
                    <!-- Publisher Field -->
                    <x-fields.input label="Publisher" name="publisher" placeholder="Enter publisher" required />
                    <!-- Quantity Field -->
                    <x-fields.input type="number" label="Quantity" name="quantity" min="0"
                        placeholder="Enter quantity" required />
                    <x-fields.select name="category_id" label="Category" :options="$categories" :value="old('category_id')"
                        required="true" searchable="true" />
                </div>
                <x-fields.textarea label="Description" name="description" rows="2"
                    placeholder="Enter description" />
            </div>
        </div>
        <!-- Form Actions -->
        <x-modal.footer-actions :create="true" />
    </form>
</x-modal.modal>
