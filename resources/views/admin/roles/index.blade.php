@extends('layouts.admin')
@section('title', 'Roles')
@section('content')
    <div
        class="box px-2 py-4 md:p-4 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">
        <h3 class="text-lg mb-3 font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
            <div
                class="flex justify-center items-center not-only:size-8 p-1 rounded-full bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900">
                <i class="fa-brands fa-critical-role"></i>
            </div>
            Roles
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
                Create New Role
            </button>
            <div class="flex items-center mt-3 md:mt-0 gap-2">
                <div class="relative w-full">
                    <input type="search" id="searchInput" placeholder="Search subjects..."
                        class="w-full border border-gray-300 dark:border-gray-500 dark:bg-gray-700 text-sm rounded-lg pl-8 pr-2 py-1.5 
            focus:outline-none focus:ring-2 focus:ring-indigo-500 text-gray-800 dark:text-gray-100">
                    <i class="fas fa-search absolute left-2.5 top-2.5 text-gray-400 text-xs"></i>
                </div>
            </div>
        </div>
        <div id="TableContainer" class="table-respone overflow-x-auto h-[60vh]">
            @include('admin.roles.partials.table', ['roles' => $roles])
        </div>
        <x-table.pagination :paginator="$roles" />

    </div>
    <div id="modalBackdrop" class="fixed inset-0 bg-black/50 z-40 hidden backdrop-blur-sm"></div>
    @include('admin.roles.partials.create')
    @include('admin.roles.partials.edit')
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

            const backdrop = document.getElementById('modalBackdrop');
            const tableContainer = $('#TableContainer');
            const searchInput = $('#searchInput');

            function debounce(func, wait) {
                let timeout;
                return function() {
                    const context = this,
                        args = arguments;
                    clearTimeout(timeout);
                    timeout = setTimeout(() => func.apply(context, args), wait);
                };
            }
            searchInput.on('input', debounce(() => searchData(searchInput.val()), 500));

            const openCreateBtn = document.getElementById('openCreateModal');
            if (openCreateBtn) {
                openCreateBtn.addEventListener('click', function() {
                    showModal('Modalcreate');
                });
            }

            function handleCreateSubmit(e) {
                e.preventDefault();
                const form = $(this);
                const submitBtn = $('#createSubmitBtn');
                const originalBtnHtml = submitBtn.html();
                // Check validity before submitting
                if (!this.checkValidity()) {
                    $(this).addClass('was-validated');
                    return;
                }
                submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i> Saving...');

                $.ajax({
                    url: form.attr('action'),
                    method: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        if (response.success) {
                            closeModal('Modalcreate');
                            ShowTaskMessage('success', response.message);
                            refreshContent();
                            form.trigger('reset');
                            // Reset validation state
                            form.removeClass('was-validated');
                            form.find('.is-valid, .is-invalid').removeClass('is-valid is-invalid');
                        } else {
                            ShowTaskMessage('error', response.message || 'Error creating role');
                        }
                    },
                    error: function(xhr) {
                        const errors = xhr.responseJSON?.errors || {};

                        if (xhr.status === 422) {
                            // Name field specific handling
                            if (errors.name) {
                                $('#name').addClass('border-red-500 is-invalid');
                                $('#error-name').text(errors.name[0]);
                            }
                            // Add similar blocks for other fields if needed
                        } else {
                            const errorMsg = xhr.responseJSON?.message ||
                                xhr.statusText ||
                                'Network error occurred';
                            ShowTaskMessage('error', errorMsg);
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
                const originalContent = editBtn.find('.btn-content').html();
                editBtn.find('.btn-content').html(
                    '<i class="fas fa-spinner fa-spin"></i><span class="ml-2 textnone">Loading...</span>');
                editBtn.prop('disabled', true);

                const Id = $(this).data('id');

                $.get(`/admin/roles/${Id}`) // Changed URL to roles
                    .done(function(response) {
                        if (response.success) {
                            $('#edit_name').val(response.role.name); // Changed to response.role
                            $('#Formedit').attr('action', `roles/${Id}`); // Changed action URL

                            $('#Formedit').removeClass('was-validated');
                            $('#Formedit').find('.is-valid, .is-invalid').removeClass('is-valid is-invalid');
                            showModal('Modaledit');
                        } else {
                            ShowTaskMessage('error', response.message ||
                                'Failed to load role data'); // Changed message
                        }
                    })
                    .fail(function(xhr) {
                        console.error('Error:', xhr.responseText);
                        ShowTaskMessage('error', 'Failed to load role data'); // Changed message
                    })
                    .always(function() {
                        editBtn.find('.btn-content').html(originalContent);
                        editBtn.prop('disabled', false);
                    });
            }

            function handleEditSubmit(e) {
                e.preventDefault();
                const form = $(this);
                const submitBtn = $('#saveEditBtn');
                const originalBtnHtml = submitBtn.html();
                // Check validity before submitting
                if (!this.checkValidity()) {
                    $(this).addClass('was-validated');
                    return;
                }

                submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i> Saving...');

                $.ajax({
                    url: form.attr('action'),
                    method: 'POST',
                    data: form.serialize() + '&_method=PUT',
                    success: function(response) {
                        if (response.success) {
                            closeModal('Modaledit');
                            ShowTaskMessage('success', response.message);
                            refreshContent(); // Changed to refreshContent
                            form.removeClass('was-validated');
                            form.find('.is-valid, .is-invalid').removeClass('is-valid is-invalid');
                        } else {
                            ShowTaskMessage('error', response.message ||
                                'Error updating role'); // Changed message
                        }
                    },
                    error: function(xhr) {
                        const errors = xhr.responseJSON?.errors || {};

                        if (xhr.status === 422) {
                            // Name field specific handling
                            if (errors.name) {
                                $('#edit_name').addClass('border-red-500 is-invalid');
                                $('#edit-error-name').text(errors.name[0]);
                            }
                            // Add similar blocks for other fields if needed
                        } else {
                            const errorMsg = xhr.responseJSON?.message ||
                                xhr.statusText ||
                                'Network error occurred';
                            ShowTaskMessage('error', errorMsg);
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
                $('#Formdelete').attr('action', `/admin/roles/${Id}`); // Changed URL
                showModal('Modaldelete');
            }

            function handleDeleteSubmit(e) {
                e.preventDefault();
                const form = $(this);
                const submitBtn = $('#confirmDeleteBtn');
                const originalBtnHtml = submitBtn.html();

                submitBtn.prop('disabled', true).html(
                    '<i class="fas fa-spinner fa-spin"></i><span class="ml-2 textnone">Deleting...</span>');

                $.ajax({
                    url: form.attr('action'),
                    method: 'POST',
                    data: {
                        _method: 'DELETE'
                    },
                    success: function(response) {
                        if (response.success) {
                            closeModal('Modaldelete');
                            ShowTaskMessage('success', response.message);
                            refreshContent(); // Changed to refreshContent
                        } else {
                            ShowTaskMessage('error', response.message ||
                                'Error deleting role'); // Changed message
                        }
                    },
                    error: function(xhr) {
                        ShowTaskMessage('error', xhr.responseJSON?.message ||
                            'Error deleting role'); // Changed message
                    },
                    complete: function() {
                        submitBtn.prop('disabled', false).html(originalBtnHtml);
                    }
                });
            }

            // Search and Pagination
            function searchData(searchTerm) {
                $.ajax({
                    url: "{{ route('admin.roles.index') }}",
                    method: 'GET',
                    data: {
                        search: searchTerm
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

            function refreshContent() {
                $.ajax({
                    url: "{{ route('admin.roles.index') }}", // Changed route
                    method: 'GET',
                    data: {},
                    success: function(response) {
                        if (response.success) {
                            tableContainer.html(response.html.table);
                            $('.pagination').html(response.html.pagination);
                            attachRowEventHandlers();
                        } else {
                            ShowTaskMessage('error', 'Failed to refresh role data'); // Changed message
                        }
                    },
                    error: function(xhr) {
                        console.error('Refresh failed:', xhr.responseText);
                        ShowTaskMessage('error', 'Failed to refresh role data'); // Changed message
                    }
                });
            }

            function attachRowEventHandlers() {
                $('.edit-btn').off('click').on('click', handleEditClick);
                $('.delete-btn').off('click').on('click', handleDeleteClick);
            }

            function initialize() {
                $('#Modalcreate form').off('submit').on('submit', handleCreateSubmit);
                $('#Formedit').off('submit').on('submit', handleEditSubmit);
                $('#Formdelete').off('submit').on('submit', handleDeleteSubmit);
                attachRowEventHandlers();
            }

            initialize();
        });
    </script>
@endpush
