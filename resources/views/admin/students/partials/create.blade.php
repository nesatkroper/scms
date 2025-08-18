<!-- Create Modal -->
<div id="Modalcreate" class="fixed inset-0 z-50 flex items-center justify-center p-4 hidden">
    <div
        class="relative bg-white dark:bg-gray-800 rounded-xl shadow-2xl w-full max-w-2xl transform transition-all duration-300 opacity-0 scale-95 border border-white dark:border-gray-600">
        <!-- Header -->
        <div class="flex justify-between items-center p-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="size-8 rounded-full p-1 bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"
                    viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                        clip-rule="evenodd" />
                </svg>
                Create New Student
            </h3>
            <button id="closeCreateModal"
                class="text-red-400 hover:bg-red-50 dark:hover:bg-gray-700 cursor-pointer rounded-full p-1 hover:text-red-500">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Form Content -->
        <form action="{{ route('admin.students.store') }}" method="POST" class="py-4 needs-validation " novalidate
            enctype="multipart/form-data">
            @csrf

            <div class="h-[65vh] md:h-[75vh] overflow-y-auto px-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-2">
                    <x-upload-file />
                    <!-- Empty column to maintain layout -->
                    <div class="mb-2">
                        <!-- Personal Information -->
                        <x-fields.input label="Full Name" name="name" placeholder="Enter full name"
                            :required="true" />
                        <x-fields.select name="gender" label="Gender" :options="['male' => 'Male', 'female' => 'Female', 'other' => 'Other']" :value="old('gender', 'male')" />
                        <x-fields.input type="date" label="Date of Birth" name="dob"
                            placeholder="Enter Date of Birth" :required="true" />
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-4 gap-y-2 mb-2">
                    <!-- Email Field -->
                    <x-fields.input type="email" label="Email" name="email" placeholder="Enter email"
                        :required="true" />
                    <x-fields.input type="tel" label="Phone" name="phone" placeholder="Enter phone number"
                        :required="true" />

                    <!-- Student Information -->
                    <div class="mb-2">
                        <label for="grade_level_id"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Grade Level <span class="text-red-500">*</span>
                        </label>
                        <select id="grade_level_id" name="grade_level_id"
                            class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('grade_level_id') border-red-500 @else border-gray-400 @enderror"
                            required>
                            <option value="">Select grade level</option>
                            @foreach ($gradeLevels as $gradeLevel)
                                <option value="{{ $gradeLevel->id }}"
                                    {{ old('grade_level_id') == $gradeLevel->id ? 'selected' : '' }}>
                                    {{ $gradeLevel->name }}
                                </option>
                            @endforeach
                        </select>
                        <p class="error-grade_level mt-1 text-sm text-red-600"></p>
                    </div>
                    <x-fields.input label="Blood group" name="blood_group" placeholder="Enter blood group"/>
                    <div class="mb-2">
                        <label for="nationality"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Nationality
                        </label>
                        <input type="text" id="nationality" name="nationality" value="{{ old('nationality') }}"
                            class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white focus:ring-2 focus:ring-indigo-500
                             focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('phone') border-red-500 @else border-gray-400 @enderror"
                            placeholder="Enter nationality">
                        <p class="error-nationality mt-1 text-sm text-red-600"></p>
                    </div>
                    <div class="mb-2">
                        <label for="religion" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Religion
                        </label>
                        <input type="text" id="religion" name="religion" value="{{ old('religion') }}"
                            class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white focus:ring-2 focus:ring-indigo-500
                             focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('phone') border-red-500 @else border-gray-400 @enderror"
                            placeholder="Enter religion">
                        <p class="error-religion mt-1 text-sm text-red-600"></p>
                    </div>
                    <div class="mb-2">
                        <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Address
                        </label>
                        <input type="text" id="address" name="address" value="{{ old('address') }}"
                            class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white focus:ring-2 focus:ring-indigo-500
                             focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('phone') border-red-500 @else border-gray-400 @enderror"
                            placeholder="Enter address">
                        <p class="error-address mt-1 text-sm text-red-600"></p>
                    </div>
                    <div class="mb-2">
                        <label for="admission_date"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Admission Date <span class="text-red-500">*</span>
                        </label>
                        <input type="date" id="admission_date" name="admission_date"
                            value="{{ old('admission_date') }}"
                            class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                </div>
                <!-- Form Actions -->
                <div class="flex justify-end space-x-3 px-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                    <button type="button" id="cancelCreateModal"
                        class="px-4 py-2 cursor-pointer border border-red-500 hover:border-red-600 text-red-600 rounded-md flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                        Cancel
                    </button>
                    <button type="submit" id="createSubmitBtn"
                        class="px-4 py-2 cursor-pointer bg-indigo-600 text-white rounded-md hover:bg-indigo-700 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        Create
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
