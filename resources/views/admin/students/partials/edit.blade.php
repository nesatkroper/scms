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
                Edit Student
            </h3>
            <button id="closeEditModal"
                class="text-red-400 hover:bg-red-50 dark:hover:bg-gray-700 cursor-pointer rounded-full p-1 hover:text-red-500">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Form Content -->
        <form id="Formedit" method="POST">
            @csrf
            @method('PUT')

            <div class="h-[65vh] md:h-[75vh] overflow-y-auto">
                <!-- Profile Header -->
                <div class="relative bg-gradient-to-r from-indigo-500 to-purple-600 h-28 flex items-end justify-center">
                    <!-- Circular Avatar -->
                    <div class="absolute -bottom-12">
                        <div
                            class="size-35 rounded-full border-4 border-white dark:border-slate-800 bg-white dark:bg-slate-700 shadow-lg relative">
                            <img id="edit_photo" src="" alt=""
                                class="w-full h-full object-cover rounded-full">
                            <div id="edit_initials"
                                class="rounded-full w-full h-full flex items-center justify-center bg-indigo-100 dark:bg-slate-600 hidden">
                                <span class="text-3xl font-bold text-indigo-600 dark:text-indigo-300"></span>
                            </div>
                            <input type="file" id="photo_upload" name="photo" accept="image/*" class="hidden">
                            <label for="photo_upload"
                                class="size-8 flex justify-center items-center absolute bottom-0 right-0 bg-white dark:bg-gray-700 p-1 rounded-full shadow cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600">
                                <i class="ri-camera-line text-indigo-600 dark:text-indigo-300"></i>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Profile Body -->
                <div class="pt-16 pb-4 px-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-2">
                        <!-- Field -->
                        <div class="mb-2">
                            <label for="edit_name"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="edit_name" name="name"
                                class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600
                         dark:text-white"
                                placeholder="Enter name" required>
                            <p class="error-name mt-1 text-sm text-red-600"></p>
                        </div>
                        <div class="mb-2">
                            <label for="edit_user"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                User Account <span class="text-red-500">*</span>
                            </label>
                            <select id="edit_user" name="user_id"
                                class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('user_id') border-red-500 @else border-gray-400 @enderror"
                                required>
                                <option value="">Select user account</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}"
                                        {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                            <p class="error-user mt-1 text-sm text-red-600"></p>
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
                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male
                                </option>
                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female
                                </option>
                                <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other
                                </option>
                            </select>
                            <p class="error-gender mt-1 text-sm text-red-600"></p>
                        </div>
                        <div class="mb-2">
                            <label for="edit_grade_level_id"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Grade level<span class="text-red-500">*</span>
                            </label>
                            <select id="edit_grade_level_id" name="grade_level_id"
                                class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                required>
                                <option value="">Select Grade level</option>
                                @foreach ($gradeLevels as $gradeLevel)
                                    <option value="{{ $gradeLevel->id }}"
                                        {{ old('grade_level_id') == $gradeLevel->id ? 'selected' : '' }}>
                                        {{ $gradeLevel->name }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="error-grade_level mt-1 text-sm text-red-600"></p>
                        </div>
                        <div class="mb-2">
                            <label for="edit_admission_date"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Admission Date <span class="text-red-500">*</span>
                            </label>
                            <input type="date" id="edit_admission_date" name="admission_date" value=""
                                class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                required>
                            <p class="mt-1 error-admission_date text-sm text-red-600"></p>
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
                            <input type="tel" id="edit_phone" name="phone"
                                class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('phone') border-red-500 @else border-gray-400 @enderror"
                                placeholder="Enter phone number" required>
                            <p class="error-phone mt-1 text-sm text-red-600"></p>
                        </div>

                        <div class="mb-2">
                            <label for="edit_nationality"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Nationality
                            </label>
                            <input type="text" id="edit_nationality" name="phone"
                                class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('phone') border-red-500 @else border-gray-400 @enderror"
                                placeholder="Enter nationality">
                            <p class="error-nationality mt-1 text-sm text-red-600"></p>
                        </div>
                        <div class="mb-2">
                            <label for="edit_religion"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Religion
                            </label>
                            <input type="text" id="edit_religion" name="phone"
                                class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('phone') border-red-500 @else border-gray-400 @enderror"
                                placeholder="Enter edit_religion">
                            <p class="error-religion mt-1 text-sm text-red-600"></p>
                        </div>
                        <div class="mb-2">
                            <label for="edit_address"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Address <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="edit_address" name="address" value=""
                                class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('email') border-red-500 @else border-gray-400 @enderror"
                                placeholder="Enter address address" required>
                            <p class="error-address mt-1 text-sm text-red-600"></p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Form Actions -->
            <div class="flex justify-end space-x-3 p-4 border-t border-gray-200 dark:border-gray-700">
                <button type="button" id="cancelEditModal"
                    class="px-4 py-2 cursor-pointer border border-red-500 hover:text-white hover:bg-red-600 text-red-500 rounded-md flex items-center gap-2 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    Cancel
                </button>
                <button type="submit" id="saveEditBtn"
                    class="px-4 py-2 cursor-pointer bg-indigo-600 text-white rounded-md hover:bg-indigo-700 flex items-center gap-2 transition-colors">
                    <span class="btn-content flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        Save Changes
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>
