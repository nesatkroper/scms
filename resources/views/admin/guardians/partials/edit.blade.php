<x-modal.modal id="Modaledit" title="Edit Guardians" class="rounded-xl w-full max-w-2xl"
    svgPath="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
    <!-- Form Content -->
    <form id="Formedit" method="POST" class="overflow-y-auto max-h-[80vh] needs-validation" novalidate
        enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div>
            <!-- Profile Header -->
            <div class="relative bg-gradient-to-r from-indigo-500 to-purple-600 h-28 flex items-end justify-center">
                <!-- Circular Avatar -->
                <x-photos.upload :edit="true" name="photo" />
            </div>

            <!-- Profile Body -->
            <div class="pt-16 pb-4 px-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-2 gap-x-4">
                    <!-- Name Field -->
                    <x-fields.input :edit="true" label="Name" name="name" placeholder="Enter name"
                        :required="true" />
                    <!-- Email Field -->
                    <x-fields.input :edit="true" type="email" label="Email" name="email"
                        placeholder="Enter email" :required="true" max="255" />
                    <!-- Phone Number Field -->
                    <x-fields.input :edit="true" type="tel" label="Phone number" name="phone" max="20"
                        placeholder="Enter phone number" required />
                    <x-fields.input :edit="true" label="Relation" name="relation" placeholder="Enter relation name"
                        max="255" required />
                    <x-fields.input :edit="true" label="Company" name="company" placeholder="Enter company name"
                        max="255" />
                    <x-fields.input :edit="true" label="Occupation" name="occupation"
                        placeholder="Enter occupation" max="255" />
                    <!-- Address Field -->
                    <x-fields.input :edit="true" label="Address" name="address" placeholder="Enter address"
                        required />
                    <!-- Gender Select -->
                    {{-- <x-fields.select name="gender" label="Gender" :options="['male' => 'Male', 'female' => 'Female', 'other' => 'Other']" :value="old('gender', 'male')" /> --}}
                </div>
            </div>
        </div>
        <!-- Form Actions -->
        <x-modal.footer-actions :edit="true" />
    </form>
</x-modal.modal>
