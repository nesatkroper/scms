@extends('layouts.admin')
@section('title', 'Students')
@section('content')
    <x-page.index btn-text="Create New Student" :showReset="true" :showViewToggle="true" title="Student"
        iconSvgPath="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z">

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
        <x-table.pagination :paginator="$students" />
    </x-page.index>

    @include('admin.students.partials.create')
    @include('admin.students.partials.edit')
    @include('admin.students.partials.detail')
    <x-modal.confirmdelete title="students" />
    @include('admin.students.partials.bulkedit')
    @include('admin.students.partials.bulkdelete')

@endsection

@push('scripts')
    <script src="{{ asset('assets/js/modal.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Core Configuration
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
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
                        if (response.success && response.data) {
                            const std = response.data;
                            const date = std.admission_date ? std.admission_date.substring(0, 10) : '';
                            const datedob = std.dob ? std.dob.substring(0, 10) : '';
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
                            // Handle photo display
                            if (std.photo) {
                                $('#edit_photo').attr('src', window.location.origin + '/' + std.photo)
                                    .removeClass('hidden');
                            } else {
                                let initials = '?';
                                if (std.name) {
                                    initials = std.name.split(' ')
                                        .filter(n => n.length > 0)
                                        .map(n => n[0])
                                        .join('')
                                        .toUpperCase()
                                        .substring(0, 2);
                                }
                                if (std.photo) {
                                    $('#edit_photo').attr('src', '/' + std.photo).removeClass('hidden');
                                    alert("ccc")
                                } else {
                                    const initials = std.name.split(' ').map(n => n[0]).join('')
                                        .toUpperCase();
                                    $('#edit_initials').removeClass('hidden').find('span').text(initials);
                                }
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
                if (!form[0].checkValidity()) {
                    form.addClass('was-validated');
                    submitBtn.prop('disabled', false).html(originalBtnHtml);
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
                            const student = response.data;
                            // Format dates
                            const admissionDate = student.admission_date ?
                                new Date(student.admission_date).toLocaleDateString() :
                                '';
                            const dob = student.dob ?
                                new Date(student.dob).toLocaleDateString() :
                                '';
                            // Basic info
                            $('#detail_name').text(student.name ?? '');
                            $('#detail_age').text(student.age ?? '');
                            $('#detail_gender').text(student.gender ?? '');
                            $('#detail_blood_group').text(student.blood_group ?? '');
                            $('#detail_religion').text(student.religion ?? '');
                            $('#detail_nationality').text(student.nationality ?? '');
                            $('#detail_grade').text(student.grade_level?.name ?? 'Unknown');
                            $('#detail_code').text(student.grade_level?.code ?? 'Unknown');
                            $('#detail_description').text(student.grade_level?.description ?? 'Unknown');
                            $('.title').text(student.name ?? '');
                            $('#detail_specialization').text(student.specialization ?? '');
                            $('#detail_department')
                                .text(student.department ?? '')
                                .toggleClass('hidden', !student.department);

                            // Stats
                            $('#detail_experience').text(student.experience ?? '0');
                            $('#detail_qualification').text(student.qualification ?? '');
                            $('#detail_admission_date').text(admissionDate);

                            // Contact info
                            $('#detail_email').text(student.email ?? 'Not provided');
                            $('#detail_phone').text(student.phone ?? 'Not provided');
                            $('#detail_dob').text(dob);
                            $('#detail_address').text(student.address ?? '');

                            // Avatar / Initials
                            const photoContainer = $('#detail_photo');
                            const initialsContainer = $('#detail_initials');
                            const initialsSpan = initialsContainer.find('span');

                            if (student.photo) {
                                photoContainer
                                    .attr('src', `${window.location.origin}/${student.photo}`)
                                    .removeClass('hidden');
                                initialsContainer.addClass('hidden');
                            } else {
                                photoContainer.addClass('hidden');
                                initialsContainer.removeClass('hidden');
                                const nameParts = (student.name ?? '')
                                    .split(' ')
                                    .filter(Boolean);
                                const initials = nameParts.map((part) => part[0]).join('').toUpperCase();
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
                // Attach initial event handlers
                attachRowEventHandlers();
                updateBulkActionsBar();
            }

            // Start the application
            initialize();
        });
    </script>
@endpush
