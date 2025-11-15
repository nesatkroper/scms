<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Wat Damnak Learning Centre</title>
    <!-- SwiperJS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <!-- AOS -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <!-- Fancybox -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: sans-serif;
        }

        /* Offcanvas transitions */
        .offcanvas {
            transform: translateX(-100%);
            transition: transform 0.3s ease-in-out;
        }

        .offcanvas.open {
            transform: translateX(0);
        }

        .backdrop {
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;
        }

        .backdrop.open {
            opacity: 1;
            visibility: visible;
        }

        /* small helper for smooth submenu transitions */
        .submenu {
            display: none;
        }

        .no-select {
            -webkit-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        /* Hero video cover */
        .hero-video {
            object-fit: cover;
            width: 100%;
            height: 100%;
        }

        .footer-gradient {
            background: linear-gradient(135deg, #1e3a8a 0%, #0f172a 100%);
        }

        .dark .footer-gradient {
            background: linear-gradient(135deg, #0f172a 0%, #020617 100%);
        }

        .gradient-text {
            background: linear-gradient(to right, white, #3b82f6);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .dark .gradient-text {
            background: linear-gradient(to right, #e2e8f0, #60a5fa);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
    </style>
    @include('layouts.partials.metatag')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-800 dark:bg-gray-900 dark:text-gray-100 transition-colors duration-300">
    <!-- Container -->
    <div class="min-h-screen flex flex-col">
        <!-- Header / Nav -->
        <header
            class="bg-white/90 dark:bg-gray-800/60 backdrop-blur sticky top-0 z-40 shadow-sm border-b border-slate-300 dark:border-slate-600">
            <div class="max-w-7xl xl:max-w-[96rem] mx-auto px-4 py-3 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <a href="#" class="flex items-center gap-3">
                        <img src="assets{{ '/images/scms.png' }}" alt="logo" class="size-14 rounded-full border" />
                        <div class="hidden sm:block">
                            <div class="font-semibold text-lg">Wat Damnak</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">Learning Centre</div>
                        </div>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <nav class="hidden lg:flex items-center gap-6">
                    <ul class="flex gap-2 items-center">
                        <li class="group relative">
                            <a href="{{ route('web.home') }}"
                                class="px-3 py-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">Home</a>
                        </li>
                        <li class="group relative">
                            <button
                                class="px-3 py-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 flex items-center gap-2 submenu-toggle no-select transition-colors duration-200">
                                Who i am
                                <svg class="w-3 h-3 transition-transform duration-200 group-hover:rotate-180"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                            <!-- Submenu -->
                            <ul
                                class="submenu absolute left-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg py-2 border border-gray-200 dark:border-gray-700">
                                <li>
                                    <a href="{{ route('web.about') }}"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">Our
                                        History</a>
                                </li>
                                <li>
                                    <a href="#team"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">Mission
                                        &
                                        Vision</a>
                                </li>
                            </ul>
                        </li>
                        <li class="group relative">
                            <a href="{{ route('web.home') }}"
                                class="px-3 py-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">What
                                we do</a>
                        </li>

                        <li class="group relative">
                            <button
                                class="px-3 py-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 flex items-center gap-2 submenu-toggle no-select transition-colors duration-200">Activity
                                <svg class="w-3 h-3 transition-transform duration-200 group-hover:rotate-180"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                            <ul
                                class="submenu absolute left-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg py-2 border border-gray-200 dark:border-gray-700">
                                <li><a href="#events"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">Events</a>
                                </li>

                                <li>
                                    <a href="#clubs"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">News</a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="{{ route('web.contact') }}"
                                class="px-3 py-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">Contact
                                Us</a>
                        </li>
                    </ul>
                </nav>
                <div class="relative">
                    <a href="{{ route('web.home') }}"
                        class="px-3 py-2 border border-orange-500 rounded-md bg-orange-500 hover:bg-transparent dark:hover:bg-gray-7 hover:text-orange-500 text-slate-100 transition-colors duration-200 cursor-pointer">
                        <i class="fas fa-hand-holding-heart w-5 group-hover:text-blue-500 transition-colors duration-200"></i>
                        Donations
                    </a>
                </div>
                <!-- Desktop Theme Toggle -->
                <button id="darkToggle"
                    class="size-9 hidden lg:flex items-center justify-center rounded-full cursor-pointer p-2 border border-slate-300 dark:border-slate-700 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200"
                    title="Toggle dark mode">
                    <i class="fas fa-moon"></i>
                </button>
                <!-- Mobile controls -->
                <div class="flex items-center gap-3 lg:hidden">
                    <button id="mobileOpen"
                        class="bg-indigo-800 cursor-pointer text-slate-200 size-9 flex items-center justify-center rounded-full p-2 
                        border hover:bg-slate-100 hover:text-indigo-800 dark:hover:bg-gray-700 transition-colors duration-200"
                        aria-expanded="false">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
        </header>

        <!-- Offcanvas Backdrop -->
        <div id="offcanvasBackdrop" class="backdrop fixed inset-0 bg-black/50 z-50 lg:hidden"></div>
        <!-- Offcanvas Menu -->
        <div id="offcanvasMenu"
            class="offcanvas fixed top-0 left-0 h-full w-80 bg-white dark:bg-gray-800 shadow-xl z-50 lg:hidden overflow-y-auto">
            <!-- Offcanvas Header -->
            <div class="flex items-center justify-between p-4 border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-center gap-3">
                    <img src="assets{{ '/images/scms.png' }}" alt="logo" class="size-12 rounded-full border" />
                    <div>
                        <div class="font-semibold text-lg">Wat Damnak</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">Learning Centre</div>
                    </div>
                </div>
                <button id="mobileClose"
                    class="p-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>

            <!-- Offcanvas Body -->
            <div class="p-4">
                <nav class="space-y-2">
                    <a href="{{ route('web.home') }}"
                        class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200 group">
                        <i
                            class="fas fa-home w-5 text-gray-400 group-hover:text-blue-500 transition-colors duration-200"></i>
                        <span>Home</span>
                    </a>

                    <!-- Who I Am Section -->
                    <div class="mobile-menu-section">
                        <button
                            class="mobile-menu-toggle w-full flex items-center justify-between px-3 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200 group">
                            <div class="flex items-center gap-3">
                                <i
                                    class="fas fa-user w-5 text-gray-400 group-hover:text-blue-500 transition-colors duration-200"></i>
                                <span>Who I Am</span>
                            </div>
                            <i class="fas fa-chevron-down text-xs text-gray-400 transition-transform duration-200"></i>
                        </button>
                        <div class="mobile-submenu pl-8 hidden">
                            <a href="{{ route('web.about') }}"
                                class="block py-2 px-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                                Our History
                            </a>
                            <a href="#team"
                                class="block py-2 px-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                                Mission & Vision
                            </a>
                        </div>
                    </div>

                    <a href="{{ route('web.home') }}"
                        class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200 group">
                        <i
                            class="fas fa-tasks w-5 text-gray-400 group-hover:text-blue-500 transition-colors duration-200"></i>
                        <span>What We Do</span>
                    </a>

                    <!-- Activity Section -->
                    <div class="mobile-menu-section">
                        <button
                            class="mobile-menu-toggle w-full flex items-center justify-between px-3 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200 group">
                            <div class="flex items-center gap-3">
                                <i
                                    class="fas fa-calendar-alt w-5 text-gray-400 group-hover:text-blue-500 transition-colors duration-200"></i>
                                <span>Activity</span>
                            </div>
                            <i class="fas fa-chevron-down text-xs text-gray-400 transition-transform duration-200"></i>
                        </button>
                        <div class="mobile-submenu pl-8 hidden">
                            <a href="#events"
                                class="block py-2 px-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                                Events
                            </a>
                            <a href="#clubs"
                                class="block py-2 px-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                                News
                            </a>
                        </div>
                    </div>

                    <a href="{{ route('web.contact') }}"
                        class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200 group">
                        <i
                            class="fas fa-envelope w-5 text-gray-400 group-hover:text-blue-500 transition-colors duration-200"></i>
                        <span>Contact Us</span>
                    </a>

                </nav>

                <div class="mt-6 flex justify-center">
                    <button id="darkToggle"
                        class="size-9 flex items-center justify-center rounded-full cursor-pointer p-2 border border-slate-300 dark:border-slate-700 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200"
                        title="Toggle dark mode">
                        <i class="fas fa-moon"></i>
                    </button>
                </div>

                <!-- Social Links in Mobile Menu -->
                <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <h4 class="font-medium text-gray-700 dark:text-gray-300 mb-4">Follow Us</h4>
                    <div class="flex space-x-3">
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center hover:bg-blue-500 hover:text-white transition-all duration-300">
                            <i class="fab fa-facebook-f text-sm"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center hover:bg-pink-500 hover:text-white transition-all duration-300">
                            <i class="fab fa-instagram text-sm"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center hover:bg-red-500 hover:text-white transition-all duration-300">
                            <i class="fab fa-youtube text-sm"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center hover:bg-blue-400 hover:text-white transition-all duration-300">
                            <i class="fab fa-telegram text-sm"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main -->
        <main class="flex-1">
            @yield('content')
        </main>
        @include('web.partials.footer')
    </div>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/mainjq.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    @stack('scripts')
    @stack('script')
    <script>
        // Init AOS
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100
        });

        // Offcanvas functionality
        function openOffcanvas() {
            document.getElementById('offcanvasMenu').classList.add('open');
            document.getElementById('offcanvasBackdrop').classList.add('open');
            document.body.style.overflow = 'hidden';
        }

        function closeOffcanvas() {
            document.getElementById('offcanvasMenu').classList.remove('open');
            document.getElementById('offcanvasBackdrop').classList.remove('open');
            document.body.style.overflow = '';
            // Close all mobile submenus
            document.querySelectorAll('.mobile-submenu').forEach(menu => {
                menu.classList.add('hidden');
            });
        }

        // Event listeners
        document.getElementById('mobileOpen').addEventListener('click', openOffcanvas);
        document.getElementById('mobileClose').addEventListener('click', closeOffcanvas);
        document.getElementById('offcanvasBackdrop').addEventListener('click', closeOffcanvas);

        // Mobile submenu toggle
        document.querySelectorAll('.mobile-menu-toggle').forEach(toggle => {
            toggle.addEventListener('click', function() {
                const submenu = this.parentElement.querySelector('.mobile-submenu');
                const icon = this.querySelector('.fa-chevron-down');

                submenu.classList.toggle('hidden');
                icon.classList.toggle('rotate-180');
            });
        });

        // Close offcanvas when clicking on links (optional)
        document.querySelectorAll('#offcanvasMenu a').forEach(link => {
            link.addEventListener('click', closeOffcanvas);
        });

        // Keyboard support
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeOffcanvas();
            }
        });

        // Swiper initialization
        const swiper = new Swiper('.mySwiper', {
            loop: true,
            autoplay: {
                delay: 4500,
                disableOnInteraction: false
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev'
            },
            effect: 'slide'
        });

        // Initialize Staff Swiper
        const staffSwiper = new Swiper('.staffSwiper', {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true,
            autoplay: {
                delay: 3000,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            },
        });

        // Initialize Student Swiper
        const studentSwiper = new Swiper('.studentSwiper', {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true,
            autoplay: {
                delay: 3500,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            },
        });

        // Submenu hover + jQuery toggle
        $(function() {
            // Desktop submenu: show on hover with small delay
            $('.group').hover(function() {
                $(this).find('.submenu').stop(true, true).delay(80).fadeIn(180);
            }, function() {
                $(this).find('.submenu').stop(true, true).delay(80).fadeOut(120);
            });

            // Toggle submenu icon rotation
            $('.submenu-toggle').on('click', function(e) {
                // prevent on small screens where this is used by mobile
                e.preventDefault();
                $(this).next('.submenu').slideToggle(180);
            });

            // Dark mode persistence
            function setDark(dark) {
                if (dark) $('html').addClass('dark');
                else $('html').removeClass('dark');
                localStorage.setItem('watdamnak_dark', dark ? '1' : '0');
            }
            // read saved pref or system
            const saved = localStorage.getItem('watdamnak_dark');
            if (saved === null) {
                const prefers = window.matchMedia('(prefers-color-scheme: dark)').matches;
                setDark(prefers);
            } else setDark(saved === '1');

            $('#darkToggle, #darkToggleMd').on('click', function() {
                const isDark = $('html').hasClass('dark');
                setDark(!isDark);
            });

            // Footer year
            $('#year').text(new Date().getFullYear());
        });

        Fancybox.bind("[data-fancybox]", {
            // Your custom options
        });
    </script>
</body>

</html>
