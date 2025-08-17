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
            <button id="closeEditModal"
                class="text-red-400 hover:bg-red-50 dark:hover:bg-gray-700 cursor-pointer rounded-full p-1 hover:text-red-500">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Form Content -->
        <form id="Formedit" method="POST" class="overflow-y-auto max-h-[80vh] needs-validation" novalidate>
            @csrf
            @method('PUT')

            <div class="bg-white dark:bg-slate-800 rounded-xl border border-gray-100 dark:border-slate-700">
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
                    <!-- Cropper Modal (same as create page but with edit-specific IDs) -->
                    <div id="editCropModal"
                        class="overflow-hidden rounded-xl fixed inset-0 z-50 flex items-center justify-center bg-black/90 backdrop-blur-lg bg-opacity-50 hidden">
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-3xl p-4">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Crop Image</h3>
                                <button id="closeEditCropModal"
                                    class="text-red-400 hover:bg-red-50 dark:hover:bg-gray-700 cursor-pointer rounded-full p-1 hover:text-red-500">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>

                            <div class="flex flex-col md:flex-row gap-4">
                                <div class="flex-1">
                                    <div class="img-container">
                                        <img id="editImageToCrop" class="max-w-full max-h-[60vh]" src=""
                                            alt="Image to crop">
                                    </div>
                                </div>

                                <div class="md:w-64 flex flex-col gap-3">
                                    <div class="preview-container overflow-hidden rounded-lg"
                                        style="width: 200px; height: 200px;"></div>

                                    <div class="flex gap-2 mt-2">
                                        <button type="button" id="editRotateLeft"
                                            class="p-2 bg-gray-200 dark:bg-gray-700 rounded-md hover:bg-gray-300 dark:hover:bg-gray-600">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                            </svg>
                                        </button>
                                        <button type="button" id="editRotateRight"
                                            class="p-2 bg-gray-200 dark:bg-gray-700 rounded-md hover:bg-gray-300 dark:hover:bg-gray-600">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 8V4m0 0h-4m4 0l-4 4m4 11v4m0 0h-4m4 0l-4-4" />
                                            </svg>
                                        </button>
                                        <button type="button" id="editFlipHorizontal"
                                            class="p-2 bg-gray-200 dark:bg-gray-700 rounded-md hover:bg-gray-300 dark:hover:bg-gray-600">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                                            </svg>
                                        </button>
                                    </div>

                                    <div class="flex gap-2 mt-auto pt-4">
                                        <button type="button" id="cancelEditCrop"
                                            class="cursor-pointer px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 flex-1">
                                            Cancel
                                        </button>
                                        <button type="button" id="applyEditCrop"
                                            class="cursor-pointer px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 flex-1">
                                            Apply
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Profile Body -->
                <div class="pt-16 pb-5 px-5">
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
                                class="text-indigo-600 dark:text-indigo-400 text-sm hover:underline truncate w-[90%]"
                                id="cv_link"></a>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-2">

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
                            <input type="text" id="edit_experience" name="experience"
                                value="{{ old('experience') }}"
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Edit Modal Photo Upload with Cropper.js
        const editPhotoInput = document.getElementById('photo_upload');
        const editPhotoPreview = document.getElementById('edit_photo');
        const editCropModal = document.getElementById('editCropModal');
        const editImageToCrop = document.getElementById('editImageToCrop');
        const closeEditCropModal = document.getElementById('closeEditCropModal');
        const cancelEditCrop = document.getElementById('cancelEditCrop');
        const applyEditCrop = document.getElementById('applyEditCrop');
        const editRotateLeft = document.getElementById('editRotateLeft');
        const editRotateRight = document.getElementById('editRotateRight');
        const editFlipHorizontal = document.getElementById('editFlipHorizontal');

        let editCropper;
        let editOriginalImageUrl;

        // Handle file selection for edit modal
        editPhotoInput.addEventListener('change', function(e) {
            // if (this.files && this.files[0]) {
            //     handleEditFile(this.files[0]);
            // }
            if (this.files && this.files[0]) {
                const file = this.files[0];
                this.value = '';
                handleEditFile(file);
            }
        });

        // Handle file for edit modal
        function handleEditFile(file) {
            // Check if the file is an image
            if (!file.type.match('image.*')) {
                ShowTaskMessage('error', 'Please select an image file (JPG, PNG)');
                return;
            }
            // // Check file size (2MB max)
            // if (file.size > 2 * 1024 * 1024) {
            //     ShowTaskMessage('error', 'File size exceeds 2MB limit');
            //     return;
            // }

            // Create a URL for the file
            editOriginalImageUrl = URL.createObjectURL(file);

            // Show crop modal
            editImageToCrop.src = editOriginalImageUrl;
            editCropModal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');

            // Initialize cropper after image is loaded
            editImageToCrop.onload = function() {
                if (editCropper) {
                    editCropper.destroy();
                }

                editCropper = new Cropper(editImageToCrop, {
                    aspectRatio: 1,
                    viewMode: 1,
                    autoCropArea: 0.8,
                    responsive: true,
                    preview: '.preview-container',
                    guides: true,
                    center: true,
                    highlight: true,
                    cropBoxMovable: true,
                    cropBoxResizable: true,
                    toggleDragModeOnDblclick: false,
                });
            };
        }

        // Close edit crop modal and clean up
        function closeEditCrop() {
            if (editCropper) {
                editCropper.destroy();
                editCropper = null;
            }
            if (editOriginalImageUrl) {
                URL.revokeObjectURL(editOriginalImageUrl);
                editOriginalImageUrl = null;
            }
            editCropModal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
            editPhotoInput.value = ''; // Reset the input
        }

        // Event listeners for edit modal
        closeEditCropModal.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            e.stopImmediatePropagation();
            closeEditCrop();
        });

        cancelEditCrop.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            e.stopImmediatePropagation();
            closeEditCrop();
        });

        applyEditCrop.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

            if (editCropper) {
                const canvas = editCropper.getCroppedCanvas({
                    width: 300,
                    height: 300,
                    minWidth: 256,
                    minHeight: 256,
                    maxWidth: 4096,
                    maxHeight: 4096,
                    fillColor: '#fff',
                    imageSmoothingEnabled: true,
                    imageSmoothingQuality: 'high',
                });

                if (canvas) {
                    canvas.toBlob((blob) => {
                        // Update preview
                        editPhotoPreview.src = URL.createObjectURL(blob);

                        // Hide initials if shown
                        document.getElementById('edit_initials').classList.add('hidden');

                        // Create a new File object
                        const file = new File([blob], 'profile-photo.jpg', {
                            type: 'image/jpeg',
                            lastModified: Date.now()
                        });

                        // Create a new FileList and DataTransfer
                        const dataTransfer = new DataTransfer();
                        dataTransfer.items.add(file);

                        // Update the file input
                        editPhotoInput.files = dataTransfer.files;

                        // Clean up
                        if (editOriginalImageUrl) {
                            URL.revokeObjectURL(editOriginalImageUrl);
                        }
                    }, 'image/jpeg', 0.9);
                }
            }
            closeEditCrop();
        });

        editRotateLeft.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            editCropper && editCropper.rotate(-90);
        });

        editRotateRight.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            editCropper && editCropper.rotate(90);
        });

        editFlipHorizontal.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            if (editCropper) {
                const scaleX = editCropper.getData().scaleX || 1;
                editCropper.scaleX(-scaleX);
            }
        });
    });
</script>
