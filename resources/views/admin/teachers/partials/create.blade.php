<x-modal.modal id="Modalcreate" title="Create New Teacher" class="rounded-xl w-full max-w-4xl"
    svgPath="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z">
    <form action="{{ route('admin.teachers.store') }}" method="POST" class="py-4 needs-validation"
        enctype="multipart/form-data" novalidate>
        @csrf

        <div class="h-[65vh] md:h-[75vh] overflow-y-auto px-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-2">
                <x-upload-file />
                <x-cvupload />
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-4 gap-y-2 mb-2">
                <!-- Personal Information -->
                <x-fields.input label="Full Name" name="name" placeholder="Enter full name" :required="true" />
                <!-- Gender Select (Non-searchable) -->
                <x-fields.select name="gender" label="Gender" :required="true" :options="['male' => 'Male', 'female' => 'Female', 'other' => 'Other']"
                    :value="old('gender', 'male')" />

                <x-fields.input type="date" label="Date of Birth" name="dob"
                    placeholder="Enter Date of Birth" :required="true" />
                <!-- Email Field -->
                <x-fields.input type="email" label="Email" name="email" placeholder="Enter email"
                    :required="true" />
                <x-fields.input type="tel" label="Phone" name="phone" placeholder="Enter phone number"
                    :required="true" />
                {{-- <x-fields.select name="department_id" label="Department" :options="$departments" :value="old('department_id')"
                        :required="true" searchable="true" /> --}}
                <div class="mb-2">
                    <label for="department_id"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Department <span class="text-red-500">*</span>
                    </label>
                    <select id="department_id" name="department_id"
                        class="form-control form-select w-full px-3 py-2 border rounded-md focus:outline focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('department_id') border-red-500 @else border-gray-400 @enderror"
                        required>
                        <option value="">Select department</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}"
                                {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                {{ $department->name }}
                            </option>
                        @endforeach
                    </select>
                    <p class="error-department mt-1 text-sm text-red-600"></p>
                    <div class="invalid-feedback text-sm text-red-600 dark:text-red-500 mt-1">
                        Field department is required.
                    </div>
                </div>
                <x-fields.input type="date" label="Joining Date" name="joining_date"
                    placeholder="Enter joining date" :required="true" />

                <x-fields.input label="Qualification" name="qualification" placeholder="Enter qualification"
                    :required="true" />
                <x-fields.input type="number" label="Experience" name="experience" placeholder="Enter experience"
                    :required="true" />
                <x-fields.input label="Specialization" name="specialization" placeholder="Enter specialization" />
                <x-fields.input type="number" label="Salary" name="salary" placeholder="Enter salary" />
            </div>
            <x-fields.input label="Address" name="address" placeholder="Enter address" required />
        </div>
        <!-- Form Actions -->
        <x-modal.footer-actions :create="true" class="pb-0" />
    </form>
</x-modal.modal>
