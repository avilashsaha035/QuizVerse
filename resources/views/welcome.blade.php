@extends('layouts.app')

@push('frontend_title')
    Home
@endpush

@section('content')
    <!-- Hero Section with Vibrant Blue Gradient -->
    <section class="gradient-bg text-white pt-20 pb-16 md:pt-28 md:pb-24 relative overflow-hidden">
        <!-- Animated background elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-blue-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse"></div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-blue-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse delay-1000"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-pulse delay-500"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="text-left">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight mb-6">
                        Master Exams with
                        <span class="text-emerald-300 bg-gradient-to-r from-emerald-400 to-emerald-200 bg-clip-text text-transparent">Smart Practice</span>
                    </h1>
                    <p class="text-lg md:text-xl text-blue-100 mb-8 max-w-2xl">
                        Take unlimited MCQ exams, track your progress, and improve your skills with instant feedback.
                        The intelligent way to prepare for your next challenge.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        @auth
                            <a href="{{ url('/dashboard') }}"
                               class="px-6 py-3 md:px-8 md:py-4 bg-white text-blue-600 rounded-lg md:rounded-xl font-semibold text-base md:text-lg shadow-2xl hover-lift hover:bg-gray-50 hover:scale-105 transition-all duration-300 inline-flex items-center justify-center pulse-glow">
                                <i class="fas fa-rocket mr-3 text-blue-500"></i>
                                Go to Dashboard
                            </a>
                            <a href="/exams"
                               class="px-6 py-3 md:px-8 md:py-4 bg-transparent border-2 border-white text-white rounded-lg md:rounded-xl font-semibold text-base md:text-lg hover-lift hover:bg-white hover:text-blue-600 hover:scale-105 transition-all duration-300 inline-flex items-center justify-center">
                                <i class="fas fa-play mr-3"></i>
                                Start Exam
                            </a>
                        @else
                            <a href="{{ route('register') }}"
                               class="px-6 py-3 md:px-8 md:py-4 bg-white text-blue-600 rounded-lg md:rounded-xl font-semibold text-base md:text-lg shadow-2xl hover-lift hover:bg-gray-50 hover:scale-105 transition-all duration-300 inline-flex items-center justify-center pulse-glow">
                                <i class="fas fa-user-plus mr-3 text-blue-500"></i>
                                Start Free Trial
                            </a>
                            <a href="{{ route('login') }}"
                               class="px-6 py-3 md:px-8 md:py-4 bg-transparent border-2 border-white text-white rounded-lg md:rounded-xl font-semibold text-base md:text-lg hover-lift hover:bg-white hover:text-blue-600 hover:scale-105 transition-all duration-300 inline-flex items-center justify-center">
                                <i class="fas fa-sign-in-alt mr-3"></i>
                                Sign In
                            </a>
                        @endauth
                    </div>
                    <div class="mt-8 md:mt-10 flex items-center">
                        <div class="flex -space-x-2">
                            <div class="w-8 h-8 md:w-10 md:h-10 rounded-full border-2 border-white bg-gradient-to-br from-blue-300 to-blue-400 shadow-lg"></div>
                            <div class="w-8 h-8 md:w-10 md:h-10 rounded-full border-2 border-white bg-gradient-to-br from-blue-400 to-blue-500 shadow-lg"></div>
                            <div class="w-8 h-8 md:w-10 md:h-10 rounded-full border-2 border-white bg-gradient-to-br from-emerald-400 to-emerald-500 shadow-lg"></div>
                            <div class="w-8 h-8 md:w-10 md:h-10 rounded-full border-2 border-white bg-gradient-to-br from-emerald-500 to-emerald-600 shadow-lg"></div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm md:text-base font-semibold text-blue-100">Join 10,000+ Successful Learners</p>
                            <div class="flex items-center mt-1">
                                <i class="fas fa-star text-emerald-300 mr-1 animate-pulse"></i>
                                <i class="fas fa-star text-emerald-300 mr-1 animate-pulse delay-100"></i>
                                <i class="fas fa-star text-emerald-300 mr-1 animate-pulse delay-200"></i>
                                <i class="fas fa-star text-emerald-300 mr-1 animate-pulse delay-300"></i>
                                <i class="fas fa-star text-emerald-300 mr-1 animate-pulse delay-400"></i>
                                <span class="ml-2 text-blue-200 text-sm md:text-base">4.9/5 from 2,500+ reviews</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <div class="relative mx-auto max-w-md">
                        <div class="bg-white/15 backdrop-blur-lg rounded-xl md:rounded-2xl p-6 md:p-8 feature-card border border-white/30 shadow-2xl card-hover">
                            <div class="flex items-center justify-between mb-4 md:mb-6">
                                <div class="flex items-center">
                                    <div class="w-2 h-2 md:w-3 md:h-3 rounded-full bg-red-400 mr-2 animate-pulse"></div>
                                    <div class="w-2 h-2 md:w-3 md:h-3 rounded-full bg-amber-400 mr-2 animate-pulse delay-300"></div>
                                    <div class="w-2 h-2 md:w-3 md:h-3 rounded-full bg-emerald-400 animate-pulse delay-500"></div>
                                </div>
                                <span class="text-xs md:text-sm font-medium bg-gradient-to-r from-blue-400 to-emerald-400 bg-clip-text text-transparent">Live Exam Preview</span>
                            </div>

                            <div class="bg-gray-900/80 backdrop-blur-sm rounded-lg md:rounded-xl p-4 md:p-6 mb-4 md:mb-6 border border-gray-700">
                                <div class="flex items-center justify-between mb-3 md:mb-4">
                                    <div class="text-xs md:text-sm text-gray-300">
                                        <span class="font-semibold bg-gradient-to-r from-blue-400 to-blue-300 bg-clip-text text-transparent">Question 7</span> of 50
                                    </div>
                                    <div class="text-xs md:text-sm text-gray-300">
                                        Time: <span class="font-bold text-emerald-300">12:45</span>
                                    </div>
                                </div>

                                <h3 class="text-white font-medium mb-3 md:mb-4 text-sm md:text-base">
                                    Which of the following is a key feature of Laravel's Eloquent ORM?
                                </h3>

                                <div class="space-y-2 md:space-y-3">
                                    <div class="bg-gray-800/80 rounded-lg p-2 md:p-3 hover:bg-gray-700/80 cursor-pointer transition-all duration-200 hover:scale-[1.02]">
                                        <div class="flex items-center">
                                            <div class="w-5 h-5 md:w-6 md:h-6 rounded-full border border-gray-400 flex items-center justify-center mr-2 md:mr-3 bg-gray-700">
                                                <span class="text-xs md:text-sm text-gray-300">A</span>
                                            </div>
                                            <span class="text-gray-200 text-xs md:text-sm">Active Record Implementation</span>
                                        </div>
                                    </div>
                                    <div class="bg-gradient-to-r from-emerald-600 to-emerald-500 rounded-lg p-2 md:p-3 shadow-lg hover:shadow-emerald-500/25">
                                        <div class="flex items-center">
                                            <div class="w-5 h-5 md:w-6 md:h-6 rounded-full border border-white flex items-center justify-center mr-2 md:mr-3 bg-emerald-500">
                                                <span class="text-xs md:text-sm text-white">B</span>
                                            </div>
                                            <span class="text-white text-xs md:text-sm font-medium">Database Migrations</span>
                                        </div>
                                    </div>
                                    <div class="bg-gray-800/80 rounded-lg p-2 md:p-3 hover:bg-gray-700/80 cursor-pointer transition-all duration-200 hover:scale-[1.02]">
                                        <div class="flex items-center">
                                            <div class="w-5 h-5 md:w-6 md:h-6 rounded-full border border-gray-400 flex items-center justify-center mr-2 md:mr-3 bg-gray-700">
                                                <span class="text-xs md:text-sm text-gray-300">C</span>
                                            </div>
                                            <span class="text-gray-200 text-xs md:text-sm">Built-in Authentication</span>
                                        </div>
                                    </div>
                                    <div class="bg-gray-800/80 rounded-lg p-2 md:p-3 hover:bg-gray-700/80 cursor-pointer transition-all duration-200 hover:scale-[1.02]">
                                        <div class="flex items-center">
                                            <div class="w-5 h-5 md:w-6 md:h-6 rounded-full border border-gray-400 flex items-center justify-center mr-2 md:mr-3 bg-gray-700">
                                                <span class="text-xs md:text-sm text-gray-300">D</span>
                                            </div>
                                            <span class="text-gray-200 text-xs md:text-sm">Blade Templating</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex justify-between mt-4 md:mt-6">
                                    <button class="px-3 py-1 md:px-4 md:py-2 bg-gray-800 text-gray-300 rounded-lg hover:bg-gray-700 transition-all duration-200 text-xs md:text-sm hover:scale-105">
                                        <i class="fas fa-arrow-left mr-1 md:mr-2"></i>Previous
                                    </button>
                                    <button class="px-3 py-1 md:px-4 md:py-2 bg-gradient-to-r from-blue-600 to-blue-500 text-white rounded-lg hover:from-blue-700 hover:to-blue-600 transition-all duration-200 text-xs md:text-sm shadow-lg hover:shadow-xl hover:scale-105">
                                        Next<i class="fas fa-arrow-right ml-1 md:ml-2"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="text-center">
                                <div class="inline-flex space-x-1">
                                    @for($i = 1; $i <= 10; $i++)
                                        <div class="w-2 h-2 md:w-3 md:h-3 rounded-full {{ $i == 7 ? 'bg-gradient-to-br from-blue-400 to-blue-500' : ($i < 7 ? 'bg-gradient-to-br from-emerald-400 to-emerald-500' : 'bg-gray-600') }}"></div>
                                    @endfor
                                </div>
                                <p class="text-xs md:text-sm text-gray-300 mt-2">
                                    <span class="text-emerald-300">Answered: 6/50</span> • <span class="text-amber-300">Skipped: 1</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-16 md:py-20 bg-gradient-to-b from-blue-50 to-white dark:from-gray-900 dark:to-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 md:mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 dark:text-white mb-4">
                    Why Choose <span class="bg-gradient-to-r from-blue-600 to-emerald-500 bg-clip-text text-transparent">QuizVerse</span>?
                </h2>
                <p class="text-lg md:text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                    Our platform is designed to provide the best exam preparation experience
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8">
                <!-- Feature 1 -->
                <div class="bg-white dark:bg-gray-800 rounded-xl md:rounded-2xl p-6 md:p-8 shadow-lg hover-lift transition-all duration-300 card-hover border border-transparent hover:border-blue-200 dark:hover:border-blue-900/50">
                    <div class="w-12 h-12 md:w-16 md:h-16 rounded-lg md:rounded-xl bg-gradient-to-br from-blue-100 to-blue-50 dark:from-blue-900/30 dark:to-blue-900/10 flex items-center justify-center mb-4 md:mb-6 shadow-inner">
                        <i class="fas fa-file-import text-xl md:text-3xl text-blue-600 dark:text-blue-400"></i>
                    </div>
                    <h3 class="text-lg md:text-xl font-bold text-gray-800 dark:text-white mb-2 md:mb-3">
                        Easy Question Import
                    </h3>
                    <p class="text-sm md:text-base text-gray-600 dark:text-gray-300">
                        Admins can upload questions via CSV/Excel files. Bulk import saves time and effort.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white dark:bg-gray-800 rounded-xl md:rounded-2xl p-6 md:p-8 shadow-lg hover-lift transition-all duration-300 card-hover border border-transparent hover:border-emerald-200 dark:hover:border-emerald-900/50">
                    <div class="w-12 h-12 md:w-16 md:h-16 rounded-lg md:rounded-xl bg-gradient-to-br from-emerald-100 to-emerald-50 dark:from-emerald-900/30 dark:to-emerald-900/10 flex items-center justify-center mb-4 md:mb-6 shadow-inner">
                        <i class="fas fa-forward text-xl md:text-3xl text-emerald-600 dark:text-emerald-400"></i>
                    </div>
                    <h3 class="text-lg md:text-xl font-bold text-gray-800 dark:text-white mb-2 md:mb-3">
                        Navigate Questions
                    </h3>
                    <p class="text-sm md:text-base text-gray-600 dark:text-gray-300">
                        Move forward/backward between questions. Track unanswered questions easily.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white dark:bg-gray-800 rounded-xl md:rounded-2xl p-6 md:p-8 shadow-lg hover-lift transition-all duration-300 card-hover border border-transparent hover:border-blue-200 dark:hover:border-blue-900/50">
                    <div class="w-12 h-12 md:w-16 md:h-16 rounded-lg md:rounded-xl bg-gradient-to-br from-blue-100 to-blue-50 dark:from-blue-900/30 dark:to-blue-900/10 flex items-center justify-center mb-4 md:mb-6 shadow-inner">
                        <i class="fas fa-bolt text-xl md:text-3xl text-blue-600 dark:text-blue-400"></i>
                    </div>
                    <h3 class="text-lg md:text-xl font-bold text-gray-800 dark:text-white mb-2 md:mb-3">
                        Instant Results
                    </h3>
                    <p class="text-sm md:text-base text-gray-600 dark:text-gray-300">
                        Get your score immediately after exam completion. Review correct/incorrect answers.
                    </p>
                </div>

                <!-- Feature 4 -->
                <div class="bg-white dark:bg-gray-800 rounded-xl md:rounded-2xl p-6 md:p-8 shadow-lg hover-lift transition-all duration-300 card-hover border border-transparent hover:border-emerald-200 dark:hover:border-emerald-900/50">
                    <div class="w-12 h-12 md:w-16 md:h-16 rounded-lg md:rounded-xl bg-gradient-to-br from-emerald-100 to-emerald-50 dark:from-emerald-900/30 dark:to-emerald-900/10 flex items-center justify-center mb-4 md:mb-6 shadow-inner">
                        <i class="fas fa-chart-line text-xl md:text-3xl text-emerald-600 dark:text-emerald-400"></i>
                    </div>
                    <h3 class="text-lg md:text-xl font-bold text-gray-800 dark:text-white mb-2 md:mb-3">
                        Progress Tracking
                    </h3>
                    <p class="text-sm md:text-base text-gray-600 dark:text-gray-300">
                        Monitor your performance over time. Identify weak areas and improve systematically.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section id="how-it-works" class="py-16 md:py-20 bg-gradient-to-b from-white to-blue-50 dark:from-gray-800 dark:to-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 md:mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 dark:text-white mb-4">
                    How It <span class="bg-gradient-to-r from-blue-600 to-blue-500 bg-clip-text text-transparent">Works</span>
                </h2>
                <p class="text-lg md:text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                    Get started in just a few simple steps
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 md:gap-12">
                <!-- Step 1 -->
                <div class="relative">
                    <div class="flex flex-col items-center text-center">
                        <div class="w-16 h-16 md:w-20 md:h-20 rounded-full bg-gradient-to-br from-blue-600 to-blue-500 text-white flex items-center justify-center text-xl md:text-2xl font-bold mb-4 md:mb-6 z-10 shadow-xl hover:scale-110 transition-transform duration-300 cursor-pointer">
                            1
                        </div>
                        <h3 class="text-lg md:text-xl font-bold text-gray-800 dark:text-white mb-2 md:mb-3">Sign Up & Login</h3>
                        <p class="text-sm md:text-base text-gray-600 dark:text-gray-300">
                            Create your account and verify your email. Secure authentication ensures your data safety.
                        </p>
                    </div>
                    <div class="hidden md:block absolute top-8 left-2/3 w-full h-0.5 bg-gradient-to-r from-blue-300 to-emerald-300 dark:from-blue-700 dark:to-emerald-700"></div>
                </div>

                <!-- Step 2 -->
                <div class="relative">
                    <div class="flex flex-col items-center text-center">
                        <div class="w-16 h-16 md:w-20 md:h-20 rounded-full bg-gradient-to-br from-emerald-600 to-emerald-500 text-white flex items-center justify-center text-xl md:text-2xl font-bold mb-4 md:mb-6 z-10 shadow-xl hover:scale-110 transition-transform duration-300 cursor-pointer">
                            2
                        </div>
                        <h3 class="text-lg md:text-xl font-bold text-gray-800 dark:text-white mb-2 md:mb-3">Choose Your Exam</h3>
                        <p class="text-sm md:text-base text-gray-600 dark:text-gray-300">
                            Browse available exams by category, difficulty, or topic. Select one that matches your goal.
                        </p>
                    </div>
                    <div class="hidden md:block absolute top-8 left-2/3 w-full h-0.5 bg-gradient-to-r from-emerald-300 to-blue-300 dark:from-emerald-700 dark:to-blue-700"></div>
                </div>

                <!-- Step 3 -->
                <div class="relative">
                    <div class="flex flex-col items-center text-center">
                        <div class="w-16 h-16 md:w-20 md:h-20 rounded-full bg-gradient-to-br from-blue-600 to-emerald-500 text-white flex items-center justify-center text-xl md:text-2xl font-bold mb-4 md:mb-6 z-10 shadow-xl hover:scale-110 transition-transform duration-300 cursor-pointer">
                            3
                        </div>
                        <h3 class="text-lg md:text-xl font-bold text-gray-800 dark:text-white mb-2 md:mb-3">Take Exam & Get Results</h3>
                        <p class="text-sm md:text-base text-gray-600 dark:text-gray-300">
                            Answer questions at your pace, review instantly, and track progress to improve.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 md:py-20 gradient-bg relative overflow-hidden">
        <!-- Animated background elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-0 left-1/4 w-64 h-64 bg-blue-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse"></div>
            <div class="absolute bottom-0 right-1/4 w-64 h-64 bg-blue-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse delay-700"></div>
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-4 md:mb-6">
                Ready to Ace Your Next Exam?
            </h2>
            <p class="text-lg md:text-xl text-blue-100 mb-8 md:mb-10 max-w-2xl mx-auto">
                Join thousands of learners who have improved their scores with QuizVerse
            </p>

            @auth
                <div class="flex flex-col sm:flex-row gap-4 md:gap-6 justify-center">
                    <a href="{{ url('/dashboard') }}"
                       class="inline-flex items-center px-6 py-3 md:px-8 md:py-4 bg-white text-blue-600 rounded-lg md:rounded-xl font-bold text-base md:text-lg shadow-2xl hover-lift hover:bg-gray-50 hover:scale-105 transition-all duration-300 pulse-glow">
                        <i class="fas fa-play-circle mr-3 text-lg md:text-xl text-blue-500"></i>
                        Start Your First Exam
                    </a>
                    <a href="/exams"
                       class="inline-flex items-center px-6 py-3 md:px-8 md:py-4 bg-transparent border-2 border-white text-white rounded-lg md:rounded-xl font-bold text-base md:text-lg hover-lift hover:bg-white hover:text-blue-600 hover:scale-105 transition-all duration-300">
                        <i class="fas fa-list mr-3 text-lg md:text-xl"></i>
                        Browse All Exams
                    </a>
                </div>
            @else
                <div class="flex flex-col sm:flex-row gap-4 md:gap-6 justify-center">
                    <a href="{{ route('register') }}"
                       class="inline-flex items-center px-6 py-3 md:px-8 md:py-4 bg-white text-blue-600 rounded-lg md:rounded-xl font-bold text-base md:text-lg shadow-2xl hover-lift hover:bg-gray-50 hover:scale-105 transition-all duration-300 pulse-glow">
                        <i class="fas fa-user-plus mr-3 text-lg md:text-xl text-blue-500"></i>
                        Sign Up for Free
                    </a>
                    <a href="{{ route('login') }}"
                       class="inline-flex items-center px-6 py-3 md:px-8 md:py-4 bg-transparent border-2 border-white text-white rounded-lg md:rounded-xl font-bold text-base md:text-lg hover-lift hover:bg-white hover:text-blue-600 hover:scale-105 transition-all duration-300">
                        <i class="fas fa-sign-in-alt mr-3 text-lg md:text-xl"></i>
                        Login to Continue
                    </a>
                </div>
            @endauth

            <p class="text-blue-200 mt-6 md:mt-8 text-sm md:text-base">
                <i class="fas fa-shield-alt mr-2"></i>No credit card required • 7-day free trial • Cancel anytime
            </p>
        </div>
    </section>
@endsection
