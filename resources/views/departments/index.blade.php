@extends('layouts.app')
@section('title', 'Departments')
@section('content')
    <div class="p-4 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">
        <h3 class="text-lg mb-3 font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 0v12h8V4H6z"
                    clip-rule="evenodd" />
            </svg>
            Departments
        </h3>
        <div class="p-2 md:flex justify-between items-center border rounded-md border-gray-200 dark:border-gray-700">
            <button id="openCreateModal"
                class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                        clip-rule="evenodd" />
                </svg>
                Create New
            </button>
            <div class="flex items-center mt-3 md:mt-0 gap-2">
                <div class="relative w-full">
                    <input type="text" id="searchInput" placeholder="Search departments..."
                        class="w-full border border-gray-300 dark:bg-gray-700 text-sm rounded-lg pl-8 pr-2 py-1.5 
            focus:outline-none focus:ring-2 focus:ring-indigo-500 text-gray-800 dark:text-gray-100">
                    <i class="fas fa-search absolute left-2.5 top-2.5 text-gray-400 text-xs"></i>
                </div>
                <button id="resetSearch"
                    class="p-2 h-8 w-8 flex items-center justify-center bg-indigo-100 dark:bg-indigo-700 hover:bg-gray-300 dark:hover:bg-indigo-600 rounded-md transition-colors">
                    <i class="fas fa-redo text-indigo-600 dark:text-gray-300 text-sm"></i>
                </button>
            </div>
        </div>
        <div class="mt-6" id="departmentsTableContainer">
            @include('departments.partials.table', ['departments' => $departments])
        </div>

        {{-- pagination --}}
        {{-- {{ $departments->links() }} --}}
        @if ($departments->hasPages())
            <div class="flex items-center justify-between border-t border-gray-200 dark:border-gray-700 px-4 py-3 sm:px-6">
                <div class="flex flex-1 justify-between sm:hidden">
                    @if ($departments->onFirstPage())
                        <span
                            class="relative inline-flex items-center rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 px-4 py-2 text-sm font-medium text-gray-400 dark:text-gray-500 cursor-not-allowed">
                            Previous
                        </span>
                    @else
                        <a href="{{ $departments->previousPageUrl() }}"
                            class="relative inline-flex items-center rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700">
                            Previous
                        </a>
                    @endif

                    @if ($departments->hasMorePages())
                        <a href="{{ $departments->nextPageUrl() }}"
                            class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700">
                            Next
                        </a>
                    @else
                        <span
                            class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 px-4 py-2 text-sm font-medium text-gray-400 dark:text-gray-500 cursor-not-allowed">
                            Next
                        </span>
                    @endif
                </div>
                <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-gray-700 dark:text-gray-300">
                            Showing
                            <span class="font-medium">{{ $departments->firstItem() }}</span>
                            to
                            <span class="font-medium">{{ $departments->lastItem() }}</span>
                            of
                            <span class="font-medium">{{ $departments->total() }}</span>
                            results
                        </p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="flex items-center">
                            <span class="text-sm text-gray-700 dark:text-gray-300 mr-2">Rows per page:</span>
                            <select id="perPageSelect"
                                class="text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:text-gray-300">
                                <option value="5" {{ $departments->perPage() == 5 ? 'selected' : '' }}>5</option>
                                <option value="10" {{ $departments->perPage() == 10 ? 'selected' : '' }}>10</option>
                                <option value="15" {{ $departments->perPage() == 15 ? 'selected' : '' }}>15</option>
                                <option value="20" {{ $departments->perPage() == 20 ? 'selected' : '' }}>20</option>
                                <option value="25" {{ $departments->perPage() == 25 ? 'selected' : '' }}>25</option>
                            </select>
                        </div>
                        <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                            @if ($departments->onFirstPage())
                                <span
                                    class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 dark:text-gray-500 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 focus:z-20 focus:outline-offset-0 cursor-not-allowed">
                                    <span class="sr-only">Previous</span>
                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </span>
                            @else
                                <a href="{{ $departments->previousPageUrl() }}"
                                    class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-700 dark:text-gray-200 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 focus:z-20 focus:outline-offset-0">
                                    <span class="sr-only">Previous</span>
                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </a>
                            @endif

                            @foreach ($departments->getUrlRange(1, $departments->lastPage()) as $page => $url)
                                @if ($page == $departments->currentPage())
                                    <span aria-current="page"
                                        class="relative z-10 inline-flex items-center bg-indigo-600 px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                        {{ $page }}
                                    </span>
                                @else
                                    <a href="{{ $url }}"
                                        class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 dark:text-gray-100 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 focus:z-20 focus:outline-offset-0">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach

                            @if ($departments->hasMorePages())
                                <a href="{{ $departments->nextPageUrl() }}"
                                    class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-700 dark:text-gray-200 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 focus:z-20 focus:outline-offset-0">
                                    <span class="sr-only">Next</span>
                                    <svg class="h-5 w-5 rotate-180" viewBox="0 0 20 20" fill="currentColor"
                                        aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </a>
                            @else
                                <span
                                    class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 dark:text-gray-500 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 focus:z-20 focus:outline-offset-0 cursor-not-allowed">
                                    <span class="sr-only">Next</span>
                                    <svg class="h-5 w-5 rotate-180" viewBox="0 0 20 20" fill="currentColor"
                                        aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </span>
                            @endif
                        </nav>
                    </div>
                </div>
            </div>
        @endif

    </div>

    <!-- Modal Backdrop -->
    <div id="modalBackdrop" class="fixed inset-0 bg-black/50 z-40 hidden backdrop-blur-sm"></div>

    @include('departments.partials.create')
    @include('departments.partials.edit')
    @include('departments.partials.detail')
    @include('departments.partials.delete')
    <style>
        .animate-fade-in-out {
            animation: fadeInOut 3s ease-in-out forwards;
        }

        @keyframes fadeInOut {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }

            10% {
                opacity: 1;
                transform: translateY(0);
            }

            90% {
                opacity: 1;
                transform: translateY(0);
            }

            100% {
                opacity: 0;
                transform: translateY(-20px);
            }
        }
    </style>
