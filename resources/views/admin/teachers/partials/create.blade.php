<!-- Create Teacher Modal -->
<div id="Modalcreate" class="fixed inset-0 z-50 flex items-center justify-center p-4 hidden">
    <div
        class="relative bg-white dark:bg-gray-800 rounded-xl shadow-2xl w-full max-w-4xl transform transition-all duration-300 opacity-0 scale-95 border border-white dark:border-gray-600">
        <!-- Header -->
        <div class="flex justify-between items-center p-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="size-8 rounded-full p-1 bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"
                    viewBox="0 0 20 20" fill="currentColor">
                    <path
                        d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                </svg>
                Create New Teacher
            </h3>
            <button id="closeCreateModal"
                class="text-red-400 hover:bg-red-50 dark:hover:bg-gray-700 cursor-pointer rounded-full p-1 hover:text-red-500">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Form Content -->
        <form action="{{ route('admin.teachers.store') }}" method="POST" class="py-4 needs-validation"
            enctype="multipart/form-data" novalidate>
            @csrf

            <div class="h-[65vh] md:h-[75vh] overflow-y-auto px-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-2">
                    <x-upload-file />
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-2">
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

                    <div class="mb-2">
                        <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Phone <span class="text-red-500">*</span>
                        </label>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                            class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('phone') border-red-500 @else border-gray-400 @enderror"
                            placeholder="Enter phone number" required>
                        <p class="error-phone mt-1 text-sm text-red-600"></p>
                    </div>

                    <!-- Professional Information -->
                    <div class="mb-2">
                        <label for="department_id"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Department <span class="text-red-500">*</span>
                        </label>
                        <select id="department_id" name="department_id"
                            class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('department_id') border-red-500 @else border-gray-400 @enderror"
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
                    </div>

                    <div class="mb-2">
                        <label for="user_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            User Account <span class="text-red-500">*</span>
                        </label>
                        <select id="user_id" name="user_id"
                            class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('user_id') border-red-500 @else border-gray-400 @enderror"
                            required>
                            <option value="">Select user account</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} ({{ $user->email }})
                                </option>
                            @endforeach
                        </select>
                        <p class="error-user mt-1 text-sm text-red-600"></p>
                    </div>

                    <div class="mb-2">
                        <label for="joining_date"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Joining Date <span class="text-red-500">*</span>
                        </label>
                        <input type="date" id="joining_date" name="joining_date" value="{{ old('joining_date') }}"
                            class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('joining_date') border-red-500 @else border-gray-400 @enderror"
                            required>
                        <p class="error-joining_date mt-1 text-sm text-red-600"></p>
                    </div>

                    <div class="mb-2">
                        <label for="qualification"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Qualification <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="qualification" name="qualification"
                            value="{{ old('qualification') }}"
                            class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('qualification') border-red-500 @else border-gray-400 @enderror"
                            placeholder="Enter qualifications" required>
                        <p class="error-qualification mt-1 text-sm text-red-600"></p>
                    </div>

                    <div class="mb-2">
                        <label for="experience" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Experience <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="experience" name="experience" value="{{ old('experience') }}"
                            class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('experience') border-red-500 @else border-gray-400 @enderror"
                            placeholder="Enter years of experience" required>
                        <p class="error-experience mt-1 text-sm text-red-600"></p>
                    </div>

                    <!-- Optional Fields -->
                    <div class="mb-2">
                        <label for="specialization"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Specialization
                        </label>
                        <input type="text" id="specialization" name="specialization"
                            value="{{ old('specialization') }}"
                            class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('specialization') border-red-500 @else border-gray-400 @enderror"
                            placeholder="Enter specializations">
                        <p class="error-specialization mt-1 text-sm text-red-600"></p>
                    </div>

                    <div class="mb-2">
                        <label for="salary" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Salary
                        </label>
                        <input type="number" step="0.01" id="salary" name="salary"
                            value="{{ old('salary') }}"
                            class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('salary') border-red-500 @else border-gray-400 @enderror"
                            placeholder="Enter salary amount">
                        <p class="error-salary mt-1 text-sm text-red-600"></p>
                    </div>
                </div>
                <div class="mb-2">
                    <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Address <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="address" name="address" value="{{ old('address') }}"
                        class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('email') border-red-500 @else border-gray-400 @enderror"
                        placeholder="Enter address address" required>
                    <p class="error-address mt-1 text-sm text-red-600"></p>
                </div>
                <!-- Description -->
                <div class="mb-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Additional Information
                    </label>
                    <textarea id="description" name="description" rows="3"
                        class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('description') border-red-500 @else border-gray-400 @enderror"
                        placeholder="Enter any additional information about the teacher">{{ old('description') }}</textarea>
                    <p class="error-description mt-1 text-sm text-red-600"></p>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end space-x-3 pt-4 px-4 border-t border-gray-200 dark:border-gray-700">
                <button type="button" id="cancelCreateModal"
                    class="px-4 py-2 cursor-pointer border border-red-500 hover:border-red-600 text-red-600 rounded-md flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    Cancel
                </button>
                <button type="submit" id="createSubmitBtn"
                    class="px-4 py-2 cursor-pointer bg-indigo-600 text-white rounded-md hover:bg-indigo-700 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                    Create Teacher
                </button>
            </div>
        </form>
    </div>
</div>
