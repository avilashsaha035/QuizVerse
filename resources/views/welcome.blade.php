@extends('layouts.app')

@push('frontend_title')
    Home
@endpush

@section('content')
    <!-- Main content -->
    <main class="flex-grow flex items-center justify-center bg-gray-50 dark:bg-gray-900">
        <div class="max-w-4xl mx-auto px-6 py-20 text-center">
            <h1 class="text-5xl font-extrabold text-gray-800 dark:text-white leading-tight mb-6">
                Welcome to <span class="text-indigo-600">QuizVerse</span>
            </h1>
            <p class="text-lg text-gray-600 dark:text-gray-300 mb-10 max-w-2xl mx-auto">
                Your trusted platform for practice exams and learning. Prepare smarter, faster, and better.
            </p>

            @auth
                <a href="{{ url('/dashboard') }}"
                   class="inline-block px-8 py-3 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 transition">
                    Go to Dashboard
                </a>
            @else
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('login') }}"
                       class="px-8 py-3 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 transition">
                        Login
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                           class="px-8 py-3 border border-indigo-600 text-indigo-600 rounded-lg hover:bg-indigo-50 transition">
                            Register
                        </a>
                    @endif
                </div>
            @endauth
        </div>
    </main>
@endsection
