@extends('layouts.app')

@push('frontend_title')
    Dashboard
@endpush

@section('content')
    <div class="py-8 w-full">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Dashboard Header -->
            <div class="mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-800 dark:text-gray-200">
                            Welcome back, <span class="bg-gradient-to-r from-blue-600 to-emerald-500 bg-clip-text text-transparent">{{ Auth::user()->name }}</span>! 👋
                        </h1>
                        <p class="text-gray-600 dark:text-gray-400 mt-2 text-sm md:text-base">
                            Track your progress and continue learning
                        </p>
                    </div>
                    <div class="mt-4 sm:mt-0">
                        <a href="/exams"
                           class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white rounded-lg font-medium shadow-lg hover:shadow-xl transition-all duration-200 text-sm">
                            <i class="fas fa-play mr-2"></i>
                            Start New Exam
                        </a>
                    </div>
                </div>
            </div>

            <!-- Stats Overview -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <!-- Total Exams Taken -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md border border-gray-100 dark:border-gray-700 p-4 card-hover">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Exams Taken</p>
                            <p class="text-2xl font-bold text-gray-800 dark:text-gray-200 mt-1">12</p>
                        </div>
                        <div class="p-3 rounded-lg bg-blue-50 dark:bg-blue-900/20">
                            <i class="fas fa-file-alt text-blue-500 text-lg"></i>
                        </div>
                    </div>
                    <div class="mt-3 text-xs text-emerald-600 dark:text-emerald-400">
                        <i class="fas fa-arrow-up mr-1"></i>+3 this week
                    </div>
                </div>

                <!-- Average Score -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md border border-gray-100 dark:border-gray-700 p-4 card-hover">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Avg. Score</p>
                            <p class="text-2xl font-bold text-gray-800 dark:text-gray-200 mt-1">85%</p>
                        </div>
                        <div class="p-3 rounded-lg bg-emerald-50 dark:bg-emerald-900/20">
                            <i class="fas fa-chart-line text-emerald-500 text-lg"></i>
                        </div>
                    </div>
                    <div class="mt-3 text-xs text-emerald-600 dark:text-emerald-400">
                        <i class="fas fa-arrow-up mr-1"></i>+5% improvement
                    </div>
                </div>

                <!-- Study Time -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md border border-gray-100 dark:border-gray-700 p-4 card-hover">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Study Time</p>
                            <p class="text-2xl font-bold text-gray-800 dark:text-gray-200 mt-1">18h</p>
                        </div>
                        <div class="p-3 rounded-lg bg-blue-50 dark:bg-blue-900/20">
                            <i class="fas fa-clock text-blue-500 text-lg"></i>
                        </div>
                    </div>
                    <div class="mt-3 text-xs text-blue-600 dark:text-blue-400">
                        <i class="fas fa-trend-up mr-1"></i>Active learner
                    </div>
                </div>

                <!-- Streak -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md border border-gray-100 dark:border-gray-700 p-4 card-hover">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Current Streak</p>
                            <p class="text-2xl font-bold text-gray-800 dark:text-gray-200 mt-1">7 days</p>
                        </div>
                        <div class="p-3 rounded-lg bg-emerald-50 dark:bg-emerald-900/20">
                            <i class="fas fa-fire text-emerald-500 text-lg"></i>
                        </div>
                    </div>
                    <div class="mt-3 text-xs text-emerald-600 dark:text-emerald-400">
                        <i class="fas fa-flame mr-1"></i>Keep it up!
                    </div>
                </div>
            </div>

            <!-- Main Dashboard Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left Column -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Recent Exams -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md border border-gray-100 dark:border-gray-700 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 flex items-center">
                                <i class="fas fa-history mr-3 text-blue-500"></i>
                                Recent Exams
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                @for($i = 1; $i <= 3; $i++)
                                    <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-900/50 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-900 transition-colors duration-200">
                                        <div class="flex items-center">
                                            <div class="p-2 rounded-lg {{ $i == 1 ? 'bg-emerald-100 dark:bg-emerald-900/30' : ($i == 2 ? 'bg-blue-100 dark:bg-blue-900/30' : 'bg-amber-100 dark:bg-amber-900/30') }}">
                                                <i class="fas {{ $i == 1 ? 'fa-code' : ($i == 2 ? 'fa-database' : 'fa-server') }} {{ $i == 1 ? 'text-emerald-600' : ($i == 2 ? 'text-blue-600' : 'text-amber-600') }}"></i>
                                            </div>
                                            <div class="ml-4">
                                                <h4 class="font-medium text-gray-800 dark:text-gray-200">{{ $i == 1 ? 'Web Development' : ($i == 2 ? 'Database Management' : 'System Administration') }}</h4>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">Completed {{ $i }} hour{{ $i > 1 ? 's' : '' }} ago</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <span class="inline-block px-3 py-1 rounded-full text-xs font-medium {{ $i == 1 ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-300' : ($i == 2 ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300' : 'bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-300') }}">
                                                {{ $i == 1 ? '92%' : ($i == 2 ? '85%' : '78%') }}
                                            </span>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $i == 1 ? 'A+' : ($i == 2 ? 'B+' : 'C+') }}</p>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                            <div class="mt-6 text-center">
                                <a href="/exam-history"
                                   class="inline-flex items-center text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300 text-sm font-medium">
                                    <span>View All Exams</span>
                                    <i class="fas fa-arrow-right ml-2 text-xs"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md border border-gray-100 dark:border-gray-700 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 flex items-center">
                                <i class="fas fa-bolt mr-3 text-emerald-500"></i>
                                Quick Actions
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                <a href="/exams" class="group">
                                    <div class="p-4 bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-900/10 rounded-lg text-center hover:from-blue-100 hover:to-blue-200 dark:hover:from-blue-900/30 dark:hover:to-blue-900/20 transition-all duration-200 border border-blue-100 dark:border-blue-800">
                                        <i class="fas fa-play-circle text-2xl text-blue-500 mb-2 group-hover:scale-110 transition-transform"></i>
                                        <p class="text-sm font-medium text-gray-800 dark:text-gray-200">Start Exam</p>
                                    </div>
                                </a>
                                <a href="/practice" class="group">
                                    <div class="p-4 bg-gradient-to-br from-emerald-50 to-emerald-100 dark:from-emerald-900/20 dark:to-emerald-900/10 rounded-lg text-center hover:from-emerald-100 hover:to-emerald-200 dark:hover:from-emerald-900/30 dark:hover:to-emerald-900/20 transition-all duration-200 border border-emerald-100 dark:border-emerald-800">
                                        <i class="fas fa-brain text-2xl text-emerald-500 mb-2 group-hover:scale-110 transition-transform"></i>
                                        <p class="text-sm font-medium text-gray-800 dark:text-gray-200">Practice</p>
                                    </div>
                                </a>
                                <a href="/results" class="group">
                                    <div class="p-4 bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-900/10 rounded-lg text-center hover:from-blue-100 hover:to-blue-200 dark:hover:from-blue-900/30 dark:hover:to-blue-900/20 transition-all duration-200 border border-blue-100 dark:border-blue-800">
                                        <i class="fas fa-chart-bar text-2xl text-blue-500 mb-2 group-hover:scale-110 transition-transform"></i>
                                        <p class="text-sm font-medium text-gray-800 dark:text-gray-200">Results</p>
                                    </div>
                                </a>
                                <a href="/leaderboard" class="group">
                                    <div class="p-4 bg-gradient-to-br from-emerald-50 to-emerald-100 dark:from-emerald-900/20 dark:to-emerald-900/10 rounded-lg text-center hover:from-emerald-100 hover:to-emerald-200 dark:hover:from-emerald-900/30 dark:hover:to-emerald-900/20 transition-all duration-200 border border-emerald-100 dark:border-emerald-800">
                                        <i class="fas fa-trophy text-2xl text-emerald-500 mb-2 group-hover:scale-110 transition-transform"></i>
                                        <p class="text-sm font-medium text-gray-800 dark:text-gray-200">Leaderboard</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <!-- Profile Card -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md border border-gray-100 dark:border-gray-700 overflow-hidden">
                        <div class="relative">
                            <div class="h-20 bg-gradient-to-r from-blue-600 to-emerald-500"></div>
                            <div class="absolute -bottom-8 left-6">
                                <div class="w-16 h-16 rounded-full border-4 border-white bg-gradient-to-br from-blue-400 to-blue-300 flex items-center justify-center overflow-hidden">
                                    @if(auth()->user()->participant && auth()->user()->participant->profile_image)
                                        <img src="{{ asset('storage/' . auth()->user()->participant->profile_image) }}" alt="Profile Picture" class="w-full h-full object-cover">
                                    @else
                                        <span class="text-white font-bold text-xl"> {{ substr(auth()->user()->name, 0, 1) }}</span>
                                    @endif
                                </div>

                            </div>
                        </div>
                        <div class="pt-12 px-6 pb-6">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ Auth::user()->email }}</p>

                            <div class="mt-6 space-y-3">
                                <a href="{{ route('profile.edit') }}"
                                   class="flex items-center justify-center w-full px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white rounded-lg font-medium shadow hover:shadow-md transition-all duration-200 text-sm">
                                    <i class="fas fa-user-edit mr-2"></i>
                                    Edit Profile
                                </a>
                            </div>

                            <!-- Account Status -->
                            <div class="mt-6 p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-100 dark:border-blue-800">
                                <div class="flex items-center">
                                    <i class="fas fa-shield-alt text-blue-500 mr-3"></i>
                                    <div>
                                        <p class="text-xs font-medium text-gray-800 dark:text-gray-200">Account Status</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Active • Member since {{ Auth::user()->created_at->format('M Y') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Upcoming Exams -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md border border-gray-100 dark:border-gray-700 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 flex items-center">
                                <i class="fas fa-calendar-alt mr-3 text-emerald-500"></i>
                                Upcoming Exams
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                @for($i = 1; $i <= 2; $i++)
                                    <div class="p-3 bg-gray-50 dark:bg-gray-900/50 rounded-lg border-l-4 {{ $i == 1 ? 'border-blue-500' : 'border-emerald-500' }}">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h4 class="font-medium text-gray-800 dark:text-gray-200 text-sm">{{ $i == 1 ? 'Advanced JavaScript' : 'Network Security' }}</h4>
                                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                                    <i class="fas fa-clock mr-1"></i>
                                                    {{ $i == 1 ? 'Tomorrow, 10:00 AM' : 'Dec 25, 2:00 PM' }}
                                                </p>
                                            </div>
                                            <span class="px-2 py-1 rounded-full text-xs font-medium {{ $i == 1 ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300' : 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-300' }}">
                                                {{ $i == 1 ? '50 Qs' : '75 Qs' }}
                                            </span>
                                        </div>
                                        @if($i == 1)
                                            <button class="mt-3 w-full px-3 py-1.5 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white rounded text-xs font-medium transition-all duration-200">
                                                Prepare Now
                                            </button>
                                        @endif
                                    </div>
                                @endfor
                            </div>
                            <div class="mt-6 text-center">
                                <a href="/exams"
                                   class="inline-flex items-center text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300 text-sm font-medium">
                                    <span>Browse All Exams</span>
                                    <i class="fas fa-arrow-right ml-2 text-xs"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Progress Ring -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md border border-gray-100 dark:border-gray-700 p-6 text-center">
                        <div class="relative w-24 h-24 mx-auto mb-4">
                            <svg class="w-full h-full" viewBox="0 0 100 100">
                                <!-- Background circle -->
                                <circle cx="50" cy="50" r="45" fill="none" stroke="#e5e7eb" stroke-width="8"/>
                                <!-- Progress circle -->
                                <circle cx="50" cy="50" r="45" fill="none" stroke="url(#gradient)"
                                        stroke-width="8" stroke-linecap="round"
                                        stroke-dasharray="283" stroke-dashoffset="56.6"
                                        transform="rotate(-90 50 50)"/>
                                <defs>
                                    <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                        <stop offset="0%" stop-color="#3b82f6"/>
                                        <stop offset="100%" stop-color="#10b981"/>
                                    </linearGradient>
                                </defs>
                            </svg>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <span class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-emerald-500 bg-clip-text text-transparent">80%</span>
                            </div>
                        </div>
                        <h4 class="font-semibold text-gray-800 dark:text-gray-200">Monthly Goal</h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">8 of 10 exams completed</p>
                        <button class="mt-4 px-4 py-2 bg-gradient-to-r from-emerald-500 to-emerald-400 hover:from-emerald-600 hover:to-emerald-500 text-white rounded-lg text-sm font-medium shadow hover:shadow-md transition-all duration-200">
                            Keep Going
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
