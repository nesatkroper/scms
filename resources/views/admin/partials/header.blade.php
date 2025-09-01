<header
    class="flex items-center justify-between px-6 py-3 bg-white dark:bg-slate-800  fixed w-[100%] md:sticky top-0 z-10 border-b border-gray-200 dark:border-gray-700">
    <!-- Left side - Toggle button -->
    <div class="flex items-center">
        <button id="toggle-sidebar"
            class="rounded-full cursor-pointer size-9 flex justify-center items-center text-gray-600 dark:text-gray-300
                        hover:text-indigo-600 hover:bg-indigo-100 dark:hover:bg-indigo-900 dark:hover:text-indigo-400 focus:outline-none">
            <i class="fas fa-bars text-lg"></i>
        </button>
    </div>

    <!-- Right side - User actions -->
    <div class="flex items-center space-x-4">
        <div class="ml-4 relative hidden lg:block" id="search-container">
            <div class="relative">
                <input type="text" id="search-input" placeholder="Search..."
                    class="bg-slate-50 border border-slate-300 dark:border-gray-500 dark:bg-slate-700 text-gray-800 dark:text-gray-200 rounded-full pl-11 pr-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 w-80">
                <i class="fas fa-search absolute left-4 top-3 text-gray-500 dark:text-gray-400"></i>
            </div>

            <!-- Dropdown results -->
            <div id="search-results"
                class="hidden absolute p-4 z-10 mt-2 w-full bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 max-h-96 overflow-y-auto">
                <!-- Results will be inserted here by JavaScript -->
            </div>
        </div>

        <!-- Mobile search button -->
        <div class="lg:hidden">
            <search>
                <button id="searchall"
                    class="rounded-full size-9 cursor-pointer flex justify-center items-center border border-indigo-100 dark:border-indigo-900
                dark:text-gray-300 text-indigo-600 hover:bg-indigo-50 dark:hover:bg-gray-700 focus:outline-none ">
                    <i class="ri-search-line text-xl"></i>
                </button>
            </search>
        </div>

        <!-- Dark mode toggle -->
        <button id="dark-mode-toggle"
            class="rounded-full size-9 cursor-pointer flex justify-center items-center border border-indigo-100 dark:border-indigo-900
                        dark:text-gray-300 text-indigo-600 hover:bg-indigo-50 dark:hover:bg-gray-700 focus:outline-none ">
            <!-- Moon icon (shown in light mode) -->
            <svg class="size-4 dark:hidden" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"
                fill="currentColor">
                <path
                    d="M223.5 32C100 32 0 132.3 0 256S100 480 223.5 480c60.6 0 115.5-24.2 155.8-63.4c5-4.9 6.3-12.5 3.1-18.7s-10.1-9.7-17-8.5c-9.8 1.7-19.8 2.6-30.1 2.6c-96.9 0-175.5-78.8-175.5-176c0-65.8 36-123.1 89.3-153.3c6.1-3.5 9.2-10.5 7.7-17.3s-7.3-11.9-14.3-12.5c-6.3-.5-12.6-.8-19-.8z" />
            </svg>
            <!-- Sun icon (shown in dark mode) -->
            <svg id="sun-icon" class="size-5 hidden dark:block" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z">
                </path>
            </svg>
        </button>

        <!-- Notifications -->
        <div class="relative">
            <button
                class="rounded-full size-9 cursor-pointer border border-indigo-100 text-indigo-600 dark:text-indigo-300 dark:border-indigo-900 dark:hover:bg-gray-700
                             hover:bg-indigo-50 dark:indigo-gray-300 focus:outline-none">
                <i class="fas fa-bell text-xl"></i>
                <span class="notification-dot absolute bg-red-500 rounded-full w-2 h-2"></span>
            </button>
        </div>

        <!-- User profile -->
        <div class="relative">
            <button class="cursor-pointer flex items-center focus:outline-none" id="user-menu-button">
                @if (auth()->user()->avatar)
                    <img src="{{ asset(auth()->user()->avatar) }}" alt="User"
                        class="size-9 rounded-full border-2 border-indigo-500 dark:border-white">
                @else
                    <img src="{{ asset('images/user.png') }}" alt="User"
                        class="size-9 rounded-full border-2 border-indigo-500 dark:border-white">
                @endif
            </button>
            <!-- Dropdown menu with icons -->
            <div id="user-dropdown"
                class="border border-gray-200 dark:border-gray-700 absolute right-0 mt-2 w-56 bg-white dark:bg-gray-800 rounded-lg shadow-lg py-2 hidden animate-fadeIn z-20">
                <a href="#"
                    class="flex items-center px-4 py-2 text-gray-800 dark:text-gray-200 hover:bg-indigo-100 dark:hover:bg-gray-700">
                    <svg class="w-5 h-5 mr-3 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Profile
                </a>
                <a href="#"
                    class="flex items-center px-4 py-2 text-gray-800 dark:text-gray-200 hover:bg-indigo-100 dark:hover:bg-gray-700">
                    <svg class="w-5 h-5 mr-3 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                        </path>
                    </svg>
                    Account Settings
                </a>
                <div class="border-t border-gray-200 dark:border-gray-700 my-1"></div>

                <form method="POST" action="{{ route('logout') }}"
                    class="block hover:bg-indigo-100 dark:hover:bg-gray-700">
                    @csrf
                    <button type="submit" class="flex items-center w-full pl-5 px-4 py-2 text-red-500 cursor-pointer">
                        <svg class="w-5 h-5 mr-3 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                            </path>
                        </svg>
                        {{ __('Logout') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search-input');
            const searchResults = document.getElementById('search-results');
            let searchTimeout;

            // Sample data - replace with real data from your Laravel backend
            const sampleData = [{
                    id: 1,
                    title: 'Home',
                    type: 'Page',
                    icon: 'fas fa-tachometer-alt',
                    url: 'admin/home'
                },

                {
                    id: 2,
                    title: 'User Settings',
                    type: 'Page',
                    icon: 'fas fa-cog',
                    url: 'admin/settings'
                },
                {
                    id: 3,
                    title: 'Project Report',
                    type: 'Document',
                    icon: 'fas fa-file-alt',
                    url: 'admin/reports'
                },
                {
                    id: 4,
                    title: 'Team Meeting',
                    type: 'Event',
                    icon: 'fas fa-calendar',
                    url: '/calendar'
                },
                {
                    id: 5,
                    title: 'Subjects',
                    type: 'Page',
                    icon: 'fas fa-tachometer-alt',
                    url: 'admin/subjects'
                },
                {
                    id: 5,
                    title: 'Students',
                    type: 'Page',
                    icon: 'fas fa-user-graduate',
                    url: 'admin/students'
                },
                {
                    id: 5,
                    title: 'Teachers',
                    type: 'Page',
                    icon: 'fas fa-chalkboard-teacher',
                    url: 'admin/teachers'
                },
            ];

            searchInput.addEventListener('input', function(e) {
                clearTimeout(searchTimeout);
                const query = e.target.value.trim();

                if (query.length > 2) {
                    searchTimeout = setTimeout(() => {
                        // In a real app, you would make an AJAX call here
                        // fetchSearchResults(query);

                        // For demo, we'll filter the sample data
                        const results = sampleData.filter(item =>
                            item.title.toLowerCase().includes(query.toLowerCase())
                        );

                        displayResults(results, query);
                    }, 300);
                } else {
                    hideResults();
                }
            });

            // Click outside to close
            document.addEventListener('click', function(e) {
                if (!e.target.closest('#search-container')) {
                    hideResults();
                }
            });

            function displayResults(results, query) {
                if (results.length === 0) {
                    searchResults.innerHTML = `
                <div class="px-4 py-3 text-gray-500 dark:text-gray-400">
                    No results found for "${query}"
                </div>
            `;
                } else {
                    searchResults.innerHTML = results.map(item => `
                <a href="${item.url}" class="block rounded-sm px-2 p-1 hover:bg-indigo-50 dark:hover:bg-gray-700 border-b border-gray-100 dark:border-gray-700 last:border-b-0">
                    <div class="flex items-center">
                        <i class="${item.icon} mr-3 text-indigo-500"></i>
                        <div>
                            <div class="font-medium text-gray-800 dark:text-gray-200">${item.title}</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">${item.type}</div>
                        </div>
                    </div>
                </a>
            `).join('');
                }

                searchResults.classList.remove('hidden');
            }

            function hideResults() {
                searchResults.classList.add('hidden');
            }

            // For a real implementation, you would make an AJAX call like this:
            /*
            function fetchSearchResults(query) {
                fetch(`/api/search?q=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(data => displayResults(data, query))
                    .catch(error => {
                        console.error('Search error:', error);
                        hideResults();
                    });
            }
            */
        });
    </script>
@endpush
