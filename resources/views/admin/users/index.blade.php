@extends('layouts.admin')
@section('title', 'Users')
@section('content')
    <x-page.index :showReset="true" :showViewToggle="false" title="Users"
        iconSvgPath="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" btn-text="Create New User">
        <div id="TableContainer" class="table-respone overflow-y-hidden overflow-x-auto">
            @include('admin.users.partials.table', ['users' => $users])
        </div>
    </x-page.index>
    @include('admin.users.partials.create')
    @include('admin.users.partials.edit')
    <x-modal.confirmdelete title="User" />
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/modal.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // DOM Elements
            const backdrop = document.getElementById('modalBackdrop');
            const searchInput = $('#searchInput');
            const resetSearch = $('#resetSearch');
            const tableContainer = $('#TableContainer');
            const perPageSelect = $('#perPageSelect');

            // Initialize modal for create button
            const openCreateBtn = document.getElementById('openCreateModal');
            if (openCreateBtn) {
                openCreateBtn.addEventListener('click', function() {
                    showModal('Modalcreate');
                });
            }

            // Handle per page selection change
            perPageSelect.off('change').on('change', function() {
                const perPage = $(this).val();
                refreshContent();
            });

            // Search function
            function searchData(searchTerm) {
                const perPage = perPageSelect.val() || '';
                $.ajax({
                    url: "{{ route('admin.users.index') }}",
                    method: 'GET',
                    data: {
                        search: searchTerm,
                        per_page: perPage
                    },
                    success: function(response) {
                        if (response.success) {
                            tableContainer.html(response.html.table);
                            $('.pagination').html(response.html.pagination);
                            attachRowEventHandlers();
                        } else {
                            ShowTaskMessage('error', 'Failed to load data');
                        }
                    },
                    error: function(xhr) {
                        // console.error('Search failed:', xhr.responseText);
                        ShowTaskMessage('error', 'Failed to load data');
                    }
                });
            }

            // Handle create form submission
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
                        } else {
                            ShowTaskMessage('error', response.message || 'Error creating user');
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

            // Handle edit button click
            function handleEditClick(e) {
                e.preventDefault();
                const editBtn = $(this);
                const originalContent = editBtn.html();
                editBtn.html('<i class="fas fa-spinner fa-spin"></i><span class="ml-2 textnone">Loading...</span>')
                    .prop('disabled', true);

                const Id = $(this).data('id');

                $.get(`/admin/users/${Id}`)
                    .done(function(response) {
                        if (response.success && response.user) {
                            const user = response.user;
                            // Format date of birth
                            const datedob = user.date_of_birth ? user.date_of_birth.substring(0, 10) : '';
                            // Set form values with null checks
                            $('#edit_name').val(user.name || '');
                            $('#edit_user').val(user.user_id || '');
                            $('#edit_phone').val(user.phone || '');
                            $('#edit_email').val(user.email || '');
                            $('#edit_gender').val(user.gender || '');
                            $('#edit_dob').val(datedob);
                            $('#edit_user_id').val(user.user_id || '');
                            $('#edit_password').val(''); // Don't pre-fill password for security
                            $('#edit_address').val(user.address || '');

                            // Handle role selection
                            if (user.roles && user.roles.length > 0) {
                                $('#role').val(user.roles[0].name);
                            } else {
                                $('#role').val('');
                            }

                            // Handle photo display
                            if (user.avatar) {
                                $('#edit_avatar').attr('src', window.location.origin + '/' + user.avatar)
                                    .removeClass('hidden');
                                $('#edit_initials').addClass('hidden');
                            } else {
                                let initials = '?';
                                if (user.name) {
                                    initials = user.name.split(' ')
                                        .filter(n => n.length > 0)
                                        .map(n => n[0])
                                        .join('')
                                        .toUpperCase()
                                        .substring(0, 2);
                                }

                                if (user.avatar) {
                                    $('#edit_avatar').attr('src', '/' + user.avatar).removeClass('hidden');
                                    $('#edit_initials').addClass('hidden');
                                } else {
                                    $('#edit_photo').addClass('hidden');
                                    const initials = user.name.split(' ').map(n => n[0]).join('')
                                        .toUpperCase();
                                    $('#edit_initials').removeClass('hidden').find('span').text(initials);
                                }
                            }
                            // Set form action
                            $('#Formedit').attr('action', `/users/${Id}`);
                            showModal('Modaledit');
                        } else {
                            ShowTaskMessage('error', response.message ||
                                'Failed to load user data: Invalid response');
                        }
                    })
                    .fail(function(xhr) {
                        // console.error('Error:', xhr.responseText);
                        ShowTaskMessage('error', xhr.responseJSON?.message || 'Failed to load user data');
                    })
                    .always(function() {
                        editBtn.html(originalContent).prop('disabled', false);
                    });
            }

            // Handle edit form submission
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
                            refreshContent();
                        } else {
                            ShowTaskMessage('error', response.message || 'Error updating users');
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
                            ShowTaskMessage('error', errorMessages || 'Error updating users');
                        }
                    },
                    complete: function() {
                        submitBtn.prop('disabled', false).html(originalBtnHtml);
                    }
                });
            }

            // Handle delete button click
            function handleDeleteClick(e) {
                e.preventDefault();
                const Id = $(this).data('id');
                $('#Formdelete').attr('action', `/users/${Id}`);
                showModal('Modaldelete');
            }

            // Handle delete form submission
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
                            ShowTaskMessage('error', response.message || 'Error deleting user');
                        }
                    },
                    error: function(xhr) {
                        ShowTaskMessage('error', xhr.responseJSON?.message || 'Error deleting user');
                    },
                    complete: function() {
                        submitBtn.prop('disabled', false).html(originalBtnHtml);
                    }
                });
            }

            // Refresh table content
            function refreshContent() {
                const searchTerm = searchInput.val() || '';
                const perPage = perPageSelect.val() || '';

                $.ajax({
                    url: "{{ route('admin.users.index') }}",
                    method: 'GET',
                    data: {
                        search: searchTerm,
                        per_page: perPage
                    },
                    success: function(response) {
                        if (response.success) {
                            tableContainer.html(response.html.table);
                            $('.pagination').html(response.html.pagination);
                            attachRowEventHandlers();
                        } else {
                            ShowTaskMessage('error', 'Failed to refresh data');
                        }
                    },
                    error: function(xhr) {
                        // console.error('Refresh failed:', xhr.responseText);
                        ShowTaskMessage('error', 'Failed to refresh data');
                    }
                });
            }

            // Attach event handlers to table rows
            function attachRowEventHandlers() {
                $('.edit-btn').off('click').on('click', handleEditClick);
                $('.delete-btn').off('click').on('click', handleDeleteClick);
            }
            // Debounce function for search input
            function debounce(func, wait) {
                let timeout;
                return function() {
                    const context = this,
                        args = arguments;
                    clearTimeout(timeout);
                    timeout = setTimeout(() => func.apply(context, args), wait);
                };
            }

            // Initialize all event listeners
            function initialize() {
                // Search functionality
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
