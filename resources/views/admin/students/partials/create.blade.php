<x-modal.modal id="Modalcreate" title="Create New Student" class="rounded-xl w-full max-w-2xl"
    svgPath="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z">
    
    <form action="{{ route('admin.students.store') }}" method="POST" class="pt-4 needs-validation" novalidate enctype="multipart/form-data">
        @csrf
        <div class="h-[65vh] md:h-[70vh] overflow-y-auto px-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-2">
                <x-upload-file />
                <div class="mb-2">
                    <x-fields.input label="Full Name" name="name" placeholder="Enter full name" :required="true" />
                    <x-fields.select name="gender" label="Gender" :options="['male' => 'Male', 'female' => 'Female', 'other' => 'Other']" :value="old('gender', 'male')" />
                    <x-fields.input type="date" label="Date of Birth" name="dob" :required="true" />
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-4 gap-y-2 mb-2">
                <x-fields.input type="email" label="Email" name="email" :required="true" />
                <x-fields.input type="tel" label="Phone" name="phone" :required="true" />
                <x-fields.select label="Grade Level" name="grade_level_id" :options="$gradeLevels->pluck('name', 'id')->toArray()" :required="true" />
                <x-fields.input label="Blood Group" name="blood_group" placeholder="Enter blood group" />
                <x-fields.input label="Nationality" name="nationality" placeholder="Enter nationality" />
                <x-fields.input label="Religion" name="religion" placeholder="Enter religion" />
                <x-fields.input label="Address" name="address" placeholder="Enter address" />
                <x-fields.input type="date" label="Admission Date" name="admission_date" :required="true" />
            </div>
        </div>
        <!-- Form Actions -->
        <x-modal.footer-actions :create="true"  />
    </form>
</x-modal.modal>
