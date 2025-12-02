@extends('layouts.app')

@section('content')
<div class="w-full max-w-md bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8">
    <h2 class="text-2xl font-bold text-center text-gray-800 dark:text-white mb-6">Login to QuizVerse</h2>

    <!-- Session Status -->
    @if (session('status'))
        <div class="mb-4 text-sm text-green-600 dark:text-green-400">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                   class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            @error('email')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                   class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            @error('password')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <input id="remember_me" type="checkbox" name="remember"
                   class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600">
            <label for="remember_me" class="ml-2 text-sm text-gray-600 dark:text-gray-400">Remember me</label>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-between">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                   class="text-sm text-indigo-600 hover:underline dark:text-indigo-400">
                    Forgot your password?
                </a>
            @endif

            <button type="submit"
                    class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                Log in
            </button>
        </div>
    </form>

    <p class="mt-6 text-center text-sm text-gray-600 dark:text-gray-400">
        Don’t have an account?
        <a href="{{ route('register') }}" class="text-indigo-600 hover:underline dark:text-indigo-400">Register</a>
    </p>
</div>
@endsection
