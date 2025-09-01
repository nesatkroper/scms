<x-modal.modal id="Modaledit" title="Edit Student" class="rounded-xl w-full max-w-2xl"
    svgPath="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">

    <form id="Formedit" method="POST" class="overflow-y-auto max-h-[80vh] needs-validation" novalidate
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <!-- Profile Header -->
        <div class="relative bg-gradient-to-r from-indigo-500 to-purple-600 h-28 flex items-end justify-center">
            <x-photos.upload :edit="true" name="photo" />
        </div>
        <!-- Profile Body -->
        <div class="pt-16 pb-4 px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-2">

                <x-fields.input :edit="true" label="Name" name="name" placeholder="Enter student name"
                    :required="true" />

                <x-fields.input :edit="true" type="email" label="Email" name="email" placeholder="Enter email"
                    :required="true" />

                <x-fields.input :edit="true" label="Phone" name="phone" placeholder="Enter phone number"
                    :required="true" />

                <x-fields.input :edit="true" type="date" label="Date of Birth" name="dob"
                    :required="true" />

                <x-fields.select :edit="true" label="Gender" name="gender" :options="['male' => 'Male', 'female' => 'Female', 'other' => 'Other']"
                    :required="true" />

                <x-fields.select :edit="true" label="Grade Level" name="grade_level_id" :options="$gradeLevels->pluck('name', 'id')"
                    :required="true" />
                <x-fields.input :edit="true" min="5" label="Blood group" name="blood_group"
                    placeholder="Enter blood group" />

                <x-fields.input :edit="true" label="Address" name="address" placeholder="Enter address" />

                <x-fields.input :edit="true" label="Nationality" name="nationality"
                    placeholder="Enter nationality" />

                <x-fields.input :edit="true" label="Religion" name="religion" placeholder="Enter religion" />

                <x-fields.input :edit="true" type="date" label="Admission Date" name="admission_date"
                    :required="true" />

            </div>
        </div>
        <!-- Form Actions -->
        <x-modal.footer-actions :edit="true" />
    </form>
</x-modal.modal>
