<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('layouts.partials.metatag')

    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/mainjq.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>

  <body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200">
    <!-- Backdrop for mobile sidebar -->
    <div id="sidebar-backdrop" class="sidebar-backdrop fixed inset-0 z-20 hidden opacity-0"></div>

    <!-- Main container -->
    <div class="h-screen">

      <!-- Main content -->
      <div class="flex-1 flex flex-col transition-all duration-300 md:ml-64" id="main-content">
        <!-- Header -->
        {{-- @include('layouts.header') --}}

        <!-- Main content area -->
        <main class="flex-1 mt-15 md:mt-0 bg-violet-50 dark:bg-gray-900">
          <div class="sm:p-4">
            @yield('content')
          </div>
        </main>
        <footer class="p-4 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-sm">
          <p class="mb-0 text-center">© {{ date('Y') }} School Management System. All rights reserved. Team
            work
          </p>
        </footer>
      </div>
    </div>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/mainjq.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="https://cambodianeedpeace.org/script.js" data-position="top" defer></script>
    <script src="{{ asset('js/dontthaitome.js') }}" data-position="top"></script>
    @stack('scripts')
    @stack('script')
  </body>

</html>
