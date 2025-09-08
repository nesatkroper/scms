
document.addEventListener('DOMContentLoaded', () => {
    // --- ELEMENTS ---
    const sidebar = document.getElementById('sidebar');
    const sidebarBackdrop = document.getElementById('sidebar-backdrop');
    const toggleSidebarBtn = document.getElementById('toggle-sidebar');
    const closeSidebarBtn = document.getElementById('close-sidebar');
    const mainContent = document.getElementById('main-content');
    const sidebarFooterDropdown = document.getElementById('sidebar-footer-dropdown');
    const userMenuButton = document.getElementById('user-menu-button');
    const userDropdown = document.getElementById('user-dropdown');
    const darkModeToggle = document.getElementById('dark-mode-toggle');
    const attendanceChart = document.getElementById('attendanceChart');

    // If none of the sidebar elements exist, exit early (not a page with sidebar)
    if (!sidebar || !toggleSidebarBtn) return;

    // --- STATE ---
    let sidebarCollapsed = false; // Start with expanded sidebar (w-72)
    let activeDropdown = null;
    let footerDropdownActive = false;

    // --- FUNCTIONS ---

    // Toggle Sidebar: Handles mobile off-canvas and desktop collapse
    const toggleSidebar = () => {
        if (window.innerWidth < 768) {
            sidebar?.classList?.toggle('-translate-x-full');
            sidebarBackdrop?.classList?.toggle('hidden');
            sidebarBackdrop?.classList?.toggle('opacity-0');
        } else {
            sidebarCollapsed = !sidebarCollapsed;
            localStorage.setItem('sidebar-collapsed', sidebarCollapsed);
            updateDesktopSidebar();
        }
    };

    // Update Desktop Sidebar View: Toggles classes for collapsed/expanded state
    const updateDesktopSidebar = () => {
        if (!sidebar || !mainContent) return;

        sidebar.classList.toggle('w-72', !sidebarCollapsed);
        sidebar.classList.toggle('w-16', sidebarCollapsed);
        sidebar.classList.toggle('sidebar-collapsed', sidebarCollapsed);
        mainContent.classList.toggle('md:ml-72', !sidebarCollapsed);
        mainContent.classList.toggle('md:ml-16', sidebarCollapsed);

        document.querySelectorAll('.sidebar-text').forEach(el => el?.classList?.toggle('hidden', sidebarCollapsed));
        document.getElementById('sidebar-footer-profile')?.classList?.toggle('hidden', sidebarCollapsed);
        document.getElementById('sidebar-footer-collapsed')?.classList?.toggle('hidden', !sidebarCollapsed);

        if (sidebarCollapsed) {
            closeAllSubmenus();
            closeFooterDropdown();
        } else {
            closeAllCollapsedDropdowns();
        }
    };

    // Submenu Logic
    const toggleSubmenu = (element) => {
        if (!element) return;

        const submenu = element.nextElementSibling;
        const icon = element.querySelector('.menu-icon');

        if (submenu?.classList?.contains('active')) {
            submenu.classList.remove('active');
            if (icon) icon.classList.remove('rotate-icon');
        } else {
            // Close all other submenus at the same level
            const parentMenu = element.closest('ul');
            if (parentMenu) {
                parentMenu.querySelectorAll('.submenu.active').forEach(menu => {
                    if (menu !== submenu) {
                        menu.classList.remove('active');
                        const prevIcon = menu.previousElementSibling?.querySelector('.menu-icon');
                        if (prevIcon) prevIcon.classList.remove('rotate-icon');
                    }
                });
            }

            submenu?.classList?.add('active');
            if (icon) icon.classList.add('rotate-icon');
        }
    };

    const closeAllSubmenus = (parentUl = document) => {
        parentUl.querySelectorAll('.submenu.active').forEach(menu => {
            menu?.classList?.remove('active');
            const prevIcon = menu.previousElementSibling?.querySelector('.menu-icon');
            if (prevIcon) prevIcon.classList.remove('rotate-icon');
        });
    };

    const closeAllCollapsedDropdowns = () => {
        document.querySelectorAll('.collapsed-dropdown.show').forEach(d => d?.classList?.remove('show'));
        activeDropdown = null;
    };

    // Footer Dropdown
    const toggleFooterDropdown = () => {
        if (!sidebarFooterDropdown) return;

        footerDropdownActive = !footerDropdownActive;
        sidebarFooterDropdown.classList.toggle('show', footerDropdownActive);
        if (footerDropdownActive) closeAllCollapsedDropdowns();
    };

    const closeFooterDropdown = () => {
        if (!sidebarFooterDropdown) return;

        sidebarFooterDropdown.classList.remove('show');
        footerDropdownActive = false;
    };

    // Dark Mode
    const applyDarkMode = (isDark) => {
        if (isDark) {
            document.documentElement.classList.add('dark');
            if (darkModeToggle) darkModeToggle.checked = true;
        } else {
            document.documentElement.classList.remove('dark');
            if (darkModeToggle) darkModeToggle.checked = false;
        }
    };

    const toggleDarkMode = () => {
        const isDark = !document.documentElement.classList.contains('dark');
        localStorage.setItem('dark-mode', isDark);
        applyDarkMode(isDark);
    };

    // --- EVENT LISTENERS ---
    if (toggleSidebarBtn) toggleSidebarBtn.addEventListener('click', toggleSidebar);
    if (closeSidebarBtn) closeSidebarBtn.addEventListener('click', toggleSidebar);
    if (sidebarBackdrop) sidebarBackdrop.addEventListener('click', toggleSidebar);

    // Global click listener to close dropdowns
    document.addEventListener('click', (e) => {
        if (userMenuButton && userDropdown && !userMenuButton.contains(e.target) && !userDropdown.contains(e.target)) {
            userDropdown.classList.add('hidden');
        }
        if (footerDropdownActive && !e.target.closest('.sidebar-footer')) {
            closeFooterDropdown();
        }
        if (sidebarCollapsed && activeDropdown && !e.target.closest('.menu-item') && !e.target.closest('.collapsed-dropdown')) {
            closeAllCollapsedDropdowns();
        }
    });

    // Toggles on click
    if (userMenuButton) userMenuButton.addEventListener('click', () => userDropdown?.classList?.toggle('hidden'));
    if (darkModeToggle) darkModeToggle.addEventListener('click', toggleDarkMode);

    // Handle all submenu toggles
    document.addEventListener('click', (e) => {
        const submenuToggleButton = e.target.closest('.js-submenu-toggle');
        if (submenuToggleButton) {
            e.preventDefault();
            toggleSubmenu(submenuToggleButton);
            return;
        }

        const footerProfileButton = e.target.closest('#sidebar-footer-profile, #sidebar-footer-collapsed');
        if (footerProfileButton) {
            toggleFooterDropdown();
            return;
        }
    });

    // Handle hover for collapsed dropdowns
    document.querySelectorAll('.menu-item').forEach(item => {
        item.addEventListener('click', (e) => {
            if (sidebarCollapsed && item.querySelector('.submenu')) {
                closeAllCollapsedDropdowns();
                closeFooterDropdown();
                const dropdown = item.querySelector('.collapsed-dropdown') || createCollapsedDropdown(item);
                dropdown?.classList?.add('show');
                activeDropdown = dropdown;
            }
        });
    });

    const createCollapsedDropdown = (menuItem) => {
        const submenu = menuItem.querySelector('.submenu');
        if (!submenu) return null;
        const dropdown = document.createElement('div');
        dropdown.className = 'collapsed-dropdown bg-indigo-800 dark:bg-gray-800 border border-gray-200 dark:border-gray-700';
        dropdown.innerHTML = submenu.innerHTML;
        menuItem.appendChild(dropdown);
        return dropdown;
    };

    window.addEventListener('resize', () => {
        if (window.innerWidth >= 768) { // Desktop
            if (sidebar && sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.remove('-translate-x-full');
            }
        } else { // Mobile
            sidebarCollapsed = false;
            sidebar.classList.add('-translate-x-full');
            if (sidebar && !sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.add('-translate-x-full');
                if (sidebarBackdrop) sidebarBackdrop.classList.add('hidden', 'opacity-0');
            }
        }
        updateDesktopSidebar();
    });

    // Initialize Chart only if it exists
    if (attendanceChart) {
        const chartColors = {
            light: {
                grid: 'rgba(0, 0, 0, 0.1)',
                ticks: '#6b7280',
                labels: '#1f2937'
            },
            dark: {
                grid: 'rgba(255, 255, 255, 0.1)',
                ticks: '#9ca3af',
                labels: '#e5e7eb'
            }
        };

        const ctx = attendanceChart.getContext('2d');
        const chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                datasets: [{
                    label: 'Present',
                    data: [92, 88, 90, 85, 87, 94],
                    borderColor: '#4ade80',
                    backgroundColor: 'rgba(74, 222, 128, 0.1)',
                    tension: 0.4,
                    fill: true
                }, {
                    label: 'Absent',
                    data: [8, 12, 10, 15, 13, 6],
                    borderColor: '#f87171',
                    backgroundColor: 'rgba(248, 113, 113, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: {
                                family: "'Poppins', sans-serif"
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        ticks: {
                            font: {
                                family: "'Poppins', sans-serif"
                            }
                        }
                    },
                    x: {
                        ticks: {
                            font: {
                                family: "'Poppins', sans-serif"
                            }
                        }
                    }
                }
            }
        });

        const updateChartTheme = (isDark) => {
            const colors = isDark ? chartColors.dark : chartColors.light;
            chart.options.scales.y.grid.color = colors.grid;
            chart.options.scales.x.grid.color = colors.grid;
            chart.options.scales.y.ticks.color = colors.ticks;
            chart.options.scales.x.ticks.color = colors.ticks;
            chart.options.plugins.legend.labels.color = colors.labels;
            chart.update();
        };
    }

    // --- INITIALIZATION ---
    const savedSidebarState = localStorage.getItem('sidebar-collapsed');
    if (savedSidebarState !== null) {
        sidebarCollapsed = savedSidebarState === 'true'; // convert string to boolean
    }
    const prefersDark = localStorage.getItem('dark-mode') === 'true' ||
        (!localStorage.getItem('dark-mode') && window.matchMedia('(prefers-color-scheme: dark)').matches);
    applyDarkMode(prefersDark);
    updateDesktopSidebar();
});
