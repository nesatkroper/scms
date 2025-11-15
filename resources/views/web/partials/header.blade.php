<header class="bg-white/60 dark:bg-gray-800/60 backdrop-blur sticky top-0 z-40 shadow-sm">
    <div class="max-w-7xl xl:max-w-[96rem] mx-auto px-4 py-4 flex items-center justify-between">
        <div class="flex items-center gap-4">
            <a href="#" class="flex items-center gap-3">
                <img src="assets{{ '/images/scms.png' }}" alt="logo" class="w-12 h-12 rounded-full border" />
                <div>
                    <div class="font-semibold text-lg">Wat Damnak</div>
                    <div class="text-xs text-gray-500 dark:text-gray-400">Learning Centre</div>
                </div>
            </a>
        </div>

        <nav class="hidden md:flex items-center gap-6">
            <ul class="flex gap-2 items-center">
                <li class="group relative">
                    <a href="{{ route('web.home') }}"
                        class="px-3 py-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700">Home</a>
                </li>
                <li class="group relative">
                    <button
                        class="px-3 py-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 flex items-center gap-2 submenu-toggle no-select">
                        Who i am
                        <svg class="w-3 h-3 transition-transform group-hover:rotate-180" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                    <!-- Submenu -->
                    <ul class="submenu absolute left-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-md py-2">
                        <li>
                            <a href="{{ route('web.about') }}"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Our History</a>
                        </li>
                        <li>
                            <a href="#team" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Mission &
                                Vision</a>
                        </li>
                    </ul>
                </li>
                <li class="group relative">
                    <a href="{{ route('web.home') }}"
                        class="px-3 py-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700">What we do</a>
                </li>

                <li class="group relative">
                    <button
                        class="px-3 py-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 flex items-center gap-2 submenu-toggle no-select">Activity
                        <svg class="w-3 h-3 transition-transform group-hover:rotate-180" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                    <ul class="submenu absolute left-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-md py-2">
                        <li><a href="#events"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Events</a></li>

                        <li>
                            <a href="#clubs" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">News</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('web.contact') }}"
                        class="px-3 py-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700">Contact Us</a>
                </li>

                <li class="group relative">
                    <a href="{{ route('web.home') }}"
                        class="px-3 py-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700">Donations</a>
                </li>
            </ul>
        </nav>

        <!-- Mobile controls -->
        <div class="flex items-center gap-3 md:hidden">
            <button id="darkToggle" class="p-2 rounded-md border dark:border-transparent"
                title="Toggle dark mode">🌙</button>
            <button id="mobileOpen" class="p-2 rounded-md border" aria-expanded="false">☰</button>
        </div>

        <div class="hidden md:flex items-center gap-3">
            <button id="darkToggleMd" class="p-2 rounded-md border dark:border-transparent"
                title="Toggle dark mode">🌙</button>
        </div>
    </div>

    <!-- Mobile menu panel -->
    <div id="mobileMenu" class="md:hidden bg-white dark:bg-gray-800/95 border-t hidden">
        <div class="px-4 py-4">
            <ul class="space-y-2">
                <li><a href="#home" class="block px-3 py-2 rounded-md">Home</a></li>
                <li>
                    <button class="w-full text-left px-3 py-2 flex justify-between items-center mobile-sub-toggle">About
                        Us <span>▾</span></button>
                    <ul class="pl-3 mobile-submenu hidden">
                        <li><a href="#mission" class="block py-2">Mission</a></li>
                        <li><a href="#team" class="block py-2">Team</a></li>
                    </ul>
                </li>
                <li>
                    <button
                        class="w-full text-left px-3 py-2 flex justify-between items-center mobile-sub-toggle">Activity
                        <span>▾</span></button>
                    <ul class="pl-3 mobile-submenu hidden">
                        <li><a href="#events" class="block py-2">Events</a></li>
                        <li><a href="#gallery" class="block py-2">Gallery</a></li>
                    </ul>
                </li>
                <li><a href="#contact" class="block px-3 py-2 rounded-md">Contact</a></li>
            </ul>
        </div>
    </div>
</header>
