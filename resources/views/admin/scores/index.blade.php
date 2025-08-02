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

            {{-- <button id="createnew"
                class="text-nowrap px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 cursor-pointer transition-colors flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                        clip-rule="evenodd" />
                </svg>
                Add Score
            </button> --}}
            <a href="{{route('admin.scores.create')}}"
                class="text-nowrap px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 cursor-pointer transition-colors flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                        clip-rule="evenodd" />
                </svg>
                Add Score
            </a>

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

                <form id="filterForm" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-2 sm:gap-4">
                    <!-- Student Filter -->
                    <div>
                        <label for="studentFilter"
                            class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Student</label>
                        <div data-name="student_id"
                            class="custom-select relative w-full text-sm px-3 py-2 border rounded-md focus:outline focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300">
                            <div class="select-header cursor-pointer flex justify-between items-center">
                                <span class="selected-value truncate">
                                    {{ request('student_id') ? $students->firstWhere('id', request('student_id'))?->name : 'Select student' }}
                                </span>
                                <span class="arrow transition-transform duration-300">▼</span>
                            </div>
                            <div
                                class="select-options absolute z-10 top-full left-0 right-0 max-h-[250px] overflow-y-auto hidden shadow-md rounded-sm bg-slate-50 dark:bg-slate-700 border border-slate-300 dark:border-slate-600">
                                <div class="search-container p-2 sticky top-0 z-1 bg-white dark:bg-slate-700">
                                    <input type="search"
                                        class="search-input text-sm w-full px-3 py-2 border rounded-md focus:outline focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300"
                                        placeholder="Search student...">
                                </div>
                                <div class="options-container">
                                    <div class="select-option px-[10px] py-2 cursor-pointer border-b border-slate-200 dark:border-slate-600"
                                        data-value="">
                                        All Students
                                    </div>
                                    @foreach ($students as $student)
                                        <div class="select-option px-[10px] py-2 cursor-pointer border-b border-slate-200 dark:border-slate-600 {{ request('student_id') == $student->id ? 'selected' : '' }}"
                                            data-value="{{ $student->id }}">
                                            {{ $student->name }}
                                        </div>
                                    @endforeach
                                </div>
                                <div class="no-results p-2 text-center text-red-500" style="display: none;">No results found
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="student_id" id="studentFilter" value="{{ request('student_id') }}">
                    </div>

                    <!-- Exam Filter -->
                    <div>
                        <label for="examFilter"
                            class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Exam</label>
                        <div data-name="exam_id"
                            class="custom-select relative w-full text-sm px-3 py-2 border rounded-md focus:outline focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300">
                            <div class="select-header cursor-pointer flex justify-between items-center">
                                <span class="selected-value truncate">
                                    {{ request('exam_id') ? $exams->firstWhere('id', request('exam_id'))?->name : 'Select exam' }}
                                </span>
                                <span class="arrow transition-transform duration-300">▼</span>
                            </div>
                            <div
                                class="select-options absolute z-10 top-full left-0 right-0 max-h-[250px] overflow-y-auto hidden shadow-md rounded-sm bg-slate-50 dark:bg-slate-700 border border-slate-300 dark:border-slate-600">
                                <div class="search-container p-2 sticky top-0 z-1 bg-white dark:bg-slate-700">
                                    <input type="search"
                                        class="search-input text-sm w-full px-3 py-2 border rounded-md focus:outline focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300"
                                        placeholder="Search exam...">
                                </div>
                                <div class="options-container">
                                    <div class="select-option px-[10px] py-2 cursor-pointer border-b border-slate-200 dark:border-slate-600"
                                        data-value="">
                                        All Exams
                                    </div>
                                    @foreach ($exams as $exam)
                                        <div class="select-option px-[10px] py-2 cursor-pointer border-b border-slate-200 dark:border-slate-600 {{ request('exam_id') == $exam->id ? 'selected' : '' }}"
                                            data-value="{{ $exam->id }}">
                                            {{ $exam->name }}
                                        </div>
                                    @endforeach
                                </div>
                                <div class="no-results p-2 text-center text-red-500" style="display: none;">No results found
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="exam_id" id="examFilter" value="{{ request('exam_id') }}">
                    </div>

                    <!-- Grade Filter -->
                    <div>
                        <label for="gradeFilter"
                            class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Grade</label>
                        <input type="text" id="gradeFilter" name="grade" placeholder="Enter grade"
                            value="{{ request('grade') }}"
                            class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 text-sm">
                    </div>
                    <!-- grade Filter -->
                    {{-- <div>
                        <label for="gradeFilter"
                            class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Grade</label>
                        <div data-name="grade_id"
                            class="custom-select relative w-full text-sm px-3 py-2 border rounded-md focus:outline focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300">
                            <div class="select-header cursor-pointer flex justify-between items-center">
                                <span class="selected-value truncate">
                                    {{ request('grade_id') ? $grades->firstWhere('id', request('grade_id'))?->name : 'Select grade' }}
                                </span>
                                <span class="arrow transition-transform duration-300">▼</span>
                            </div>
                            <div
                                class="select-options absolute z-10 top-full left-0 right-0 max-h-[250px] overflow-y-auto hidden shadow-md rounded-sm bg-slate-50 dark:bg-slate-700 border border-slate-300 dark:border-slate-600">
                                <div class="search-container p-2 sticky top-0 z-1 bg-white dark:bg-slate-700">
                                    <input type="search"
                                        class="search-input text-sm w-full px-3 py-2 border rounded-md focus:outline focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300"
                                        placeholder="Search grade...">
                                </div>
                                <div class="options-container">
                                    <div class="select-option px-[10px] py-2 cursor-pointer border-b border-slate-200 dark:border-slate-600"
                                        data-value="">
                                        All grade
                                    </div>
                                    @foreach ($grades as $grade)
                                        <div class="select-option px-[10px] py-2 cursor-pointer border-b border-slate-200 dark:border-slate-600 {{ request('exam_id') == $exam->id ? 'selected' : '' }}"
                                            data-value="{{ $grade->id }}">
                                            {{ $grade->name }}
                                        </div>
                                    @endforeach
                                </div>
                                <div class="no-results p-2 text-center text-red-500" style="display: none;">No results
                                    found
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="grade_id" id="gradeFilter" value="{{ request('grade_id') }}">
                    </div> --}}

                    <!-- Score Range Filter -->
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label for="minScoreFilter"
                                class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Min Score</label>
                            <input type="number" id="minScoreFilter" name="min_score" placeholder="Min"
                                value="{{ request('min_score') }}"
                                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 text-sm">
                        </div>
                        <div>
                            <label for="maxScoreFilter"
                                class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Max Score</label>
                            <input type="number" id="maxScoreFilter" name="max_score" placeholder="Max"
                                value="{{ request('max_score') }}"
                                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 text-sm">
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
            @include('admin.scores.partials.table', ['scores' => $scores])
        </div>

        <!-- Card View (hidden by default) -->
        <div id="CardContainer" class="hidden my-5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
            @include('admin.scores.partials.cardlist', ['scores' => $scores])
        </div>

        <!-- Pagination -->
        <div class="pagination-container">
            {{ $scores->links() }}
        </div>
    </div>

    <!-- Modal Backdrop -->
    <div id="modalBackdrop" class="fixed inset-0 bg-black/50 z-40 hidden backdrop-blur-sm"></div>


    @include('admin.scores.partials.create')
    {{-- @include('admin.scores.partials.edit')
    @include('admin.scores.partials.detail')
    @include('admin.scores.partials.delete')
    @include('admin.scores.partials.bulkedit')
    @include('admin.scores.partials.bulkdelete') --}}
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

            // DOM Elements
            const backdrop = document.getElementById('modalBackdrop');
            const searchInput = $('#searchInput');
            const resetSearch = $('#resetSearch');
            const listViewBtn = $('#listViewBtn');
            const cardViewBtn = $('#cardViewBtn');
            const tableContainer = $('#TableContainer');
            const cardContainer = $('#CardContainer');
            const applyFilters = $('#applyFilters');
            const resetFilters = $('#resetFilters');
            const filterForm = $('#filterForm');

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

            // Search and Filter
            function loadData(search = '', filters = {}) {
                const currentView = localStorage.getItem('viewitem') || 'table';

                $.ajax({
                    url: "{{ route('admin.scores.index') }}",
                    method: 'GET',
                    data: {
                        search: search,
                        view: currentView,
                        ...filters
                    },
                    success: function(response) {
                        if (response.success) {
                            tableContainer.html(response.html.table);
                            cardContainer.html(response.html.cards);
                            $('.pagination-container').html(response.html.pagination);
                            attachRowEventHandlers();
                        } else {
                            ShowTaskMessage('error', 'Failed to load data');
                        }
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr.responseText);
                        ShowTaskMessage('error', 'Failed to load data');
                    }
                });
            }

            // Apply Filters
            applyFilters.on('click', function() {
                const formData = filterForm.serializeArray();
                const filters = {};

                formData.forEach(item => {
                    if (item.value) {
                        filters[item.name] = item.value;
                    }
                });

                loadData(searchInput.val(), filters);
            });

            // Reset Filters
            resetFilters.on('click', function() {
                filterForm.trigger('reset');
                loadData(searchInput.val(), {});
            });

            // Search with debounce
            function debounce(func, wait) {
                let timeout;
                return function() {
                    const context = this,
                        args = arguments;
                    clearTimeout(timeout);
                    timeout = setTimeout(() => func.apply(context, args), wait);
                };
            }

            searchInput.on('input', debounce(function() {
                const formData = filterForm.serializeArray();
                const filters = {};

                formData.forEach(item => {
                    if (item.value) {
                        filters[item.name] = item.value;
                    }
                });

                loadData($(this).val(), filters);
            }, 500));

            resetSearch.on('click', function() {
                searchInput.val('');
                const formData = filterForm.serializeArray();
                const filters = {};

                formData.forEach(item => {
                    if (item.value) {
                        filters[item.name] = item.value;
                    }
                });

                loadData('', filters);
            });

            // View toggle
            listViewBtn.on('click', () => setView('list'));
            cardViewBtn.on('click', () => setView('card'));

            // Initialize
            function initialize() {
                // Set initial view
                const savedView = localStorage.getItem('viewitem') || 'list';
                setView(savedView);
                // Attach initial event handlers
                attachRowEventHandlers();
            }

            $('#createnew').off('click').on('click', function() {
                showModal('Modalcreate');
            });

            // Modal close buttons
            $('[id^="close"], [id^="cancel"]').on('click', function() {
                const modalId = $(this).closest('[id^="Modal"]').attr('id') ||
                    $(this).closest('[id$="Modal"]').attr('id');
                if (modalId) closeModal(modalId);
            });

            $('#Modalcreate form').off('submit').on('submit', handleCreateSubmit);

            // Utility Functions
            function refreshSubjectContent() {
                const currentView = localStorage.getItem('viewitem') || 'table';
                const searchTerm = searchInput.val() || '';

                $.ajax({
                    url: "{{ route('admin.scores.index') }}",
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
                // $('.edit-btn').off('click').on('click', handleEditClick);
                // $('.delete-btn').off('click').on('click', handleDeleteClick);
                // $('.detail-btn').off('click').on('click', handleDetailClick);
                // $('.row-checkbox').off('change').on('change', updateBulkActionsBar);
            }
            // ============ CRUD Operations ====================
            // Create
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
                            refreshSubjectContent();
                            form.trigger('reset');
                        } else {
                            ShowTaskMessage('error', response.message || 'Error creating subject');
                        }
                    },
                    error: function(xhr) {
                        const errors = xhr.responseJSON?.errors || {};
                        let errorMessages = Object.values(errors).flat().join('\n');
                        ShowTaskMessage('error', errorMessages || 'Error creating subject');
                    },
                    complete: function() {
                        submitBtn.prop('disabled', false).html(originalBtnHtml);
                    }
                });
            }
            // Edit
            function handleEditClick(e) {
                e.preventDefault();
                const editBtn = $(this);
                const originalContent = editBtn.find('.btn-content').html();
                editBtn.find('.btn-content').html(
                    '<i class="fas fa-spinner fa-spin"></i><span class="ml-2 textnone">Loading...</span>');
                editBtn.prop('disabled', true);

                const Id = $(this).data('id');

                $.get(`/admin/subjects/${Id}`)
                    .done(function(response) {
                        if (response.success) {
                            $('#edit_name').val(response.subject.name);
                            $('#edit_code').val(response.subject.code);
                            $('#edit_depid').val(response.subject.department_id);
                            $('#edit_credit_hours').val(response.subject.credit_hours);
                            $('#edit_description').val(response.subject.description);
                            $('#Formedit').attr('action', `subjects/${Id}`);
                            showModal('Modaledit');
                        } else {
                            ShowTaskMessage('error', response.message || 'Failed to load subject datas');
                        }
                    })
                    .fail(function(xhr) {
                        console.error('Error:', xhr.responseText);
                        ShowTaskMessage('error', 'Failed to load subject data');
                    })
                    .always(function() {
                        editBtn.find('.btn-content').html(originalContent);
                        editBtn.prop('disabled', false);
                    });
            }
            // Edit Submit
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
                            refreshSubjectContent();
                        } else {
                            ShowTaskMessage('error', response.message || 'Error updating subject');
                        }
                    },
                    error: function(xhr) {
                        const errors = xhr.responseJSON?.errors || {};
                        let errorMessages = Object.values(errors).flat().join('\n');
                        ShowTaskMessage('error', errorMessages || 'Error updating subject');
                    },
                    complete: function() {
                        submitBtn.prop('disabled', false).html(originalBtnHtml);
                    }
                });
            }

            // Start the application
            initialize();

            // Modal Management
            function showModal(modalId) {
                backdrop.classList.remove('hidden');
                const modal = document.getElementById(modalId);
                modal.classList.remove('hidden');
                // console.log(modal);
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
