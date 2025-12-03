@extends('layouts.app')

@push('frontend_title')
    Verify Email
@endpush

@section('content')
    <div class="w-full max-w-md bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8 text-center">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Verify Your Email 📧</h2>

        <p class="mb-6 text-sm text-gray-600 dark:text-gray-400">
            Thanks for signing up! Before getting started, please verify your email address by clicking the link we just emailed to you.
            If you didn’t receive the email, we’ll gladly send you another.
        </p>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                A new verification link has been sent to the email address you provided during registration.
            </div>
        @endif

        <div class="mt-6 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit"
                        class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                    Resend Verification Email
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="text-sm text-indigo-600 hover:underline dark:text-indigo-400">
                    Log Out
                </button>
            </form>
        </div>
    </div>
@endsection
