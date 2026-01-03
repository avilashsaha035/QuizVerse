@extends('layouts.app')

@push('frontend_title')
    Login
@endpush

@section('content')
    <div class="min-h-[70vh] flex items-center justify-center px-4 py-8">
        <div class="w-full max-w-sm bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden border border-gray-100 dark:border-gray-700">
            <!-- Header with gradient -->
            <div class="bg-gradient-to-r from-blue-600 to-emerald-500 p-4 text-center">
                <h2 class="text-xl font-bold text-white">Welcome Back</h2>
                <p class="text-blue-100 text-sm mt-1">Sign in to continue</p>
            </div>

            <div class="p-6">
                <!-- Session Status -->
                @if (session('status'))
                    <div class="mb-3 p-2 bg-gradient-to-r from-emerald-50 to-green-50 dark:from-emerald-900/20 dark:to-green-900/20 text-emerald-700 dark:text-emerald-300 rounded border border-emerald-200 dark:border-emerald-800 text-xs">
                        <i class="fas fa-check-circle mr-1"></i>{{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    <!-- Email Address -->
                    <div class="space-y-1">
                        <label for="email" class="block text-xs font-medium text-gray-700 dark:text-gray-300">Email</label>
                        <div class="relative">
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                                class="w-full px-3 py-2 pl-8 border border-gray-300 dark:border-gray-600 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500 focus:outline-none dark:bg-gray-700 dark:text-white text-sm"
                                placeholder="you@example.com">
                            <i class="fas fa-envelope absolute left-2 top-1/2 transform -translate-y-1/2 text-gray-400 text-xs"></i>
                        </div>
                        @error('email')
                            <div class="text-xs text-red-600 dark:text-red-400 mt-1 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1 text-xs"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="space-y-1">
                        <label for="password" class="block text-xs font-medium text-gray-700 dark:text-gray-300">Password</label>
                        <div class="relative">
                            <input id="password" type="password" name="password" required autocomplete="current-password"
                                class="w-full px-3 py-2 pl-8 border border-gray-300 dark:border-gray-600 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500 focus:outline-none dark:bg-gray-700 dark:text-white text-sm"
                                placeholder="••••••••">
                            <i class="fas fa-lock absolute left-2 top-1/2 transform -translate-y-1/2 text-gray-400 text-xs"></i>
                        </div>
                        @error('password')
                            <div class="text-xs text-red-600 dark:text-red-400 mt-1 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1 text-xs"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between text-xs">
                        <div class="flex items-center">
                            <input id="remember_me" type="checkbox" name="remember"
                                class="h-3 w-3 rounded border-gray-300 text-blue-600 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600">
                            <label for="remember_me" class="ml-1 text-gray-600 dark:text-gray-400">Remember me</label>
                        </div>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                            class="text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300">
                                Forgot password?
                            </a>
                        @endif
                    </div>

                    <!-- Login Button -->
                    <button type="submit"
                            class="w-full py-2 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white rounded font-medium shadow hover:shadow-md transition-all duration-200 text-sm">
                        Sign In
                    </button>
                </form>

                <!-- Divider -->
                <div class="relative my-4">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300 dark:border-gray-600"></div>
                    </div>
                    <div class="relative flex justify-center text-xs">
                        <span class="px-2 bg-white dark:bg-gray-800 text-gray-500 dark:text-gray-400">New to QuizVerse?</span>
                    </div>
                </div>

                <!-- Register Link -->
                <div class="text-center">
                    <a href="{{ route('register') }}"
                       class="inline-block px-4 py-2 border border-blue-500 text-blue-600 hover:text-white hover:bg-gradient-to-r hover:from-blue-600 hover:to-emerald-500 rounded font-medium transition-all duration-200 text-sm">
                        <i class="fas fa-user-plus mr-2"></i>Create Account
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
