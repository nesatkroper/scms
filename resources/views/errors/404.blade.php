<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Page Not Found - School Management System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'cyber-blue': '#0ff',
                        'cyber-purple': '#b300ff',
                        'cyber-dark': '#0a0a1a',
                        'school-blue': '#1e3a8a',
                        'school-light': '#3b82f6',
                        'school-accent': '#f59e0b',
                    },
                    animation: {
                        'pulse-fast': 'pulse 1.5s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'float': 'float 3s ease-in-out infinite',
                        'glow': 'glow 2s ease-in-out infinite alternate',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-10px)' },
                        },
                        glow: {
                            '0%': { boxShadow: '0 0 5px #0ff, 0 0 10px #0ff' },
                            '100%': { boxShadow: '0 0 20px #0ff, 0 0 30px #0ff' },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap');
        
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f3f4f6;
            background-image: 
                radial-gradient(circle at 25% 25%, rgba(11, 39, 90, 0.2) 0%, transparent 50%),
                radial-gradient(circle at 75% 75%, rgba(179, 0, 255, 0.1) 0%, transparent 50%),
                linear-gradient(to bottom, transparent, #0a0a1a);
            background-size: 100% 100%;
            overflow-x: hidden;
        }
        
        .circuit-lines {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                linear-gradient(90deg, rgba(0, 255, 255, 0.1) 1px, transparent 1px),
                linear-gradient(0deg, rgba(0, 255, 255, 0.1) 1px, transparent 1px);
            background-size: 30px 30px;
            z-index: -1;
        }
        
        .school-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%233b82f6' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        
        .pencil {
            transform: rotate(45deg);
        }
        
        .glitch {
            position: relative;
        }
        
        .glitch::before, .glitch::after {
            content: attr(data-text);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        
        .glitch::before {
            left: 2px;
            text-shadow: -1px 0 #b300ff;
            clip: rect(24px, 550px, 90px, 0);
            animation: glitch-anim 3s infinite linear alternate-reverse;
        }
        
        .glitch::after {
            left: -2px;
            text-shadow: -1px 0 #0ff;
            clip: rect(85px, 550px, 140px, 0);
            animation: glitch-anim 2s infinite linear alternate-reverse;
        }
        
        @keyframes glitch-anim {
            0% { clip: rect(51px, 9999px, 28px, 0); }
            5% { clip: rect(26px, 9999px, 44px, 0); }
            10% { clip: rect(88px, 9999px, 71px, 0); }
            15% { clip: rect(15px, 9999px, 30px, 0); }
            20% { clip: rect(35px, 9999px, 73px, 0); }
            25% { clip: rect(52px, 9999px, 40px, 0); }
            30% { clip: rect(18px, 9999px, 82px, 0); }
            35% { clip: rect(63px, 9999px, 59px, 0); }
            40% { clip: rect(94px, 9999px, 27px, 0); }
            45% { clip: rect(10px, 9999px, 55px, 0); }
            50% { clip: rect(31px, 9999px, 84px, 0); }
            55% { clip: rect(49px, 9999px, 32px, 0); }
            60% { clip: rect(76px, 9999px, 67px, 0); }
            65% { clip: rect(21px, 9999px, 92px, 0); }
            70% { clip: rect(87px, 9999px, 46px, 0); }
            75% { clip: rect(5px, 9999px, 79px, 0); }
            80% { clip: rect(69px, 9999px, 38px, 0); }
            85% { clip: rect(41px, 9999px, 81px, 0); }
            90% { clip: rect(57px, 9999px, 25px, 0); }
            95% { clip: rect(73px, 9999px, 50px, 0); }
            100% { clip: rect(33px, 9999px, 65px, 0); }
        }
        
        .typing-cursor {
            display: inline-block;
            width: 10px;
            height: 24px;
            background-color: #0ff;
            animation: blink 1s infinite;
        }
        
        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0; }
        }
    </style>
</head>
<body class="antialiased school-pattern">
    <div class="min-h-screen flex flex-col items-center justify-center px-4">
        <div class="bg-white rounded-lg shadow-xl p-8 max-w-lg w-full">
            <div class="flex flex-col items-center text-center space-y-6">
                <!-- School Icon -->
                <div class="w-24 h-24 bg-school-blue rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                        <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                    </svg>
                </div>
                
                <!-- Error Number -->
                <div class="flex items-center">
                    <span class="text-7xl font-bold text-school-blue">4</span>
                    <div class="mx-2 pencil">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-school-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                    </div>
                    <span class="text-7xl font-bold text-school-blue">4</span>
                </div>
                
                <!-- Error Message -->
                <div class="space-y-3">
                    <h2 class="text-2xl font-bold text-gray-800">Page Not Found</h2>
                    <p class="text-gray-600">Oops! It seems this lesson plan is missing from our curriculum.</p>
                    <p class="text-gray-500 text-sm">The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.</p>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 w-full">
                    <a href="{{ url('/') }}" class="flex-1 px-6 py-3 bg-school-blue text-white rounded-md hover:bg-school-light transition-all duration-300 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Back to Dashboard
                    </a>
                    <button onclick="window.history.back()" class="flex-1 px-6 py-3 bg-white border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 transition-all duration-300 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                        </svg>
                        Go Back
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="mt-8 text-sm text-gray-500">
            <p>If you believe this is an error, please contact the school administrator.</p>
        </div>
    </div>
</body>
</html>
