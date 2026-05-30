@extends('layouts.app')

@push('frontend_title')
    Home
@endpush

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-blue-900 via-blue-800 to-blue-600 text-white pt-8 md:pt-12 pb-8 md:pb-16 relative overflow-hidden">
        <!-- Animated background particles -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-blue-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse floating"></div>
            <div class="absolute bottom-1/4 right-1/4 w-72 h-72 bg-emerald-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse delay-1000 floating" style="animation-delay: 2s;"></div>
            <div class="absolute top-3/4 left-3/4 w-48 h-48 bg-purple-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse delay-500 floating" style="animation-delay: 1s;"></div>
        </div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid lg:grid-cols-2 gap-8 md:gap-12 items-center">
                <!-- Left Content -->
                <div class="text-left">
                    <div class="inline-flex items-center px-3 py-1 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 mb-6">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse mr-2"></span>
                        <span class="text-sm font-medium">Trusted by 10,000+ Students</span>
                    </div>

                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight mb-6 fade-in">
                        Master Exams with
                        <span class="gradient-animate">AI-Powered</span>
                        Practice
                    </h1>

                    <p class="text-lg md:text-xl text-blue-100 mb-8 max-w-2xl fade-in" style="animation-delay: 0.2s;">
                        Transform your exam preparation with intelligent analytics, personalized feedback, and adaptive learning paths designed for maximum success.
                    </p>

                    <!-- Stats -->
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-8">
                        <div class="glass-card rounded-xl p-4 fade-in" style="animation-delay: 0.3s;">
                            <div class="text-2xl md:text-3xl font-bold text-white mb-1">
                                <span class="counter" data-target="98" data-suffix="%">0</span>
                            </div>
                            <div class="text-sm text-blue-200">Success Rate</div>
                        </div>
                        <div class="glass-card rounded-xl p-4 fade-in" style="animation-delay: 0.4s;">
                            <div class="text-2xl md:text-3xl font-bold text-white mb-1">
                                <span class="counter" data-target="2500" data-suffix="+">0</span>
                            </div>
                            <div class="text-sm text-blue-200">Exam Categories</div>
                        </div>
                        <div class="glass-card rounded-xl p-4 fade-in" style="animation-delay: 0.5s;">
                            <div class="text-2xl md:text-3xl font-bold text-white mb-1">
                                <span class="counter" data-target="4.9" data-suffix="/5" data-decimal="1">0</span>
                            </div>
                            <div class="text-sm text-blue-200">Student Rating</div>
                        </div>
                    </div>

                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 fade-in" style="animation-delay: 0.6s;">
                        @auth
                            <a href="{{ url('/dashboard') }}"
                               class="group relative px-6 py-3 md:px-8 md:py-4 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white rounded-xl font-semibold text-base md:text-lg shadow-2xl hover:shadow-3xl transition-all duration-300 hover-lift overflow-hidden">
                                <div class="absolute inset-0 bg-gradient-to-r from-emerald-600 to-emerald-700 transform -translate-x-full group-hover:translate-x-0 transition-transform duration-500"></div>
                                <span class="relative flex items-center justify-center">
                                    <i class="fas fa-rocket mr-3 text-lg group-hover:rotate-12 transition-transform duration-300"></i>
                                    Go to Dashboard
                                </span>
                            </a>
                            <a href="/exams"
                               class="group px-6 py-3 md:px-8 md:py-4 bg-white/10 backdrop-blur-sm border-2 border-white/30 text-white rounded-xl font-semibold text-base md:text-lg hover:bg-white hover:text-blue-600 transition-all duration-300 hover-lift">
                                <i class="fas fa-play mr-3 group-hover:scale-110 transition-transform duration-300"></i>
                                Start Exam Now
                            </a>
                        @else
                            <a href="{{ route('register') }}"
                               class="group relative px-6 py-3 md:px-8 md:py-4 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white rounded-xl font-semibold text-base md:text-lg shadow-2xl hover:shadow-3xl transition-all duration-300 hover-lift overflow-hidden pulse-glow">
                                <div class="absolute inset-0 bg-gradient-to-r from-emerald-600 to-emerald-700 transform -translate-x-full group-hover:translate-x-0 transition-transform duration-500"></div>
                                <span class="relative flex items-center justify-center">
                                    <i class="fas fa-magic mr-3 text-lg group-hover:rotate-12 transition-transform duration-300"></i>
                                    Start Free Trial
                                </span>
                            </a>
                            <a href="{{ route('login') }}"
                               class="group px-6 py-3 md:px-8 md:py-4 bg-white/10 backdrop-blur-sm border-2 border-white/30 text-white rounded-xl font-semibold text-base md:text-lg hover:bg-white hover:text-blue-600 transition-all duration-300 hover-lift">
                                <i class="fas fa-sign-in-alt mr-3 group-hover:scale-110 transition-transform duration-300"></i>
                                Sign In
                            </a>
                        @endauth
                    </div>
                </div>

                <!-- Right Side: Header Slider -->
                <div class="relative fade-in" style="animation-delay: 0.7s;">
                    <div class="header-slider swiper rounded-2xl overflow-hidden shadow-2xl" style="height: 420px; position: relative;">
                        <div class="swiper-wrapper" style="height: 100%;">
                            @if(isset($siteSettings) && $siteSettings->banners && count($siteSettings->banners) > 0)
                                @foreach($siteSettings->banners as $key => $path)
                                    <div class="swiper-slide" style="position: relative; height: 100%;">
                                        <img src="{{ asset('storage/' . $path) }}" style="width: 100%; height: 100%; object-fit: cover; position: absolute; inset: 0;" alt="Slide {{ $key + 1 }}"/>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        <!-- Controls -->
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-16 md:py-24 bg-gradient-to-b from-white via-blue-50/50 to-white dark:from-gray-900 dark:via-gray-800/50 dark:to-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 md:mb-20">
                <span class="inline-block px-4 py-2 rounded-full bg-gradient-to-r from-blue-100 to-emerald-100 dark:from-blue-900/30 dark:to-emerald-900/30 text-blue-600 dark:text-blue-400 font-semibold text-sm mb-4 fade-in">
                    <i class="fas fa-bolt mr-2"></i>POWERFUL FEATURES
                </span>
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-4 fade-in">
                    Everything You Need to
                    <span class="bg-gradient-to-r from-blue-600 to-emerald-500 bg-clip-text text-transparent">Excel</span>
                </h2>
                <p class="text-lg md:text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto fade-in" style="animation-delay: 0.2s;">
                    A comprehensive suite of tools designed to optimize your learning experience and maximize results
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8">
                <!-- Feature 1 -->
                <div class="group relative fade-in">
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-emerald-500 rounded-2xl blur opacity-0 group-hover:opacity-20 transition duration-500"></div>
                    <div class="relative bg-white dark:bg-gray-800 rounded-2xl p-6 md:p-8 shadow-xl hover:shadow-2xl transition-all duration-300 border border-gray-100 dark:border-gray-700 group-hover:border-blue-200 dark:group-hover:border-blue-500/30 card-hover">
                        <div class="w-14 h-14 md:w-16 md:h-16 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 group-hover:from-blue-600 group-hover:to-blue-700 flex items-center justify-center mb-6 shadow-lg group-hover:shadow-blue-500/25 transition-all duration-300">
                            <i class="fas fa-file-import text-2xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-300">
                            Smart Import
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300 mb-4">
                            Upload questions via CSV/Excel with AI-powered validation and organization
                        </p>
                        <div class="flex items-center text-blue-600 dark:text-blue-400 font-medium group-hover:translate-x-2 transition-transform duration-300">
                            Learn More <i class="fas fa-arrow-right ml-2"></i>
                        </div>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="group relative fade-in" style="animation-delay: 0.1s;">
                    <div class="absolute inset-0 bg-gradient-to-r from-emerald-500 to-green-500 rounded-2xl blur opacity-0 group-hover:opacity-20 transition duration-500"></div>
                    <div class="relative bg-white dark:bg-gray-800 rounded-2xl p-6 md:p-8 shadow-xl hover:shadow-2xl transition-all duration-300 border border-gray-100 dark:border-gray-700 group-hover:border-emerald-200 dark:group-hover:border-emerald-500/30 card-hover">
                        <div class="w-14 h-14 md:w-16 md:h-16 rounded-xl bg-gradient-to-br from-emerald-500 to-emerald-600 group-hover:from-emerald-600 group-hover:to-emerald-700 flex items-center justify-center mb-6 shadow-lg group-hover:shadow-emerald-500/25 transition-all duration-300">
                            <i class="fas fa-forward text-2xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors duration-300">
                            Smart Navigation
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300 mb-4">
                            Intelligent question skipping and bookmarking with progress tracking
                        </p>
                        <div class="flex items-center text-emerald-600 dark:text-emerald-400 font-medium group-hover:translate-x-2 transition-transform duration-300">
                            Try Feature <i class="fas fa-play ml-2"></i>
                        </div>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="group relative fade-in" style="animation-delay: 0.2s;">
                    <div class="absolute inset-0 bg-gradient-to-r from-purple-500 to-pink-500 rounded-2xl blur opacity-0 group-hover:opacity-20 transition duration-500"></div>
                    <div class="relative bg-white dark:bg-gray-800 rounded-2xl p-6 md:p-8 shadow-xl hover:shadow-2xl transition-all duration-300 border border-gray-100 dark:border-gray-700 group-hover:border-purple-200 dark:group-hover:border-purple-500/30 card-hover">
                        <div class="w-14 h-14 md:w-16 md:h-16 rounded-xl bg-gradient-to-br from-purple-500 to-purple-600 group-hover:from-purple-600 group-hover:to-purple-700 flex items-center justify-center mb-6 shadow-lg group-hover:shadow-purple-500/25 transition-all duration-300">
                            <i class="fas fa-bolt text-2xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 group-hover:text-purple-600 dark:group-hover:text-purple-400 transition-colors duration-300">
                            Instant Results
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300 mb-4">
                            Real-time scoring with detailed analytics and performance breakdown
                        </p>
                        <div class="flex items-center text-purple-600 dark:text-purple-400 font-medium group-hover:translate-x-2 transition-transform duration-300">
                            See Demo <i class="fas fa-chart-bar ml-2"></i>
                        </div>
                    </div>
                </div>

                <!-- Feature 4 -->
                <div class="group relative fade-in" style="animation-delay: 0.3s;">
                    <div class="absolute inset-0 bg-gradient-to-r from-orange-500 to-red-500 rounded-2xl blur opacity-0 group-hover:opacity-20 transition duration-500"></div>
                    <div class="relative bg-white dark:bg-gray-800 rounded-2xl p-6 md:p-8 shadow-xl hover:shadow-2xl transition-all duration-300 border border-gray-100 dark:border-gray-700 group-hover:border-orange-200 dark:group-hover:border-orange-500/30 card-hover">
                        <div class="w-14 h-14 md:w-16 md:h-16 rounded-xl bg-gradient-to-br from-orange-500 to-orange-600 group-hover:from-orange-600 group-hover:to-orange-700 flex items-center justify-center mb-6 shadow-lg group-hover:shadow-orange-500/25 transition-all duration-300">
                            <i class="fas fa-chart-line text-2xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 group-hover:text-orange-600 dark:group-hover:text-orange-400 transition-colors duration-300">
                            Progress AI
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300 mb-4">
                            AI-powered insights and personalized improvement recommendations
                        </p>
                        <div class="flex items-center text-orange-600 dark:text-orange-400 font-medium group-hover:translate-x-2 transition-transform duration-300">
                            View Insights <i class="fas fa-robot ml-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section id="how-it-works" class="py-16 md:py-24 bg-gradient-to-b from-blue-50/50 to-white dark:from-gray-800/50 dark:to-gray-900 relative overflow-hidden">
        <div class="absolute inset-0 bg-grid-gray-900/[0.02] bg-grid-pattern opacity-10"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="text-center mb-16 md:mb-20">
                <span class="inline-block px-4 py-2 rounded-full bg-gradient-to-r from-blue-100 to-purple-100 dark:from-blue-900/30 dark:to-purple-900/30 text-purple-600 dark:text-purple-400 font-semibold text-sm mb-4 fade-in">
                    <i class="fas fa-play-circle mr-2"></i>3 SIMPLE STEPS
                </span>
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-4 fade-in">
                    Start Learning in
                    <span class="bg-gradient-to-r from-purple-600 to-pink-500 bg-clip-text text-transparent">Minutes</span>
                </h2>
                <p class="text-lg md:text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto fade-in" style="animation-delay: 0.2s;">
                    Our streamlined process ensures you can focus on what matters most – learning
                </p>
            </div>

            <div class="relative">
                <!-- Timeline line -->
                <div class="hidden lg:block absolute left-1/2 transform -translate-x-1/2 h-full w-0.5 bg-gradient-to-b from-blue-500 via-purple-500 to-emerald-500"></div>

                <div class="space-y-12 lg:space-y-0">
                    <!-- Step 1 -->
                    <div class="relative lg:grid lg:grid-cols-2 lg:gap-12 items-center fade-in">
                        <div class="lg:text-right lg:pr-12 mb-8 lg:mb-0">
                            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 text-white text-xl font-bold mb-4 shadow-xl lg:ml-auto hover:scale-110 transition-transform duration-300 cursor-pointer group">
                                1
                                <div class="absolute inset-0 rounded-full bg-gradient-to-br from-blue-600 to-blue-700 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">Quick Sign Up</h3>
                            <p class="text-gray-600 dark:text-gray-300">
                                Create your account in 30 seconds with email or social login. Get instant access to our platform.
                            </p>
                        </div>
                        <div class="relative">
                            <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-xl border border-gray-100 dark:border-gray-700 card-hover">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-blue-100 to-blue-50 dark:from-blue-900/30 dark:to-blue-900/10 flex items-center justify-center mr-4">
                                        <i class="fas fa-user-plus text-blue-600 dark:text-blue-400 text-xl"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-900 dark:text-white">Instant Access</h4>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Start immediately after registration</p>
                                    </div>
                                </div>
                                <div class="space-y-3">
                                    <div class="flex items-center text-sm">
                                        <i class="fas fa-check-circle text-emerald-500 mr-2"></i>
                                        <span>No credit card required</span>
                                    </div>
                                    <div class="flex items-center text-sm">
                                        <i class="fas fa-check-circle text-emerald-500 mr-2"></i>
                                        <span>7-day free trial</span>
                                    </div>
                                    <div class="flex items-center text-sm">
                                        <i class="fas fa-check-circle text-emerald-500 mr-2"></i>
                                        <span>Social login available</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="relative lg:grid lg:grid-cols-2 lg:gap-12 items-center fade-in" style="animation-delay: 0.3s;">
                        <div class="lg:order-2 lg:pl-12 mb-8 lg:mb-0">
                            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gradient-to-br from-purple-500 to-purple-600 text-white text-xl font-bold mb-4 shadow-xl lg:mr-auto hover:scale-110 transition-transform duration-300 cursor-pointer group">
                                2
                                <div class="absolute inset-0 rounded-full bg-gradient-to-br from-purple-600 to-purple-700 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">Choose Your Path</h3>
                            <p class="text-gray-600 dark:text-gray-300">
                                Select from thousands of exams across various categories and difficulty levels.
                            </p>
                        </div>
                        <div class="lg:order-1 relative">
                            <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-xl border border-gray-100 dark:border-gray-700 card-hover">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-purple-100 to-purple-50 dark:from-purple-900/30 dark:to-purple-900/10 flex items-center justify-center mr-4">
                                        <i class="fas fa-compass text-purple-600 dark:text-purple-400 text-xl"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-900 dark:text-white">Smart Discovery</h4>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">AI-powered exam recommendations</p>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-3">
                                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-900/10 rounded-lg p-3 text-center">
                                        <div class="text-lg font-bold text-blue-600 dark:text-blue-400">250+</div>
                                        <div class="text-xs text-gray-600 dark:text-gray-400">Categories</div>
                                    </div>
                                    <div class="bg-gradient-to-br from-purple-50 to-purple-100 dark:from-purple-900/20 dark:to-purple-900/10 rounded-lg p-3 text-center">
                                        <div class="text-lg font-bold text-purple-600 dark:text-purple-400">10K+</div>
                                        <div class="text-xs text-gray-600 dark:text-gray-400">Questions</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="relative lg:grid lg:grid-cols-2 lg:gap-12 items-center fade-in" style="animation-delay: 0.6s;">
                        <div class="lg:text-right lg:pr-12 mb-8 lg:mb-0">
                            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gradient-to-br from-emerald-500 to-emerald-600 text-white text-xl font-bold mb-4 shadow-xl lg:ml-auto hover:scale-110 transition-transform duration-300 cursor-pointer group">
                                3
                                <div class="absolute inset-0 rounded-full bg-gradient-to-br from-emerald-600 to-emerald-700 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">Learn & Grow</h3>
                            <p class="text-gray-600 dark:text-gray-300">
                                Take exams, receive instant feedback, and track your progress with detailed analytics.
                            </p>
                        </div>
                        <div class="relative">
                            <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-xl border border-gray-100 dark:border-gray-700 card-hover">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-emerald-100 to-emerald-50 dark:from-emerald-900/30 dark:to-emerald-900/10 flex items-center justify-center mr-4">
                                        <i class="fas fa-trophy text-emerald-600 dark:text-emerald-400 text-xl"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-900 dark:text-white">Achieve Success</h4>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Track and celebrate your progress</p>
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600 dark:text-gray-400">Accuracy</span>
                                        <span class="font-bold text-emerald-600">94%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                        <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 h-2 rounded-full" style="width: 94%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Final CTA Section -->
    <section class="py-16 md:py-24 relative overflow-hidden">
        <!-- Background gradient -->
        <div class="absolute inset-0 bg-gradient-to-br from-blue-900 via-purple-900 to-gray-900"></div>

        <!-- Animated particles -->
        <div class="absolute inset-0">
            @for($i = 1; $i <= 20; $i++)
                <div class="absolute w-2 h-2 bg-white rounded-full opacity-20"
                     style="top: {{ rand(0, 100) }}%; left: {{ rand(0, 100) }}%;
                            animation: float {{ rand(10, 30) }}s linear infinite;
                            animation-delay: {{ $i * 0.5 }}s;"></div>
            @endfor
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <!-- Floating badge -->
            <div class="inline-flex items-center px-4 py-2 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 mb-8 animate-pulse">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse mr-2"></span>
                <span class="text-sm font-medium text-white">LIMITED TIME OFFER</span>
            </div>

            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-6">
                Ready to Transform Your
                <span class="gradient-animate">Learning Journey</span>?
            </h2>

            <p class="text-lg md:text-xl text-blue-200 mb-8 max-w-2xl mx-auto">
                Join thousands of successful students who have achieved their goals with QuizVerse
            </p>

            <!-- Stats -->
            <div class="grid grid-cols-3 gap-4 mb-8 max-w-md mx-auto">
                <div class="text-center">
                    <div class="text-3xl font-bold text-white mb-1">10K+</div>
                    <div class="text-sm text-blue-300">Active Students</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-white mb-1">98%</div>
                    <div class="text-sm text-blue-300">Success Rate</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-white mb-1">24/7</div>
                    <div class="text-sm text-blue-300">Support</div>
                </div>
            </div>

            @auth
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ url('/dashboard') }}"
                       class="group relative inline-flex items-center px-8 py-4 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white rounded-xl font-bold text-lg shadow-2xl hover:shadow-3xl transition-all duration-300 overflow-hidden hover-lift">
                        <div class="absolute inset-0 bg-gradient-to-r from-emerald-600 to-emerald-700 transform -translate-x-full group-hover:translate-x-0 transition-transform duration-500"></div>
                        <span class="relative flex items-center justify-center">
                            <i class="fas fa-rocket text-xl mr-3 group-hover:rotate-45 transition-transform duration-300"></i>
                            Launch Dashboard
                        </span>
                    </a>
                    <a href="/exams"
                       class="group inline-flex items-center px-8 py-4 bg-white/10 backdrop-blur-sm border-2 border-white/30 text-white rounded-xl font-bold text-lg hover:bg-white hover:text-blue-600 transition-all duration-300 hover-lift">
                        <i class="fas fa-play-circle text-xl mr-3 group-hover:scale-110 transition-transform duration-300"></i>
                        Explore Exams
                    </a>
                </div>
            @else
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('register') }}"
                       class="group relative inline-flex items-center px-8 py-4 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white rounded-xl font-bold text-lg shadow-2xl hover:shadow-3xl transition-all duration-300 overflow-hidden hover-lift pulse-glow">
                        <div class="absolute inset-0 bg-gradient-to-r from-emerald-600 to-emerald-700 transform -translate-x-full group-hover:translate-x-0 transition-transform duration-500"></div>
                        <span class="relative flex items-center justify-center">
                            <i class="fas fa-crown text-xl mr-3 group-hover:rotate-12 transition-transform duration-300"></i>
                            Start Free Trial
                        </span>
                    </a>
                    <a href="{{ route('login') }}"
                       class="group inline-flex items-center px-8 py-4 bg-white/10 backdrop-blur-sm border-2 border-white/30 text-white rounded-xl font-bold text-lg hover:bg-white hover:text-blue-600 transition-all duration-300 hover-lift">
                        <i class="fas fa-sign-in-alt text-xl mr-3 group-hover:scale-110 transition-transform duration-300"></i>
                        Existing User? Login
                    </a>
                </div>
            @endauth

            <p class="text-blue-300 mt-8 text-sm">
                <i class="fas fa-shield-alt mr-2"></i>Secure & Encrypted • 7-Day Free Trial • Cancel Anytime
            </p>
        </div>
    </section>
