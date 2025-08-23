@extends('layouts.admin')
@section('title', 'Departments')
@section('content')
    <x-page.index :showReset="true" :showViewToggle="true" title="Departments" btn-text="Create New"
        iconSvgPath="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"
        btn-icon-svg-path="">
        <div id="TableContainer" class="table-respone mt-6 overflow-x-auto h-[60vh]">
            @include('admin.departments.partials.table', ['departments' => $departments])
        </div>
        <div id="CardContainer" class="hidden my-5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
            @include('admin.departments.partials.cardlist', ['departments' => $departments])
        </div>
        <x-table.pagination :paginator="$departments" />
    </x-page.index>
    @include('admin.departments.partials.create')
    @include('admin.departments.partials.edit')
    @include('admin.departments.partials.detail')
    <x-modal.confirmdelete title="department" />
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
            const perPageSelect = $('#perPageSelect');
            const searchInput = $('#searchInput');
            const resetSearch = $('#resetSearch');
            const listViewBtn = $('#listViewBtn');
            const cardViewBtn = $('#cardViewBtn');
            const tableContainer = $('#TableContainer');
            const cardContainer = $('#CardContainer');

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
                const perPage = perPageSelect.val() || '';
                $.ajax({
                    url: "{{ route('admin.departments.index') }}",
                    method: 'GET',
                    data: {
                        search: searchTerm,
                        view: currentView,
                        per_page: perPage
                    },
                    success: function(response) {
                        if (response.success) {
                            tableContainer.html(response.html.table);
                            cardContainer.html(response.html.cards);
                            $('.pagination').html(response.html.pagination);
                            attachRowEventHandlers();
                        } else {
                            ShowTaskMessage('error', 'Failed to load datass');
                        }
                    },
                    error: function(xhr) {
                        console.error('Search failed:', xhr.responseText);
                        ShowTaskMessage('error', 'Failed to load data');
                    }
                });
            }

            // Utility Functions
            function refreshContent() {
                const currentView = localStorage.getItem('viewitem') || 'table';
                const searchTerm = searchInput.val() || '';
                const perPage = perPageSelect.val() || '';
                $.ajax({
                    url: "{{ route('admin.departments.index') }}",
                    method: 'GET',
                    data: {
                        search: searchTerm,
                        view: currentView,
                        per_page: perPage
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

            // CRUD Operations
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
                        } else {
                            ShowTaskMessage('error', response.message ||
                                'Error creating department');
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
                const originalContent = editBtn.find('.btn-content').html();
                editBtn.find('.btn-content').html(
                    '<i class="fas fa-spinner fa-spin"></i><span class="ml-2 textnone">loading...</span>');
                editBtn.prop('disabled', true);
                const Id = $(this).data('id');
                $.get(`/admin/departments/${Id}`)
                    .done(function(response) {
                        if (response.success) {
                            $('#edit_name').val(response.data.name);
                            $('#edit_description').val(response.data.description);
                            $('#Formedit').attr('action', `departments/${Id}`);
                            showModal('Modaledit');
                        } else {
                            ShowTaskMessage('error', response.message || 'Failed to load departments data');
                        }
                    })
                    .fail(function(xhr) {
                        console.error('Error:', xhr.responseText);
                        ShowTaskMessage('error', 'Failed to load departments data');
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
                            refreshContent();
                        } else {
                            ShowTaskMessage('error', response.message ||
                                'Error updating department');
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
                            ShowTaskMessage('error', errorMessages || 'Error updating department');
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
                $('#Formdelete').attr('action', `/admin/departments/${Id}`);
                showModal('Modaldelete');
            }

            function handleDeleteSubmit(e) {
                e.preventDefault();
                const form = $(this);
                const submitBtn = $('#confirmDeleteBtn');
                const originalBtnHtml = submitBtn.html();

                submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i> Deleting...');

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
                            refreshContent();
                        } else {
                            ShowTaskMessage('error', response.message ||
                                'Error deleting departments');
                        }
                    },
                    error: function(xhr) {
                        ShowTaskMessage('error', xhr.responseJSON?.message ||
                            'Error deleting departments');
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
                detailBtn.find('.btn-content').html(
                    '<i class="fas fa-spinner fa-spin"></i><span class="ml-2 textnone">Deleting...</span>');
                detailBtn.prop('disabled', true);

                const Id = $(this).data('id');

                $.get(`/admin/departments/${Id}`)
                    .done(function(response) {
                        if (response.success) {
                            const d = response.data;
                            const createdAt = d.created_at ? d.created_at.substring(0, 10) : '';
                            const updatedAt = d.updated_at ? d.updated_at.substring(0, 10) : '';
                            $('#detail_name').val(d.name ?? '');
                            $('#detail_description').val(d.description ?? '');
                            $('#detail_created_at').val(createdAt);
                            $('#detail_updated_at').val(updatedAt);
                            showModal('Modaldetail');
                        } else {
                            ShowTaskMessage('error', response.message ||
                                'Failed to load departments details');
                        }
                    })
                    .fail(function(xhr) {
                        console.error('Error:', xhr.responseText);
                        ShowTaskMessage('error', 'Failed to load departments details');
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
                })
                // Form submissions
                $('#Modalcreate form').off('submit').on('submit', handleCreateSubmit);
                $('#Formedit').off('submit').on('submit', handleEditSubmit);
                $('#Formdelete').off('submit').on('submit', handleDeleteSubmit);
                attachRowEventHandlers();
            }
            // Start the application
            initialize();
        });
    </script>
@endpush
