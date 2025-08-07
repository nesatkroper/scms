<!-- Create User Modal -->
<div id="Modalcreate" class="fixed inset-0 z-50 flex items-center justify-center p-4 hidden">
    <div
        class="relative bg-white dark:bg-gray-800 rounded-xl shadow-2xl w-full max-w-2xl transform transition-all duration-300 opacity-0 scale-95 border border-gray-200 dark:border-gray-600">
        <!-- Header -->
        <div class="flex justify-between items-center p-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="size-8 p-1 rounded-full bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"
                    viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                        clip-rule="evenodd" />
                </svg>
                Create New User
            </h3>
            <button id="closeCreateModal"
                class="text-red-400 hover:bg-red-50 dark:hover:bg-gray-700 cursor-pointer rounded-full p-1 hover:text-red-500">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Form Content -->
        <form action="{{ route('admin.users.store') }}" method="POST"
            class="needs-validation overflow-y-auto max-h-[80vh]" enctype="multipart/form-data" novalidate>
            @csrf

            <div>
                <!-- Profile Header -->
                <div class="relative bg-gradient-to-r from-indigo-500 to-purple-600 h-28 flex items-end justify-center">
                    <!-- Circular Avatar -->
                    <div class="absolute -bottom-12">
                        <div
                            class="size-35 rounded-full border-4 border-white dark:border-slate-800 bg-white dark:bg-slate-700 shadow-lg relative">
                            <img id="create_avatar_preview" src="" alt=""
                                class="w-full h-full object-cover rounded-full hidden">
                            <div id="create_initials"
                                class="absolute inset-0 rounded-full w-full h-full flex items-center justify-center bg-indigo-100 dark:bg-slate-600">
                                <span class="text-3xl font-bold text-indigo-600 dark:text-indigo-300"><i
                                        class="ri-account-circle-fill text-8xl"></i></span>
                            </div>
                            <input type="file" id="avatar_upload" name="avatar" accept="image/*" class="hidden">
                            <label for="avatar_upload"
                                class="size-8 flex justify-center items-center absolute bottom-0 right-0 bg-white dark:bg-gray-700 p-1 rounded-full shadow cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-6009">
                                <i class="ri-camera-line text-indigo-600 dark:text-indigo-300"></i>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Profile Body -->
                <div class="pt-16 pb-4 px-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-2 gap-x-4">
                        <!-- Name Field -->
                        <x-fields.input label="Name" name="name" placeholder="Enter name" :required="true" />
                        <!-- Email Field -->
                        <x-fields.input type="email" label="Email" name="email" placeholder="Enter email"
                            :required="true" />
                        <!-- Password Field -->
                        <x-fields.input type="password" label="Password" name="password" placeholder="Enter password"
                            :required="true" />
                        <!-- Confirm Password Field -->
                        <x-fields.input type="password" label="Confirm Password" name="password_confirmation"
                            placeholder="Enter Confirm password" :required="true" />
                        <!-- User Role Select (Searchable) -->
                        <x-fields.select name="type" label="User Role" :options="$roles" 
                        :value="old('type')" required="true" searchable="true" />
                        <!-- Phone Number Field -->
                        <x-fields.input type="tel" label="Phone number" name="phone"
                            placeholder="Enter phone number" />
                        <!-- Address Field -->
                        <x-fields.input label="Address" name="address" placeholder="Enter address" />
                        <!-- Date of Birth Field -->
                        <x-fields.input type="date" label="Date of Birth" name="date_of_birth"
                            placeholder="Enter Date of Birth" />
                        <!-- Gender Select (Non-searchable) -->
                        <x-fields.select name="gender" label="Gender" :options="['male' => 'Male', 'female' => 'Female', 'other' => 'Other']" :value="old('gender', 'male')" />
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end space-x-3 p-4 border-t border-gray-200 dark:border-gray-700 mt-4">
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
                    class="px-4 py-2 cursor-pointer bg-indigo-600 text-white rounded-md hover:bg-indigo-700 flex items-center gap-2 transition-colors">
                    <span class="btn-content flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        Create User
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Avatar preview for create modal
        const avatarUpload = document.getElementById('avatar_upload');
        const avatarPreview = document.getElementById('create_avatar_preview');
        const initialsPreview = document.getElementById('create_initials');

        avatarUpload.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    avatarPreview.src = e.target.result;
                    avatarPreview.classList.remove('hidden');
                    initialsPreview.classList.add('hidden');
                }
                reader.readAsDataURL(file);
            }
        });
    });
</script>
