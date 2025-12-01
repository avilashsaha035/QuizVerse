<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $title ?? 'QuizVerse' }}</title>
        @vite('resources/css/app.css') <!-- Tailwind compiled -->
    </head>

    <body class="flex flex-col min-h-screen bg-gray-50">

        <!-- Header -->
        <header class="bg-white shadow-md sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <!-- Logo -->
                    <a href="/" class="text-2xl font-bold text-indigo-600">QuizVerse</a>

                    <!-- Navigation -->
                    <nav class="hidden md:flex space-x-6">
                        <a href="/" class="text-gray-700 hover:text-indigo-600">Home</a>
                        <a href="/exams" class="text-gray-700 hover:text-indigo-600">Exams</a>
                        <a href="/about" class="text-gray-700 hover:text-indigo-600">About</a>
                        <a href="/contact" class="text-gray-700 hover:text-indigo-600">Contact</a>
                    </nav>

                    <!-- CTA / Auth -->
                    <div class="flex items-center space-x-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">Login</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-4 py-2 border border-indigo-600 text-indigo-600 rounded-lg hover:bg-indigo-50 transition">Register</a>
                            @endif
                        @endauth
                    </div>

                    <!-- Mobile menu button -->
                    <button id="mobileMenuBtn" class="md:hidden text-gray-700 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile menu -->
            <div id="mobileMenu" class="hidden md:hidden bg-white border-t">
                <nav class="px-4 py-3 space-y-2">
                    <a href="/" class="block text-gray-700 hover:text-indigo-600">Home</a>
                    <a href="/exams" class="block text-gray-700 hover:text-indigo-600">Exams</a>
                    <a href="/about" class="block text-gray-700 hover:text-indigo-600">About</a>
                    <a href="/contact" class="block text-gray-700 hover:text-indigo-600">Contact</a>

                    <!-- Auth logic in mobile menu -->
                    @auth
                        <a href="{{ url('/dashboard') }}" class="block text-gray-700 hover:text-indigo-600">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="block text-gray-700 hover:text-indigo-600">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="block text-gray-700 hover:text-indigo-600">Register</a>
                        @endif
                    @endauth
                </nav>
            </div>
        </header>

        <!-- Main content -->
        <main class="flex-grow">
            <div class="max-w-7xl mx-auto px-6 py-12 text-center">
                <h1 class="text-4xl font-bold text-gray-800 mb-4">Welcome to QuizVerse</h1>
                <p class="text-gray-600 mb-8">Your trusted platform for practice exams and learning.</p>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-gray-900 text-gray-300 mt-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-lg font-semibold text-white">QuizVerse</h3>
                    <p class="mt-2 text-sm">Your trusted platform for practice exams and learning.</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-white">Quick Links</h3>
                    <ul class="mt-2 space-y-2 text-sm">
                        <li><a href="/exams" class="hover:text-white">Exams</a></li>
                        <li><a href="/about" class="hover:text-white">About</a></li>
                        <li><a href="/contact" class="hover:text-white">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-white">Follow Us</h3>
                    <div class="mt-2 flex space-x-4">
                        <a href="#" class="hover:text-white"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="hover:text-white"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="hover:text-white"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700 text-center py-4 text-sm">
                © {{ date('Y') }} QuizVerse. All rights reserved.
            </div>
        </footer>

        <!-- Mobile menu toggle -->
        <script>
            const btn = document.getElementById('mobileMenuBtn');
            const menu = document.getElementById('mobileMenu');
            btn.addEventListener('click', () => {
                menu.classList.toggle('hidden');
            });
        </script>
    </body>
</html>
