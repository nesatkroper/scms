<!-- Edit Modal -->
<x-modal.modal id="Modaledit" title="Edit User Profile" svgClass="rounded-md" fill="none" stroke="currentColor"
    viewBox="0 0 24 24" class="rounded-xl w-full max-w-2xl"
    svgPath="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
    <!-- Form Content -->
    <form id="Formedit" method="POST" class="overflow-y-auto max-h-[80vh] needs-validation" novalidate
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
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
                    <label for="user_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        User Role <span class="text-red-500">*</span>
                    </label>
                    <select id="role" name="type"
                        class="form-control w-full px-3 py-2 border rounded-md focus:outline focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('user_id') border-red-500 @else border-gray-400 @enderror"
                        required>
                        <option value="">Select user Type</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}" {{ old('type') == $role->name ? 'selected' : '' }}>
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

                {{-- <!-- Password Field (optional for edit) -->
                <x-fields.input :edit="true" type="password" label="New Password" name="password"
                    placeholder="Leave blank to keep current password" :required="true" />
                <!-- Password Field (optional for edit) -->
                <x-fields.input :edit="true" type="password" label="Confirm new password" name="confirm_password"
                    placeholder="Confirm password" :required="true" /> --}}
                <!-- Phone Field -->
                <x-fields.input :edit="true" type="tel" label="Phone" name="phone"
                    placeholder="Enter phone nubmer" />
                <x-fields.input :edit="true" type="tel" label="Address" name="address"
                    placeholder="Enter address" />
                <!-- Date of Birth Field -->
                <x-fields.input :edit="true" type="date" label="Date of Birth" name="dob" />
                <!-- Gender Field -->
                <x-fields.select :edit="true" name="gender" label="Gender" :options="['male' => 'Male', 'female' => 'Female', 'other' => 'Other']" :value="old('gender', 'male')" />
            </div>
        </div>
        <!-- Form Actions -->
        <x-modal.footer-actions :edit="true" />
    </form>
</x-modal.modal>
