@extends('layouts.admin')

@section('content')
    <div
        class="px-2 py-4 md:p-4 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">
        <div class="md:flex gap-2 justify-between items-center mb-3">
            <h3 class="mb-3 sm:mb-sm-0 text-lg font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
                <svg class="size-8 p-1 rounded-full bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                        clip-rule="evenodd" />
                </svg>
                Scores Management
            </h3>

            <button id="createnew"
                class="text-nowrap px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 cursor-pointer transition-colors flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                        clip-rule="evenodd" />
                </svg>
                Add Score
            </button>
            {{-- <a href="{{ route('admin.scores.create') }}"
                class="text-nowrap px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 cursor-pointer transition-colors flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                        clip-rule="evenodd" />
                </svg>
                Add Score
            </a> --}}

        </div>
        <div
            class="p-2 md:flex gap-2 justify-between items-center border rounded-md border-gray-200
             dark:border-gray-700 bg-violet-50 dark:bg-slate-800">

            <div class="mt-3 md:mt-0 gap-2">
                <div class="mb-2 flex items-center justify-between gap-4">
                    <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300">Filters</h4>
                    <!-- View Toggle -->
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

                <form id="filterForm" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-4">
                    <!-- Department Filter -->
                    <x-fields.select labelclass="text-xs" class="py-1.5" label="Department" name="department_id"
                        :options="$departments" :value="request('department_id')" :searchable="true" />
                    <!-- Grade Level Filter -->
                    <x-fields.select labelclass="text-xs" class="py-1.5" label="Grade Level" name="gradelevel_id"
                        :options="$gradeLevels" :value="request('gradelevel_id')" :searchable="true" />
                    <!-- Student Filter -->
                    <x-fields.select labelclass="text-xs" class="py-1.5" label="Student" name="student_id"
                        :options="$students" :value="request('student_id')" :searchable="true" />
                    <!-- Exam Filter -->
                    <x-fields.select labelclass="text-xs" class="py-1.5" label="Exam" name="exam_id" :options="$exams"
                        :value="request('exam_id')" :searchable="true" />
                    <!-- Subject Filter -->
                    <x-fields.select labelclass="text-xs" class="py-1.5" label="Subject" name="subject_id"
                        :options="$subjects" :value="request('subject_id')" :searchable="true" />
                    <x-fields.select id="semester" labelclass="text-xs" class="py-1.5" name="semester" label="Semester"
                        :options="['semester1' => '1', 'semester2' => '2']" :value="old('semester1', '1')" />
                    <!-- Grade Filter -->
                    <div>
                        <label for="gradeFilter"
                            class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Grade</label>
                        <input type="text" id="gradeFilter" name="grade" placeholder="Enter grade"
                            value="{{ request('grade') }}"
                            class="w-full px-3 py-1.5 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 text-sm">
                    </div>

                    <!-- Score Range Filter -->
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label for="minScoreFilter"
                                class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Min Score</label>
                            <input type="number" id="minScoreFilter" name="min_score" placeholder="Min"
                                value="{{ request('min_score') }}"
                                class="w-full px-3 py-1.5 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 text-sm">
                        </div>
                        <div>
                            <label for="maxScoreFilter"
                                class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Max Score</label>
                            <input type="number" id="maxScoreFilter" name="max_score" placeholder="Max"
                                value="{{ request('max_score') }}"
                                class="w-full px-3 py-1.5 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 text-sm">
                        </div>
                    </div>

                    <div class="md:col-span-2 lg:col-span-4 flex justify-end gap-2">
                        <!-- Search Input -->
                        <div class="relative w-full">
                            <input type="search" id="searchInput" placeholder="Search scores..."
                                class="w-full border border-gray-300 dark:border-gray-500 dark:bg-gray-700 text-sm rounded-lg pl-8 pr-2 py-1.5 focus:outline-none focus:ring-2 focus:ring-indigo-500 text-gray-800 dark:text-gray-100">
                            <i class="fas fa-search absolute left-2.5 top-2.5 text-gray-400 text-xs"></i>
                        </div>
                        <button id="resetSearch"
                            class="p-2 h-8 w-8 flex items-center justify-center cursor-pointer bg-indigo-100 dark:bg-indigo-700 hover:bg-gray-300 dark:hover:bg-indigo-600 rounded-md transition-colors">
                            <i class="ri-reset-right-line text-indigo-600 dark:text-gray-300 text-xl"></i>
                        </button>
                        <button type="button" id="applyFilters"
                            class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 text-sm cursor-pointer">
                            Filters</button>
                        <button type="button" id="resetFilters"
                            class="px-4 py-2 cursor-pointer bg-gray-200 dark:bg-gray-600 text-gray-800 dark:text-gray-200
                             rounded-md hover:bg-gray-300 dark:hover:bg-gray-500 text-sm">
                            Reset
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Table View -->
        <div id="TableContainer" class="table-responsive overflow-x-auto h-[60vh]">
            @include('admin.scores.table', ['scores' => $scores])
        </div>
        <!-- Card View (hidden by default) -->
        <div id="CardContainer" class="hidden my-5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
            @include('admin.scores.partials.cardlist', ['scores' => $scores])
        </div>
        <!-- Pagination -->
        <x-table.pagination :paginator="$scores" />
    </div>

    <!-- Modal Backdrop -->
    <div id="modalBackdrop" class="fixed inset-0 bg-black/50 z-40 hidden backdrop-blur-sm"></div>

    @include('admin.scores.partials.create')
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
            $('#createnew').off('click').on('click', function() {
                showModal('Modalcreate');
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
                            console.log('Selected id:', this.dataset.value);
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

        });

        // function handleEditClick(e) {
        //     e.preventDefault();
        //     const editBtn = $(this);
        //     const originalContent = editBtn.html();
        //     editBtn.html('<i class="fas fa-spinner fa-spin"></i><span class="ml-2 textnone">Loading...</span>')
        //         .prop('disabled', true);
        //     const Id = $(this).data('id');
        //     $.get(`/admin/scores/${Id}`)
        //         .done(function(response) {
        //             if (response.success && response.user) {

        //                 $('#Formedit').attr('action', `/users/${Id}`);
        //                 showModal('Modaledit');
        //             } else {
        //                 ShowTaskMessage('error', response.message || 'Failed to load user data: Invalid response');
        //             }
        //         })
        //         .fail(function(xhr) {
        //             ShowTaskMessage('error', xhr.responseJSON?.message || 'Failed to load user data');
        //         })
        //         .always(function() {
        //             editBtn.html(originalContent).prop('disabled', false);
        //         });
        // }

        // $('.edit-btn').off('click').on('click', handleEditClick);
        // Handle view button click with AJAX

        $(document).on('click', '.edit-btn', function(e) {
            e.preventDefault();
            var Id = $(this).data('id');

            $.ajax({
                url: '/admin/scores/' + Id,
                type: 'GET',
                dataType: 'json',
                beforeSend: function() {
                    // Show loading spinner
                    $('#scoreModal .modal-content').html(
                        '<div class="modal-body text-center"><i class="fas fa-spinner fa-spin fa-2x"></i></div>'
                    );
                    $('#scoreModal').modal('show');
                },
                success: function(response) {
                    if (response.success) {
                        $('#scoreModal .modal-content').html(response.html);
                    } else {
                        $('#scoreModal .modal-content').html(
                            '<div class="modal-body"><div class="alert alert-danger">Error loading score details</div></div>'
                        );
                    }
                },
                error: function() {
                    $('#scoreModal .modal-content').html(
                        '<div class="modal-body"><div class="alert alert-danger">Error loading score details</div></div>'
                    );
                }
            });
        });
    </script>
@endpush
