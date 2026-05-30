@extends('backend.layouts.app')

@push('title')
    General Settings
@endpush

@push('css')
    <style>
        .banner-card-item {
            position: relative;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .banner-card-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.1) !important;
        }
        .delete-overlay-btn {
            position: absolute;
            top: 8px;
            right: 8px;
            z-index: 10;
            background-color: rgba(220, 53, 69, 0.9);
            color: #fff;
            border: none;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }
        .delete-overlay-btn:hover {
            background-color: rgba(220, 53, 69, 1);
        }
    </style>
@endpush

@section('content')
    <div class="page-content-wrapper border">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <h5 class="mb-1 text-dark"><i class="fa-solid fa-sliders me-2"></i>General Settings</h5>
                <p class="mb-0 text-muted small">Manage the main parameters of the application, upload logos, configure contact parameters and manage home slide banners.</p>
            </div>
        </div>

        <!-- Main Card -->
        <div class="card shadow-sm border rounded">
            <div class="card-header bg-success py-3 d-flex align-items-center">
                <h5 class="text-white mb-0"><i class="fa-solid fa-gears me-2"></i> Configure Site Properties</h5>
            </div>

            <form id="settingsForm" action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card-body">
                    <div class="row g-4">

                        <!-- Left Column: Site Logo & Text Fields -->
                        <div class="col-lg-6">
                            <div class="card border">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0 text-dark"><i class="bi bi-info-circle-fill me-2 text-success"></i>Core Properties</h6>
                                </div>
                                <div class="card-body">
                                    <!-- Logo File Input -->
                                    <div class="mb-4">
                                        <label class="form-label fw-bold">Site Logo</label>
                                        <input type="file" id="logoInput" name="logo" class="form-control @error('logo') is-invalid @enderror" accept="image/*">
                                        <small class="text-muted d-block mt-1">Recommended size: 250x60px. Supports PNG, JPG, JPEG, SVG, WebP.</small>
                                        @error('logo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror

                                        <!-- Logo Preview -->
                                        <div class="mt-3">
                                            <p class="small text-muted mb-2">Current / Live Logo Preview:</p>
                                            <div class="p-3 border rounded text-center bg-light" style="min-height: 100px; display: flex; align-items: center; justify-content: center;">
                                                @if($settings->logo)
                                                    <img id="logoPreview" src="{{ asset('storage/' . $settings->logo) }}" alt="Logo" class="img-fluid" style="max-height: 60px;">
                                                @else
                                                    <img id="logoPreview" src="" alt="New Logo Preview" class="img-fluid d-none" style="max-height: 60px;">
                                                    <span id="logoPlaceholderText" class="text-muted small"><i class="fa-regular fa-image me-1"></i> No Logo Uploaded</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Contact Email -->
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Contact Email Address</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-envelope-at-fill"></i></span>
                                            <input type="email" name="email" value="{{ old('email', $settings->email) }}" class="form-control @error('email') is-invalid @enderror" placeholder="info@quizverse.com">
                                        </div>
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <!-- Contact Number -->
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Contact Number</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                                            <input type="text" name="contact_number" value="{{ old('contact_number', $settings->contact_number) }}" class="form-control @error('contact_number') is-invalid @enderror" placeholder="+123 456 7890">
                                        </div>
                                        @error('contact_number')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <!-- Site Address -->
                                    <div class="mb-0">
                                        <label class="form-label fw-bold">Physical Address</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-geo-alt-fill"></i></span>
                                            <textarea name="address" rows="3" class="form-control @error('address') is-invalid @enderror" placeholder="123 Quiz Street, Tech City, Country">{{ old('address', $settings->address) }}</textarea>
                                        </div>
                                        @error('address')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        <!-- Social Media Links -->
                        <div class="card border mt-4">
                            <div class="card-header bg-light">
                                <h6 class="mb-0 text-dark"><i class="bi bi-share-fill me-2 text-success"></i>Social Media Links</h6>
                            </div>
                            <div class="card-body">
                                <!-- Facebook Link -->
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Facebook Profile/Page URL</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-primary text-white"><i class="fab fa-facebook-f"></i></span>
                                        <input type="url" name="facebook_link" value="{{ old('facebook_link', $settings->facebook_link) }}" class="form-control @error('facebook_link') is-invalid @enderror" placeholder="https://facebook.com/yourpage">
                                    </div>
                                    @error('facebook_link')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- LinkedIn Link -->
                                <div class="mb-3">
                                    <label class="form-label fw-bold">LinkedIn Company/Profile URL</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-info text-white"><i class="fab fa-linkedin-in"></i></span>
                                        <input type="url" name="linkedin_link" value="{{ old('linkedin_link', $settings->linkedin_link) }}" class="form-control @error('linkedin_link') is-invalid @enderror" placeholder="https://linkedin.com/company/yourpage">
                                    </div>
                                    @error('linkedin_link')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Instagram Link -->
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Instagram Profile URL</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-danger text-white"><i class="fab fa-instagram"></i></span>
                                        <input type="url" name="instagram_link" value="{{ old('instagram_link', $settings->instagram_link) }}" class="form-control @error('instagram_link') is-invalid @enderror" placeholder="https://instagram.com/yourprofile">
                                    </div>
                                    @error('instagram_link')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- WhatsApp Number / Chat Link -->
                                <div class="mb-0">
                                    <label class="form-label fw-bold">WhatsApp Number or Chat Link</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-success text-white"><i class="fab fa-whatsapp"></i></span>
                                        <input type="text" name="whatsapp_link" value="{{ old('whatsapp_link', $settings->whatsapp_link) }}" class="form-control @error('whatsapp_link') is-invalid @enderror" placeholder="+1234567890 or https://wa.me/...">
                                    </div>
                                    @error('whatsapp_link')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                        <!-- Right Column: Home Slide Banners Manager -->
                        <div class="col-lg-6">
                            <div class="card border h-100">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0 text-dark"><i class="bi bi-images me-2 text-success"></i>Home Slide Banners</h6>
                                </div>
                                <div class="card-body d-flex flex-column h-100">
                                    <div class="mb-4">
                                        <label class="form-label fw-bold">Upload Slide Banners (Multiple)</label>
                                        <input type="file" id="bannersInput" name="banners[]" class="form-control @error('banners.*') is-invalid @enderror" accept="image/*" multiple>
                                        <small class="text-muted d-block mt-1">Select multiple images to append to the home banner carousel.</small>
                                        @error('banners.*')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- New Banner Selection Previews -->
                                    <div class="mb-4 d-none" id="newBannersWrapper">
                                        <p class="small text-muted fw-bold mb-2">Selected Banners to Upload:</p>
                                        <div class="row g-2" id="newBannersPreviewContainer"></div>
                                    </div>

                                    <!-- Existing Banner Management Grid -->
                                    <div class="flex-grow-1">
                                        <p class="small text-muted fw-bold mb-2">Current Active Slide Banners:</p>
                                        @if($settings->banners && count($settings->banners) > 0)
                                            <div class="row g-2" id="existingBannersGrid">
                                                @foreach($settings->banners as $path)
                                                    <div class="col-6 col-sm-4 banner-card-item mb-2">
                                                        <div class="card border p-1 shadow-sm h-100">
                                                            <img src="{{ asset('storage/' . $path) }}" class="card-img-top rounded img-fluid" style="height: 100px; object-fit: cover;" alt="Banner Slide">
                                                            <!-- Queue Deletion Overlay Trigger -->
                                                            <button type="button" class="delete-overlay-btn" onclick="queueBannerDeletion(this, '{{ $path }}')" title="Remove Slide">
                                                                <i class="fa-solid fa-trash-can fa-xs"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="p-4 border rounded text-center bg-light" id="noBannersAlert">
                                                <span class="text-muted small"><i class="bi bi-images me-1"></i> No active slide banners. Upload new banners above.</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Footer Operations -->
                <div class="card-footer bg-light py-3 d-flex justify-content-between">
                    <span class="small text-muted align-self-center"><i class="bi bi-info-circle me-1"></i> Single-page unified setup for simple administration.</span>
                    <button type="submit" class="btn btn-success px-4">
                        <i class="fa-solid fa-floppy-disk me-1"></i> Save Configurations
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            // Live logo preview listener
            $('#logoInput').on('change', function (event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        $('#logoPreview').attr('src', e.target.result).removeClass('d-none');
                        $('#logoPlaceholderText').addClass('d-none');
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Live multiple banner preview listener
            $('#bannersInput').on('change', function (event) {
                const $container = $('#newBannersPreviewContainer').empty();
                const $wrapper = $('#newBannersWrapper');
                const files = event.target.files;

                if (files.length > 0) {
                    $wrapper.removeClass('d-none');
                    $.each(files, function (index, file) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            const col = `
                                <div class="col-6 col-sm-4 banner-card-item mb-2">
                                    <div class="card border p-1 shadow-sm h-100">
                                        <img src="${e.target.result}" class="card-img-top rounded img-fluid" style="height: 100px; object-fit: cover;" alt="Preview Banner">
                                        <span class="badge bg-primary position-absolute top-0 start-0 m-2">New</span>
                                    </div>
                                </div>
                            `;
                            $container.append(col);
                        };
                        reader.readAsDataURL(file);
                    });
                } else {
                    $wrapper.addClass('d-none');
                }
            });
        });

        /**
        * Queues an existing banner for deletion.
        * Inserts a hidden field into the form and hides the image visual card on-page.
        */
        function queueBannerDeletion(button, path) {
            // Create hidden input element using jQuery
            $('<input>').attr({
                type: 'hidden',
                name: 'deleted_banners[]',
                value: path
            }).appendTo('#settingsForm');

            // Hide visual element
            $(button).closest('.banner-card-item').remove();

            // If all existing banner items are gone, display placeholder notice
            const $grid = $('#existingBannersGrid');
            if ($grid.length && $grid.find('.banner-card-item').length === 0) {
                $grid.remove();

                if ($('#noBannersAlert').length === 0) {
                    const placeholder = `
                        <div class="p-4 border rounded text-center bg-light" id="noBannersAlert">
                            <span class="text-muted small"><i class="bi bi-images me-1"></i> No active slide banners. Upload new banners above.</span>
                        </div>
                    `;
                    $('#bannersInput').closest('.card-body').append(placeholder);
                }
            }

            // Trigger notification
            toastr.warning('Banner queued for deletion. Save changes to commit.');
        }
    </script>
@endpush
