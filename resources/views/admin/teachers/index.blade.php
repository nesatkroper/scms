@extends('layouts.admin')
@section('title', 'Teachers')
@section('content')
    <div
        class="box px-2 py-4 md:p-4 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">
        <h3 class="text-lg mb-3 font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
            <svg class="size-8 p-1 rounded-full bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"
                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path
                    d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
            </svg>
            Teachers List
        </h3>
        <div
            class="p-2 md:flex gap-2 justify-between items-center border rounded-md border-gray-200 dark:border-gray-700 bg-violet-50 dark:bg-slate-800">
            <button id="openCreateModal"
                class="text-nowrap px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 cursor-pointer transition-colors flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                        clip-rule="evenodd" />
                </svg>
                Create New
            </button>
            <div class="flex items-center mt-3 md:mt-0 gap-2">
                <div class="relative w-full">
                    <input type="search" id="searchInput" placeholder="Search teacher..."
                        class="w-full border border-gray-300 dark:border-gray-500 dark:bg-gray-700 text-sm rounded-lg pl-8 pr-2 py-1.5 
            focus:outline-none focus:ring-2 focus:ring-indigo-500 text-gray-800 dark:text-gray-100">
                    <i class="fas fa-search absolute left-2.5 top-2.5 text-gray-400 text-xs"></i>
                </div>
                <button id="resetSearch"
                    class="p-2 h-8 w-8 flex items-center justify-center cursor-pointer bg-indigo-100 dark:bg-indigo-700 hover:bg-gray-300 dark:hover:bg-indigo-600 rounded-md transition-colors">
                    <i class="ri-reset-right-line text-indigo-600 dark:text-gray-300 text-xl"></i>
                </button>
                <div
                    class="switchtab flex items-center gap-1 dark:bg-gray-700 p-1 border border-gray-200 dark:border-gray-500 rounded-lg">
                    <button id="listViewBtn"
                        class="p-2 size-6 flex items-center justify-center cursor-pointer bg-indigo-100 dark:bg-indigo-700 hover:bg-indigo-200 dark:hover:bg-indigo-600 rounded-md transition-colors">
                        <i class="ri-list-check text-xl text-indigo-600 dark:text-indigo-300"></i>
                    </button>
                    <button id="cardViewBtn"
                        class="p-2 size-6 flex items-center justify-center cursor-pointer bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-md transition-colors">
                        <i class="ri-grid-fill text-xl text-indigo-600 dark:text-indigo-300"></i>
                    </button>
                </div>
            </div>
        </div>
        <div id="TableContainer" class="table-respone overflow-x-auto h-[60vh]">
            @include('admin.teachers.partials.table', ['teachers' => $teachers])
        </div>
        <div id="CardContainer" class="hidden my-5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
            @include('admin.teachers.partials.cardlist', ['teachers' => $teachers])
        </div>
        {{-- pagination --}}
        @include('admin.teachers.partials.pagination')
    </div>

    <!-- Modal Backdrop -->
    <div id="modalBackdrop" class="fixed inset-0 bg-black/50 z-40 hidden backdrop-blur-sm"></div>

    @include('admin.teachers.partials.create')
    @include('admin.teachers.partials.edit')
    @include('admin.teachers.partials.detail')
    <x-modal.confirmdelete title="Teacher" />
    @include('admin.teachers.partials.bulkedit')
    @include('admin.teachers.partials.bulkdelete')

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Core Configuration
            $.ajaxSetup({
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    // 'Accept': 'application/json'
                }
            });

            selectfields();

            function selectfields() {
                document.querySelectorAll('.custom-select').forEach(select => {
                    const header = select.querySelector('.select-header');
                    const optionsBox = select.querySelector('.select-options');
                    const searchInput = select.querySelector('.search-input');
                    const optionsContainer = select.querySelector('.options-container');
                    const selectedValue = select.querySelector('.selected-value');
                    const noResults = select.querySelector('.no-results');
                    const options = Array.from(select.querySelectorAll('.select-option'));
                    const hiddenInput = document.querySelector(`input[name="${select.dataset.name}"]`);

                    // Toggle dropdown
                    header.addEventListener('click', function() {
                        select.classList.toggle('open');
                        if (select.classList.contains('open')) {
                            searchInput.focus();
                        }
                    });

                    // Filter options
                    searchInput.addEventListener('input', function() {
                        const term = this.value.toLowerCase().trim();
                        let hasMatch = false;

                        options.forEach(option => {
                            if (option.textContent.toLowerCase().includes(term)) {
                                option.style.display = 'block';
                                hasMatch = true;
                            } else {
                                option.style.display = 'none';
                            }
                        });

                        noResults.style.display = hasMatch ? 'none' : 'block';
                    });

                    // Select option
                    options.forEach(option => {
                        option.addEventListener('click', function() {
                            options.forEach(opt => opt.classList.remove('selected'));
                            this.classList.add('selected');
                            selectedValue.textContent = this.textContent;
                            hiddenInput.value = this.dataset.value;
                            select.classList.remove('open');
                            console.log('Selected department_id:', this.dataset.value);
                        });
                    });

                    // Close when clicking outside
                    document.addEventListener('click', function(e) {
                        if (!select.contains(e.target)) {
                            select.classList.remove('open');
                        }
                    });
                });
            }

            // DOM Elements
            const backdrop = document.getElementById('modalBackdrop');
            const searchInput = $('#searchInput');
            const resetSearch = $('#resetSearch');
            const listViewBtn = $('#listViewBtn');
            const cardViewBtn = $('#cardViewBtn');
            const tableContainer = $('#TableContainer');
            const cardContainer = $('#CardContainer');

            const selectAllCheckbox = $('#selectAllCheckbox');
            const bulkActionsBar = $('#bulkActionsBar');
            const selectedCount = $('#selectedCount');
            const deselectAllBtn = $('#deselectAll');
            const bulkEditBtn = $('#bulkEditBtn');
            const bulkDeleteBtn = $('#bulkDeleteBtn');

            const openCreateBtn = document.getElementById('openCreateModal');
            if (openCreateBtn) {
                openCreateBtn.addEventListener('click', function() {
                    showModal('Modalcreate');
                });
            }

            $('#closeBulkEditModal, #cancelBulkEditModal').on('click', function() {
                closeModal('bulkEditModal');
            });

            // View Management
            function setView(viewType) {
                if (viewType === 'list') {
                    listViewBtn.addClass('bg-indigo-100 dark:bg-indigo-700').removeClass(
                        'bg-gray-100 dark:bg-gray-700');
                    cardViewBtn.addClass('bg-gray-100 dark:bg-gray-700').removeClass(
                        'bg-indigo-100 dark:bg-indigo-700');
                    tableContainer.removeClass('hidden');
                    cardContainer.addClass('hidden');
                } else {
                    cardViewBtn.addClass('bg-indigo-100 dark:bg-indigo-700').removeClass(
                        'bg-gray-100 dark:bg-gray-700');
                    listViewBtn.addClass('bg-gray-100 dark:bg-gray-700').removeClass(
                        'bg-indigo-100 dark:bg-indigo-700');
                    tableContainer.addClass('hidden');
                    cardContainer.removeClass('hidden');
                }
                localStorage.setItem('viewitem', viewType);
            }

            // Search and Pagination
            function searchData(searchTerm) {
                const currentView = localStorage.getItem('viewitem') || 'table';
                $.ajax({
                    url: "{{ route('admin.teachers.index') }}",
                    method: 'GET',
                    data: {
                        search: searchTerm,
                        view: currentView
                    },
                    success: function(response) {
                        if (response.success) {
                            tableContainer.html(response.html.table);
                            cardContainer.html(response.html.cards);
                            $('.pagination').html(response.html.pagination);
                            attachRowEventHandlers();
                            updateBulkActionsBar();
                        } else {
                            ShowTaskMessage('error', 'Failed to load data');
                        }
                    },
                    error: function(xhr) {
                        console.error('Search failed:', xhr.responseText);
                        ShowTaskMessage('error', 'Failed to load data');
                    }
                });
            }

            function handleCreateSubmit(e) {
                e.preventDefault();
                const form = $(this);
                const submitBtn = $('#createSubmitBtn');
                const originalBtnHtml = submitBtn.html();
                submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i> Saving...');

                // Create FormData object for file uploads
                const formData = new FormData(form[0]);

                $.ajax({
                    url: form.attr('action'),
                    method: 'POST',
                    processData: false,
                    contentType: false,
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            closeModal('Modalcreate');
                            ShowTaskMessage('success', response.message);
                            refreshTeacherContent();
                            form.trigger('reset');
                            // Reset photo preview
                            $('#photoPreview').addClass('hidden');
                            $('#dropArea').removeClass('hidden');
                            // Reset CV preview
                            $('#cvFileName').addClass('hidden');
                            $('#removeCv').addClass('hidden');
                            $('#cvDropArea').removeClass('hidden');
                        } else {
                            ShowTaskMessage('error', response.message || 'Error creating teacher');
                        }
                    },
                    error: function(xhr) {
                        // const errors = xhr.responseJSON?.errors || {};
                        // let errorMessages = Object.values(errors).flat().join('\n');
                        // ShowTaskMessage('error', errorMessages || 'Error creating teacher');
                        console.log(xhr.responseJSON.errors); // This will show validation errors
                        // Display errors to user
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            for (const field in errors) {
                                console.log(errors[field][0]);
                                ShowTaskMessage('error', `${field}: ${errors[field][0]}`);
                            }
                        }
                    },

                    complete: function() {
                        submitBtn.prop('disabled', false).html(originalBtnHtml);
                    }
                });
            }

            function handleEditClick(e) {
                e.preventDefault();
                const editBtn = $(this);
                const originalContent = editBtn.html();
                editBtn.html('<i class="fas fa-spinner fa-spin"></i><span class="ml-2 textnone">Loading...</span>')
                    .prop('disabled', true);

                const teacherId = $(this).data('id');

                $.get(`/admin/teachers/${teacherId}`)
                    .done(function(response) {
                        if (response.success && response.teacher) {
                            const teacher = response.teacher;
                            const date = teacher.joining_date ? teacher.joining_date.substring(0, 10) : '';
                            const datedob = teacher.dob ? teacher.dob.substring(0, 10) : '';
                            // Set form values
                            console.log(teacher)
                            $('#edit_name').val(teacher.name);
                            $('#edit_user').val(teacher.user_id);
                            $('#edit_phone').val(teacher.phone);
                            $('#edit_email').val(teacher.email);
                            $('#edit_gender').val(teacher.gender);
                            $('#edit_dob').val(datedob);
                            $('#edit_teacher_id').val(teacher.teacher_id);
                            $('#edit_depid').val(teacher.department_id);
                            $('#edit_joining_date').val(date);
                            $('#edit_qualification').val(teacher.qualification);
                            $('#edit_specialization').val(teacher.specialization);
                            $('#edit_salary').val(teacher.salary);
                            $('#edit_address').val(teacher.address);
                            $('#edit_experience').val(teacher.experience);

                            // Handle photo display
                            if (teacher.photo) {
                                $('#edit_photo').attr('src', '/' + teacher.photo).removeClass('hidden');
                                $('#edit_initials').addClass('hidden');
                            } else {
                                $('#edit_photo').addClass('hidden');
                                const initials = teacher.name.split(' ').map(n => n[0]).join('').toUpperCase();
                                $('#edit_initials').removeClass('hidden').find('span').text(initials);
                            }

                            // Handle CV display
                            if (teacher.cv) {
                                $('#current_cv').removeClass('hidden');
                                $('#cv_link').attr('href', '/storage/' + teacher.cv).text(teacher.cv.split('/')
                                    .pop());
                            } else {
                                $('#current_cv').addClass('hidden');
                            }

                            // Set form action
                            $('#Formedit').attr('action', `/teachers/${teacherId}`);
                            showModal('Modaledit');
                        } else {
                            ShowTaskMessage('error', response.message || 'Failed to load teacher data');
                        }
                    })
                    .fail(function(xhr) {
                        console.error('Error:', xhr.responseText);
                        ShowTaskMessage('error', 'Failed to load teacher data');
                    })
                    .always(function() {
                        editBtn.html(originalContent).prop('disabled', false);
                    });
            }

            function handleEditSubmit(e) {
                e.preventDefault();
                const form = $(this);
                const submitBtn = $('#saveEditBtn');
                const originalBtnHtml = submitBtn.html();
                // Create FormData object to handle file uploads
                const formData = new FormData(form[0]);
                submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i> Saving...');
                $.ajax({
                    url: '/admin' + form.attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false, // Important for file uploads
                    contentType: false, // Important for file uploads
                    success: function(response) {
                        if (response.success) {
                            closeModal('Modaledit');
                            ShowTaskMessage('success', response.message);
                            refreshTeacherContent();
                        } else {
                            ShowTaskMessage('error', response.message || 'Error updating teacher');
                        }
                    },
                    error: function(xhr) {
                        const errors = xhr.responseJSON?.errors || {};
                        let errorMessages = Object.values(errors).flat().join('\n');
                        ShowTaskMessage('error', errorMessages || 'Error updating teacher');
                    },
                    complete: function() {
                        submitBtn.prop('disabled', false).html(originalBtnHtml);
                    }
                });
            }

            // Preview photo before upload
            $('#photo_upload').change(function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#edit_photo').attr('src', e.target.result).removeClass('hidden');
                        $('#edit_initials').addClass('hidden');
                    }
                    reader.readAsDataURL(file);
                }
            });

            function handleDeleteClick(e) {
                e.preventDefault();
                const teacherId = $(this).data('id');
                $('#Formdelete').attr('action', `/teachers/${teacherId}`);
                showModal('Modaldelete');
            }

            function handleDeleteSubmit(e) {
                e.preventDefault();
                const form = $(this);
                const submitBtn = $('#confirmDeleteBtn');
                const originalBtnHtml = submitBtn.html();

                submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i> Deleting...');

                $.ajax({
                    url: '/admin' + form.attr('action'),
                    method: 'POST',
                    data: {
                        _method: 'DELETE'
                    },
                    success: function(response) {
                        if (response.success) {
                            closeModal('Modaldelete');
                            ShowTaskMessage('success', response.message);
                            refreshTeacherContent();
                        } else {
                            ShowTaskMessage('error', response.message || 'Error deleting teacher');
                        }
                    },
                    error: function(xhr) {
                        ShowTaskMessage('error', xhr.responseJSON?.message || 'Error deleting teacher');
                    },
                    complete: function() {
                        submitBtn.prop('disabled', false).html(originalBtnHtml);
                    }
                });
            }

            function handleDetailClick(e) {
                e.preventDefault();
                const detailBtn = $(this);
                const originalContent = detailBtn.find('.btn-content').html();
                detailBtn.find('.btn-content').html('<i class="fas fa-spinner fa-spin mr-2"></i> Loading...');
                detailBtn.prop('disabled', true);

                const Id = $(this).data('id');

                $.get(`/admin/teachers/${Id}`)
                    .done(function(response) {
                        if (response.success) {
                            const teach = response.teacher;
                            const departmentName = teach.department?.name ?? "Unknown";
                            const updatedAt = teach.updated_at ? teach.updated_at.substring(0, 10) : '';
                            // Set basic info
                            $('#detail_name').text(teach.name ?? '');
                            $('.title').text(teach.name ?? '');
                            $('#detail_user').val(teach.user_id);
                            $('#detail_gender').val(teach.gender);
                            $('#detail_salary').text(teach.salary);
                            $('#detail_department').text(departmentName).toggleClass('hidden', !departmentName);
                            $('#detail_specialization').text(teach.specialization ?? '');
                            $('#detail_experience').text(teach.experience ?? '0');
                            $('#detail_qualification').text(teach.qualification ?? '');
                            $('#detail_joining_date').text(teach.joining_date ? new Date(teach.joining_date)
                                .toLocaleDateString() : '');
                            $('#detail_email').text(teach.email ?? '');
                            $('#detail_phone').text(teach.phone ?? 'Not provided');
                            $('#detail_dob').text(teach.dob ? new Date(teach.dob).toLocaleDateString() :
                                '');
                            $('#detail_address').text(teach.address ?? '');

                            // Handle photo display
                            const photoContainer = $('#detail_photo');
                            const initialsContainer = $('#detail_initials');
                            const initialsSpan = initialsContainer.find('span');

                            if (teach.photo) {
                                photoContainer.attr('src', `${window.location.origin}/${teach.photo}`)
                                    .removeClass('hidden');
                                initialsContainer.addClass('hidden');
                            } else {
                                // Display initials if no photo
                                photoContainer.addClass('hidden');
                                initialsContainer.removeClass('hidden');
                                const nameParts = teach.name.split(' ');
                                const initials = nameParts.map(part => part[0]).join('').toUpperCase();
                                initialsSpan.text(initials);
                            }

                            // Handle CV preview
                            if (teach.cv) {
                                const cvPath = teach.cv.startsWith('http') ? teach.cv : `/${teach.cv}`;
                                const fileName = teach.cv.split('/').pop();

                                $('#cv_preview_container').removeClass('hidden');
                                $('#no_cv_message').addClass('hidden');
                                $('#cv_filename').text(fileName);
                                $('#cv_download_btn').attr('href', cvPath);

                                // Make the whole container clickable to view
                                $('#cv_preview_container').off('click').on('click', function() {
                                    window.open(cvPath, '_blank');
                                });
                            } else {
                                $('#cv_preview_container').addClass('hidden');
                                $('#no_cv_message').removeClass('hidden');
                            }
                            showModal('Modaldetail');
                        } else {
                            ShowTaskMessage('error', response.message || 'Failed to load teacher details');
                        }
                    })
                    .fail(function(xhr) {
                        console.error('Error:', xhr.responseText);
                        ShowTaskMessage('error', 'Failed to load teacher details');
                    })
                    .always(function() {
                        detailBtn.find('.btn-content').html(originalContent);
                        detailBtn.prop('disabled', false);
                    });
            }

            // Bulk Actions
            function getSelectedIds() {
                const selectedIds = [];
                document.querySelectorAll('.row-checkbox:checked').forEach(checkbox => {
                    selectedIds.push(checkbox.value);
                });
                return selectedIds;
            }

            function updateBulkActionsBar() {
                const selectedCountValue = $('.row-checkbox:checked').length;
                selectedCount.text(selectedCountValue);

                if (selectedCountValue > 0) {
                    bulkActionsBar.removeClass('hidden');
                    selectAllCheckbox.prop('checked', selectedCountValue === $('.row-checkbox').length);
                } else {
                    bulkActionsBar.addClass('hidden');
                    selectAllCheckbox.prop('checked', false);
                }
            }

            function handleBulkDelete() {
                const selectedIds = getSelectedIds();
                if (selectedIds.length === 0) {
                    ShowTaskMessage('error', 'Please select at least one teacher to delete');
                    return;
                }

                const modal = document.getElementById('bulkDeleteToastModal');
                document.getElementById('selectedCountText').textContent = selectedIds.length;

                showModal('bulkDeleteToastModal');

                document.getElementById('confirmBulkDeleteBtn').onclick = function() {
                    const deleteBtn = document.getElementById('confirmBulkDeleteBtn');
                    const originalBtnHtml = deleteBtn.innerHTML;
                    deleteBtn.disabled = true;
                    deleteBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Deleting...';

                    $.ajax({
                        url: "{{ route('admin.teachers.bulkDelete') }}",
                        method: 'POST',
                        data: {
                            ids: selectedIds
                        },
                        success: function(response) {
                            if (response.success) {
                                closeModal('bulkDeleteToastModal');
                                ShowTaskMessage('success', response.message);
                                refreshTeacherContent();
                            } else {
                                ShowTaskMessage('error', response.message ||
                                    'Error deleting teachers');
                            }
                        },
                        error: function(xhr) {
                            ShowTaskMessage('error', xhr.responseJSON?.message ||
                                'Error deleting teachers');
                        },
                        complete: function() {
                            deleteBtn.disabled = false;
                            deleteBtn.innerHTML = originalBtnHtml;
                        }
                    });
                };
            }

            // function handleBulkEdit() {
            //     const selectedIds = getSelectedIds();
            //     if (selectedIds.length === 0) {
            //         ShowTaskMessage('error', 'Please select at least one teacher to edit');
            //         return;
            //     }

            //     const bulkEditBtn = document.getElementById('bulkEditBtn');
            //     const originalBtnText = bulkEditBtn.innerHTML;
            //     bulkEditBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Loading...';
            //     bulkEditBtn.disabled = true;

            //     $('#bulkEditContainer').addClass('h-[70vh] md:h-auto')
            //     if (selectedIds.length > 1) {
            //         $('#bulkEditContainer').removeClass('md:h-auto')
            //         $('#bulkEditContainer').addClass('h-[70vh]')
            //     }
            //     if (selectedIds.length > 5) {
            //         ShowTaskMessage('error', 'You can only edit up to 5 teachers at a time');
            //         bulkEditBtn.innerHTML = originalBtnText;
            //         bulkEditBtn.disabled = false;
            //         return;
            //     }

            //     document.getElementById('bulkEditCount').textContent = selectedIds.length;

            //     $.ajax({
            //         url: "{{ route('admin.teachers.getBulkData') }}",
            //         method: 'POST',
            //         data: {
            //             ids: selectedIds
            //         },
            //         success: function(response) {
            //             bulkEditBtn.innerHTML = originalBtnText;
            //             bulkEditBtn.disabled = false;

            //             if (!response.success) {
            //                 ShowTaskMessage('error', response.message || 'Error loading data');
            //                 return;
            //             }

            //             const container = document.getElementById('bulkEditContainer');
            //             container.innerHTML = '';

            //             response.data.forEach((teacher, index) => {
            //                 const fieldHtml = `
        //             <div class="sub-field mb-6 p-4 border border-gray-200 dark:border-gray-700 rounded-lg">
        //                 <input type="hidden" name="teachers[${index}][id]" value="${teacher.id}">
        //                 <div class="flex justify-between items-center mb-2">
        //                     <h4 class="text-md font-medium text-gray-700 dark:text-gray-300">Teacher #${index + 1}</h4>
        //                 </div>

        //                 <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        //                     
        //                     <div class="mb-4">
        //                         <label for="teachers[${index}][department_id]" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
        //                             Department <span class="text-red-500">*</span>
        //                         </label>
        //                         <select id="teachers[${index}][department_id]" name="teachers[${index}][department_id]"
        //                             class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
        //                             focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white
        //                             border-gray-400" required>
        //                             @foreach ($departments as $department)
        //                                 <option value="{{ $department->id }}" ${teacher.department_id == {{ $department->id }} ? 'selected' : ''}>
        //                                     {{ $department->name }}
        //                                 </option>
        //                             @endforeach
        //                         </select>
        //                     </div>

        //                     <div class="mb-4">
        //                         <label for="teachers[${index}][joining_date]" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
        //                             Joining Date <span class="text-red-500">*</span>
        //                         </label>
        //                         <input type="date" id="teachers[${index}][joining_date]" name="teachers[${index}][joining_date]"
        //                             class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
        //                             focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white
        //                             border-gray-400"
        //                             value="${teacher.joining_date}"
        //                             required>
        //                     </div>

        //                     <div class="mb-4">
        //                         <label for="teachers[${index}][qualification]" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
        //                             Qualification <span class="text-red-500">*</span>
        //                         </label>
        //                         <input type="text" id="teachers[${index}][qualification]" name="teachers[${index}][qualification]"
        //                             class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
        //                             focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white
        //                             border-gray-400"
        //                             value="${teacher.qualification}"
        //                             placeholder="Enter qualification" required>
        //                     </div>

        //                     <div class="mb-4">
        //                         <label for="teachers[${index}][specialization]" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
        //                             Specialization
        //                         </label>
        //                         <input type="text" id="teachers[${index}][specialization]" name="teachers[${index}][specialization]"
        //                             class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
        //                             focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white
        //                             border-gray-400"
        //                             value="${teacher.specialization || ''}"
        //                             placeholder="Enter specialization">
        //                     </div>

        //                     <div class="mb-4">
        //                         <label for="teachers[${index}][salary]" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
        //                             Salary
        //                         </label>
        //                         <input type="number" step="0.01" id="teachers[${index}][salary]" name="teachers[${index}][salary]"
        //                             class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
        //                             focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white
        //                             border-gray-400"
        //                             value="${teacher.salary || ''}"
        //                             placeholder="Enter salary">
        //                     </div>
        //                 </div>
        //             </div>
        //         `;

            //                 container.insertAdjacentHTML('beforeend', fieldHtml);
            //             });

            //             showModal('bulkEditModal');
            //         },
            //         error: function(xhr) {
            //             bulkEditBtn.innerHTML = originalBtnText;
            //             bulkEditBtn.disabled = false;
            //             ShowTaskMessage('error', 'Error loading data');
            //         }
            //     });
            // }

            // function handleBulkEditSubmit(e) {
            //     e.preventDefault();
            //     const submitBtn = document.getElementById('bulkEditSubmitBtn');
            //     const originalBtnHtml = submitBtn.innerHTML;
            //     submitBtn.disabled = true;
            //     submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Saving...';

            //     const dataform = [];
            //     $('.sub-field').each(function(index) {
            //         const data = {
            //             id: $(this).find('input[type="hidden"]').val(),
            //             teacher_id: $(this).find('input[name$="[teacher_id]"]').val(),
            //             department_id: $(this).find('select[name$="[department_id]"]').val(),
            //             joining_date: $(this).find('input[name$="[joining_date]"]').val(),
            //             qualification: $(this).find('input[name$="[qualification]"]').val(),
            //             specialization: $(this).find('input[name$="[specialization]"]').val(),
            //             salary: $(this).find('input[name$="[salary]"]').val()
            //         };
            //         dataform.push(data);
            //     });

            //     $.ajax({
            //         url: "{{ route('admin.teachers.bulkUpdate') }}",
            //         method: 'POST',
            //         data: {
            //             teachers: dataform
            //         },
            //         success: function(response) {
            //             if (response.success) {
            //                 closeModal('bulkEditModal');
            //                 ShowTaskMessage('success', response.message);
            //                 refreshTeacherContent();
            //             } else {
            //                 let errorMessage = response.message || 'Error updating teachers';
            //                 if (response.errors) {
            //                     errorMessage += '\n' + Object.values(response.errors).flat().join('\n');
            //                 }
            //                 ShowTaskMessage('error', errorMessage);
            //             }
            //         },
            //         error: function(xhr) {
            //             let errorMessage = 'An error occurred while updating';
            //             if (xhr.status === 422) {
            //                 const errors = xhr.responseJSON?.errors || {};
            //                 errorMessage = Object.values(errors).flat().join('\n');
            //             }
            //             ShowTaskMessage('error', errorMessage);
            //         },
            //         complete: function() {
            //             submitBtn.disabled = false;
            //             submitBtn.innerHTML = originalBtnHtml;
            //         }
            //     });
            // }


            function handleBulkEdit() {
                const selectedIds = getSelectedIds();
                if (selectedIds.length === 0) {
                    ShowTaskMessage('error', 'Please select at least one teacher to edit');
                    return;
                }

                const bulkEditBtn = document.getElementById('bulkEditBtn');
                const originalBtnText = bulkEditBtn.innerHTML;
                bulkEditBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Loading...';
                bulkEditBtn.disabled = true;

                $('#bulkEditContainer').addClass('h-[70vh] md:h-auto')
                if (selectedIds.length > 1) {
                    $('#bulkEditContainer').removeClass('md:h-auto')
                    $('#bulkEditContainer').addClass('h-[70vh]')
                }
                if (selectedIds.length > 5) {
                    ShowTaskMessage('error', 'You can only edit up to 5 teachers at a time');
                    bulkEditBtn.innerHTML = originalBtnText;
                    bulkEditBtn.disabled = false;
                    return;
                }

                document.getElementById('bulkEditCount').textContent = selectedIds.length;

                $.ajax({
                    url: "{{ route('admin.teachers.getBulkData') }}",
                    method: 'POST',
                    data: {
                        ids: selectedIds
                    },
                    success: function(response) {
                        bulkEditBtn.innerHTML = originalBtnText;
                        bulkEditBtn.disabled = false;

                        if (!response.success) {
                            ShowTaskMessage('error', response.message || 'Error loading data');
                            return;
                        }

                        const container = document.getElementById('bulkEditContainer');
                        container.innerHTML = '';

                        response.data.forEach((teacher, index) => {
                            const fieldHtml = `
                <div class="sub-field mb-6 p-4 border border-gray-200 dark:border-gray-700 rounded-lg">
                    <input type="hidden" name="teachers[${index}][id]" value="${teacher.id}">
                    <div class="flex justify-between items-center mb-2">
                        <h4 class="text-md font-medium text-gray-700 dark:text-gray-300">Teacher #${index + 1}</h4>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Name -->
                        <div class="mb-4">
                            <label for="teachers[${index}][name]" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Full Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="teachers[${index}][name]" name="teachers[${index}][name]"
                                class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                                focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white
                                border-gray-400"
                                value="${teacher.name}"
                                placeholder="Enter full name" required>
                        </div>

                        <!-- Gender -->
                        <div class="mb-4">
                            <label for="teachers[${index}][gender]" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Gender <span class="text-red-500">*</span>
                            </label>
                            <select id="teachers[${index}][gender]" name="teachers[${index}][gender]"
                                class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                                focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white
                                border-gray-400" required>
                                <option value="male" ${teacher.gender === 'male' ? 'selected' : ''}>Male</option>
                                <option value="female" ${teacher.gender === 'female' ? 'selected' : ''}>Female</option>
                                <option value="other" ${teacher.gender === 'other' ? 'selected' : ''}>Other</option>
                            </select>
                        </div>

                        <!-- Date of Birth -->
                        <div class="mb-4">
                            <label for="teachers[${index}][dob]" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Date of Birth <span class="text-red-500">*</span>
                            </label>
                            <input type="date" id="teachers[${index}][dob]" name="teachers[${index}][dob]"
                                class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                                focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white
                                border-gray-400"
                                value="${teacher.dob}"
                                required>
                        </div>

                        <!-- Department -->
                        <div class="mb-4">
                            <label for="teachers[${index}][department_id]" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Department <span class="text-red-500">*</span>
                            </label>
                            <select id="teachers[${index}][department_id]" name="teachers[${index}][department_id]"
                                class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                                focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white
                                border-gray-400" required>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}" ${teacher.department_id == {{ $department->id }} ? 'selected' : ''}>
                                        {{ $department->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Joining Date -->
                        <div class="mb-4">
                            <label for="teachers[${index}][joining_date]" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Joining Date <span class="text-red-500">*</span>
                            </label>
                            <input type="date" id="teachers[${index}][joining_date]" name="teachers[${index}][joining_date]"
                                class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                                focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white
                                border-gray-400"
                                value="${teacher.joining_date}"
                                required>
                        </div>

                        <!-- Qualification -->
                        <div class="mb-4">
                            <label for="teachers[${index}][qualification]" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Qualification <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="teachers[${index}][qualification]" name="teachers[${index}][qualification]"
                                class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                                focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white
                                border-gray-400"
                                value="${teacher.qualification}"
                                placeholder="Enter qualification" required>
                        </div>

                        <!-- Experience -->
                        <div class="mb-4">
                            <label for="teachers[${index}][experience]" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Experience
                            </label>
                            <input type="text" id="teachers[${index}][experience]" name="teachers[${index}][experience]"
                                class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                                focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white
                                border-gray-400"
                                value="${teacher.experience || ''}"
                                placeholder="Enter experience">
                        </div>

                        <!-- Phone -->
                        <div class="mb-4">
                            <label for="teachers[${index}][phone]" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Phone
                            </label>
                            <input type="text" id="teachers[${index}][phone]" name="teachers[${index}][phone]"
                                class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                                focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white
                                border-gray-400"
                                value="${teacher.phone || ''}"
                                placeholder="Enter phone number">
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="teachers[${index}][email]" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Email
                            </label>
                            <input type="email" id="teachers[${index}][email]" name="teachers[${index}][email]"
                                class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                                focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white
                                border-gray-400"
                                value="${teacher.email || ''}"
                                placeholder="Enter email">
                        </div>

                        <!-- Address -->
                        <div class="mb-4">
                            <label for="teachers[${index}][address]" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Address
                            </label>
                            <textarea id="teachers[${index}][address]" name="teachers[${index}][address]"
                                class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                                focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white
                                border-gray-400"
                                placeholder="Enter address">${teacher.address || ''}</textarea>
                        </div>

                        <!-- Specialization -->
                        <div class="mb-4">
                            <label for="teachers[${index}][specialization]" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Specialization
                            </label>
                            <input type="text" id="teachers[${index}][specialization]" name="teachers[${index}][specialization]"
                                class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                                focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white
                                border-gray-400"
                                value="${teacher.specialization || ''}"
                                placeholder="Enter specialization">
                        </div>

                        <!-- Salary -->
                        <div class="mb-4">
                            <label for="teachers[${index}][salary]" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Salary
                            </label>
                            <input type="number" step="0.01" id="teachers[${index}][salary]" name="teachers[${index}][salary]"
                                class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                                focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white
                                border-gray-400"
                                value="${teacher.salary || ''}"
                                placeholder="Enter salary">
                        </div>
                    </div>
                </div>
                `;

                            container.insertAdjacentHTML('beforeend', fieldHtml);
                        });

                        showModal('bulkEditModal');
                    },
                    error: function(xhr) {
                        bulkEditBtn.innerHTML = originalBtnText;
                        bulkEditBtn.disabled = false;
                        ShowTaskMessage('error', 'Error loading data');
                    }
                });
            }

            function handleBulkEditSubmit(e) {
                e.preventDefault();
                const submitBtn = document.getElementById('bulkEditSubmitBtn');
                const originalBtnHtml = submitBtn.innerHTML;
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Saving...';

                const dataform = [];
                $('.sub-field').each(function(index) {
                    const data = {
                        id: $(this).find('input[type="hidden"]').val(),
                        teacher_id: $(this).find('input[name$="[teacher_id]"]').val(),
                        name: $(this).find('input[name$="[name]"]').val(),
                        gender: $(this).find('select[name$="[gender]"]').val(),
                        dob: $(this).find('input[name$="[dob]"]').val(),
                        department_id: $(this).find('select[name$="[department_id]"]').val(),
                        joining_date: $(this).find('input[name$="[joining_date]"]').val(),
                        qualification: $(this).find('input[name$="[qualification]"]').val(),
                        experience: $(this).find('input[name$="[experience]"]').val(),
                        phone: $(this).find('input[name$="[phone]"]').val(),
                        email: $(this).find('input[name$="[email]"]').val(),
                        address: $(this).find('textarea[name$="[address]"]').val(),
                        specialization: $(this).find('input[name$="[specialization]"]').val(),
                        salary: $(this).find('input[name$="[salary]"]').val()
                    };
                    dataform.push(data);
                });

                $.ajax({
                    url: "{{ route('admin.teachers.bulkUpdate') }}",
                    method: 'POST',
                    data: {
                        teachers: dataform
                    },
                    success: function(response) {
                        if (response.success) {
                            closeModal('bulkEditModal');
                            ShowTaskMessage('success', response.message);
                            refreshTeacherContent();
                        } else {
                            let errorMessage = response.message || 'Error updating teachers';
                            if (response.errors) {
                                errorMessage += '\n' + Object.values(response.errors).flat().join('\n');
                            }
                            ShowTaskMessage('error', errorMessage);
                        }
                    },
                    error: function(xhr) {
                        let errorMessage = 'An error occurred while updating';
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON?.errors || {};
                            errorMessage = Object.values(errors).flat().join('\n');
                        }
                        ShowTaskMessage('error', errorMessage);
                    },
                    complete: function() {
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalBtnHtml;
                    }
                });
            }

            // Modal Management
            function showModal(modalId) {
                backdrop.classList.remove('hidden');
                const modal = document.getElementById(modalId);
                modal.classList.remove('hidden');
                setTimeout(() => {
                    modal.querySelector('div').classList.remove('opacity-0', 'scale-95');
                    modal.querySelector('div').classList.add('opacity-100', 'scale-100');
                }, 10);
                document.body.style.overflow = 'hidden';
            }

            function closeModal(modalId) {
                const modal = document.getElementById(modalId);
                modal.querySelector('div').classList.remove('opacity-100', 'scale-100');
                modal.querySelector('div').classList.add('opacity-0', 'scale-95');

                setTimeout(() => {
                    modal.classList.add('hidden');
                    backdrop.classList.add('hidden');
                    document.body.style.overflow = 'auto';
                }, 300);
            }

            // Utility Functions
            function refreshTeacherContent() {
                const currentView = localStorage.getItem('viewitem') || 'table';
                const searchTerm = searchInput.val() || '';

                $.ajax({
                    url: "{{ route('admin.teachers.index') }}",
                    method: 'GET',
                    data: {
                        search: searchTerm,
                        view: currentView
                    },
                    success: function(response) {
                        if (response.success) {
                            tableContainer.html(response.html.table);
                            cardContainer.html(response.html.cards);
                            $('.pagination').html(response.html.pagination);
                            attachRowEventHandlers();
                            updateBulkActionsBar();
                        } else {
                            ShowTaskMessage('error', 'Failed to refresh data');
                        }
                    },
                    error: function(xhr) {
                        console.error('Refresh failed:', xhr.responseText);
                        ShowTaskMessage('error', 'Failed to refresh data');
                    }
                });
            }

            function attachRowEventHandlers() {
                $('.edit-btn').off('click').on('click', handleEditClick);
                $('.delete-btn').off('click').on('click', handleDeleteClick);
                $('.detail-btn').off('click').on('click', handleDetailClick);
                $('.row-checkbox').off('change').on('change', updateBulkActionsBar);
            }

            function debounce(func, wait) {
                let timeout;
                return function() {
                    const context = this,
                        args = arguments;
                    clearTimeout(timeout);
                    timeout = setTimeout(() => func.apply(context, args), wait);
                };
            }

            // Event Listeners
            function initialize() {
                // Set initial view
                const savedView = localStorage.getItem('viewitem') || 'list';
                setView(savedView);

                // View toggle
                listViewBtn.on('click', () => setView('list'));
                cardViewBtn.on('click', () => setView('card'));

                // Search
                searchInput.on('input', debounce(() => searchData(searchInput.val()), 500));
                resetSearch.on('click', () => {
                    searchInput.val('');
                    searchData('');
                });

                // Bulk actions
                selectAllCheckbox.on('change', function() {
                    $('.row-checkbox').prop('checked', this.checked);
                    updateBulkActionsBar();
                });

                deselectAllBtn.on('click', function() {
                    $('.row-checkbox').prop('checked', false);
                    selectAllCheckbox.prop('checked', false);
                    updateBulkActionsBar();
                });

                bulkEditBtn.on('click', handleBulkEdit);
                bulkDeleteBtn.on('click', handleBulkDelete);

                // Form submissions
                $('#Modalcreate form').off('submit').on('submit', handleCreateSubmit);
                $('#Formedit').off('submit').on('submit', handleEditSubmit);
                $('#Formdelete').off('submit').on('submit', handleDeleteSubmit);
                $('#bulkEditForm').off('submit').on('submit', handleBulkEditSubmit);

                // Modal close buttons
                $('[id^="close"], [id^="cancel"]').on('click', function() {
                    const modalId = $(this).closest('[id^="Modal"]').attr('id') ||
                        $(this).closest('[id$="Modal"]').attr('id');
                    if (modalId) closeModal(modalId);
                });

                // Close modals with Escape key
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape') {
                        $('[id^="Modal"]').each(function() {
                            if (!$(this).hasClass('hidden')) {
                                closeModal(this.id);
                            }
                        });
                    }
                });

                // Attach initial event handlers
                attachRowEventHandlers();
                updateBulkActionsBar();
            }

            // Start the application
            initialize();
        });

        // Global notification function
        function ShowTaskMessage(type, message) {
            const TasksmsContainer = document.createElement('div');
            TasksmsContainer.className = `fixed top-5 right-4 z-50 animate-fade-in-out`;
            TasksmsContainer.innerHTML = `
        <div class="flex items-start gap-3 ${type === 'success' ? 'bg-green-200/80 dark:bg-green-900/60 border-green-400 dark:border-green-600 text-green-700 dark:text-green-300' : 'bg-red-200/80 dark:bg-red-900/60 border-red-400 dark:border-red-600 text-red-700 dark:text-red-300'} 
            border backdrop-blur-sm px-4 py-3 rounded-lg shadow-lg">
            <svg class="w-6 h-6 flex-shrink-0 ${type === 'success' ? 'text-green-500 dark:text-green-400' : 'text-red-500 dark:text-red-400'} mt-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="${type === 'success' ? 'M5 13l4 4L19 7' : 'M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'}" />
            </svg>
            <div class="flex-1 text-sm sm:text-base">${message}</div>
            <button onclick="this.parentElement.parentElement.remove()" class="text-gray-600 rounded-full dark:text-gray-400 hover:bg-gray-100/30 dark:hover:bg-gray-50/10 focus:outline-none">
                <svg class="w-5 h-5 rounded-full" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    `;
            document.body.appendChild(TasksmsContainer);
            setTimeout(() => TasksmsContainer.remove(), 3000);
        }
    </script>
@endpush
