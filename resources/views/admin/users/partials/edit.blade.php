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
                Edit User Profile
            </h3>
            <button id="closeEditModal"
                class="text-red-400 hover:bg-red-50 dark:hover:bg-gray-700 cursor-pointer rounded-full p-1 hover:text-red-500">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Form Content -->
        <form id="Formedit" method="POST" class="overflow-y-auto max-h-[80vh] needs-validation" novalidate
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="bg-white dark:bg-slate-800 rounded-xl border border-gray-100 dark:border-slate-700">
                <!-- Profile Header -->
                <div class="relative bg-gradient-to-r from-indigo-500 to-purple-600 h-28 flex items-end justify-center">
                    <!-- Circular Avatar -->
                    <x-photos.upload :edit="true" name="avatar" />
                </div>

                <!-- Profile Body -->
                <div class="pt-16 pb-4 px-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-2 gap-x-4">
                        <!-- Name Field -->
                        <x-fields.input :edit="true" label="Name" name="name" placeholder="Enter name"
                            :required="true" />

                        <div class="mb-2">
                            <label for="user_id"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                User Role <span class="text-red-500">*</span>
                            </label>
                            <select id="role" name="type"
                                class="form-control w-full px-3 py-2 border rounded-md focus:outline focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('user_id') border-red-500 @else border-gray-400 @enderror"
                                required>
                                <option value="">Select user Type</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}"
                                        {{ old('type') == $role->name ? 'selected' : '' }}>
                                        {{ ucfirst($role->name) }}
                                    </option>
                                @endforeach
                            </select>
                            <p id="edit-error-type" class="mt-1 text-sm text-red-600 dark:text-red-500"></p>
                            <div class="invalid-feedback text-sm text-red-600 dark:text-red-500 mt-1">
                                field user is required
                            </div>
                        </div>

                        <!-- Email Field -->
                        <x-fields.input :edit="true" type="email" label="Email" name="email"
                            placeholder="Enter email address" :required="true" />

                        <!-- Password Field (optional for edit) -->
                        <div class="mb-2">
                            <label for="edit_password"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                New Password
                            </label>
                            <input type="password" id="edit_password" name="password"
                                class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                         dark:border-gray-600 dark:text-white"
                                placeholder="Leave blank to keep current password">

                            <p id="edit-error-password" class="mt-1 text-sm text-red-600 dark:text-red-500"></p>
                        </div>
                        <!-- Password Field (optional for edit) -->
                        <div class="mb-2">
                            <label for="edit_confirm_password"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Confirm new password
                            </label>
                            <input type="password" id="edit_confirm_password" name="confirm_password"
                                class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                         dark:border-gray-600 dark:text-white"
                                placeholder="Confirm password">

                            <p id="edit_confirm_password" class="mt-1 text-sm text-red-600 dark:text-red-500"></p>
                        </div>

                        <!-- Phone Field -->
                        <x-fields.input :edit="true" type="tel" label="Phone" name="phone"
                            placeholder="Enter phone nubmer" />
                        <!-- Address Field -->
                        <div class="mb-2">
                            <label for="edit_address"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Address
                            </label>
                            <input type="text" id="edit_address" name="address"
                                class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white
                        @error('address') border-red-500 @else border-gray-400 @enderror"
                                placeholder="Enter address">

                            @error('address')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Date of Birth Field -->
                        <div class="mb-2">
                            <label for="edit_dob"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Date of Birth
                            </label>
                            <input type="date" id="edit_dob" name="date_of_birth"
                                class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">

                            @error('date_of_birth')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Gender Field -->
                        <x-fields.select :edit="true" name="gender" label="Gender" :options="['male' => 'Male', 'female' => 'Female', 'other' => 'Other']"
                            :value="old('gender', 'male')" />
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end space-x-3 p-4 border-t border-gray-200 dark:border-gray-700 mt-4">
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
