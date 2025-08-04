@extends('layouts.admin')

@section('title', 'Users')

@section('content')
    <x-page.index title="Users" icon-svg-path="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
        create-button-text="Create New User"
        create-button-icon-svg-path="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z">
        <div id="TableContainer">
            <x-table.table :headers="['Name', 'Phone', 'Type', 'Gender', 'Date of Birth']">
                @if (count($users) > 0)
                    @foreach ($users as $user)
                        <tr
                            class="text-nowrap border-b border-gray-200 dark:border-gray-700 hover:bg-indigo-50 dark:hover:bg-gray-700">
                            <x-table.td class="whitespace-nowrap text-gray-900 dark:text-white">
                                <div class="flex items-center">
                                    @if ($user->avatar)
                                        <img class="w-10 h-10 rounded-full object-cover cursor-grab"
                                            src="{{ asset($user->avatar) }}" alt="{{ $user->name }} image"
                                            data-id="{{ $user->id }}">
                                    @else
                                        <div
                                            class="w-10 h-10 rounded-full flex items-center justify-center bg-indigo-600 text-white font-bold cursor-default select-none">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                    @endif

                                    <div class="pl-3">
                                        <div class="text-base font-semibold">
                                            {{ $user->name }}
                                        </div>
                                        <div class="font-normal text-gray-500 truncate">
                                            {{ $user->email }}
                                        </div>
                                    </div>
                                </div>

                            </x-table.td>
                            <x-table.td>{{ $user->phone ?? 'N/A' }}</x-table.td>
                            <x-table.td> {{ $user->getRoleNames()->first() ?? 'N/A' }}</x-table.td>
                            <x-table.td>{{ ucfirst($user->gender ?? 'N/A') }}</x-table.td>
                            <x-table.td>
                                {{ $user->date_of_birth ? \Carbon\Carbon::parse($user->date_of_birth)->format('Y-m-d') : 'N/A' }}
                            </x-table.td>
                            <x-table.td class="text-right">
                                <x-table.action :userId="$user->id" />
                            </x-table.td>
                        </tr>
                    @endforeach
                @else
                    <x-table.no-data :colspan="count(['Id', 'Name', 'Phone', 'Type', 'Gender', 'Date of Birth']) + 1" />
                @endif
            </x-table.table>
            <x-table.pagination :paginator="$users" />
        </div>

        @include('admin.users.partials.create')
        @include('admin.users.partials.edit')
        <x-modal.confirmdelete title="User" />

    </x-page.index>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/modal.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Core Configuration
            // DOM Elements
            const backdrop = document.getElementById('modalBackdrop');
            const searchInput = $('#searchInput');
            const resetSearch = $('#resetSearch');
            const listViewBtn = $('#listViewBtn');
            const cardViewBtn = $('#cardViewBtn');
            const tableContainer = $('#TableContainer');
            const cardContainer = $('#CardContainer');

            const openCreateBtn = document.getElementById('openCreateModal');
            if (openCreateBtn) {
                openCreateBtn.addEventListener('click', function() {
                    showModal('Modalcreate');
                });
            }

            // Search and Pagination
            function searchData(searchTerm) {
                $.ajax({
                    url: "{{ route('admin.users.index') }}",
                    method: 'GET',
                    data: {
                        search: searchTerm,
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
                if (!this.checkValidity()) {
                    $(this).addClass('was-validated');
                    return;
                }
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
                                    // Display error message in corresponding HTML element
                                    $(`#error-${field}`).text(errorMessage);
                                    console.log(field)
                                    console.log(field)
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

                            // Handle role selection (check if roles exist and has at least one)
                            if (user.roles && user.roles.length > 0) {
                                $('#role').val(user.roles[0].name);
                            } else {
                                $('#role').val(''); // or set to default role if needed
                            }
                            // Handle photo display with better null checks
                            if (user.avatar) {
                                $('#edit_avatar').attr('src', window.location.origin + '/' + user.avatar)
                                    .removeClass('hidden');
                                $('#edit_initials').addClass('hidden');
                            } else {
                                $('#edit_avatar').addClass('hidden');
                                let initials = '?';
                                if (user.name) {
                                    initials = user.name.split(' ')
                                        .filter(n => n.length > 0) // filter out empty parts
                                        .map(n => n[0])
                                        .join('')
                                        .toUpperCase()
                                        .substring(0, 2); // limit to 2 characters
                                }
                                $('#edit_initials').removeClass('hidden').find('span').text(initials);
                            }

                            $('#avatar_upload').off('change').on('change', function(e) {
                                const file = e.target.files[0];
                                if (file) {
                                    if (!file.type.match('image.*')) {
                                        ShowTaskMessage('error', 'Please select an image file');
                                        return;
                                    }

                                    const reader = new FileReader();
                                    reader.onload = function(e) {
                                        $('#edit_avatar').attr('src', e.target.result).removeClass(
                                            'hidden');
                                        $('#edit_initials').addClass('hidden');
                                    };
                                    reader.readAsDataURL(file);
                                }
                            });

                            // Set form action
                            $('#Formedit').attr('action', `/users/${Id}`);
                            showModal('Modaledit');
                        } else {
                            ShowTaskMessage('error', response.message ||
                                'Failed to load user data: Invalid response');
                        }
                    })
                    .fail(function(xhr) {
                        console.error('Error:', xhr.responseText);
                        ShowTaskMessage('error', xhr.responseJSON?.message || 'Failed to load user data');
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
                            refreshContent();
                        } else {
                            ShowTaskMessage('error', response.message || 'Error updating users');
                        }
                    },
                    error: function(xhr) {
                        const errors = xhr.responseJSON?.errors || {};
                        let errorMessages = Object.values(errors).flat().join('\n');
                        ShowTaskMessage('error', errorMessages || 'Error updating users');
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
                $('#Formdelete').attr('action', `/users/${Id}`);
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
            function refreshContent() {
                const searchTerm = searchInput.val() || '';
                $.ajax({
                    url: "{{ route('admin.users.index') }}",
                    method: 'GET',
                    data: {
                        search: searchTerm,
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
                        console.error('Refresh failed:', xhr.responseText);
                        ShowTaskMessage('error', 'Failed to refresh data');
                    }
                });
            }

            function attachRowEventHandlers() {
                $('.edit-btn').off('click').on('click', handleEditClick);
                $('.delete-btn').off('click').on('click', handleDeleteClick);
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
