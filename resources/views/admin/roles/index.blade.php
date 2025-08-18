@extends('layouts.admin')
@section('title', 'Roles')
@section('content')

    <x-page.alert />
    <x-page.index :canCreate="false" :btnLink="true"  :showSearch="true" :showReset="true" :showViewToggle="false" title="Roles"
        iconSvgPath="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" btn-text="Create new role">
        <div id="TableContainer" class="table-respone">
            @include('admin.roles.table', ['roles' => $roles])
        </div>
    </x-page.index>
    <x-modal.confirmdelete title="Role" />
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
            // DOM Elements
            const backdrop = document.getElementById('modalBackdrop');
            const searchInput = $('#searchInput');
            const resetSearch = $('#resetSearch');
            const tableContainer = $('#TableContainer');
            const perPageSelect = $('#perPageSelect');

            // Handle per page selection change
            perPageSelect.off('change').on('change', function() {
                const perPage = $(this).val();
                refreshContent();
            });

            // Search function
            function searchData(searchTerm) {
                const perPage = perPageSelect.val() || '';
                $.ajax({
                    url: "{{ route('admin.roles.index') }}",
                    method: 'GET',
                    data: {
                        search: searchTerm,
                        per_page: perPage
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

            // Handle delete button click
            function handleDeleteClick(e) {
                e.preventDefault();
                const Id = $(this).data('id');
                $('#Formdelete').attr('action', `/roles/${Id}`);
                showModal('Modaldelete');
            }

            // Handle delete form submission
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
                            ShowTaskMessage('error', response.message || 'Error deleting role');
                        }
                    },
                    error: function(xhr) {
                        ShowTaskMessage('error', xhr.responseJSON?.message || 'Error deleting role');
                    },
                    complete: function() {
                        submitBtn.prop('disabled', false).html(originalBtnHtml);
                    }
                });
            }

            // Refresh table content
            function refreshContent() {
                const searchTerm = searchInput.val() || '';
                const perPage = perPageSelect.val() || '';

                $.ajax({
                    url: "{{ route('admin.roles.index') }}",
                    method: 'GET',
                    data: {
                        search: searchTerm,
                        per_page: perPage
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

            // Attach event handlers to table rows
            function attachRowEventHandlers() {
                $('.delete-btn').off('click').on('click', handleDeleteClick);
            }

            // Debounce function for search input
            function debounce(func, wait) {
                let timeout;
                return function() {
                    const context = this,
                        args = arguments;
                    clearTimeout(timeout);
                    timeout = setTimeout(() => func.apply(context, args), wait);
                };
            }

            // Initialize all event listeners
            function initialize() {
                // Search functionality
                searchInput.on('input', debounce(() => searchData(searchInput.val()), 500));
                resetSearch.on('click', () => {
                    searchInput.val('');
                    searchData('');
                });

                $('#Formdelete').off('submit').on('submit', handleDeleteSubmit);
                // Attach initial event handlers
                attachRowEventHandlers();
            }

            // Start the application
            initialize();
        });
    </script>
@endpush
