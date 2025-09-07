@extends('layouts.admin')
@section('title', 'Books')
@section('content')

    <x-page.index :showReset="true" :showViewToggle="true" title="Books" btn-text="Create New Book"
        iconSvgPath="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"
        btn-icon-svg-path="">
        <div id="TableContainer" class="table-respone mt-6 overflow-x-auto h-[60vh]">
            @include('admin.books.partials.table', ['books' => $books])
        </div>
        <div id="CardContainer" class="hidden my-5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
            @include('admin.books.partials.cardlist', ['books' => $books])
        </div>
        <x-table.pagination :paginator="$books" />
    </x-page.index>
    @include('admin.books.partials.create')
    @include('admin.books.partials.edit')
    @include('admin.books.partials.detail')
    @include('admin.books.partials.delete')
    @include('admin.books.partials.bulkedit')
    @include('admin.books.partials.bulkdelete')
    <x-modal.confirmdelete title="Book" />

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
            const perPageSelect = $('#perPageSelect');
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
                const perPage = perPageSelect.val() || '';
                $.ajax({
                    url: "{{ route('admin.books.index') }}",
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

            function refreshContent() {
                const currentView = localStorage.getItem('viewitem') || 'table';
                const searchTerm = searchInput.val() || '';
                const perPage = perPageSelect.val() || '';
                $.ajax({
                    url: "{{ route('admin.books.index') }}",
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
                if (!this.checkValidity()) {
                    $(this).addClass('was-validated');
                    return;
                }
                const formData = new FormData(form[0]); // Use FormData for file uploads
                const submitBtn = $('#createSubmitBtn');
                const originalBtnHtml = submitBtn.html();
                submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i> Saving...');

                $.ajax({
                    url: form.attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            closeModal('Modalcreate');
                            ShowTaskMessage('success', response.message);
                            refreshContent();
                            form.trigger('reset');
                        } else {
                            ShowTaskMessage('error', response.message || 'Error creating book');
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
                            ShowTaskMessage('error', 'Error creating book');
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

                $.get(`/admin/books/${Id}`)
                    .done(function(response) {
                        if (response.success) {
                            const book = response.data;
                            $('#edit_title').val(book.title);
                            $('#edit_author').val(book.author);
                            $('#edit_isbn').val(book.isbn);
                            $('#edit_publication_year').val(book.publication_year);
                            $('#edit_publisher').val(book.publisher);
                            $('#edit_quantity').val(book.quantity);
                            $('#edit_description').val(book.description);
                            $('#edit_category').val(book.category);
                            // Handle photo display
                            if (book.cover_image) {
                                $('#edit_cover_image').attr('src', window.location.origin + '/' + book
                                        .cover_image)
                                    .removeClass('hidden');
                                $('#edit_initials').addClass('hidden');
                            } else {

                                if (book.cover_image) {
                                    $('#edit_avatar').attr('src', '/' + book.cover_image).removeClass('hidden');
                                    $('#edit_initials').addClass('hidden');
                                } else {
                                    $('#edit_photo').addClass('hidden');
                                    $('#edit_initials').removeClass('hidden').find('span').text(initials);
                                }
                            }
                            $('#Formedit').attr('action', `/books/${Id}`);
                            showModal('Modaledit');
                        } else {
                            ShowTaskMessage('error', response.message || 'Failed to load book data');
                        }
                    })
                    .fail(function(xhr) {
                        console.error('Error:', xhr.responseText);
                        ShowTaskMessage('error', 'Failed to load book data');
                    })
                    .always(function() {
                        editBtn.find('.btn-content').html(originalContent);
                        editBtn.prop('disabled', false);
                    });
            }

            function handleEditSubmit(e) {
                e.preventDefault();
                const form = $(this);
                const formData = new FormData(form[0]); // Use FormData for file uploads
                formData.append('_method', 'PUT');
                const submitBtn = $('#saveEditBtn');
                const originalBtnHtml = submitBtn.html();
                submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i> Saving...');

                $.ajax({
                    url: form.attr('action'),
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
                            ShowTaskMessage('error', response.message || 'Error updating book');
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
                            ShowTaskMessage('error', errorMessages || 'Error updating book');
                        }
                    },
                    complete: function() {
                        submitBtn.prop('disabled', false).html(originalBtnHtml);
                    }
                });
            }

            function handleDeleteClick(e) {
                e.preventDefault();
                const bookId = $(this).data('id');
                $('#Formdelete').attr('action', `/admin/books/${bookId}`);
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
                            ShowTaskMessage('error', response.message || 'Error deleting book');
                        }
                    },
                    error: function(xhr) {
                        ShowTaskMessage('error', xhr.responseJSON?.message || 'Error deleting book');
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
                    '<i class="fas fa-spinner fa-spin"></i><span class="ml-2 textnone">Loading...</span>');
                detailBtn.prop('disabled', true);
                const Id = $(this).data('id');
                $.get(`/admin/books/${Id}`)
                    .done(function(response) {
                        if (response.success) {
                            const book = response.book;
                            const createdAt = book.created_at ? book.created_at.substring(0, 10) : '';
                            const updatedAt = book.updated_at ? book.updated_at.substring(0, 10) : '';
                            $('#detail_title').val(book.title ?? '');
                            $('#detail_author').val(book.author ?? '');
                            $('#detail_isbn').val(book.isbn ?? '');
                            $('#detail_publication_year').val(book.publication_year ?? '');
                            $('#detail_publisher').val(book.publisher ?? '');
                            $('#detail_quantity').val(book.quantity ?? '');
                            $('#detail_description').val(book.description ?? '');
                            $('#detail_category').val(book.category ?? '');
                            $('#detail_created_at').val(createdAt);
                            $('#detail_updated_at').val(updatedAt);

                            // Display cover image if exists
                            if (book.cover_image) {
                                $('#detailCoverImage').html(`
                                    <img src="/storage/${book.cover_image}" 
                                         class="h-32 w-32 object-cover rounded-md">
                                `);
                            } else {
                                $('#detailCoverImage').html('<p class="text-gray-500">No cover image</p>');
                            }

                            showModal('Modaldetail');
                        } else {
                            ShowTaskMessage('error', response.message || 'Failed to load book details');
                        }
                    })
                    .fail(function(xhr) {
                        console.error('Error:', xhr.responseText);
                        ShowTaskMessage('error', 'Failed to load book details');
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
                    ShowTaskMessage('error', 'Please select at least one book to delete');
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
                        url: "{{ route('admin.books.bulkDelete') }}",
                        method: 'POST',
                        data: {
                            ids: selectedIds
                        },
                        success: function(response) {
                            if (response.success) {
                                closeModal('bulkDeleteToastModal');
                                ShowTaskMessage('success', response.message);
                                refreshContent();
                            } else {
                                ShowTaskMessage('error', response.message ||
                                    'Error deleting books');
                            }
                        },
                        error: function(xhr) {
                            ShowTaskMessage('error', xhr.responseJSON?.message ||
                                'Error deleting books');
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
                    ShowTaskMessage('error', 'Please select at least one book to edit');
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
                    ShowTaskMessage('error', 'You can only edit up to 5 books at a time');
                    bulkEditBtn.innerHTML = originalBtnText;
                    bulkEditBtn.disabled = false;
                    return;
                }

                document.getElementById('bulkEditCount').textContent = selectedIds.length;

                $.ajax({
                    url: "{{ route('admin.books.getBulkData') }}",
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

                        response.data.forEach((book, index) => {
                            const fieldHtml = `
                        <div class="sub-field mb-5 p-4 border border-gray-200 dark:border-gray-700 rounded-lg">
                            <input type="hidden" name="books[${index}][id]" value="${book.id}">
                            <div class="flex justify-between items-center mb-2">
                                <h4 class="text-md font-medium text-gray-700 dark:text-gray-300">Book #${index + 1}</h4>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 sm:gap-4">
                                <div class="mb-4">
                                    <label for="books[${index}][title]" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                        Title <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="books[${index}][title]" name="books[${index}][title]"
                                        class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white
                                        border-gray-400"
                                        value="${book.title}"
                                        placeholder="Enter book title" required>
                                </div>

                                <div class="mb-4">
                                    <label for="books[${index}][author]" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                        Author <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="books[${index}][author]" name="books[${index}][author]"
                                        class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white
                                        border-gray-400"
                                        value="${book.author}"
                                        placeholder="Enter author name" required>
                                </div>

                                <div class="mb-4">
                                    <label for="books[${index}][isbn]" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                        ISBN <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="books[${index}][isbn]" name="books[${index}][isbn]"
                                        class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white
                                        border-gray-400"
                                        value="${book.isbn}"
                                        placeholder="Enter ISBN" required>
                                </div>

                                <div class="mb-4">
                                    <label for="books[${index}][publication_year]" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                        Publication Year <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number" id="books[${index}][publication_year]" name="books[${index}][publication_year]"
                                        class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white
                                        border-gray-400"
                                        value="${book.publication_year}"
                                        placeholder="Enter publication year" required>
                                </div>

                                <div class="mb-4">
                                    <label for="books[${index}][publisher]" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                        Publisher <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="books[${index}][publisher]" name="books[${index}][publisher]"
                                        class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white
                                        border-gray-400"
                                        value="${book.publisher}"
                                        placeholder="Enter publisher" required>
                                </div>

                                <div class="mb-4">
                                    <label for="books[${index}][quantity]" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                        Quantity <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number" id="books[${index}][quantity]" name="books[${index}][quantity]"
                                        class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white
                                        border-gray-400"
                                        value="${book.quantity}"
                                        placeholder="Enter quantity" required>
                                </div>

                                <div class="mb-4">
                                    <label for="books[${index}][description]" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                        Description
                                    </label>
                                    <textarea id="books[${index}][description]" name="books[${index}][description]"
                                        class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white
                                        border-gray-400"
                                        placeholder="Enter description">${book.description || ''}</textarea>
                                </div>

                                <div class="mb-4">
                                    <label for="books[${index}][category]" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                        Category <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="books[${index}][category]" name="books[${index}][category]"
                                        class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white
                                        border-gray-400"
                                        value="${book.category}"
                                        placeholder="Enter category" required>
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
                    const book = {
                        id: $(this).find('input[type="hidden"]').val(),
                        title: $(this).find('input[name$="[title]"]').val(),
                        author: $(this).find('input[name$="[author]"]').val(),
                        isbn: $(this).find('input[name$="[isbn]"]').val(),
                        publication_year: $(this).find('input[name$="[publication_year]"]').val(),
                        publisher: $(this).find('input[name$="[publisher]"]').val(),
                        quantity: $(this).find('input[name$="[quantity]"]').val(),
                        description: $(this).find('textarea[name$="[description]"]').val(),
                        category: $(this).find('input[name$="[category]"]').val()
                    };
                    dataform.push(book);
                });

                $.ajax({
                    url: "{{ route('admin.books.bulkUpdate') }}",
                    method: 'POST',
                    data: {
                        books: dataform
                    },
                    success: function(response) {
                        if (response.success) {
                            closeModal('bulkEditModal');
                            ShowTaskMessage('success', response.message);
                            refreshContent();
                        } else {
                            let errorMessage = response.message || 'Error updating books';
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
