@extends('layouts.app')

@push('frontend_title')
    Confirm Password
@endpush

@section('content')
    <div class="w-full max-w-md bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8">
        <h2 class="text-2xl font-bold text-center text-gray-800 dark:text-white mb-6">Confirm Password 🔐</h2>

        <p class="mb-6 text-sm text-gray-600 dark:text-gray-400 text-center">
            This is a secure area of the application. Please confirm your password before continuing.
        </p>

        <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
            @csrf

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                    class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none
                            dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                @error('password')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <!-- Actions -->
            <div class="flex justify-end">
                <button type="submit"
                        class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                    Confirm
                </button>
            </div>
        </form>
    </div>
@endsection
