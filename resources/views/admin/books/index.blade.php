@extends('layouts.admin')
@section('title', 'Books')
@section('content')
    <div
        class="box px-2 py-4 md:p-4 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">
        <h3 class="text-lg mb-3 font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
            <svg class="size-8 p-1 rounded-full bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"
                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path
                    d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z" />
            </svg>
            Books
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
                Add New Book
            </button>
            <div class="flex items-center mt-3 md:mt-0 gap-2">
                <div class="relative w-full">
                    <input type="search" id="searchInput" placeholder="Search books..."
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
            @include('admin.books.partials.table', ['books' => $books])
        </div>
        <div id="CardContainer" class="hidden my-5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
            @include('admin.books.partials.cardlist', ['books' => $books])
        </div>
        {{-- pagination --}}
        @include('admin.books.partials.pagination')
    </div>

    <!-- Modal Backdrop -->
    <div id="modalBackdrop" class="fixed inset-0 bg-black/50 z-40 hidden backdrop-blur-sm"></div>

    @include('admin.books.partials.create')
    @include('admin.books.partials.edit')
    @include('admin.books.partials.detail')
    @include('admin.books.partials.delete')
    @include('admin.books.partials.bulkedit')
    @include('admin.books.partials.bulkdelete')
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
                    url: "{{ route('admin.books.index') }}",
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
                            refreshBookContent();
                            form.trigger('reset');
                        } else {
                            ShowTaskMessage('error', response.message || 'Error creating book');
                        }
                    },
                    error: function(xhr) {
                        const errors = xhr.responseJSON?.errors || {};
                        let errorMessages = Object.values(errors).flat().join('\n');
                        ShowTaskMessage('error', errorMessages || 'Error creating book');
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
                editBtn.find('.btn-content').html('<i class="fas fa-spinner fa-spin"></i><span class="ml-2 textnone">Loading...</span>');
                editBtn.prop('disabled', true);

                const bookId = $(this).data('id');

                $.get(`/admin/books/${bookId}`)
                    .done(function(response) {
                        if (response.success) {
                            $('#edit_title').val(response.book.title);
                            $('#edit_author').val(response.book.author);
                            $('#edit_isbn').val(response.book.isbn);
                            $('#edit_publication_year').val(response.book.publication_year);
                            $('#edit_publisher').val(response.book.publisher);
                            $('#edit_quantity').val(response.book.quantity);
                            $('#edit_description').val(response.book.description);
                            $('#edit_category').val(response.book.category);
                            $('#current_cover_image').val(response.book.cover_image);

                            // Display current cover image if exists
                            if (response.book.cover_image) {
                                $('#currentCoverImage').html(`
                                    <img src="/storage/${response.book.cover_image}" 
                                         class="h-32 w-32 object-cover rounded-md mb-2">
                                    <div class="flex items-center">
                                        <input type="checkbox" name="cover_image_removed" id="cover_image_removed" 
                                               class="mr-2 appearance-none size-4 
                    border-2 border-gray-300 dark:border-gray-600 rounded-sm cursor-pointer transition-all duration-200 
                    ease-in-out relative checked:bg-indigo-500 dark:checked:bg-indigo-600
                    checked:border-indigo-500 dark:checked:border-indigo-600 hover:border-indigo-400 dark:hover:border-indigo-500
                    focus:ring-2 focus:ring-indigo-200 dark:focus:ring-indigo-700 focus:ring-offset-2 focus:outline-none before:content-['']
                    before:absolute before:inset-0 before:bg-no-repeat before:bg-center
                    before:bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgc3Ryb2tlPSJ3aGl0ZSIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiPjxwb2x5bGluZSBwb2ludHM9IjIwIDYgOSAxNyA0IDEyIj48L3BvbHlsaW5lPjwvc3ZnPg==')]
                    before:opacity-0 before:transition-opacity before:duration-200 checked:before:opacity-100">
                                        <label for="cover_image_removed" class="text-sm text-gray-600 dark:text-gray-300">
                                            Remove cover image
                                        </label>
                                    </div>
                                `);
                            }

                            $('#Formedit').attr('action', `/books/${bookId}`);
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
                            refreshBookContent();
                        } else {
                            ShowTaskMessage('error', response.message || 'Error updating book');
                        }
                    },
                    error: function(xhr) {
                        const errors = xhr.responseJSON?.errors || {};
                        let errorMessages = Object.values(errors).flat().join('\n');
                        ShowTaskMessage('error', errorMessages || 'Error updating book');
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
                            refreshBookContent();
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
                detailBtn.find('.btn-content').html('<i class="fas fa-spinner fa-spin"></i><span class="ml-2 textnone">Loading...</span>');
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
                                refreshBookContent();
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
                            refreshBookContent();
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
            function refreshBookContent() {
                const currentView = localStorage.getItem('viewitem') || 'table';
                const searchTerm = searchInput.val() || '';

                $.ajax({
                    url: "{{ route('admin.books.index') }}",
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
