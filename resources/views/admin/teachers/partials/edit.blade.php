<!-- Edit Modal -->
<div id="Modaledit" class="fixed inset-0 z-50 flex items-center justify-center p-4 hidden">
    <div
        class="relative bg-white dark:bg-gray-800 rounded-xl shadow-2xl w-full max-w-2xl transform transition-all duration-300 opacity-0 scale-95 border border-gray-200 dark:border-gray-600">
        <!-- Header -->
        <div class="flex justify-between items-center p-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="size-8 p-1 rounded-full bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"
                    viewBox="0 0 20 20" fill="currentColor">
                    <path
                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                </svg>
                Edit Teacher Profile
            </h3>
            <x-button.btnclose id="closeEditModal"/>
        </div>

        <!-- Form Content -->
        <form id="Formedit" method="POST" class="overflow-y-auto max-h-[80vh] needs-validation" novalidate>
            @csrf
            @method('PUT')

            <div class="bg-white dark:bg-slate-800 rounded-xl border border-gray-100 dark:border-slate-700">
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

                        <!-- Field -->
                        <div class="mb-2">
                            <label for="edit_name"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="edit_name" name="name"
                                class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white
                        @error('name') border-red-500 @else border-gray-400 @enderror"
                                placeholder="Enter name" required>

                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label for="edit_gender"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Gender <span class="text-red-500">*</span>
                            </label>
                            <select id="edit_gender" name="gender"
                                class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('gender') border-red-500 @else border-gray-400 @enderror"
                                required>
                                <option value="">Select gender</option>
                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female
                                </option>
                                <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            <p class="error-gender mt-1 text-sm text-red-600"></p>
                        </div>

                        <!-- Department Field -->
                        <div class="mb-2">
                            <label for="edit_depid"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
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
                        <div class="mb-2">
                            <label for="edit_experience"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Experience <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="edit_experience" name="experience" value="{{ old('experience') }}"
                                class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('experience') border-red-500 @else border-gray-400 @enderror"
                                placeholder="Enter years of experience" required>
                            <p class="error-experience mt-1 text-sm text-red-600"></p>
                        </div>
                        <!-- Joining Date Field -->
                        <div class="mb-2">
                            <label for="edit_joining_date"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Joining Date <span class="text-red-500">*</span>
                            </label>
                            <input type="date" id="edit_joining_date" name="joining_date"
                                value="{{ old('joining_date') }}"
                                class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white
                        @error('joining_date') border-red-500 @else border-gray-400 @enderror"
                                required>

                            @error('joining_date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="edit_dob"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Date of Birth <span class="text-red-500">*</span>
                            </label>
                            <input type="date" id="edit_dob" name="dob" value=""
                                class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('dob') border-red-500 @else border-gray-400 @enderror"
                                required>
                            <p class="error-dob mt-1 text-sm text-red-600"></p>
                        </div>


                        <!-- Contact Information -->
                        <div class="mb-2">
                            <label for="edit_email"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input type="email" id="edit_email" name="email" value=""
                                class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('email') border-red-500 @else border-gray-400 @enderror"
                                placeholder="Enter email address" required>
                            <p class="error-email mt-1 text-sm text-red-600"></p>
                        </div>

                        <div class="mb-2">
                            <label for="edit_phone"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Phone <span class="text-red-500">*</span>
                            </label>
                            <input type="tel" id="edit_phone" name="phone" value=""
                                class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('phone') border-red-500 @else border-gray-400 @enderror"
                                placeholder="Enter phone number" required>
                            <p class="error-phone mt-1 text-sm text-red-600"></p>
                        </div>
                        <div class="mb-2">
                            <label for="edit_address"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Address <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="edit_address" name="address" value="{{ old('address') }}"
                                class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('email') border-red-500 @else border-gray-400 @enderror"
                                placeholder="Enter address address" required>
                            <p class="error-address mt-1 text-sm text-red-600"></p>
                        </div>
                        <!-- Qualification Field -->
                        <div class="mb-2">
                            <label for="edit_qualification"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Qualification <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="edit_qualification" name="qualification"
                                value="{{ old('qualification') }}"
                                class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white
                        @error('qualification') border-red-500 @else border-gray-400 @enderror"
                                placeholder="Enter qualification" required>

                            @error('qualification')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Specialization Field -->
                        <div class="mb-2">
                            <label for="edit_specialization"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Specialization
                            </label>
                            <input type="text" id="edit_specialization" name="specialization"
                                value="{{ old('specialization') }}"
                                class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white
                        @error('specialization') border-red-500 @else border-gray-400 @enderror"
                                placeholder="Enter specialization">

                            @error('specialization')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Salary Field -->
                        <div class="mb-2">
                            <label for="edit_salary"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Salary
                            </label>
                            <input type="number" step="0.01" id="edit_salary" name="salary"
                                value="{{ old('salary') }}"
                                class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white
                        @error('salary') border-red-500 @else border-gray-400 @enderror"
                                placeholder="Enter salary">

                            @error('salary')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end space-x-3 p-4 border-t border-gray-200 dark:border-gray-700">
                <x-button btn-type="cancel" id="cancelEditModal">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    Cancel
                </x-button>
                <x-button btn-type="save" id="saveEditBtn" type="submit">
                    <span class="btn-content flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        Save Changes
                    </span>
                </x-button>
            </div>
        </form>
    </div>
</div>
