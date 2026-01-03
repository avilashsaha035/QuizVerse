@extends('layouts.app')

@push('frontend_title')
    Verify Email
@endpush

@section('content')
    <div class="min-h-[70vh] flex items-center justify-center px-4 py-8">
        <div class="w-full max-w-sm bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden border border-gray-100 dark:border-gray-700">
            <!-- Header with gradient -->
            <div class="bg-gradient-to-r from-emerald-500 to-blue-500 p-4 text-center">
                <h2 class="text-xl font-bold text-white">Verify Email</h2>
                <p class="text-emerald-100 text-sm mt-1">Almost there!</p>
            </div>

            <div class="p-6 text-center">
                <div class="mb-4 flex justify-center">
                    <i class="fas fa-envelope-open-text text-3xl text-emerald-500"></i>
                </div>

                <p class="mb-4 text-xs text-gray-600 dark:text-gray-400">
                    Thanks for signing up! Please verify your email address by clicking the link we just emailed you.
                </p>

                @if (session('status') == 'verification-link-sent')
                    <div class="mb-4 p-2 bg-gradient-to-r from-emerald-50 to-green-50 dark:from-emerald-900/20 dark:to-green-900/20 text-emerald-700 dark:text-emerald-300 rounded border border-emerald-200 dark:border-emerald-800 text-xs">
                        <div class="flex items-center justify-center">
                            <i class="fas fa-check-circle mr-2 text-xs"></i>
                            New verification link sent!
                        </div>
                    </div>
                @endif

                <div class="space-y-3">
                    <!-- Resend Button -->
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit"
                                class="w-full px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white rounded font-medium shadow hover:shadow-md transition-all duration-200 text-sm">
                            Resend Verification Email
                        </button>
                    </form>

                    <!-- Divider -->
                    <div class="relative my-2">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300 dark:border-gray-600"></div>
                        </div>
                        <div class="relative flex justify-center text-xs">
                            <span class="px-2 bg-white dark:bg-gray-800 text-gray-500 dark:text-gray-400">or</span>
                        </div>
                    </div>

                    <!-- Logout Button -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 rounded font-medium transition-colors duration-200 text-sm">
                            Log Out
                        </button>
                    </form>
                </div>

                <!-- Help Text -->
                <div class="mt-6 pt-4 border-t border-gray-200 dark:border-gray-700">
                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        Didn't receive email? Check spam folder or
                        <a href="mailto:support@quizverse.com" class="text-blue-600 hover:underline dark:text-blue-400">
                            contact support
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
