@extends('layouts.app')

@section('content')
    <div class="w-full max-w-md bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8">
        <h2 class="text-2xl font-bold text-center text-gray-800 dark:text-white mb-6">Forgot Password 🔑</h2>

        <p class="mb-6 text-sm text-gray-600 dark:text-gray-400 text-center">
            Forgot your password? No problem. Just enter your email address and we’ll send you a reset link.
        </p>

        <!-- Session Status -->
        @if (session('status'))
            <div class="mb-4 text-sm text-green-600 dark:text-green-400">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none
                            dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                @error('email')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-between">
                <a href="{{ route('login') }}"
                class="text-sm text-indigo-600 hover:underline dark:text-indigo-400">
                    Back to Login
                </a>
                <button type="submit"
                        class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                    Email Reset Link
                </button>
            </div>
        </form>
    </div>
@endsection
