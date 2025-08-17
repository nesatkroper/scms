@extends('layouts.admin')
@section('title', 'Book Issues')
@section('content')

    <div
        class="box px-2 py-4 md:p-4 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">
        <h3 class="text-lg mb-3 font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
            <svg class="size-8 p-1 rounded-full bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"
                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path
                    d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z" />
            </svg>
            Book Issues
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
                Issue New Book
            </button>
            <div class="flex items-center mt-3 md:mt-0 gap-2">
                <div class="relative w-full">
                    <input type="search" id="searchInput" placeholder="Search book issues..."
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
        <div id="TableContainer" class="table-respone mt-6 overflow-x-auto h-[60vh]">
            @include('admin.bookissues.partials.table', ['bookIssues' => $bookIssues])
        </div>
        <div id="CardContainer" class="hidden my-5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
            @include('admin.bookissues.partials.cardlist', ['bookIssues' => $bookIssues])
        </div>
        {{-- pagination --}}
        @include('admin.bookissues.partials.pagination')
    </div>

    <!-- Modal Backdrop -->
    <div id="modalBackdrop" class="fixed inset-0 bg-black/50 z-40 hidden backdrop-blur-sm"></div>

    @include('admin.bookissues.partials.create')
    @include('admin.bookissues.partials.edit')
    @include('admin.bookissues.partials.detail')
    @include('admin.bookissues.partials.delete')
    @include('admin.bookissues.partials.bulkedit')
    @include('admin.bookissues.partials.bulkdelete')
@endsection