@endsection

@push('frontend_scripts')
    <script>
        $(document).ready(function() {
            // Simple jQuery Counter Animation
            function initCounterAnimation() {
                $('.counter').each(function() {
                    const $counter = $(this);

                    // Don't re-animate
                    if ($counter.data('animated')) return;

                    // Check if element is in viewport
                    const elementTop = $counter.offset().top;
                    const elementBottom = elementTop + $counter.outerHeight();
                    const viewportTop = $(window).scrollTop();
                    const viewportBottom = viewportTop + $(window).height();

                    // If not in viewport, skip
                    if (elementBottom < viewportTop || elementTop > viewportBottom) {
                        return;
                    }

                    // Mark as animated
                    $counter.data('animated', true);

                    // Get counter data
                    const target = parseFloat($counter.data('target')) || parseFloat($counter.text());
                    const suffix = $counter.data('suffix') || '';
                    const isDecimal = target.toString().includes('.');

                    // Store original content for suffix
                    const originalSuffix = suffix;

                    // Start animation
                    $({ countNum: 0 }).animate({ countNum: target }, {
                        duration: 2000,
                        easing: 'swing',
                        step: function(now) {
                            // For decimal values (like 4.9)
                            if (isDecimal) {
                                $counter.text(now.toFixed(1) + originalSuffix);
                            }
                            // For percentage (98%)
                            else if (originalSuffix === '%') {
                                $counter.text(Math.floor(now) + originalSuffix);
                            }
                            // For other values (2500+)
                            else {
                                $counter.text(Math.floor(now) + originalSuffix);
                            }
                        },
                        complete: function() {
                            // Ensure final value is correct
                            if (isDecimal) {
                                $counter.text(target.toFixed(1) + originalSuffix);
                            } else {
                                $counter.text(target + originalSuffix);
                            }
                        }
                    });
                });
            }

            // Run on scroll and load
            $(window).on('scroll', initCounterAnimation);
            $(document).ready(initCounterAnimation);
            $(window).on('load', initCounterAnimation);

            // Also trigger after a short delay to catch any dynamically loaded content
            setTimeout(initCounterAnimation, 500);
        });
    </script>
@endpush
