<header class="bg-white dark:bg-gray-900 shadow-lg sticky top-0 z-50 border-b border-blue-100 dark:border-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo with gradient -->
            <a href="/" class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-emerald-500 bg-clip-text text-transparent hover:from-blue-700 hover:to-emerald-600 transition-all duration-300">
                QuizVerse
            </a>

            <!-- Navigation -->
            <nav class="hidden md:flex space-x-8">
                <a href="/" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-medium link-hover py-2">
                    Home
                </a>
                <a href="/exams" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-medium link-hover py-2">
                    Exams
                </a>
                <a href="#features" class="text-gray-700 dark:text-gray-300 hover:text-emerald-600 dark:hover:text-emerald-400 font-medium link-hover py-2">
                    Features
                </a>
                <a href="#how-it-works" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-medium link-hover py-2">
                    How It Works
                </a>
                <a href="/contact" class="text-gray-700 dark:text-gray-300 hover:text-emerald-600 dark:hover:text-emerald-400 font-medium link-hover py-2">
                    Contact
                </a>
            </nav>

            <!-- CTA / Auth -->
            <div class="flex items-center space-x-4">
                @auth
                    <!-- User Dropdown -->
                    <div class="relative">
                        <button id="userDropdownBtn"
                                class="px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-500 text-white rounded-lg hover:from-blue-700 hover:to-blue-600 transition-all duration-300 flex items-center shadow-lg hover:shadow-xl hover-lift">
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="ml-2 h-4 w-4 fill-current transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10
                                        10.586l3.293-3.293a1 1 0
                                        111.414 1.414l-4 4a1 1 0
                                        01-1.414 0l-4-4a1 1 0
                                        010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>

                        <!-- Dropdown Menu with enhanced hover -->
                        <div id="userDropdownMenu"
                            class="hidden absolute right-0 mt-2 w-56 bg-white dark:bg-gray-800 rounded-xl shadow-2xl py-3 z-50 border border-blue-100 dark:border-gray-700 transform transition-all duration-200 origin-top-right">
                            <a href="{{ url('/dashboard') }}"
                            class="block px-4 py-3 text-sm text-gray-700 dark:text-gray-200 hover:bg-gradient-to-r hover:from-blue-50 hover:to-blue-100 dark:hover:from-blue-900/30 dark:hover:to-blue-900/10 hover:text-blue-600 dark:hover:text-blue-300 transition-all duration-200 flex items-center group border-l-4 border-transparent hover:border-blue-500 pl-3">
                                <i class="fas fa-tachometer-alt mr-3 text-blue-500 group-hover:scale-110 transition-transform duration-200"></i>
                                <span class="group-hover:translate-x-1 transition-transform duration-200">Dashboard</span>
                            </a>
                            @if(auth()->user() && !auth()->user()->roles->isEmpty())
                                <a href="{{ route('admin.dashboard') }}"
                                class="block px-4 py-3 text-sm text-gray-700 dark:text-gray-200 hover:bg-gradient-to-r hover:from-blue-50 hover:to-blue-100 dark:hover:from-blue-900/30 dark:hover:to-blue-900/10 hover:text-blue-600 dark:hover:text-blue-300 transition-all duration-200 flex items-center group border-l-4 border-transparent hover:border-blue-500 pl-3">
                                    <i class="fas fa-user-shield mr-3 text-blue-500 group-hover:scale-110 transition-transform duration-200"></i>
                                    <span class="group-hover:translate-x-1 transition-transform duration-200">Admin Dashboard</span>
                                </a>
                            @endif
                            <a href="/profile"
                            class="block px-4 py-3 text-sm text-gray-700 dark:text-gray-200 hover:bg-gradient-to-r hover:from-emerald-50 hover:to-emerald-100 dark:hover:from-emerald-900/30 dark:hover:to-emerald-900/10 hover:text-emerald-600 dark:hover:text-emerald-300 transition-all duration-200 flex items-center group border-l-4 border-transparent hover:border-emerald-500 pl-3">
                                <i class="fas fa-user mr-3 text-emerald-500 group-hover:scale-110 transition-transform duration-200"></i>
                                <span class="group-hover:translate-x-1 transition-transform duration-200">My Profile</span>
                            </a>
                            <a href="/my-results"
                            class="block px-4 py-3 text-sm text-gray-700 dark:text-gray-200 hover:bg-gradient-to-r hover:from-blue-50 hover:to-blue-100 dark:hover:from-blue-900/30 dark:hover:to-blue-900/10 hover:text-blue-600 dark:hover:text-blue-300 transition-all duration-200 flex items-center group border-l-4 border-transparent hover:border-blue-500 pl-3">
                                <i class="fas fa-chart-line mr-3 text-blue-500 group-hover:scale-110 transition-transform duration-200"></i>
                                <span class="group-hover:translate-x-1 transition-transform duration-200">My Results</span>
                            </a>
                            <div class="border-t border-gray-200 dark:border-gray-700 my-2"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        class="w-full text-left block px-4 py-3 text-sm text-gray-700 dark:text-gray-200 hover:bg-gradient-to-r hover:from-red-50 hover:to-red-100 dark:hover:from-red-900/30 dark:hover:to-red-900/10 hover:text-red-600 dark:hover:text-red-300 transition-all duration-200 flex items-center group border-l-4 border-transparent hover:border-red-500 pl-3">
                                    <i class="fas fa-sign-out-alt mr-3 text-red-500 group-hover:scale-110 transition-transform duration-200"></i>
                                    <span class="group-hover:translate-x-1 transition-transform duration-200">Log Out</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="hidden md:flex items-center space-x-4">
                        <a href="{{ route('login') }}" class="px-4 py-2 text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-medium link-hover">
                            <i class="fas fa-sign-in-alt mr-2"></i>Login
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-5 py-2 bg-gradient-to-r from-blue-600 to-emerald-500 text-white rounded-lg hover:from-blue-700 hover:to-emerald-600 transition-all duration-300 font-medium shadow-lg hover:shadow-xl hover-lift pulse-glow">
                                <i class="fas fa-user-plus mr-2"></i>Get Started
                            </a>
                        @endif
                    </div>
                @endauth
            </div>

            <!-- Mobile menu button -->
            <button id="mobileMenuBtn" class="md:hidden text-gray-700 dark:text-gray-300 focus:outline-none p-2 hover:bg-blue-50 dark:hover:bg-gray-800 rounded-lg transition-all duration-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile menu -->
    <div id="mobileMenu" class="hidden md:hidden bg-white dark:bg-gray-900 border-t border-blue-100 dark:border-gray-800">
        <nav class="px-4 py-3 space-y-1">
            <a href="/" class="block px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-gradient-to-r hover:from-blue-50 hover:to-blue-100 dark:hover:from-blue-900/30 dark:hover:to-blue-900/10 rounded-lg font-medium transition-all duration-200 group">
                <i class="fas fa-home mr-3 text-blue-500 group-hover:scale-110 transition-transform duration-200"></i>
                <span class="group-hover:translate-x-1 transition-transform duration-200">Home</span>
            </a>
            <a href="/exams" class="block px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-gradient-to-r hover:from-blue-50 hover:to-blue-100 dark:hover:from-blue-900/30 dark:hover:to-blue-900/10 rounded-lg font-medium transition-all duration-200 group">
                <i class="fas fa-file-alt mr-3 text-blue-500 group-hover:scale-110 transition-transform duration-200"></i>
                <span class="group-hover:translate-x-1 transition-transform duration-200">Exams</span>
            </a>
            <a href="#features" class="block px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-gradient-to-r hover:from-emerald-50 hover:to-emerald-100 dark:hover:from-emerald-900/30 dark:hover:to-emerald-900/10 rounded-lg font-medium transition-all duration-200 group">
                <i class="fas fa-star mr-3 text-emerald-500 group-hover:scale-110 transition-transform duration-200"></i>
                <span class="group-hover:translate-x-1 transition-transform duration-200">Features</span>
            </a>
            <a href="#how-it-works" class="block px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-gradient-to-r hover:from-blue-50 hover:to-blue-100 dark:hover:from-blue-900/30 dark:hover:to-blue-900/10 rounded-lg font-medium transition-all duration-200 group">
                <i class="fas fa-play-circle mr-3 text-blue-500 group-hover:scale-110 transition-transform duration-200"></i>
                <span class="group-hover:translate-x-1 transition-transform duration-200">How It Works</span>
            </a>
            <a href="/contact" class="block px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-gradient-to-r hover:from-emerald-50 hover:to-emerald-100 dark:hover:from-emerald-900/30 dark:hover:to-emerald-900/10 rounded-lg font-medium transition-all duration-200 group">
                <i class="fas fa-envelope mr-3 text-emerald-500 group-hover:scale-110 transition-transform duration-200"></i>
                <span class="group-hover:translate-x-1 transition-transform duration-200">Contact</span>
            </a>

            <!-- Auth logic in mobile menu -->
            @auth
                <div class="border-t border-gray-200 dark:border-gray-800 mt-3 pt-3">
                    <a href="{{ url('/dashboard') }}" class="block px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-gradient-to-r hover:from-blue-50 hover:to-blue-100 dark:hover:from-blue-900/30 dark:hover:to-blue-900/10 rounded-lg font-medium transition-all duration-200 group">
                        <i class="fas fa-tachometer-alt mr-3 text-blue-500 group-hover:scale-110 transition-transform duration-200"></i>
                        <span class="group-hover:translate-x-1 transition-transform duration-200">Dashboard</span>
                    </a>
                    @if(auth()->user() && !auth()->user()->roles->isEmpty())
                        <a href="{{ url('/dashboard') }}" class="block px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-gradient-to-r hover:from-blue-50 hover:to-blue-100 dark:hover:from-blue-900/30 dark:hover:to-blue-900/10 rounded-lg font-medium transition-all duration-200 group">
                            <i class="fas fa-user-shield mr-3 text-blue-500 group-hover:scale-110 transition-transform duration-200"></i>
                            <span class="group-hover:translate-x-1 transition-transform duration-200">Admin Dashboard</span>
                        </a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" class="block">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-gradient-to-r hover:from-red-50 hover:to-red-100 dark:hover:from-red-900/30 dark:hover:to-red-900/10 rounded-lg font-medium transition-all duration-200 group">
                            <i class="fas fa-sign-out-alt mr-3 text-red-500 group-hover:scale-110 transition-transform duration-200"></i>
                            <span class="group-hover:translate-x-1 transition-transform duration-200">Log Out</span>
                        </button>
                    </form>
                </div>
            @else
                <div class="border-t border-gray-200 dark:border-gray-800 mt-3 pt-3">
                    <a href="{{ route('login') }}" class="block px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-gradient-to-r hover:from-blue-50 hover:to-blue-100 dark:hover:from-blue-900/30 dark:hover:to-blue-900/10 rounded-lg font-medium transition-all duration-200 group">
                        <i class="fas fa-sign-in-alt mr-3 text-blue-500 group-hover:scale-110 transition-transform duration-200"></i>
                        <span class="group-hover:translate-x-1 transition-transform duration-200">Login</span>
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="block px-4 py-3 bg-gradient-to-r from-blue-600 to-emerald-500 text-white rounded-lg hover:from-blue-700 hover:to-emerald-600 transition-all duration-300 font-medium mt-2 shadow-lg hover:shadow-xl">
                            <i class="fas fa-user-plus mr-3"></i>
                            <span>Register</span>
                        </a>
                    @endif
                </div>
            @endauth
        </nav>
    </div>
</header>
