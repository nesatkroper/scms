<x-modal.modal id="Modalcreate" title="Create New User" class="rounded-xl w-full max-w-2xl"
    svgPath="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z">

    <!-- Form Content -->
        <form action="{{ route('admin.users.store') }}" method="POST"
            class="needs-validation overflow-y-auto max-h-[80vh]" enctype="multipart/form-data" novalidate>
            @csrf

            <div>
                <!-- Profile Header -->
                <div class="relative bg-gradient-to-r from-indigo-500 to-purple-600 h-28 flex items-end justify-center">
                    <!-- Circular Avatar -->
                    <div class="absolute -bottom-12">
                        {{-- <div
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
                        </div> --}}
                        <x-upload name="avatar" size="xl" />
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
                        <x-fields.select name="type" label="User Role" :options="$roles" :value="old('type')"
                            required="true" searchable="true" />
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
            <x-modal.footer-actions :create="true"/>
        </form>
</x-modal.modal>