@endsection

@push('scripts')
    <script>
        $('#perPageSelect').on('change', function() {
            const perPage = $(this).val();
            const url = new URL(window.location.href);
            url.searchParams.set('per_page', perPage);
            window.location.href = url.toString();
        });

        let searchTimeout;
        $('#searchInput').on('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                const searchTerm = $(this).val();
                searchDepartments(searchTerm);
            }, 500);
        });

        $('#resetSearch').on('click', function() {
            $('#searchInput').val('');
            searchDepartments('');
        });

        function searchDepartments(searchTerm) {
            $.ajax({
                url: "{{ route('departments.index') }}",
                method: 'GET',
                data: {
                    search: searchTerm
                },
                success: function(response) {
                    $('#departmentsTableContainer').html(response.html);
                    // Reinitialize event listeners after table update
                    
                },
                error: function(xhr) {
                    console.error('Search failed:', xhr.responseText);
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
       
            // CSRF token setup for AJAX
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // Modal handling for create modal
            const openBtn = document.getElementById('openCreateModal');
            const closeBtn = document.getElementById('closeCreateModal');
            const cancelBtn = document.getElementById('cancelCreateModal');
            const createModal = document.getElementById('createDepartmentModal');
            const backdrop = document.getElementById('modalBackdrop');

            function openCreateModal() {
                backdrop.classList.remove('hidden');
                createModal.classList.remove('hidden');

                setTimeout(() => {
                    createModal.querySelector('div').classList.remove('opacity-0', 'scale-95');
                    createModal.querySelector('div').classList.add('opacity-100', 'scale-100');
                }, 10);

                document.body.style.overflow = 'hidden';
            }

            function closeCreateModal() {
                createModal.querySelector('div').classList.remove('opacity-100', 'scale-100');
                createModal.querySelector('div').classList.add('opacity-0', 'scale-95');

                setTimeout(() => {
                    createModal.classList.add('hidden');
                    backdrop.classList.add('hidden');
                    document.body.style.overflow = 'auto';
                }, 300);
            }

            openBtn.addEventListener('click', openCreateModal);
            closeBtn.addEventListener('click', closeCreateModal);
            cancelBtn.addEventListener('click', closeCreateModal);

            // Create Department Form Submission
            $('#createDepartmentModal form').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        closeCreateModal();
                        showFlashMessage('success', 'Department created successfully');
                        // Reload the page to see the new department
                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                    },
                    error: function(xhr) {
                        const errors = xhr.responseJSON.errors;
                        let errorMessages = '';

                        for (const field in errors) {
                            errorMessages += errors[field][0] + '\n';
                        }

                        showFlashMessage('error', errorMessages);
                    }
                });
            });

            // Edit button handling
            document.querySelectorAll('.edit-btn').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const departmentId = this.getAttribute('data-id');

                    // Fetch department data
                    $.get(`/departments/${departmentId}`, function(data) {
                        $('#edit_name').val(data.department.name);
                        $('#edit_description').val(data.department.description);
                        $('#editDepartmentForm').attr('action',
                            `/departments/${departmentId}`);

                        // Show edit modal
                        const modal = document.getElementById('editDepartmentModal');
                        backdrop.classList.remove('hidden');
                        modal.classList.remove('hidden');

                        setTimeout(() => {
                            modal.querySelector('div').classList.remove(
                                'opacity-0',
                                'scale-95');
                            modal.querySelector('div').classList.add(
                                'opacity-100',
                                'scale-100');
                        }, 10);
                    });
                });
            });

            // Edit Department Form Submission
            $('#editDepartmentForm').submit(function(e) {
                e.preventDefault();

                const url = $(this).attr('action');

                $.ajax({
                    url: url,
                    method: 'PUT',
                    data: $(this).serialize(),
                    success: function(response) {
                        closeEditModalFunc();
                        showFlashMessage('success', 'Department updated successfully');
                        // Reload the page to see the updated department
                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                    },
                    error: function(xhr) {
                        const errors = xhr.responseJSON.errors;
                        let errorMessages = '';

                        for (const field in errors) {
                            errorMessages += errors[field][0] + '\n';
                        }

                        showFlashMessage('error', errorMessages);
                    }
                });
            });

            // Detail button handling
            document.querySelectorAll('.detail-btn').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const departmentId = this.getAttribute('data-id');

                    // Fetch department data
                    $.get(`/departments/${departmentId}`, function(data) {
                        $('#detail_name').text(data.department.name);
                        $('#detail_description').text(data.department.description);
                        $('#detail_created_at').text(data.created_at);
                        $('#detail_updated_at').text(data.updated_at);

                        // Show detail modal
                        const modal = document.getElementById('detailDepartmentModal');
                        backdrop.classList.remove('hidden');
                        modal.classList.remove('hidden');

                        setTimeout(() => {
                            modal.querySelector('div').classList.remove(
                                'opacity-0',
                                'scale-95');
                            modal.querySelector('div').classList.add(
                                'opacity-100',
                                'scale-100');
                        }, 10);
                    });
                });
            });

            // Delete button handling
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const form = this.closest('form');
                    const departmentId = form.action.split('/').pop();

                    // Set up delete form
                    $('#deleteDepartmentForm').attr('action', `/departments/${departmentId}`);

                    // Show delete confirmation modal
                    const modal = document.getElementById('deleteConfirmationModal');
                    backdrop.classList.remove('hidden');
                    modal.classList.remove('hidden');

                    setTimeout(() => {
                        modal.querySelector('div').classList.remove('opacity-0',
                            'scale-95');
                        modal.querySelector('div').classList.add('opacity-100',
                            'scale-100');
                    }, 10);
                });
            });

            // Delete Department Form Submission
            $('#deleteDepartmentForm').submit(function(e) {
                e.preventDefault();

                const url = $(this).attr('action');

                $.ajax({
                    url: url,
                    method: 'DELETE',
                    success: function(response) {
                        closeDeleteModalFunc();
                        showFlashMessage('success', 'Department deleted successfully');
                        // Reload the page to see the changes
                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                    },
                    error: function(xhr) {
                        showFlashMessage('error', 'Error deleting department');
                    }
                });
            });

            // Close edit modal
            const closeEditModal = document.getElementById('closeEditModal');
            const cancelEditModal = document.getElementById('cancelEditModal');

            function closeEditModalFunc() {
                const modal = document.getElementById('editDepartmentModal');
                modal.querySelector('div').classList.remove('opacity-100', 'scale-100');
                modal.querySelector('div').classList.add('opacity-0', 'scale-95');

                setTimeout(() => {
                    modal.classList.add('hidden');
                    backdrop.classList.add('hidden');
                }, 300);
            }

            if (closeEditModal) closeEditModal.addEventListener('click', closeEditModalFunc);
            if (cancelEditModal) cancelEditModal.addEventListener('click', closeEditModalFunc);

            // Close detail modal
            const closeDetailModal = document.getElementById('closeDetailModal');
            const closeDetailModalBtn = document.getElementById('closeDetailModalBtn');

            function closeDetailModalFunc() {
                const modal = document.getElementById('detailDepartmentModal');
                modal.querySelector('div').classList.remove('opacity-100', 'scale-100');
                modal.querySelector('div').classList.add('opacity-0', 'scale-95');

                setTimeout(() => {
                    modal.classList.add('hidden');
                    backdrop.classList.add('hidden');
                }, 300);
            }

            if (closeDetailModal) closeDetailModal.addEventListener('click', closeDetailModalFunc);
            if (closeDetailModalBtn) closeDetailModalBtn.addEventListener('click', closeDetailModalFunc);

            // Close delete modal
            const closeDeleteModal = document.getElementById('closeDeleteModal');
            const cancelDeleteModal = document.getElementById('cancelDeleteModal');

            function closeDeleteModalFunc() {
                const modal = document.getElementById('deleteConfirmationModal');
                modal.querySelector('div').classList.remove('opacity-100', 'scale-100');
                modal.querySelector('div').classList.add('opacity-0', 'scale-95');

                setTimeout(() => {
                    modal.classList.add('hidden');
                    backdrop.classList.add('hidden');
                }, 300);
            }

            if (closeDeleteModal) closeDeleteModal.addEventListener('click', closeDeleteModalFunc);
            if (cancelDeleteModal) cancelDeleteModal.addEventListener('click', closeDeleteModalFunc);

            // Close with Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    if (!document.getElementById('createDepartmentModal').classList.contains(
                            'hidden')) {
                        closeCreateModal();
                    } else if (!document.getElementById('editDepartmentModal').classList.contains(
                            'hidden')) {
                        closeEditModalFunc();
                    } else if (!document.getElementById('detailDepartmentModal').classList.contains(
                            'hidden')) {
                        closeDetailModalFunc();
                    } else if (!document.getElementById('deleteConfirmationModal').classList.contains(
                            'hidden')) {
                        closeDeleteModalFunc();
                    }
                }
            });

            // Auto-hide flash messages
            const flashMessages = document.querySelectorAll('.animate-fade-in-out');
            flashMessages.forEach(
                message => {
                    setTimeout(() => {
                        message.style.display = 'none';
                    }, 3000);
                });

            // Function to show flash messages
            function showFlashMessage(type, message) {
                const flashContainer = document.createElement('div');
                flashContainer.className = `fixed top-5 right-4 z-50 animate-fade-in-out`;

                const innerHtml = `
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

                flashContainer.innerHTML = innerHtml;
                document.body.appendChild(flashContainer);

                setTimeout(() => {
                    flashContainer.remove();
                }, 3000);
            }
        });
    </script>
@endpush
