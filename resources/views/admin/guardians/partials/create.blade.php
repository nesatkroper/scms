<x-modal.modal id="Modalcreate" title="Create New guardians" class="rounded-xl w-full max-w-2xl"
    svgPath="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z">
    <form action="{{ route('admin.guardians.store') }}" method="POST"
        class="needs-validation overflow-y-auto max-h-[80vh]" enctype="multipart/form-data" novalidate>
        @csrf

        <div>
            <!-- Profile Header -->
            <div class="relative bg-gradient-to-r from-indigo-500 to-purple-600 h-28 flex items-end justify-center">
                <!-- Circular Avatar -->
                <div class="absolute -bottom-12">
                    <x-photos.upload2 name="photo" size="xl" />
                </div>
            </div>
            <!-- Profile Body -->
            <div class="pt-16 pb-4 px-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-2 gap-x-4">
                    <!-- Name Field -->
                    <x-fields.input label="Name" name="name" placeholder="Enter name" :required="true" />
                    <!-- Email Field -->
                    <x-fields.input type="email" label="Email" name="email" placeholder="Enter email"
                        :required="true" max="255" />
                    <!-- Phone Number Field -->
                    <x-fields.input type="tel" label="Phone number" name="phone" max="20"
                        placeholder="Enter phone number" required />
                    <x-fields.input label="Relation" name="relation" placeholder="Enter relation name" max="255"
                        required />
                    <x-fields.input label="Company" name="company" placeholder="Enter company name" max="255" />
                    <x-fields.input label="Occupation" name="occupation" placeholder="Enter occupation"
                        max="255" />
                    <!-- Address Field -->
                    <x-fields.input label="Address" name="address" placeholder="Enter address" required />
                    <!-- Gender Select -->
                    {{-- <x-fields.select name="gender" label="Gender" :options="['male' => 'Male', 'female' => 'Female', 'other' => 'Other']" :value="old('gender', 'male')" /> --}}
                </div>
            </div>
        </div>
        <!-- Form Actions -->
        <x-modal.footer-actions :create="true" />
    </form>
</x-modal.modal>
