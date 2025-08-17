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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Upload Area -->
        <div id="photoUploadArea" class="relative w-full">
            <div id="dropArea"
                class="text-center w-[160px] h-[160px] mx-auto rounded-full text-[10px] flex flex-col items-center justify-center pt-5 pb-6 border-2 border-gray-300 border-dashed dark:border-gray-600 hover:border-indigo-500 dark:hover:border-indigo-400 bg-gray-50/50 dark:bg-gray-700/50 hover:bg-indigo-50/50 dark:hover:bg-indigo-900/20 transition-colors cursor-pointer">
                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                </svg>
                <p class="mb-2 text-gray-500 dark:text-gray-400">
                    <span>Click to upload</span> or drag and drop
                </p>
                <p class="text-gray-500 dark:text-gray-400">JPG, PNG (MAX. 2MB)</p>
            </div>
            <input type="file" id="photo" name="photo" class="hidden" accept="image/*">

            <!-- Cropper Modal -->
            <div id="cropModal"
                class="overflow-hidden rounded-xl fixed inset-0 z-50 flex items-center justify-center bg-black/90 backdrop-blur-lg bg-opacity-50 hidden">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-3xl p-4">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Crop Image</h3>
                        <button id="closeCropModal"
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
                                <img id="imageToCrop" class="max-w-full max-h-[60vh]" src=""
                                    alt="Image to crop">
                            </div>
                        </div>

                        <div class="md:w-64 flex flex-col gap-3">
                            <div class="preview-container overflow-hidden rounded-lg"
                                style="width: 200px; height: 200px;">
                            </div>

                            <div class="flex gap-2 mt-2">
                                <button type="button" id="rotateLeft"
                                    class="p-2 bg-gray-200 dark:bg-gray-700 rounded-md hover:bg-gray-300 dark:hover:bg-gray-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                    </svg>
                                </button>
                                <button type="button" id="rotateRight"
                                    class="p-2 bg-gray-200 dark:bg-gray-700 rounded-md hover:bg-gray-300 dark:hover:bg-gray-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 8V4m0 0h-4m4 0l-4 4m4 11v4m0 0h-4m4 0l-4-4" />
                                    </svg>
                                </button>
                                <button type="button" id="flipHorizontal"
                                    class="p-2 bg-gray-200 dark:bg-gray-700 rounded-md hover:bg-gray-300 dark:hover:bg-gray-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                                    </svg>
                                </button>
                            </div>

                            <div class="flex gap-2 mt-auto pt-4">
                                <button type="button" id="cancelCrop"
                                    class="cursor-pointer px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 flex-1">
                                    Cancel
                                </button>
                                <button type="button" id="applyCrop"
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
<!-- CV/Resume Upload -->
<div class="mb-2">
    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
        CV/Resume
    </label>
    <div class="mt-1">
        <!-- Preview Container -->
        <div id="cvPreview" class="hidden w-full">
            <div
                class="h-[155px] flex items-center p-3 border border-gray-200 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700/30">
                <div class="flex-shrink-0 p-2 bg-blue-100 dark:bg-blue-900/50 rounded-lg">
                    <svg class="size-15 text-blue-600 dark:text-blue-300" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <div class="ml-3 flex-1 min-w-0">
                    <p id="cvFileName" class="text-sm font-medium text-gray-900 dark:text-gray-100 truncate">
                        resume.pdf</p>
                    <p id="fileSize" class="text-xs text-gray-500 dark:text-gray-400">2.4 MB</p>
                </div>
                <button type="button" id="removeCv"
                    class="cursor-pointer ml-2 p-1 text-gray-400 hover:text-red-500 dark:hover:text-red-400 rounded-full hover:bg-gray-100 dark:hover:bg-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Upload Area -->
        <div id="cvDropArea"
            class="flex flex-col items-center justify-center p-6 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg hover:border-indigo-500 dark:hover:border-indigo-400 bg-gray-50/50 dark:bg-gray-700/50 hover:bg-indigo-50/50 dark:hover:bg-indigo-900/20 transition-colors cursor-pointer">
            <div class="p-3 bg-indigo-100/50 dark:bg-indigo-900/30 rounded-full mb-3">
                <svg class="w-6 h-6 text-indigo-500 dark:text-indigo-400" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                </svg>
            </div>
            <p class="text-sm text-gray-600 dark:text-gray-300 mb-1"><span class="font-medium">Click to upload</span>
                or drag and drop</p>
            <p class="text-xs text-gray-500 dark:text-gray-400">PDF, DOC, DOCX (MAX. 5MB)</p>
        </div>
        <input type="file" id="cv" name="cv" class="hidden" accept=".pdf,.doc,.docx">
    </div>
    <p class="error-cv mt-1 text-sm text-red-600"></p>
</div>

@push('scripts')
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
                photoInput.value = '';
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

            // Prevent form submission when clicking on drop area
            dropArea.addEventListener('click', (e) => {
                e.preventDefault();
                photoInput.click();
            });

            photoInput.addEventListener('change', function(e) {
                if (this.files && this.files[0]) {
                    const file = this.files[0];
                    this.value = '';
                    handleFile(file);
                }
            });

            removePhoto.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                resetPhoto();
            });

            closeCropModal.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                e.stopImmediatePropagation();
                closeCrop();
            });

            cancelCrop.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                e.stopImmediatePropagation();
                closeCrop();
            });

            applyCrop.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

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

            rotateLeft.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                cropper && cropper.rotate(-90);
            });

            rotateRight.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                cropper && cropper.rotate(90);
            });

            flipHorizontal.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                if (cropper) {
                    const scaleX = cropper.getData().scaleX || 1;
                    cropper.scaleX(-scaleX);
                }
            });

            // Prevent form submission when pressing enter in the crop modal
            document.querySelectorAll('#cropModal button').forEach(button => {
                button.addEventListener('keydown', (e) => {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>
@endpush

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css">
    <style>
        /* Ensure the cropper container has proper dimensions */
        .img-container {
            max-height: 60vh;
            width: 100%;
            overflow: hidden;
        }

        /* Cropper.js overrides */
        .cropper-view-box,
        .cropper-face {
            border-radius: 50%;
        }

        /* Preview container */
        .preview-container {
            width: 200px;
            height: 200px;
            margin: 0 auto;
            overflow: hidden;
            border: 1px solid #e5e7eb;
            border-radius: 50%;
        }

        /* Drop area styling */
        #dropArea.hidden {
            display: none;
        }

        /* Prevent body scrolling when modal is open */
        body.overflow-hidden {
            overflow: hidden;
        }
    </style>
@endpush
