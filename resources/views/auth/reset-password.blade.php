@extends('layouts.app')

@push('frontend_title')
    Reset Password
@endpush

@section('content')
    <div class="min-h-[70vh] flex items-center justify-center px-4 py-8">
        <div class="w-full max-w-sm bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden border border-gray-100 dark:border-gray-700">
            <!-- Header with gradient -->
            <div class="bg-gradient-to-r from-blue-600 to-emerald-500 p-4 text-center">
                <h2 class="text-xl font-bold text-white">Reset Password</h2>
                <p class="text-blue-100 text-sm mt-1">Create new password</p>
            </div>

            <div class="p-6">
                <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
                    @csrf

                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Email Address -->
                    <div class="space-y-1">
                        <label for="email" class="block text-xs font-medium text-gray-700 dark:text-gray-300">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500 focus:outline-none dark:bg-gray-700 dark:text-white text-sm"
                            placeholder="you@example.com">
                        @error('email')
                            <div class="text-xs text-red-600 dark:text-red-400 mt-1 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1 text-xs"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="space-y-1">
                        <label for="password" class="block text-xs font-medium text-gray-700 dark:text-gray-300">New Password</label>
                        <div class="relative">
                            <input id="password" type="password" name="password" required autocomplete="new-password"
                                class="w-full px-3 py-2 pr-8 border border-gray-300 dark:border-gray-600 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500 focus:outline-none dark:bg-gray-700 dark:text-white text-sm"
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
                                class="w-full px-3 py-2 pr-8 border border-gray-300 dark:border-gray-600 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500 focus:outline-none dark:bg-gray-700 dark:text-white text-sm"
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

                    <!-- Reset Button -->
                    <div class="flex justify-end">
                        <button type="submit"
                                class="px-4 py-2 bg-gradient-to-r from-blue-600 to-emerald-500 hover:from-blue-700 hover:to-emerald-600 text-white rounded font-medium shadow hover:shadow-md transition-all duration-200 text-sm">
                            Reset Password
                        </button>
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
