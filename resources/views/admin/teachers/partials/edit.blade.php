<!-- Edit Modal -->
<x-modal.modal id="Modaledit" title="Edit Teacher Profile" svgClass="rounded-md" fill="none" stroke="currentColor"
    viewBox="0 0 24 24" class="rounded-xl w-full max-w-2xl"
    svgPath="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
    <!-- Form Content -->
    <form id="Formedit" method="POST" class="overflow-y-auto max-h-[80vh] needs-validation" novalidate enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div>
            <!-- Profile Header -->
            <div class="relative bg-gradient-to-r from-indigo-500 to-purple-600 h-28 flex items-end justify-center">
                <!-- Circular Avatar -->
                <x-photos.upload :edit="true" name="photo" />
            </div>
            <!-- Profile Body -->
            <div class="pt-16 px-5">
                <div class="mb-2">
                    <label for="edit_cv" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        CV/Resume
                    </label>
                    <input type="file" id="edit_cv" name="cv" accept=".pdf,.doc,.docx"
                        class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <p class="text-xs text-gray-500 mt-1">PDF, DOC, DOCX documents only (MAX. 5MB)</p>
                    <div id="current_cv" class="mt-2 hidden">
                        <span class="text-sm text-gray-600 dark:text-gray-300">Current file: </span>
                        <a href="#" target="_blank"
                            class="text-indigo-600 dark:text-indigo-400 text-sm block hover:underline truncate w-[90%]"
                            id="cv_link"></a>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-2 mb-2">
                    <x-fields.input :edit="true" label="Name" name="name" placeholder="Enter full name"
                        :required="true" />
                    <x-fields.select :edit="true" name="gender" label="Gender" :options="['male' => 'Male', 'female' => 'Female', 'other' => 'Other']" :value="old('gender', 'male')"
                        required />
                    <!-- Department Field -->
                    <div class="mb-2">
                        <label for="edit_depid" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Department <span class="text-red-500">*</span>
                        </label>
                        <select id="edit_depid" name="department_id"
                            class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white
                        @error('department_id') border-red-500 @else border-gray-400 @enderror"
                            required>
                            <option value="">Select department</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}"
                                    {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('department_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <x-fields.input :edit="true" type="number" label="Experience" name="experience"
                        placeholder="Enter years of experience" required />
                    <!-- Joining Date Field -->
                    <x-fields.input :edit="true" type="date" label="Joining Date" name="joining_date" required
                        value="{{ old('joining_date') }}" />
                    <x-fields.input :edit="true" type="date" label="Date of Birth" name="dob" required
                        value="{{ old('dob') }}" />
                    <!-- Contact Information -->
                    <x-fields.input :edit="true" type="email" label="Email" name="email"
                        placeholder="Enter email address" required />
                    <x-fields.input :edit="true" type="tel" label="Phone" name="phone"
                        placeholder="Enter phone number" required />
                    <x-fields.input :edit="true" label="Address" name="address" placeholder="Enter address"
                        required />
                    <!-- Qualification Field -->
                    <x-fields.input :edit="true" label="Qualification" name="qualification"
                        placeholder="Enter qualification" :required="true" />
                    <!-- Specialization Field -->
                    <x-fields.input :edit="true" label="Specialization" name="specialization"
                        placeholder="Enter specialization" />
                    <!-- Salary Field -->
                    <x-fields.input :edit="true" type="number" label="Salary" name="salary"
                        placeholder="Enter salary" />

                    {{-- <x-fields.textarea :edit="true" label="Additional Information"
                        placeholder="Enter any additional information about the teacher" name="description" /> --}}

                </div>
            </div>
        </div>
        <!-- Form Actions -->
        <x-modal.footer-actions :edit="true" />
</x-modal.modal>
