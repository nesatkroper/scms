@extends('layouts.admin')
@section('title', 'Users')

@section('content')
    <x-page.index btn-text="Create New User" :showReset="true" :showViewToggle="true" title="User"
        iconSvgPath="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z">
        <!-- Filter Form -->
        <form action="{{ route('admin.users.index') }}" method="GET" id="FilterForm" class="my-2">
            <div class="flex items-center space-x-4">
                <label for="roleFilterSelect" class="text-sm font-medium text-gray-700 dark:text-gray-300">Filter by
                    Role:</label>
                <select id="roleFilterSelect" name="role_filter" onchange="this.form.submit()"
                    class="px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm dark:bg-gray-700 dark:text-white focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">All Roles</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->name }}" @selected($role->name == ($roleFilter ?? null))>
                            {{ Str::title($role->name) }}
                        </option>
                    @endforeach
                </select>
                @if (request('search'))
                    <input type="hidden" name="search" value="{{ request('search') }}">
                @endif
            </div>
        </form>

        <!-- Table and Card Views -->
        <div id="TableContainer" class="table-respone overflow-x-auto h-[60vh]">
            @include('admin.users.table', ['users' => $users])
        </div>
        <x-table.pagination :paginator="$users" />
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
        // DOM Elements
        const backdrop = document.getElementById('modalBackdrop');

        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const resetSearch = document.getElementById('resetSearch');
            const filterForm = document.getElementById('FilterForm');

            function submitSearch() {
                const currentUrl = new URL(filterForm.action);
                currentUrl.searchParams.set('search', searchInput.value);
                currentUrl.searchParams.delete('page');

                const roleFilter = document.getElementById('roleFilterSelect').value;
                if (roleFilter) {
                    currentUrl.searchParams.set('role_filter', roleFilter);
                } else {
                    currentUrl.searchParams.delete('role_filter');
                }

                window.location.href = currentUrl.toString();
            }

            searchInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    submitSearch();
                }
            });

            resetSearch.addEventListener('click', () => {
                searchInput.value = '';
                const currentUrl = new URL(filterForm.action);
                currentUrl.searchParams.delete('search');
                currentUrl.searchParams.delete('page');
                currentUrl.searchParams.delete('role_filter');
                window.location.href = currentUrl.toString();
            });

            $('.delete-btn').off('click').on('click', handleDeleteClick);

            // ADD THIS LINE ↓↓↓ (very important)
            $('#Formdelete').off('submit').on('submit', handleDeleteSubmit);

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
                            refreshContent(); // Auto refresh list
                        } else {
                            ShowTaskMessage('error', response.message);
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

            // Utility Functions
            function refreshContent() {
                const searchTerm = searchInput.val() || '';
                $.ajax({
                    url: "{{ route('admin.users.index') }}",
                    method: 'GET',
                    data: {
                        search: searchTerm,
                        view: currentView
                    },
                    success: function(response) {
                        if (response.success) {
                            tableContainer.html(response.html.table);
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

        });
    </script>
@endpush
