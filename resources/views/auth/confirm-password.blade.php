@extends('layouts.app')

@push('frontend_title')
    Confirm Password
@endpush

@section('content')
    <div class="min-h-[70vh] flex items-center justify-center px-4 py-8">
        <div class="w-full max-w-sm bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden border border-gray-100 dark:border-gray-700">
            <!-- Header with gradient -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-500 p-4 text-center">
                <h2 class="text-xl font-bold text-white">Confirm Password</h2>
                <p class="text-blue-100 text-sm mt-1">Secure area access</p>
            </div>

            <div class="p-6">
                <p class="mb-4 text-xs text-gray-600 dark:text-gray-400 text-center">
                    This is a secure area. Please confirm your password to continue.
                </p>

                <form method="POST" action="{{ route('password.confirm') }}" class="space-y-4">
                    @csrf

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

                    <!-- Confirm Button -->
                    <div class="flex justify-end">
                        <button type="submit"
                                class="px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white rounded font-medium shadow hover:shadow-md transition-all duration-200 text-sm">
                            Confirm
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