@push('scripts')
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
                    url: "{{ route('admin.bookissues.index') }}",
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

            // CRUD Operations
            function handleCreateSubmit(e) {
                e.preventDefault();
                const form = $(this);
                const submitBtn = $('#createSubmitBtn');
                const originalBtnHtml = submitBtn.html();

                submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i> Saving...');

                $.ajax({
                    url: form.attr('action'),
                    method: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        if (response.success) {
                            closeModal('Modalcreate');
                            ShowTaskMessage('success', response.message);
                            refreshGradeLevelContent();
                            form.trigger('reset');
                        } else {
                            ShowTaskMessage('error', response.message || 'Error creating grade level');
                        }
                    },
                    error: function(xhr) {
                        const errors = xhr.responseJSON?.errors || {};
                        let errorMessages = Object.values(errors).flat().join('\n');
                        ShowTaskMessage('error', errorMessages || 'Error creating grade level');
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
                editBtn.find('.btn-content').html('<i class="fas fa-spinner fa-spin mr-2"></i> Loading...');
                editBtn.prop('disabled', true);
                const Id = $(this).data('id');
                $.get(`/admin/bookissues/${Id}`)
                    .done(function(response) {
                        if (response.success) {
                            const bookIssue = response.bookIssue;
                            $('#edit_book_id').val(bookIssue.book_id);
                            $('#edit_user_id').val(bookIssue.user_id);
                            $('#edit_issue_date').val(bookIssue.issue_date);
                            $('#edit_due_date').val(bookIssue.due_date);
                            $('#edit_return_date').val(bookIssue.return_date);
                            $('#edit_fine').val(bookIssue.fine);
                            $('#edit_status').val(bookIssue.status);
                            $('#Formedit').attr('action', `/bookissues/${Id}`);
                            showModal('Modaledit');
                        } else {
                            ShowTaskMessage('error', response.message || 'Failed to load book issue data');
                        }
                    })
                    .fail(function(xhr) {
                        console.error('Error:', xhr.responseText);
                        ShowTaskMessage('error', 'Failed to load grade level data');
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

                submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i> Saving...');

                $.ajax({
                    url: form.attr('action'),
                    method: 'POST',
                    data: form.serialize() + '&_method=PUT',
                    success: function(response) {
                        if (response.success) {
                            closeModal('Modaledit');
                            ShowTaskMessage('success', response.message);
                            refreshGradeLevelContent();
                        } else {
                            ShowTaskMessage('error', response.message || 'Error updating grade level');
                        }
                    },
                    error: function(xhr) {
                        const errors = xhr.responseJSON?.errors || {};
                        let errorMessages = Object.values(errors).flat().join('\n');
                        ShowTaskMessage('error', errorMessages || 'Error updating grade level');
                    },
                    complete: function() {
                        submitBtn.prop('disabled', false).html(originalBtnHtml);
                    }
                });
            }

            function handleDeleteClick(e) {
                e.preventDefault();
                const Id = $(this).data('id');
                $('#Formdelete').attr('action', `/bookissues/${Id}`);
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
                            refreshGradeLevelContent();
                        } else {
                            ShowTaskMessage('error', response.message || 'Error deleting grade level');
                        }
                    },
                    error: function(xhr) {
                        ShowTaskMessage('error', xhr.responseJSON?.message ||
                            'Error deleting grade level');
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

                $.get(`/admin/bookissues/${Id}`)
                    .done(function(response) {
                        if (response.success) {
                            const bookIssue = response.bookIssue;
                            const updatedAt = bookIssue.updated_at ? bookIssue.updated_at.substring(0, 10) : '';

                            $('#detail_book_title').val(bookIssue.book.title ?? '');
                            $('#detail_user_name').val(bookIssue.user.name ?? '');
                            $('#detail_issue_date').val(bookIssue.issue_date ?? '');
                            $('#detail_due_date').val(bookIssue.due_date ?? '');
                            $('#detail_return_date').val(bookIssue.return_date ?? '');
                            $('#detail_fine').val(bookIssue.fine ?? '0.00');
                            $('#detail_status').val(bookIssue.status ?? '');
                            $('#detail_created_at').val(bookIssue.created_at ?? '');
                            $('#detail_updated_at').val(updatedAt);
                            showModal('Modaldetail');
                        } else {
                            ShowTaskMessage('error', response.message || 'Failed to load grade level details');
                        }
                    })
                    .fail(function(xhr) {
                        console.error('Error:', xhr.responseText);
                        ShowTaskMessage('error', 'Failed to load grade level details');
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
                    ShowTaskMessage('error', 'Please select at least one grade level to delete');
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
                        url: "{{ route('admin.bookissues.bulkDelete') }}",
                        method: 'POST',
                        data: {
                            ids: selectedIds
                        },
                        success: function(response) {
                            if (response.success) {
                                closeModal('bulkDeleteToastModal');
                                ShowTaskMessage('success', response.message);
                                refreshGradeLevelContent();
                            } else {
                                ShowTaskMessage('error', response.message ||
                                    'Error deleting grade levels');
                            }
                        },
                        error: function(xhr) {
                            ShowTaskMessage('error', xhr.responseJSON?.message ||
                                'Error deleting grade levels');
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
                    ShowTaskMessage('error', 'Please select at least one grade level to edit');
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
                    ShowTaskMessage('error', 'You can only edit up to 5 grade levels at a time');
                    bulkEditBtn.innerHTML = originalBtnText;
                    bulkEditBtn.disabled = false;
                    return;
                }

                document.getElementById('bulkEditCount').textContent = selectedIds.length;

                $.ajax({
                    url: "{{ route('admin.bookissues.getBulkData') }}",
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

                        response.data.forEach((gradeLevel, index) => {
                            const fieldHtml = `
                        <div class="sub-field mb-5 p-4 border border-gray-200 dark:border-gray-700 rounded-lg">
                            <input type="hidden" name="gradelevels[${index}][id]" value="${gradeLevel.id}">
                            <div class="flex justify-between items-center mb-2">
                                <h4 class="text-md font-medium text-gray-700 dark:text-gray-300">Grade Level #${index + 1}</h4>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 sm:gap-4">
                                <div class="mb-4">
                                    <label for="gradelevels[${index}][name]" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                        Name <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="gradelevels[${index}][name]" name="gradelevels[${index}][name]"
                                        class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white
                                        border-gray-400"
                                        value="${gradeLevel.name}"
                                        placeholder="Enter grade level name" required>
                                </div>

                                <div class="mb-4">
                                    <label for="gradelevels[${index}][code]" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                        Code <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="gradelevels[${index}][code]" name="gradelevels[${index}][code]"
                                        class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white
                                        border-gray-400"
                                        value="${gradeLevel.code}"
                                        placeholder="Enter grade level code" required>
                                </div>
                            </div>

                            <div class="mt-4">
                                <label for="gradelevels[${index}][description]"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Description
                                </label>
                                <textarea id="gradelevels[${index}][description]" name="gradelevels[${index}][description]" rows="2"
                                    class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                                    focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white
                                    border-gray-400"
                                    placeholder="Enter grade level description">${gradeLevel.description || ''}</textarea>
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
                    const gradeLevel = {
                        id: $(this).find('input[type="hidden"]').val(),
                        name: $(this).find('input[name$="[name]"]').val(),
                        code: $(this).find('input[name$="[code]"]').val(),
                        description: $(this).find('textarea[name$="[description]"]').val()
                    };
                    dataform.push(gradeLevel);
                });

                $.ajax({
                    url: "{{ route('admin.bookcategory.bulkUpdate') }}",
                    method: 'POST',
                    data: {
                        grade_levels: dataform
                    },
                    success: function(response) {
                        if (response.success) {
                            closeModal('bulkEditModal');
                            ShowTaskMessage('success', response.message);
                            refreshGradeLevelContent();
                        } else {
                            let errorMessage = response.message || 'Error updating grade levels';
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
            function refreshGradeLevelContent() {
                const currentView = localStorage.getItem('viewitem') || 'table';
                const searchTerm = searchInput.val() || '';

                $.ajax({
                    url: "{{ route('admin.bookissues.index') }}",
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
