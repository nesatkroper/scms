<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to School MS</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 font-sans">
    <div class="min-h-screen flex flex-col">
        <header class="bg-blue-600 text-white shadow-md">
            <div class="container mx-auto px-4 py-6 flex justify-between items-center">
                <h1 class="text-2xl font-bold">School Management System</h1>
                <nav>
                    <ul class="flex space-x-4">
                        @guest
                        <li><a href="{{ route('login') }}" class="hover:underline">Login</a></li>
                        <li><a href="{{ route('register') }}" class="hover:underline">Register</a></li>
                        @endguest
                        @auth
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="hover:underline">Logout</button>
                            </form>
                        </li>
                        @endauth
                    </ul>
                </nav>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-grow flex items-center justify-center">
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Welcome to School MS</h2>
                <p class="text-lg text-gray-600 mb-6">
                    Manage your school efficiently with our user-friendly system. Track student records, monitor
                    attendance, and streamline educational processes.
                </p>
                <div class="space-x-4">
                    @guest
                    <a href="{{ route('register') }}"
                        class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">
                        Get Started
                    </a>
                    <a href="{{ route('login') }}"
                        class="inline-block bg-gray-600 text-white px-6 py-3 rounded-lg hover:bg-gray-700">
                        Sign In
                    </a>
                    @endguest
                    @auth
                    <a href="{{ route('/') }}"
                        class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">
                        Go to Dashboard
                    </a>
                    @endauth
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white py-4">
            <div class="container mx-auto px-4 text-center">
                <p>© {{ date('Y') }} School Management System. All rights reserved.</p>
            </div>
        </footer>
    </div>
</body>

</html>