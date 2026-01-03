@extends('layouts.app')

@push('frontend_title')
    Register
@endpush

@section('content')
    <div class="min-h-[70vh] flex items-center justify-center px-4 py-8">
        <div class="w-full max-w-sm bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden border border-gray-100 dark:border-gray-700">
            <!-- Header with gradient -->
            <div class="bg-gradient-to-r from-emerald-500 to-blue-500 p-4 text-center">
                <h2 class="text-xl font-bold text-white">Join QuizVerse</h2>
                <p class="text-emerald-100 text-sm mt-1">Start learning today</p>
            </div>

            <div class="p-6">
                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <!-- Name -->
                    <div class="space-y-1">
                        <label for="name" class="block text-xs font-medium text-gray-700 dark:text-gray-300">Full Name</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded focus:ring-1 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none dark:bg-gray-700 dark:text-white text-sm"
                            placeholder="John Doe">
                        @error('name')
                            <div class="text-xs text-red-600 dark:text-red-400 mt-1 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1 text-xs"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Email Address -->
                    <div class="space-y-1">
                        <label for="email" class="block text-xs font-medium text-gray-700 dark:text-gray-300">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded focus:ring-1 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none dark:bg-gray-700 dark:text-white text-sm"
                            placeholder="you@example.com">
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
                            <input id="password" type="password" name="password" required autocomplete="new-password"
                                class="w-full px-3 py-2 pr-8 border border-gray-300 dark:border-gray-600 rounded focus:ring-1 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none dark:bg-gray-700 dark:text-white text-sm"
                                placeholder="••••••••">
                            <div class="absolute right-2 top-1/2 transform -translate-y-1/2">
                                <button type="button" class="text-gray-400 hover:text-gray-600" onclick="togglePassword('password')">
                                    <i class="fas fa-eye text-xs"></i>
                                </button>
                            </div>
                        </div>
                        @error('password')
                            <div class="text-xs text-red-600 dark:text-red-400 mt-1 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1 text-xs"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="space-y-1">
                        <label for="password_confirmation" class="block text-xs font-medium text-gray-700 dark:text-gray-300">Confirm Password</label>
                        <div class="relative">
                            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                                class="w-full px-3 py-2 pr-8 border border-gray-300 dark:border-gray-600 rounded focus:ring-1 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none dark:bg-gray-700 dark:text-white text-sm"
                                placeholder="••••••••">
                            <div class="absolute right-2 top-1/2 transform -translate-y-1/2">
                                <button type="button" class="text-gray-400 hover:text-gray-600" onclick="togglePassword('password_confirmation')">
                                    <i class="fas fa-eye text-xs"></i>
                                </button>
                            </div>
                        </div>
                        @error('password_confirmation')
                            <div class="text-xs text-red-600 dark:text-red-400 mt-1 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1 text-xs"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Terms Agreement -->
                    <div class="flex items-start space-x-2 p-2 bg-blue-50 dark:bg-blue-900/20 rounded border border-blue-100 dark:border-blue-800 text-xs">
                        <input id="terms" type="checkbox" required
                            class="h-3 w-3 mt-0.5 rounded border-gray-300 text-blue-600 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600">
                        <label for="terms" class="text-gray-600 dark:text-gray-400">
                            I agree to <a href="/terms" class="text-blue-600 hover:underline dark:text-blue-400">Terms</a> & <a href="/privacy" class="text-blue-600 hover:underline dark:text-blue-400">Privacy</a>
                        </label>
                    </div>

                    <!-- Register Button -->
                    <button type="submit"
                            class="w-full py-2 bg-gradient-to-r from-emerald-500 to-blue-500 hover:from-emerald-600 hover:to-blue-600 text-white rounded font-medium shadow hover:shadow-md transition-all duration-200 text-sm">
                        <i class="fas fa-user-plus mr-2"></i>Create Account
                    </button>

                    <!-- Login Link -->
                    <div class="text-center mt-4 text-xs">
                        <p class="text-gray-600 dark:text-gray-400">
                            Already have an account?
                            <a href="{{ route('login') }}"
                            class="text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300 font-medium">
                                Sign In
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = input.parentElement.querySelector('button i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
@endsection
