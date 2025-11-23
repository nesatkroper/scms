
@extends('layouts.admin')
@section('title', 'Users')

@section('content')
    <x-page.index :btnLink="true" href="{{ route('admin.users.create') }}" btn-text="Create New User" :showReset="true"
        :showViewToggle="true" title="User"
        iconSvgPath="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z">
        <!-- Filter Form -->
        <div class="my-2">
            <div class="flex items-center space-x-4 flex-wrap gap-2">
                <!-- Role Filter -->
                <div class="flex items-center space-x-2">
                    <label for="roleFilterSelect" class="text-sm font-medium text-gray-700 dark:text-gray-300">Filter by Role:</label>
                    <select id="roleFilterSelect" name="role_filter"
                        class="px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm dark:bg-gray-700 dark:text-white focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">All Roles</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}" @selected($role->name == ($roleFilter ?? null))>
                                {{ Str::title($role->name) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Per Page Select -->
                <div class="flex items-center space-x-2">
                    <label for="perPageSelect" class="text-sm font-medium text-gray-700 dark:text-gray-300">Per Page:</label>
                    <select id="perPageSelect" name="per_page"
                        class="px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm dark:bg-gray-700 dark:text-white focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="5" @selected(request('per_page', 8) == 5)>5</option>
                        <option value="8" @selected(request('per_page', 8) == 8)>8</option>
                        <option value="15" @selected(request('per_page', 8) == 15)>15</option>
                        <option value="20" @selected(request('per_page', 8) == 20)>20</option>
                        <option value="50" @selected(request('per_page', 8) == 50)>50</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Table and Card Views -->
        <div id="TableContainer" class="table-respone overflow-x-auto h-[60vh]">
            @include('admin.users.table', ['users' => $users])
        </div>
        <div id="PaginationContainer">
            <x-table.pagination :paginator="$users" />
        </div>
    </x-page.index>

    <x-modal.confirmdelete title="User" />
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/modal.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const resetSearch = document.getElementById('resetSearch');
            const roleFilterSelect = document.getElementById('roleFilterSelect');
            const perPageSelect = document.getElementById('perPageSelect');
            const tableContainer = $('#TableContainer');
            const paginationContainer = $('#PaginationContainer');

            // Current state
            let currentState = {
                search: searchInput.value,
                role_filter: roleFilterSelect.value,
                per_page: perPageSelect.value
            };

            // Function to load content via AJAX
            function loadContent(params = {}) {
                // Merge with current state
                const requestParams = {
                    ...currentState,
                    ...params
                };

                // Update current state
                currentState = { ...requestParams };

                const url = new URL("{{ route('admin.users.index') }}");
                
                // Add all parameters to URL
                Object.keys(requestParams).forEach(key => {
                    if (requestParams[key]) {
                        url.searchParams.set(key, requestParams[key]);
                    }
                });

                // Show loading indicator
                tableContainer.html('<div class="flex justify-center items-center h-32"><i class="fas fa-spinner fa-spin text-2xl text-blue-500"></i> Loading...</div>');
                paginationContainer.html('<div class="flex justify-center"><i class="fas fa-spinner fa-spin text-blue-500"></i></div>');

                $.ajax({
                    url: url.toString(),
                    method: 'GET',
                    data: requestParams,
                    success: function(response) {
                        if (response.success) {
                            tableContainer.html(response.html.table);
                            paginationContainer.html(response.html.pagination);
                            attachEventHandlers(); // Re-attach event handlers after content update
                            updateBrowserURL(url.toString());
                        } else {
                            ShowTaskMessage('error', 'Failed to load data');
                        }
                    },
                    error: function(xhr) {
                        console.error('Load failed:', xhr.responseText);
                        ShowTaskMessage('error', 'Failed to load data');
                        tableContainer.html('<div class="text-center text-red-500 py-4">Failed to load data</div>');
                    }
                });
            }

            // Function to attach all event handlers
            function attachEventHandlers() {
                // Attach delete button handlers
                $('.delete-btn').off('click').on('click', handleDeleteClick);
                
                // Attach pagination link handlers
                $(document).off('click', '.pagination a').on('click', '.pagination a', function(e) {
                    e.preventDefault();
                    const url = $(this).attr('href');
                    loadContentFromUrl(url);
                });

                // Attach view toggle handlers if needed
                $('.view-toggle-btn').off('click').on('click', function(e) {
                    e.preventDefault();
                    const viewType = $(this).data('view');
                    loadContent({ view: viewType });
                });
            }

            // Function to load content from URL
            function loadContentFromUrl(url) {
                tableContainer.html('<div class="flex justify-center items-center h-32"><i class="fas fa-spinner fa-spin text-2xl text-blue-500"></i> Loading...</div>');
                paginationContainer.html('<div class="flex justify-center"><i class="fas fa-spinner fa-spin text-blue-500"></i></div>');
                
                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function(response) {
                        if (response.success) {
                            tableContainer.html(response.html.table);
                            paginationContainer.html(response.html.pagination);
                            attachEventHandlers();
                            updateBrowserURL(url);
                        } else {
                            ShowTaskMessage('error', 'Failed to load data');
                        }
                    },
                    error: function(xhr) {
                        console.error('Load failed:', xhr.responseText);
                        ShowTaskMessage('error', 'Failed to load data');
                    }
                });
            }

            // Update browser URL without reload
            function updateBrowserURL(url) {
                window.history.pushState({ path: url }, '', url);
            }

            // Search functionality
            function submitSearch() {
                const params = {
                    search: searchInput.value,
                    page: 1 // Reset to first page when searching
                };
                loadContent(params);
            }

            // Debounced search to avoid too many requests
            let searchTimeout;
            searchInput.addEventListener('input', function(e) {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    submitSearch();
                }, 500); // Wait 500ms after user stops typing
            });

            searchInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    clearTimeout(searchTimeout);
                    submitSearch();
                }
            });

            // Role filter change event
            roleFilterSelect.addEventListener('change', function() {
                const params = {
                    role_filter: this.value,
                    page: 1 // Reset to first page when filter changes
                };
                loadContent(params);
            });

            // Per page change event
            perPageSelect.addEventListener('change', function() {
                const params = {
                    per_page: this.value,
                    page: 1 // Reset to first page when per page changes
                };
                loadContent(params);
            });

            // Reset search and filters
            resetSearch.addEventListener('click', () => {
                searchInput.value = '';
                roleFilterSelect.value = '';
                perPageSelect.value = '8';
                
                // Update current state
                currentState = {
                    search: '',
                    role_filter: '',
                    per_page: '8'
                };

                loadContent({
                    search: '',
                    role_filter: '',
                    per_page: '8',
                    page: 1
                });
            });

            // Delete functionality
            function handleDeleteClick(e) {
                e.preventDefault();
                const Id = $(this).data('id');
                $('#Formdelete').attr('action', `/admin/users/${Id}`);
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
                            refreshContent(); // Refresh the content after delete
                        } else {
                            ShowTaskMessage('error', response.message);
                        }
                    },
                    error: function(xhr) {
                        ShowTaskMessage('error', xhr.responseJSON?.message || 'Error deleting user');
                    },
                    complete: function() {
                        closeModal('Modaldelete');
                        submitBtn.prop('disabled', false).html(originalBtnHtml);
                    }
                });
            }

            // Refresh content with current filters
            function refreshContent() {
                loadContent({
                    page: 1 // Go to first page after delete
                });
            }

            // Initialize event handlers
            attachEventHandlers();
            
            // Attach delete form submit handler
            $('#Formdelete').off('submit').on('submit', handleDeleteSubmit);

            // Handle browser back/forward buttons
            window.addEventListener('popstate', function() {
                loadContentFromUrl(window.location.href);
            });

            // Initialize current state from URL parameters
            function initializeStateFromURL() {
                const urlParams = new URLSearchParams(window.location.search);
                if (urlParams.has('search')) {
                    searchInput.value = urlParams.get('search');
                    currentState.search = urlParams.get('search');
                }
                if (urlParams.has('role_filter')) {
                    roleFilterSelect.value = urlParams.get('role_filter');
                    currentState.role_filter = urlParams.get('role_filter');
                }
                if (urlParams.has('per_page')) {
                    perPageSelect.value = urlParams.get('per_page');
                    currentState.per_page = urlParams.get('per_page');
                }
            }

            initializeStateFromURL();
        });
    </script>
@endpush