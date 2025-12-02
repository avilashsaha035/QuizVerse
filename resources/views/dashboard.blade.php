@extends('layouts.app')

@section('content')
    <div class="py-12 w-full">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Dashboard</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Card 1 -->
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Welcome</h3>
                    <p class="mt-2 text-gray-600 dark:text-gray-400">
                        You're logged in! 🎉
                    </p>
                </div>

                <!-- Card 2 -->
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Upcoming Exams</h3>
                    <p class="mt-2 text-gray-600 dark:text-gray-400">
                        No exams scheduled yet.
                    </p>
                </div>

                <!-- Card 3 -->
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Profile</h3>
                    <p class="mt-2 text-gray-600 dark:text-gray-400">
                        Manage your account settings and preferences.
                    </p>
                    <a href="{{ route('profile.edit') }}"
                    class="mt-4 inline-block px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                        Edit Profile
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
