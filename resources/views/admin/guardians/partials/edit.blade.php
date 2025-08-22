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
                Edit Guardians
            </h3>
            <x-button.btnclose id="closeEditModal" />
        </div>

        <!-- Form Content -->
        <form id="Formedit" method="POST" class="overflow-y-auto max-h-[80vh] needs-validation" novalidate
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div>
                <!-- Profile Header -->
                <div class="relative bg-gradient-to-r from-indigo-500 to-purple-600 h-28 flex items-end justify-center">
                    <!-- Circular Avatar -->
                    <x-photos.upload :edit="true" name="avatar" />
                </div>

                <!-- Profile Body -->
                <div class="pt-16 pb-4 px-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-2 gap-x-4">
                        <!-- Name Field -->
                        <x-fields.input :edit="true" label="Name" name="name" placeholder="Enter name" :required="true" />
                        <!-- Email Field -->
                        <x-fields.input :edit="true" type="email" label="Email" name="email" placeholder="Enter email"
                            :required="true" max="255" />
                        <!-- Phone Number Field -->
                        <x-fields.input :edit="true" type="tel" label="Phone number" name="phone" max="20"
                            placeholder="Enter phone number" required />
                        <x-fields.input :edit="true" label="Relation" name="relation" placeholder="Enter relation name"
                            max="255" required />
                        <x-fields.input :edit="true" label="Company" name="company" placeholder="Enter company name"
                            max="255" />
                        <x-fields.input :edit="true" label="Occupation" name="occupation" placeholder="Enter occupation"
                            max="255" />
                        <!-- Address Field -->
                        <x-fields.input :edit="true" label="Address" name="address" placeholder="Enter address" required />
                        <!-- Gender Select -->
                        {{-- <x-fields.select name="gender" label="Gender" :options="['male' => 'Male', 'female' => 'Female', 'other' => 'Other']" :value="old('gender', 'male')" /> --}}
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end space-x-3 p-4 border-t border-gray-200 dark:border-gray-700 mt-4">
                <x-button.button btn-type="cancel" id="cancelEditModal">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    Cancel
                </x-button.button>
                <x-button.button btn-type="save" id="saveEditBtn" type="submit">
                    <span class="btn-content flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        Create Changes
                    </span>
                </x-button.button>
            </div>
        </form>
    </div>
</div>
