@extends('layouts.admin')
@section('title', 'Teachers')
@section('content')
    <x-page.index :btnCreate="true" btn-text="Create New Teacher" :showReset="true" :showViewToggle="true" title="Teacher"
        iconSvgPath="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z">
        <div id="TableContainer" class="table-respone overflow-x-auto h-[60vh]">
            @include('admin.teachers.partials.table', ['teachers' => $teachers])
        </div>
        <div id="CardContainer" class="hidden my-5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
            @include('admin.teachers.partials.cardlist', ['teachers' => $teachers])
        </div>
        <x-table.pagination :paginator="$teachers" />
    </x-page.index>

    @include('admin.teachers.partials.create')
    @include('admin.teachers.partials.edit')
    @include('admin.teachers.partials.detail')
    @include('admin.teachers.partials.bulkedit')
    @include('admin.teachers.partials.bulkdelete')
    <x-modal.confirmdelete title="Teacher" />

@endsection

@push('scripts')
    <script src="{{ asset('assets/js/modal.js') }}"></script>
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
            // DOM Elements
            const backdrop = document.getElementById('modalBackdrop');
            const searchInput = $('#searchInput');
            const resetSearch = $('#resetSearch');
            const listViewBtn = $('#listViewBtn');
            const cardViewBtn = $('#cardViewBtn');
            const tableContainer = $('#TableContainer');
            const cardContainer = $('#CardContainer');

            $('#openCreateModal').on('click', function() {
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

            function refreshContent() {
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

            function handleCreateSubmit(e) {
                e.preventDefault();
                const form = $(this);
                if (!this.checkValidity()) {
                    $(this).addClass('was-validated');
                    return;
                }
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
                            refreshContent();
                            form.trigger('reset');
                            // Reset photo preview
                            $('#photoPreview').addClass('hidden');
                            $('#dropArea').removeClass('hidden');
                            // Reset CV preview
                            $('#cvFileName').addClass('hidden');
                            $('#removeCv').addClass('hidden');
                            $('#cvDropArea').removeClass('hidden');
                            $('#cvPreview').addClass('hidden');
                        } else {
                            ShowTaskMessage('error', response.message || 'Error creating teacher');
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422 || xhr.status === 500) {
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

                $.get(`/admin/teachers/${Id}`)
                    .done(function(response) {
                        if (response.success && response.teacher) {
                            const teacher = response.teacher;
                            const date = teacher.joining_date ? teacher.joining_date.substring(0, 10) : '';
                            const datedob = teacher.date_of_birth ? teacher.date_of_birth.substring(0, 10) : '';
                            // Set form values
                            // console.log(teacher)
                            $('#edit_name').val(teacher.name);
                            $('#edit_user').val(teacher.user_id);
                            $('#edit_phone').val(teacher.phone);
                            $('#edit_email').val(teacher.email);
                            $('#edit_gender').val(teacher.gender);
                            $('#edit_date_of_birth').val(datedob);
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
                                $('#edit_photo').removeClass('hidden');
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
                            $('#Formedit').attr('action', `/teachers/${Id}`);
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
                if (!this.checkValidity()) {
                    $(this).addClass('was-validated');
                    return;
                }
                const formData = new FormData(form[0]);
                formData.append('_method', 'PUT');
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
                            form.trigger('reset');
                            refreshContent();
                        } else {
                            ShowTaskMessage('error', response.message || 'Error updating teacher');
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
                            ShowTaskMessage('error', errorMessages || 'Error updating teacher');
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
                $('#Formdelete').attr('action', `/teachers/${Id}`);
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
                            refreshContent();
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
                            $('#detail_date_of_birth').text(teach.date_of_birth ? new Date(teach.date_of_birth).toLocaleDateString() :
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

            function attachRowEventHandlers() {
                $('.edit-btn').off('click').on('click', handleEditClick);
                $('.delete-btn').off('click').on('click', handleDeleteClick);
                $('.detail-btn').off('click').on('click', handleDetailClick);
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
                // Form submissions
                $('#Modalcreate form').off('submit').on('submit', handleCreateSubmit);
                $('#Formedit').off('submit').on('submit', handleEditSubmit);
                $('#Formdelete').off('submit').on('submit', handleDeleteSubmit);
                // Attach initial event handlers
                attachRowEventHandlers();
            }
            // Start the application
            initialize();
        });
    </script>
@endpush
