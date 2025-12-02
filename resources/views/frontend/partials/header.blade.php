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
            <div class="flex items-center space-x-4 relative">
                @auth
                    <!-- User Dropdown -->
                    <div class="relative">
                        <button id="userDropdownBtn"
                                class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition flex items-center">
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="ml-2 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10
                                        10.586l3.293-3.293a1 1 0
                                        111.414 1.414l-4 4a1 1 0
                                        01-1.414 0l-4-4a1 1 0
                                        010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div id="userDropdownMenu"
                            class="hidden absolute right-0 mt-2 w-40 bg-white dark:bg-gray-800 rounded-md shadow-lg py-2 z-50">
                            <a href="{{ url('/dashboard') }}"
                            class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                                Dashboard
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        class="w-full text-left block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    Log Out
                                </button>
                            </form>
                        </div>
                    </div>
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
