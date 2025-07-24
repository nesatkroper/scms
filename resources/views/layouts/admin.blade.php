<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/mainjq.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200">
    <!-- Backdrop for mobile sidebar -->
    <div id="sidebar-backdrop" class="sidebar-backdrop fixed inset-0 z-20 hidden opacity-0"></div>

    <!-- Main container -->
    <div class="h-screen">
        <!-- Sidebar - Default width w-72 -->
        @include('admin.partials.sidebar')
        <!-- Main content -->
        <div class="flex-1 flex flex-col transition-all duration-300 md:ml-72" id="main-content">
            <!-- Header -->
            @include('admin.partials.header')

            <!-- Main content area -->
            <main class="flex-1 mt-15 md:mt-0 bg-violet-50 dark:bg-gray-900">
                <div class="sm:p-4">
                    @yield('content')
                </div>
            </main>
            @include('admin.partials.footer')
        </div>
    </div>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/mainjq.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/validation.js') }}"></script>
    <!-- Cropper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
    @stack('scripts')
</body>

</html>
