@extends('layouts.app')

@push('frontend_title')
    Forgot Password
@endpush

@section('content')
    <div class="min-h-[70vh] flex items-center justify-center px-4 py-8">
        <div class="w-full max-w-sm bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden border border-gray-100 dark:border-gray-700">
            <!-- Header with gradient -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-500 p-4 text-center">
                <h2 class="text-xl font-bold text-white">Reset Password</h2>
                <p class="text-blue-100 text-sm mt-1">We'll email you a reset link</p>
            </div>

            <div class="p-6">
                <!-- Session Status -->
                @if (session('status'))
                    <div class="mb-4 p-2 bg-gradient-to-r from-emerald-50 to-green-50 dark:from-emerald-900/20 dark:to-green-900/20 text-emerald-700 dark:text-emerald-300 rounded border border-emerald-200 dark:border-emerald-800 text-xs">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle mr-2 text-xs"></i>
                            {{ session('status') }}
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
                    @csrf

                    <!-- Email Address -->
                    <div class="space-y-1">
                        <label for="email" class="block text-xs font-medium text-gray-700 dark:text-gray-300">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500 focus:outline-none dark:bg-gray-700 dark:text-white text-sm"
                            placeholder="you@example.com">
                        @error('email')
                            <div class="text-xs text-red-600 dark:text-red-400 mt-1 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1 text-xs"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Reset Button -->
                    <button type="submit"
                            class="w-full py-2 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white rounded font-medium shadow hover:shadow-md transition-all duration-200 text-sm">
                        Send Reset Link
                    </button>

                    <!-- Back to Login -->
                    <div class="text-center pt-4">
                        <a href="{{ route('login') }}"
                        class="text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300 text-xs">
                            ← Back to Login
                        </a>
                    </div>
                </form>

                <!-- Help Tips -->
                <div class="mt-6 pt-4 border-t border-gray-200 dark:border-gray-700">
                    <h4 class="font-medium text-gray-700 dark:text-gray-300 mb-2 text-xs">Helpful tips:</h4>
                    <ul class="space-y-1 text-xs text-gray-600 dark:text-gray-400">
                        <li class="flex items-center">
                            <i class="fas fa-check text-emerald-500 mr-1 text-xs"></i>
                            Check spam folder
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-emerald-500 mr-1 text-xs"></i>
                            Use registered email
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
