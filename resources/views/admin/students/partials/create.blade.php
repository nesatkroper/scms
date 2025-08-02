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
        <form action="{{ route('admin.students.store') }}" method="POST" class="py-4" enctype="multipart/form-data">
            @csrf

            <div class="h-[65vh] md:h-[75vh] overflow-y-auto px-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-2">
                    <div class="mb-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Profile Photo
                        </label>
                        <div>
                            <!-- Preview Container -->
                            <div id="photoPreview" class="hidden mr-4 w-full h-full relative">
                                <img id="photoPreviewImage"
                                    class="h-40 w-40 m-auto cursor-pointer rounded-full object-cover border-2 border-gray-300 dark:border-gray-600"
                                    src="" alt="Profile preview">
                                <button type="button" id="removePhoto"
                                    class="cursor-pointer absolute mt-[-1rem] ml-[8rem] p-1 bg-red-500 rounded-full text-white hover:bg-red-600">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>

                            <!-- Upload Area -->
                            <div id="photoUploadArea" class="relative w-full">
                                <div id="dropArea"
                                    class="text-center w-[160px] h-[160px] mx-auto rounded-full text-[10px] flex flex-col items-center justify-center pt-5 pb-6 border-2 border-gray-300 border-dashed dark:border-gray-600 hover:border-indigo-500 dark:hover:border-indigo-400 bg-gray-50/50 dark:bg-gray-700/50 hover:bg-indigo-50/50 dark:hover:bg-indigo-900/20 transition-colors cursor-pointer">
                                    <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                    </svg>
                                    <p class="mb-2 text-gray-500 dark:text-gray-400">
                                        <span>Click to upload</span> or drag and drop
                                    </p>
                                    <p class=" text-gray-500 dark:text-gray-400">JPG, PNG (MAX. 2MB)</p>
                                </div>
                                <input type="file" id="photo" name="photo" class="hidden" accept="image/*">
                                <!-- Cropper Modal (hidden by default) -->
                                <div id="cropModal"
                                    class="overflow-hidden rounded-xl fixed inset-0 z-50 flex items-center justify-center bg-black/90 backdrop-blur-lg bg-opacity-50 hidden">
                                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-3xl p-4">
                                        <div class="flex justify-between items-center mb-4">
                                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Crop
                                                Image</h3>
                                            <button id="closeCropModal"
                                                class="cursor-pointer text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">
                                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>

                                        <div class="flex flex-col md:flex-row gap-4">
                                            <div class="flex-1">
                                                <div class="img-container">
                                                    <img id="imageToCrop" class="max-w-full max-h-[60vh]" src=""
                                                        alt="Image to crop">
                                                </div>
                                            </div>

                                            <div class="md:w-64 flex flex-col gap-3">
                                                <div class="preview-container overflow-hidden rounded-lg"
                                                    style="width: 200px; height: 200px;">
                                                </div>

                                                <div class="flex gap-2 mt-2">
                                                    <button id="rotateLeft"
                                                        class="p-2 bg-gray-200 dark:bg-gray-700 rounded-md hover:bg-gray-300 dark:hover:bg-gray-600">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                                        </svg>
                                                    </button>
                                                    <button id="rotateRight"
                                                        class="p-2 bg-gray-200 dark:bg-gray-700 rounded-md hover:bg-gray-300 dark:hover:bg-gray-600">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M17 8V4m0 0h-4m4 0l-4 4m4 11v4m0 0h-4m4 0l-4-4" />
                                                        </svg>
                                                    </button>
                                                    <button id="flipHorizontal"
                                                        class="p-2 bg-gray-200 dark:bg-gray-700 rounded-md hover:bg-gray-300 dark:hover:bg-gray-600">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                                                        </svg>
                                                    </button>
                                                </div>

                                                <div class="flex gap-2 mt-auto pt-4">
                                                    <button id="cancelCrop"
                                                        class="cursor-pointer px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 flex-1">
                                                        Cancel
                                                    </button>
                                                    <button id="applyCrop"
                                                        class="cursor-pointer px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 flex-1">
                                                        Apply
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="error-photo mt-1 text-sm text-red-600"></p>
                    </div>

                    <!-- Empty column to maintain layout -->
                    <div class="mb-2">
                        <!-- Personal Information -->
                        <div class="mb-2">
                            <label for="name"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Full Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}"
                                class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('name') border-red-500 @else border-gray-400 @enderror"
                                placeholder="Enter full name" required>
                            <p class="error-name mt-1 text-sm text-red-600"></p>
                        </div>

                        <div class="mb-2">
                            <label for="gender"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Gender <span class="text-red-500">*</span>
                            </label>
                            <select id="gender" name="gender"
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

                        <div class="mb-2">
                            <label for="dob"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Date of Birth <span class="text-red-500">*</span>
                            </label>
                            <input type="date" id="dob" name="dob" value="{{ old('dob') }}"
                                class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                required>
                            <p class="error-dob mt-1 text-sm text-red-600"></p>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-2">
                    <div class="mb-2">
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Email
                        </label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('email') border-red-500 @else border-gray-400 @enderror"
                            placeholder="Enter email address">
                        <p class="error-email mt-1 text-sm text-red-600"></p>
                    </div>

                    <div class="mb-2">
                        <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Phone
                        </label>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                            class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('phone') border-red-500 @else border-gray-400 @enderror"
                            placeholder="Enter phone number">
                        <p class="error-phone mt-1 text-sm text-red-600"></p>
                    </div>

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

                    <div class="mb-2">
                        <label for="user_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            User Account
                        </label>
                        <select id="user_id" name="user_id"
                            class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('user_id') border-red-500 @else border-gray-400 @enderror">
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
                        <label for="blood_group"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Blood group
                        </label>
                        <input type="text" id="blood_group" name="blood_group" value="{{ old('blood_group') }}"
                            class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white focus:ring-2 focus:ring-indigo-500
                             focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('phone') border-red-500 @else border-gray-400 @enderror"
                            placeholder="Enter blood group">
                        <p class="error-blood_group mt-1 text-sm text-red-600"></p>
                    </div>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // =============================================
        // Photo Upload with Cropper.js Functionality
        // =============================================

        // Elements
        const photoInput = document.getElementById('photo');
        const dropArea = document.getElementById('dropArea');
        const photoPreview = document.getElementById('photoPreview');
        const photoPreviewImage = document.getElementById('photoPreviewImage');
        const removePhoto = document.getElementById('removePhoto');
        const cropModal = document.getElementById('cropModal');
        const imageToCrop = document.getElementById('imageToCrop');
        const closeCropModal = document.getElementById('closeCropModal');
        const cancelCrop = document.getElementById('cancelCrop');
        const applyCrop = document.getElementById('applyCrop');
        const rotateLeft = document.getElementById('rotateLeft');
        const rotateRight = document.getElementById('rotateRight');
        const flipHorizontal = document.getElementById('flipHorizontal');

        let cropper;
        let originalImageUrl;

        // Prevent default drag behaviors
        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        // Highlight drop area when item is dragged over it
        function highlight() {
            dropArea.classList.add('border-indigo-500', 'bg-indigo-50', 'dark:bg-indigo-900');
        }

        function unhighlight() {
            dropArea.classList.remove('border-indigo-500', 'bg-indigo-50', 'dark:bg-indigo-900');
        }

        photoPreviewImage.addEventListener('click', function() {
            // Only proceed if there's an image loaded
            if (photoPreviewImage.src && photoInput.files.length > 0) {
                // Create a new File object from the current image
                const file = photoInput.files[0];
                originalImageUrl = URL.createObjectURL(file);

                // Show crop modal
                imageToCrop.src = originalImageUrl;
                cropModal.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');

                // Initialize cropper after image is loaded
                imageToCrop.onload = function() {
                    if (cropper) {
                        cropper.destroy();
                    }

                    cropper = new Cropper(imageToCrop, {
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
        });

        // Handle dropped files
        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;

            if (files.length > 0) {
                handleFile(files[0]);
            }
        }

        // Handle file selection
        function handleFile(file) {
            // Check if the file is an image
            if (!file.type.match('image.*')) {
                showAlert('Please select an image file (JPG, PNG)');
                return;
            }

            // Check file size (2MB max)
            if (file.size > 2 * 1024 * 1024) {
                showAlert('File size exceeds 2MB limit');
                return;
            }

            // Create a URL for the file
            originalImageUrl = URL.createObjectURL(file);

            // Show crop modal
            imageToCrop.src = originalImageUrl;
            cropModal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');

            // Initialize cropper after image is loaded
            imageToCrop.onload = function() {
                if (cropper) {
                    cropper.destroy();
                }

                cropper = new Cropper(imageToCrop, {
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

        // Close crop modal and clean up
        function closeCrop() {
            if (cropper) {
                cropper.destroy();
                cropper = null;
            }
            if (originalImageUrl) {
                URL.revokeObjectURL(originalImageUrl);
                originalImageUrl = null;
            }
            cropModal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        // Reset photo input and preview
        function resetPhoto() {
            photoInput.value = '';
            photoPreview.classList.add('hidden');
            dropArea.classList.remove('hidden');
            if (photoPreviewImage.src) {
                URL.revokeObjectURL(photoPreviewImage.src);
                photoPreviewImage.src = '';
            }
        }

        // Show alert message
        function showAlert(message) {
            const alertDiv = document.createElement('div');
            alertDiv.className =
                'fixed top-4 right-4 bg-red-500 text-white px-4 py-2 rounded-md shadow-lg z-50';
            alertDiv.textContent = message;
            document.body.appendChild(alertDiv);

            setTimeout(() => {
                alertDiv.classList.add('opacity-0', 'transition-opacity', 'duration-300');
                setTimeout(() => {
                    document.body.removeChild(alertDiv);
                }, 300);
            }, 3000);
        }

        // Event listeners for photo upload
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, preventDefaults, false);
            document.body.addEventListener(eventName, preventDefaults, false);
        });

        ['dragenter', 'dragover'].forEach(eventName => {
            dropArea.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, unhighlight, false);
        });

        dropArea.addEventListener('drop', handleDrop, false);
        dropArea.addEventListener('click', () => photoInput.click());
        photoInput.addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                handleFile(this.files[0]);
            }
        });

        removePhoto.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            resetPhoto();
        });

        closeCropModal.addEventListener('click', function(e) {
            e.stopPropagation(); // Prevent event from bubbling up
            closeCrop();
        });

        cancelCrop.addEventListener('click', function(e) {
            e.stopPropagation(); // Prevent event from bubbling up
            closeCrop();
        });

        applyCrop.addEventListener('click', function() {
            if (cropper) {
                const canvas = cropper.getCroppedCanvas({
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
                        // Create a new File object
                        const file = new File([blob], 'profile-photo.jpg', {
                            type: 'image/jpeg',
                            lastModified: Date.now()
                        });

                        // Create a new FileList and DataTransfer
                        const dataTransfer = new DataTransfer();
                        dataTransfer.items.add(file);

                        // Update the file input
                        const photoInput = document.getElementById('photo');
                        photoInput.files = dataTransfer.files;

                        // Update preview
                        photoPreviewImage.src = URL.createObjectURL(blob);
                        photoPreview.classList.remove('hidden');
                        dropArea.classList.add('hidden');

                        // Clean up
                        if (originalImageUrl) {
                            URL.revokeObjectURL(originalImageUrl);
                        }
                    }, 'image/jpeg', 0.9);
                }
            }
            closeCrop();
        });

        rotateLeft.addEventListener('click', () => cropper && cropper.rotate(-90));
        rotateRight.addEventListener('click', () => cropper && cropper.rotate(90));
        flipHorizontal.addEventListener('click', () => {
            if (cropper) {
                const scaleX = cropper.getData().scaleX || 1;
                cropper.scaleX(-scaleX);
            }
        });

        // =============================================
        // Modal Cleanup
        // =============================================

        function cleanupModals() {
            if (cropper) {
                cropper.destroy();
                cropper = null;
            }
            if (originalImageUrl) {
                URL.revokeObjectURL(originalImageUrl);
                originalImageUrl = null;
            }
            resetPhoto();
        }

        document.getElementById('closeCreateModal').addEventListener('click', cleanupModals);
        document.getElementById('cancelCreateModal').addEventListener('click', cleanupModals);

        // Form submission handler
        document.querySelector('form').addEventListener('submit', function(e) {
            e.preventDefault();
            const form = this;
            const submitBtn = document.getElementById('createSubmitBtn');
            const originalBtnHtml = submitBtn.innerHTML;

            submitBtn.disabled = true;
            submitBtn.innerHTML = `
                <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Processing...
            `;

            // Create FormData object
            const formData = new FormData(form);

            // Add CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

            fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(err => {
                            throw err;
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        // Reset form and close modal
                        form.reset();
                        closeModal('Modalcreate');
                        ShowTaskMessage('success', data.message);
                        // Reset photo preview
                        document.getElementById('photoPreview').classList.add('hidden');
                        document.getElementById('dropArea').classList.remove('hidden');
                        // Refresh content
                        refreshTeacherContent();
                    } else {
                        ShowTaskMessage('error', data.message || 'Error creating teacher');
                    }
                })
                .catch(error => {
                    if (error.errors) {
                        // Display validation errors
                        Object.keys(error.errors).forEach(field => {
                            const errorElement = document.querySelector(`.error-${field}`);
                            if (errorElement) {
                                errorElement.textContent = error.errors[field][0];
                            }
                        });
                    } else {
                        ShowTaskMessage('error', error.message || 'Error creating teacher');
                    }
                })
                .finally(() => {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnHtml;
                });
        });
    });
</script>
