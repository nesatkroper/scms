@extends('layouts.admin')
@section('title', 'Students')
@section('content')
    <div
        class="box px-2 py-4 md:p-4 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">
        <h3 class="text-lg mb-3 font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
            <svg class="size-8 p-1 rounded-full bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"
                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path
                    d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v1h8v-1zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-1a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v1h-3zM4.75 12.094A5.973 5.973 0 004 15v1H1v-1a3 3 0 013.75-2.906z" />
            </svg>
            Students List
        </h3>
        <div
            class="p-2 md:flex gap-2 justify-between items-center border rounded-md border-gray-200 dark:border-gray-700 bg-violet-50 dark:bg-slate-800">
            <button data-tooltip-target="tooltip" data-tooltip-placement="top" id="openCreateModal"
                class="text-nowrap px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 cursor-pointer transition-colors flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                        clip-rule="evenodd" />
                </svg>
                Create New
                <div id="tooltip" role="tooltip" class="text-sm font-medium">
                    placement tooltip t
                </div>
            </button>

            <div class="flex items-center mt-3 md:mt-0 gap-2">
                <div class="relative w-full">
                    <input type="search" id="searchInput" placeholder="Search student..."
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

        {{-- <button data-tooltip-target="tooltip-t" data-tooltip-placement="top" class="tooltip-btn">
            tooltip-t
            <div id="tooltip-t" role="tooltip" class="text-sm font-medium">
                placement tooltip t
            </div>
        </button>
        <button data-tooltip-target="tooltip-b" data-tooltip-placement="bottom" class="tooltip-btn">
            tooltip-b
            <div id="tooltip-b" role="tooltip" class="text-sm font-medium">
                b placement tooltip
            </div>
        </button>
        <button data-tooltip-target="tooltip-l" data-tooltip-placement="left" class="tooltip-btn">
            tooltip-r
            <div id="tooltip-l" role="tooltip" class="text-sm font-medium">
                left placement tooltip
            </div>
        </button>
        <button data-tooltip-target="tooltip-r" data-tooltip-placement="right" class="tooltip-btn">
            tooltip-r
            <div id="tooltip-r" role="tooltip" class="text-sm font-medium">
                Right placement tooltip
            </div>
        </button> --}}

        <div id="TableContainer" class="table-respone mt-6 overflow-x-auto h-[60vh]">
            @include('admin.students.partials.table', ['students' => $students])
        </div>
        <div id="CardContainer" class="hidden my-5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
            @include('admin.students.partials.cardlist', ['students' => $students])
        </div>
        {{-- pagination --}}
        @include('admin.students.partials.pagination')
    </div>

    <!-- Modal Backdrop -->
    <div id="modalBackdrop" class="fixed inset-0 bg-black/50 z-40 hidden backdrop-blur-sm"></div>

    @include('admin.students.partials.create')
    @include('admin.students.partials.edit')
    @include('admin.students.partials.detail')
    <x-modal.confirmdelete title="students" />
    @include('admin.students.partials.bulkedit')
    @include('admin.students.partials.bulkdelete')
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Core Configuration
            $.ajaxSetup({
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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
                            console.log('Selected grade_level_id:', this.dataset.value);
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

            $('#openCreateModal').off('click').on('click', function() {
                showModal('Modalcreate');
            });

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
                    url: "{{ route('admin.students.index') }}",
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
                            ShowTaskMessage('error', 'Failed to load datas');
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
                if (!this.checkValidity()) {
                    $(this).addClass('was-validated');
                    return;
                }
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
                            refreshStudentContent();
                            form.trigger('reset');
                            // Reset photo preview
                            $('#photoPreview').addClass('hidden');
                            $('#dropArea').removeClass('hidden');
                        } else {
                            ShowTaskMessage('error', response.message || 'Error creating student');
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            for (const field in errors) {
                                if (errors.hasOwnProperty(field)) {
                                    const errorMessage = errors[field][0];
                                    $(`#error-${field}`).text(errorMessage);
                                }
                            }
                            ShowTaskMessage('error', `Invalid field something was wrong!`);
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

                const Id = $(this).data('id');

                $.get(`/admin/students/${Id}`)
                    .done(function(response) {
                        if (response.success && response.student) {
                            const std = response.student;
                            const date = std.admission_date ? std.admission_date.substring(0, 10) : '';
                            const datedob = std.dob ? std.dob.substring(0, 10) : '';
                            // const age = datedob - Date().Now();
                            // Set form values
                            $('#edit_name').val(std.name);
                            $('#edit_user').val(std.user_id);
                            $('#edit_phone').val(std.phone);
                            $('#edit_email').val(std.email);
                            $('#edit_gender').val(std.gender);
                            $('#edit_dob').val(datedob);
                            $('#edit_admission_date').val(date);
                            $('#edit_grade_level_id').val(std.grade_level_id);
                            $('#edit_address').val(std.address);
                            $('#edit_blood_group').val(std.blood_group);
                            $('#edit_nationality').val(std.nationality);
                            $('#edit_religion').val(std.religion);
                            // $('#edit_age').val(age);
                            // Handle photo display
                            if (std.photo) {
                                $('#edit_photo').attr('src', '/' + std.photo).removeClass('hidden');
                                $('#edit_initials').addClass('hidden');
                            } else {
                                $('#edit_photo').addClass('hidden');
                                const initials = std.name.split(' ').map(n => n[0]).join('').toUpperCase();
                                $('#edit_initials').removeClass('hidden').find('span').text(initials);
                            }

                            // Set form action
                            $('#Formedit').attr('action', `/students/${Id}`);
                            showModal('Modaledit');
                        } else {
                            ShowTaskMessage('error', response.message || 'Failed to load student data');
                        }
                    })
                    .fail(function(xhr) {
                        console.error('Error:', xhr.responseText);
                        ShowTaskMessage('error', 'Failed to load student data');
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
                if (!this.checkValidity()) {
                    $(this).addClass('was-validated');
                    return;
                }
                const formData = new FormData(form[0]);
                submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i> Saving...');
                $.ajax({
                    url: '/admin' + form.attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            closeModal('Modaledit');
                            ShowTaskMessage('success', response.message);
                            refreshStudentContent();
                        } else {
                            ShowTaskMessage('error', response.message || 'Error updating student');
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            for (const field in errors) {
                                if (errors.hasOwnProperty(field)) {
                                    const errorMessage = errors[field][0];
                                    $(`#edit-error-${field}`).text(errorMessage);
                                }
                            }
                            let errorMessages = Object.values(errors).flat().join('\n');
                            ShowTaskMessage('error', errorMessages || 'Error updating student');
                        }
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
                const Id = $(this).data('id');
                $('#Formdelete').attr('action', `/students/${Id}`);
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
                            refreshStudentContent();
                        } else {
                            ShowTaskMessage('error', response.message || 'Error deleting student');
                        }
                    },
                    error: function(xhr) {
                        ShowTaskMessage('error', xhr.responseJSON?.message || 'Error deleting student');
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

                $.get(`/admin/students/${Id}`)
                    .done(function(response) {
                        if (response.success) {
                            const student = response.student;
                            const gradeLevelName = student.grade_level?.name ?? "Unknown";
                            const updatedAt = student.updated_at ? student.updated_at.substring(0, 10) : '';

                            // Set basic info
                            $('#detail_name').text(student.name ?? '');
                            $('.title').text(student.name ?? '');
                            $('#detail_user').val(student.user_id);
                            $('#detail_gender').val(student.gender);
                            $('#detail_grade_level').text(gradeLevelName).toggleClass('hidden', !
                                gradeLevelName);
                            $('#detail_blood_group').text(student.blood_group ?? '');
                            $('#detail_nationality').text(student.nationality ?? '');
                            $('#detail_religion').text(student.religion ?? '');
                            $('#detail_admission_date').text(student.admission_date ? new Date(student
                                .admission_date).toLocaleDateString() : '');
                            $('#detail_email').text(student.email ?? '');
                            $('#detail_phone').text(student.phone ?? 'Not provided');
                            $('#detail_dob').text(student.dob ? new Date(student.dob).toLocaleDateString() :
                                '');
                            $('#detail_address').text(student.address ?? '');

                            // Handle photo display
                            const photoContainer = $('#detail_photo');
                            const initialsContainer = $('#detail_initials');
                            const initialsSpan = initialsContainer.find('span');

                            if (student.photo) {
                                photoContainer.attr('src', `${window.location.origin}/${student.photo}`)
                                    .removeClass('hidden');
                                initialsContainer.addClass('hidden');
                            } else {
                                // Display initials if no photo
                                photoContainer.addClass('hidden');
                                initialsContainer.removeClass('hidden');
                                const nameParts = student.name.split(' ');
                                const initials = nameParts.map(part => part[0]).join('').toUpperCase();
                                initialsSpan.text(initials);
                            }

                            showModal('Modaldetail');
                        } else {
                            ShowTaskMessage('error', response.message || 'Failed to load student details');
                        }
                    })
                    .fail(function(xhr) {
                        console.error('Error:', xhr.responseText);
                        ShowTaskMessage('error', 'Failed to load student details');
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
                    ShowTaskMessage('error', 'Please select at least one student to delete');
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
                        url: "{{ route('admin.students.bulkDelete') }}",
                        method: 'POST',
                        data: {
                            ids: selectedIds
                        },
                        success: function(response) {
                            if (response.success) {
                                closeModal('bulkDeleteToastModal');
                                ShowTaskMessage('success', response.message);
                                refreshStudentContent();
                            } else {
                                ShowTaskMessage('error', response.message ||
                                    'Error deleting students');
                            }
                        },
                        error: function(xhr) {
                            ShowTaskMessage('error', xhr.responseJSON?.message ||
                                'Error deleting students');
                        },
                        complete: function() {
                            deleteBtn.disabled = false;
                            deleteBtn.innerHTML = originalBtnHtml;
                        }
                    });
                };
            }

            function handleBulkEdit() {
                const selectedIds = getSelectedIds();
                if (selectedIds.length === 0) {
                    ShowTaskMessage('error', 'Please select at least one student to edit');
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
                    ShowTaskMessage('error', 'You can only edit up to 5 students at a time');
                    bulkEditBtn.innerHTML = originalBtnText;
                    bulkEditBtn.disabled = false;
                    return;
                }

                document.getElementById('bulkEditCount').textContent = selectedIds.length;

                $.ajax({
                    url: "{{ route('admin.students.getBulkData') }}",
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

                        response.data.forEach((student, index) => {
                            const fieldHtml = `
                <div class="sub-field mb-6 p-4 border border-gray-200 dark:border-gray-700 rounded-lg">
                    <input type="hidden" name="students[${index}][id]" value="${student.id}">
                    <div class="flex justify-between items-center mb-2">
                        <h4 class="text-md font-medium text-gray-700 dark:text-gray-300">Student #${index + 1}</h4>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Name -->
                        <div class="mb-4">
                            <label for="students[${index}][name]" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Full Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="students[${index}][name]" name="students[${index}][name]"
                                class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                                focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white
                                border-gray-400"
                                value="${student.name}"
                                placeholder="Enter full name" required>
                        </div>

                        <!-- Gender -->
                        <div class="mb-4">
                            <label for="students[${index}][gender]" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Gender <span class="text-red-500">*</span>
                            </label>
                            <select id="students[${index}][gender]" name="students[${index}][gender]"
                                class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                                focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white
                                border-gray-400" required>
                                <option value="male" ${student.gender === 'male' ? 'selected' : ''}>Male</option>
                                <option value="female" ${student.gender === 'female' ? 'selected' : ''}>Female</option>
                                <option value="other" ${student.gender === 'other' ? 'selected' : ''}>Other</option>
                            </select>
                        </div>

                        <!-- Date of Birth -->
                        <div class="mb-4">
                            <label for="students[${index}][dob]" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Date of Birth <span class="text-red-500">*</span>
                            </label>
                            <input type="date" id="students[${index}][dob]" name="students[${index}][dob]"
                                class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                                focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white
                                border-gray-400"
                                value="${student.dob}"
                                required>
                        </div>

                        <!-- Grade Level -->
                        <div class="mb-4">
                            <label for="students[${index}][grade_level_id]" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Grade Level <span class="text-red-500">*</span>
                            </label>
                            <select id="students[${index}][grade_level_id]" name="students[${index}][grade_level_id]"
                                class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                                focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white
                                border-gray-400" required>
                                @foreach ($gradeLevels as $gradeLevel)
                                    <option value="{{ $gradeLevel->id }}" ${student.grade_level_id == {{ $gradeLevel->id }} ? 'selected' : ''}>
                                        {{ $gradeLevel->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Admission Date -->
                        <div class="mb-4">
                            <label for="students[${index}][admission_date]" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Admission Date <span class="text-red-500">*</span>
                            </label>
                            <input type="date" id="students[${index}][admission_date]" name="students[${index}][admission_date]"
                                class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                                focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white
                                border-gray-400"
                                value="${student.admission_date}"
                                required>
                        </div>

                        <!-- Blood Group -->
                        <div class="mb-4">
                            <label for="students[${index}][blood_group]" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Blood Group
                            </label>
                            <input type="text" id="students[${index}][blood_group]" name="students[${index}][blood_group]"
                                class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                                focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white
                                border-gray-400"
                                value="${student.blood_group || ''}"
                                placeholder="Enter blood group">
                        </div>

                        <!-- Nationality -->
                        <div class="mb-4">
                            <label for="students[${index}][nationality]" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Nationality
                            </label>
                            <input type="text" id="students[${index}][nationality]" name="students[${index}][nationality]"
                                class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                                focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white
                                border-gray-400"
                                value="${student.nationality || ''}"
                                placeholder="Enter nationality">
                        </div>

                        <!-- Religion -->
                        <div class="mb-4">
                            <label for="students[${index}][religion]" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Religion
                            </label>
                            <input type="text" id="students[${index}][religion]" name="students[${index}][religion]"
                                class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                                focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white
                                border-gray-400"
                                value="${student.religion || ''}"
                                placeholder="Enter religion">
                        </div>

                        <!-- Phone -->
                        <div class="mb-4">
                            <label for="students[${index}][phone]" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Phone
                            </label>
                            <input type="text" id="students[${index}][phone]" name="students[${index}][phone]"
                                class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                                focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white
                                border-gray-400"
                                value="${student.phone || ''}"
                                placeholder="Enter phone number">
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="students[${index}][email]" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Email
                            </label>
                            <input type="email" id="students[${index}][email]" name="students[${index}][email]"
                                class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                                focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white
                                border-gray-400"
                                value="${student.email || ''}"
                                placeholder="Enter email">
                        </div>

                        <!-- Address -->
                        <div class="mb-4">
                            <label for="students[${index}][address]" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Address
                            </label>
                            <textarea id="students[${index}][address]" name="students[${index}][address]"
                                class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                                focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white
                                border-gray-400"
                                placeholder="Enter address">${student.address || ''}</textarea>
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
                        name: $(this).find('input[name$="[name]"]').val(),
                        gender: $(this).find('select[name$="[gender]"]').val(),
                        dob: $(this).find('input[name$="[dob]"]').val(),
                        grade_level_id: $(this).find('select[name$="[grade_level_id]"]').val(),
                        admission_date: $(this).find('input[name$="[admission_date]"]').val(),
                        blood_group: $(this).find('input[name$="[blood_group]"]').val(),
                        nationality: $(this).find('input[name$="[nationality]"]').val(),
                        religion: $(this).find('input[name$="[religion]"]').val(),
                        phone: $(this).find('input[name$="[phone]"]').val(),
                        email: $(this).find('input[name$="[email]"]').val(),
                        address: $(this).find('textarea[name$="[address]"]').val()
                    };
                    dataform.push(data);
                });

                $.ajax({
                    url: "{{ route('admin.students.bulkUpdate') }}",
                    method: 'POST',
                    data: {
                        students: dataform
                    },
                    success: function(response) {
                        if (response.success) {
                            closeModal('bulkEditModal');
                            ShowTaskMessage('success', response.message);
                            refreshStudentContent();
                        } else {
                            let errorMessage = response.message || 'Error updating students';
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
            function refreshStudentContent() {
                const currentView = localStorage.getItem('viewitem') || 'table';
                const searchTerm = searchInput.val() || '';

                $.ajax({
                    url: "{{ route('admin.students.index') }}",
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
