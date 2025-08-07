<div
    class="box px-2 py-4 md:p-4 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">
    <h3 class="text-lg mb-3 font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
        <svg class="size-8 p-1 rounded-full bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"
            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="{{ $iconSvgPath }}" clip-rule="evenodd" />
        </svg>
        {{ $title }} List
    </h3>

    <div
        class="p-2 md:flex gap-2 justify-between items-center border rounded-md border-gray-200 dark:border-gray-700 bg-violet-50 dark:bg-slate-800">
        <button id="openCreateModal"
            class="text-nowrap px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 cursor-pointer transition-colors flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="{{ $btnIconSvgPath }}" clip-rule="evenodd" />
            </svg>
            {{ $btnText }}
        </button>

        @if ($showSearch || $showReset || $showViewToggle)
            <div class="flex items-center mt-3 md:mt-0 gap-2">
                @if ($showSearch)
                    <div class="relative w-full">
                        <input type="search" id="searchInput" placeholder="Search {{ $title }}..."
                            class="w-full border border-gray-300 dark:border-gray-500 dark:bg-gray-700 text-sm rounded-lg pl-8 pr-2 py-1.5 
            focus:outline-none focus:ring-2 focus:ring-indigo-500 text-gray-800 dark:text-gray-100">
                        <i class="fas fa-search absolute left-2.5 top-2.5 text-gray-400 text-xs"></i>
                    </div>
                @endif

                @if ($showReset)
                    <button id="resetSearch"
                        class="p-2 h-8 w-8 flex items-center justify-center cursor-pointer bg-indigo-100 dark:bg-indigo-700 hover:bg-gray-300 dark:hover:bg-indigo-600 rounded-md transition-colors">
                        <i class="ri-reset-right-line text-indigo-600 dark:text-gray-300 text-xl"></i>
                    </button>
                @endif

                @if ($showViewToggle)
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
                @endif
            </div>
        @endif
    </div>

    {{ $slot }}

</div>
<div id="modalBackdrop" class="fixed inset-0 bg-black/50 z-40 hidden backdrop-blur-sm"></div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            if (typeof $ !== 'undefined') {
                $.ajaxSetup({
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        // 'Accept': 'application/json'
                    }
                });
            }

            window.selectfields = function() {
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
                            console.log('Selected department_id:', this.dataset.value);
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
            selectfields();
        });
    </script>
@endpush
