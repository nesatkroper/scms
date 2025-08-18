@extends('layouts.admin')
@section('title', 'Book Categories')
@section('content')
    <x-page.index :showReset="true" :showViewToggle="true" title="Book Categories" btn-text="Create New Category"
        iconSvgPath="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"
        btn-icon-svg-path="">
        <div id="TableContainer" class="table-respone mt-6 overflow-x-auto h-[60vh]">
            @include('admin.bookcategory.partials.table', ['categories' => $categories])
        </div>
        <div id="CardContainer" class="hidden my-5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
            @include('admin.bookcategory.partials.cardlist', ['categories' => $categories])
        </div>
        <x-table.pagination :paginator="$categories"/>
    </x-page.index>

    @include('admin.bookcategory.partials.create')
    @include('admin.bookcategory.partials.edit')
    @include('admin.bookcategory.partials.detail')
    <x-modal.confirmdelete title="Category" />
    @include('admin.bookcategory.partials.bulkedit')
    @include('admin.bookcategory.partials.bulkdelete')
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

            // Bulk Actions
            function getSelectedIds() {
                const selectedIds = [];
                $('.row-checkbox:checked').each(function() {
                    selectedIds.push($(this).val());
                });
                return selectedIds;
            }
            
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
                    url: "{{ route('admin.bookcategory.index') }}",
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

            // Utility Functions
            function refreshContent() {
                const currentView = localStorage.getItem('viewitem') || 'table';
                const searchTerm = searchInput.val() || '';
                $.ajax({
                    url: "{{ route('admin.bookcategory.index') }}",
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
                                'Error creating book category');
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
                $.get(`/admin/bookcategory/${Id}`)
                    .done(function(response) {
                        if (response.success) {
                            $('#edit_name').val(response.category.name);
                            $('#edit_description').val(response.category.description);
                            $('#Formedit').attr('action', `bookcategory/${Id}`);
                            showModal('Modaledit');
                        } else {
                            ShowTaskMessage('error', response.message || 'Failed to load book category data');
                        }
                    })
                    .fail(function(xhr) {
                        console.error('Error:', xhr.responseText);
                        ShowTaskMessage('error', 'Failed to load book category data');
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
                                'Error updating book category');
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
                            ShowTaskMessage('error', errorMessages || 'Error updating book category');
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
                $('#Formdelete').attr('action', `/admin/bookcategory/${Id}`);
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
                                'Error deleting book category');
                        }
                    },
                    error: function(xhr) {
                        ShowTaskMessage('error', xhr.responseJSON?.message ||
                            'Error deleting book category');
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

                $.get(`/admin/bookcategory/${Id}`)
                    .done(function(response) {
                        if (response.success) {
                            const category = response.category;
                            const createdAt = category.created_at ? category.created_at.substring(0, 10) : '';
                            const updatedAt = category.updated_at ? category.updated_at.substring(0, 10) : '';
                            $('#detail_name').val(category.name ?? '');
                            $('#detail_description').val(category.description ?? '');
                            $('#detail_created_at').val(createdAt);
                            $('#detail_updated_at').val(updatedAt);
                            showModal('Modaldetail');
                        } else {
                            ShowTaskMessage('error', response.message ||
                                'Failed to load book category details');
                        }
                    })
                    .fail(function(xhr) {
                        console.error('Error:', xhr.responseText);
                        ShowTaskMessage('error', 'Failed to load book category details');
                    })
                    .always(function() {
                        detailBtn.find('.btn-content').html(originalContent);
                        detailBtn.prop('disabled', false);
                    });
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
                    ShowTaskMessage('error', 'Please select at least one book category to delete');
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
                    const searchTerm = searchInput.val() || '';
                    $.ajax({
                        url: "{{ route('admin.bookcategory.bulkDelete') }}",
                        method: 'POST',
                        data: {
                            ids: selectedIds,
                            search: searchTerm
                        },
                        success: function(response) {
                            if (response.success) {
                                closeModal('bulkDeleteToastModal');
                                ShowTaskMessage('success', response.message);
                                refreshContent();
                            } else {
                                ShowTaskMessage('error', response.message ||
                                    'Error deleting book categories');
                            }
                        },
                        error: function(xhr) {
                            ShowTaskMessage('error', xhr.responseJSON?.message ||
                                'Error deleting book categories');
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
                    ShowTaskMessage('error', 'Please select at least one book category to edit');
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
                    ShowTaskMessage('error', 'You can only edit up to 5 book categories at a time');
                    bulkEditBtn.innerHTML = originalBtnText;
                    bulkEditBtn.disabled = false;
                    return;
                }

                document.getElementById('bulkEditCount').textContent = selectedIds.length;
                const searchTerm = searchInput.val() || '';
                $.ajax({
                    url: "{{ route('admin.bookcategory.getBulkData') }}",
                    method: 'POST',
                    data: {
                        ids: selectedIds,
                        search: searchTerm
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

                        response.data.forEach((category, index) => {
                            const fieldHtml = `
                        <div class="sub-field mb-5 p-4 border border-gray-200 dark:border-gray-700 rounded-lg">
                            <input type="hidden" name="book_categories[${index}][id]" value="${category.id}">
                            <div class="flex justify-between items-center mb-2">
                                <h4 class="text-md font-medium text-gray-700 dark:text-gray-300">Book Category #${index + 1}</h4>
                            </div>
                            
                            <div class="mb-4">
                                <label for="book_categories[${index}][name]" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="book_categories[${index}][name]" name="book_categories[${index}][name]"
                                    class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                                    focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white
                                    border-gray-400"
                                    value="${category.name}"
                                    placeholder="Enter category name" required>
                            </div>

                            <div class="mt-4">
                                <label for="book_categories[${index}][description]"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Description
                                </label>
                                <textarea id="book_categories[${index}][description]" name="book_categories[${index}][description]" rows="2"
                                    class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                                    focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white
                                    border-gray-400"
                                    placeholder="Enter category description">${category.description || ''}</textarea>
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
                    const category = {
                        id: $(this).find('input[type="hidden"]').val(),
                        name: $(this).find('input[name$="[name]"]').val(),
                        description: $(this).find('textarea[name$="[description]"]').val()
                    };
                    dataform.push(category);
                });

                $.ajax({
                    url: "{{ route('admin.bookcategory.bulkUpdate') }}",
                    method: 'POST',
                    data: {
                        book_categories: dataform
                    },
                    success: function(response) {
                        if (response.success) {
                            closeModal('bulkEditModal');
                            ShowTaskMessage('success', response.message);
                            refreshContent();
                        } else {
                            let errorMessage = response.message || 'Error updating book categories';
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

            function attachRowEventHandlers() {
                $('.edit-btn').off('click').on('click', handleEditClick);
                $('#selectAllCheckbox').off('change').on('change', function() {
                    $('.row-checkbox').prop('checked', this.checked);
                    updateBulkActionsBar();
                });
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
                attachRowEventHandlers();
                updateBulkActionsBar();
            }

            // Start the application
            initialize();
        });
    </script>
@endpush
