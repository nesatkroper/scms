<div class="relative">
    <!-- Main Container -->
    <div class="size-35 rounded-full border-4 border-white dark:border-slate-800 bg-white dark:bg-slate-700 shadow-lg relative"
        id="photoUploadContainer">
        <!-- Image Preview -->
        <div id="photoPreviewContainer" class="w-full h-full hidden">
            <img id="photoPreview" src="" alt="Preview" class="w-full h-full object-cover {{$rounded}}">
        </div>

        <!-- Initials Display (shown when no image) -->
        <div id="photoInitials"
            class="absolute inset-0 {{$rounded}} w-full h-full flex items-center justify-center bg-indigo-100 dark:bg-slate-600">
            <span class="text-3xl font-bold text-indigo-600 dark:text-indigo-300">
                <i class="{{$icon}} text-8xl"></i>
            </span>
        </div>

        <!-- Hidden file input -->
        <input type="file" id="photoUpload" name="{{ $name ?? 'avatar' }}" accept="image/*" class="hidden">

        <!-- Upload Button -->
        <label for="photoUpload"
            class="size-8 flex justify-center items-center absolute bottom-0 right-0 bg-white dark:bg-gray-700 p-1 rounded-full shadow cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 z-25">
            <i class="ri-camera-line text-indigo-600 dark:text-indigo-300"></i>
        </label>
    </div>

    <!-- Drag & Drop Overlay -->
    <div id="dropArea"
        class="absolute inset-0 bg-black bg-opacity-50 rounded-full flex items-center justify-center hidden z-20">
        <div class="text-white text-center p-4">
            <i class="ri-upload-cloud-2-line text-3xl mb-2"></i>
            <p>Drop your photo here</p>
        </div>
    </div>
</div>

<!-- Cropper Modal -->
<div id="cropModal"
    class="fixed inset-0 z-50 flex items-center justify-center rounded-xl bg-black bg-opacity-75 hidden">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-3xl p-4">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">Crop Your Image</h3>
            <button id="closeCropModal"
                class="text-gray-500 hover:text-gray-700 dark:text-gray-300 dark:hover:text-gray-100">
                <i class="ri-close-line text-2xl"></i>
            </button>
        </div>
        <div class="cropper-container w-full h-[60vh]">
            <img id="imageToCrop" src="" alt="" style="max-height: 60vh;">
        </div>
        <div class="flex justify-end space-x-3 mt-4">
            <button type="button" id="cancelCrop"
                class="px-4 py-2 text-gray-600 dark:text-gray-300 hover:text-gray-800 dark:hover:text-gray-100">
                Cancel
            </button>
            <button type="button" id="cropImageBtn"
                class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                Crop & Save
            </button>
        </div>
    </div>
</div>
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/cropperjs1.5.12.min.css') }}">
    <style>
        .cropper-view-box,
        .cropper-face {
            border-radius: 50%;
        }

        #dropArea {
            transition: all 0.3s ease;
        }

        .cropper-modal {
            background-color: rgba(0, 0, 0, 0.5);
        }
    </style>
@endpush
@push('scripts')
    <script src="{{ asset('assets/js/cropperjs1.5.12.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // DOM Elements
            const photoUpload = document.getElementById('photoUpload');
            const photoPreviewContainer = document.getElementById('photoPreviewContainer');
            const photoPreview = document.getElementById('photoPreview');
            const photoInitials = document.getElementById('photoInitials');
            const dropArea = document.getElementById('dropArea');
            const photoContainer = document.getElementById('photoUploadContainer');
            const cropModal = document.getElementById('cropModal');
            const imageToCrop = document.getElementById('imageToCrop');
            const closeCropModal = document.getElementById('closeCropModal');
            const cancelCrop = document.getElementById('cancelCrop');
            const cropImageBtn = document.getElementById('cropImageBtn');
            let cropper;
            let currentFile;

            // Prevent default drag behaviors
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                photoContainer.addEventListener(eventName, preventDefaults, false);
                document.body.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            // Highlight drop area when item is dragged over it
            ['dragenter', 'dragover'].forEach(eventName => {
                photoContainer.addEventListener(eventName, highlight, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                photoContainer.addEventListener(eventName, unhighlight, false);
            });

            function highlight() {
                dropArea.classList.remove('hidden');
            }

            function unhighlight() {
                dropArea.classList.add('hidden');
            }

            // Handle dropped files
            photoContainer.addEventListener('drop', handleDrop, false);

            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;

                if (files.length) {
                    currentFile = files[0];
                    handleImageUpload(currentFile);
                }
            }

            // Handle file selection via input
            photoUpload.addEventListener('change', function(e) {
                if (this.files && this.files.length) {
                    currentFile = this.files[0];
                    handleImageUpload(currentFile);
                }
            });

            // Process the uploaded image
            function handleImageUpload(file) {
                if (!file.type.match('image.*')) {
                    ShowTaskMessage('error', 'Please select an image file (JPEG, PNG, etc.)');
                    return;
                }
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Show crop modal with the image
                    imageToCrop.src = e.target.result;
                    cropModal.classList.remove('hidden');
                    // Initialize cropper
                    if (cropper) {
                        cropper.destroy();
                    }
                    cropper = new Cropper(imageToCrop, {
                        aspectRatio: 1,
                        viewMode: 1,
                        autoCropArea: 0.8,
                        responsive: true,
                        guides: true,
                        movable: true,
                        zoomable: true,
                        rotatable: true,
                        scalable: true,
                    });
                };
                reader.readAsDataURL(file);
            }
            // Crop image button
            cropImageBtn.addEventListener('click', function() {
                if (cropper) {
                    // Get the cropped canvas
                    const canvas = cropper.getCroppedCanvas({
                        width: 400,
                        height: 400,
                        minWidth: 100,
                        minHeight: 100,
                        maxWidth: 800,
                        maxHeight: 800,
                        fillColor: '#fff',
                        imageSmoothingEnabled: true,
                        imageSmoothingQuality: 'high',
                    });

                    if (canvas) {
                        // Convert canvas to blob
                        canvas.toBlob(function(blob) {
                            // Create a new file from the blob
                            const croppedFile = new File([blob], currentFile.name, {
                                type: 'image/jpeg',
                                lastModified: Date.now()
                            });
                            // Create a new data transfer object
                            const dataTransfer = new DataTransfer();
                            dataTransfer.items.add(croppedFile);

                            // Update the file input
                            photoUpload.files = dataTransfer.files;

                            // Update the preview
                            photoPreview.src = URL.createObjectURL(croppedFile);
                            photoPreviewContainer.classList.remove('hidden');
                            photoInitials.classList.add('hidden');

                            // Close the crop modal
                            cropModal.classList.add('hidden');
                            cropper.destroy();
                        }, 'image/jpeg', 0.9);
                    }
                }
            });

            function closeCrop() {
                cropModal.classList.add('hidden');
                if (cropper) {
                    cropper.destroy();
                    cropper = null;
                }
                // Reset file input
                photoUpload.value = '';
            }
            // Close crop modal
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
        });
    </script>
@endpush
