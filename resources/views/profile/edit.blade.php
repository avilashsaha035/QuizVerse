@extends('layouts.app')

@push('frontend_title')
    Edit Profile
@endpush

@section('content')
<div class="max-w-3xl mx-auto mt-10 bg-white shadow-lg rounded-xl p-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
        <i class="fas fa-user-edit mr-2 text-blue-600"></i> Edit Profile
    </h2>

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PATCH')

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}" class="mt-1 block w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
            <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}" class="mt-1 block w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label for="profile_image" class="block text-sm font-medium text-gray-700">Profile Picture</label>
            <input type="file" name="profile_image" id="profile_image" class="mt-1 block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-600 file:text-white hover:file:bg-blue-700">
            @if(auth()->user()->participant && auth()->user()->participant->profile_image)
                <img src="{{ asset('storage/' . auth()->user()->participant->profile_image) }}" alt="Profile Picture" class="mt-3 w-24 h-24 rounded-full border-2 border-blue-500 shadow">
            @endif
        </div>

        <div>
            <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Date of Birth</label>
            <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth', auth()->user()->participant->date_of_birth ?? '') }}"
                class="mt-1 block w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label for="division" class="block text-sm font-medium text-gray-700">Division</label>
                <input type="text" name="division" id="division"
                       value="{{ old('division', auth()->user()->participant->division ?? '') }}"
                       class="mt-1 block w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="district" class="block text-sm font-medium text-gray-700">District</label>
                <input type="text" name="district" id="district"
                       value="{{ old('district', auth()->user()->participant->district ?? '') }}"
                       class="mt-1 block w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="upazilla" class="block text-sm font-medium text-gray-700">Upazilla</label>
                <input type="text" name="upazilla" id="upazilla"
                       value="{{ old('upazilla', auth()->user()->participant->upazilla ?? '') }}"
                       class="mt-1 block w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500">
            </div>
        </div>

        <div>
            <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
            <textarea name="address" id="address" class="mt-1 block w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500">{{ old('address', auth()->user()->participant->address ?? '') }}</textarea>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-6 py-2 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white rounded-lg font-medium shadow hover:shadow-md transition-all duration-200">
                Update Profile
            </button>
        </div>
    </form>
</div>
@endsection
