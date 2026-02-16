@extends('layouts.app')

@push('frontend_title')
    Edit Profile
@endpush

@section('content')
    <div class="max-w-5xl mx-auto mt-10 bg-white shadow-xl rounded-2xl overflow-hidden">
        <div class="grid grid-cols-1 md:grid-cols-3">

            <!-- Left side -->
            <div class="bg-gradient-to-b from-emerald-500 to-emerald-600 text-white flex flex-col items-center justify-center p-8">
                <div class="relative w-32 h-32 mb-4">
                    @if(auth()->user()->participant && auth()->user()->participant->profile_image)
                        <img id="profilePreview" src="{{ asset('storage/' . auth()->user()->participant->profile_image) }}" alt="Profile Picture"
                            class="w-32 h-32 rounded-full border-4 border-white shadow-lg object-cover">
                    @else
                        <div class="w-32 h-32 rounded-full bg-white/20 flex items-center justify-center text-4xl font-bold border-4 border-white shadow-lg">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                    @endif

                    <!-- Edit Icon -->
                    <button type="button" id="editImageBtn" class="absolute bottom-0 right-0 bg-white text-blue-600 rounded p-1 shadow hover:bg-gray-100"><i class="fas fa-edit"></i></button>
                </div>

                <h3 class="mt-4 text-xl font-semibold">{{ auth()->user()->name }}</h3>
                <p class="text-sm opacity-80">{{ auth()->user()->email }}</p>
            </div>

            <!-- Right Form -->
            <div class="md:col-span-2 p-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center"><i class="fas fa-user-edit mr-2 text-emerald-500"></i> Edit Profile</h2>

                <form id="mainProfileForm" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PATCH')

                    <!-- Hidden file input for cropped image -->
                    <input type="file" name="profile_image" id="croppedFile" hidden>

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}" class="mt-1 block w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                        <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}" class="mt-1 block w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                        <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth', auth()->user()->participant->date_of_birth ?? '') }}"
                            class="mt-1 block w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                        <textarea name="address" id="address"
                            class="mt-1 block w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500">{{ old('address', auth()->user()->participant->address ?? '') }}</textarea>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="px-4 py-2 bg-gradient-to-r bg-emerald-500 hover:bg-emerald-600 text-white rounded-lg font-medium shadow hover:shadow-md transition-all duration-200">
                            <i class="fa-regular fa-floppy-disk"></i> Update
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal -->
        <div id="imageModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-2xl shadow-2xl w-[28rem] max-w-full overflow-hidden">
                <!-- Header -->
                <div class="flex justify-between items-center border-b bg-emerald-500 px-6 py-4">
                    <h2 class="text-xl font-semibold text-gray-800"><i class="fa-solid fa-cloud-arrow-up"></i> Upload Your Image</h2>
                    <button id="closeModal" class="text-gray-500 hover:text-gray-700 transition"><i class="fas fa-times"></i></button>
                </div>

                <!-- Body -->
                <div class="px-6 py-6">
                    <div id="croppie-container" class="w-64 h-64 mx-auto mb-8 border rounded-lg shadow-inner"></div>
                    <input type="file" id="upload" accept="image/*" class="block w-full mt-2 text-sm text-gray-600 rounded-md border-2 file:mr-4 file:py-2 file:px-4 file:rounded-r-sm file:border-0 file:bg-blue-50 file:text-blue-600 hover:file:bg-blue-100 cursor-pointer">
                </div>

                <!-- Footer -->
                <div class="flex justify-end space-x-3 border-t px-6 py-4 bg-gray-50">
                    <button type="button" id="crop-btn" class="px-5 py-2 rounded-lg bg-gradient-to-r bg-blue-600 text-white font-medium hover:bg-blue-700 transition">
                        Save
                    </button>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('frontend_scripts')
    <script>
        $(function() {
            var croppieInstance;
            // Open modal
            $('#editImageBtn').on('click', function() {
                $('#imageModal').removeClass('hidden');
                croppieInstance = new Croppie($('#croppie-container')[0], {
                    viewport: { width: 200, height: 200, type: 'circle' },
                    boundary: { width: 250, height: 250 },
                    enableZoom: true
                });
            });

            // Close modal
            $('#closeModal').on('click', function() {
                $('#imageModal').addClass('hidden');
                if (croppieInstance) {
                    croppieInstance.destroy();
                }
            });

            // Load image into Croppie
            $('#upload').on('change', function(event) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    croppieInstance.bind({ url: e.target.result });
                };
                reader.readAsDataURL(event.target.files[0]);
            });

            // Crop & Save
            $('#crop-btn').on('click', function() {
                croppieInstance.result({
                    type: 'blob',
                    size: 'viewport'
                }).then(function(blob) {
                    var file = new File([blob], "profile.png", { type: "image/png" });

                    // Attach to hidden file input
                    var dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);
                    $('#croppedFile')[0].files = dataTransfer.files;

                    // Update preview
                    var previewUrl = URL.createObjectURL(blob);
                    $('#profilePreview').attr('src', previewUrl);

                    // Close modal
                    $('#imageModal').addClass('hidden');
                    croppieInstance.destroy();

                    // Option A: auto-submit the form immediately
                    $('#mainProfileForm').submit();

                    // Option B: let user click "Update Profile" later
                });
            });
        });
    </script>
@endpush
