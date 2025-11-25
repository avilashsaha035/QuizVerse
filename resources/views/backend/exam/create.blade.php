@extends('backend.layouts.app')

@push('title')
    Exam Create
@endpush

@push('css')
    <style>
        .ck-editor__editable {
            min-height: 250px;
        }
    </style>
@endpush

@section('content')
    <div class="page-content-wrapper border">
        <h5 class="mb-4 text-dark">Create Exam</h5>
        <!-- Card -->
        <div class="card shadow-sm border rounded">
            <div class="card-header bg-success">
                <a href="{{ route('admin.exams.index') }}" class="btn btn-dark btn-sm float-end"> <i class="fa-solid fa-backward"></i> Back</a>
            </div>

            <form action="{{ route('admin.exams.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card-body">
                    <!-- Basic info -->
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Exam Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" required class="form-control">
                            @error('title')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Exam type <span class="text-danger">*</span></label>
                            <select name="exam_type" required class="form-select">
                            {{-- @foreach($examTypes as $type)
                                <option value="{{ $type }}">{{ strtoupper($type) }}</option>
                            @endforeach --}}
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Thumbnail</label>
                            <input type="file" name="thumbnail" id="thumbnail" class="form-control" accept="image/*">

                            <!-- Preview container -->
                            <div id="thumbnailPreview" class="mt-2" style="display:none;">
                                <img src="" alt="Preview" class="img-thumbnail mb-2" style="max-height:150px;">
                                <button type="button" id="removeThumbnail" class="btn btn-sm btn-danger"><i class="fa-regular fa-trash-can"></i></button>
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Description</label>
                            <textarea name="description" id="description" rows="3" class="form-control"></textarea>
                        </div>
                    </div>

                    <!-- Numbers and toggles -->
                    <div class="row g-3 mt-3">
                        <div class="col-md-4">
                            <label class="form-label">Duration (minutes) <span class="text-danger">*</span></label>
                            <input type="number" name="duration_minutes" min="1" required class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Total questions</label>
                            <input type="number" name="no_of_ques" min="1" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Pass marks</label>
                            <input type="number" name="pass_marks" min="0" class="form-control">
                        </div>

                        {{-- <div class="col-md-3">
                            <label class="form-label">Attempts allowed</label>
                            <input type="number" name="attempts_allowed" min="1" class="form-control">
                        </div> --}}
                    </div>

                    <!-- Optional security + active -->
                    <div class="row g-3 mt-3">
                        <div class="col-md-4">
                            <label class="form-label">Access code (optional)</label>
                            <input type="text" name="access_code" placeholder="Leave blank for open access" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Shuffle questions?</label>
                            <div class="form-check form-switch mt-2">
                                <input class="form-check-input" type="checkbox" id="is_shuffling" name="is_shuffling" value="1">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Active</label>
                            <div class="form-check form-switch mt-2">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1">
                            </div>
                        </div>
                    </div>

                    <!-- Schedule -->
                    <div class="row g-3 mt-3">
                        <div class="col-md-3">
                            <label class="form-label">Start date</label>
                            <input type="date" name="start_date" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Start time</label>
                            <input type="time" name="start_time" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">End date</label>
                            <input type="date" name="end_date" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">End time</label>
                            <input type="time" name="end_time" class="form-control">
                        </div>
                    </div>

                    <!-- Subject allocations -->
                    <div class="row g-3 mt-3">
                        <div class="col-12">
                            <label class="form-label">Subjects & Question Counts</label>
                            <div id="subjectContainer">
                                <!-- First subject row -->
                                <div class="row g-2 mb-2 subject-row">
                                    <div class="col-md-6">
                                        <select name="subject_ids[]" class="form-select" required>
                                            <option value="">-- Select Subject --</option>
                                            @foreach($subjects as $sub)
                                                <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="number" name="subject_counts[]" class="form-control" placeholder="No. of questions" min="1" required>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-sm btn-primary addSubject"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-light">
                    <button type="submit" class="btn btn-success"> <i class="fa-solid fa-floppy-disk"></i> Save Exam</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        ClassicEditor
        .create(document.querySelector('#description'))
        .catch(error => {
            console.error('CKEditor init error:', error);
        });
    </script>

    <!-- Image previwe and remove -->
    <script>
        $(document).ready(function () {
            // Handle file input change
            $("#thumbnail").on("change", function (e) {
                const file = e.target.files[0];
                if (file) {
                const reader = new FileReader();
                reader.onload = function (event) {
                    $("#thumbnailPreview img").attr("src", event.target.result);
                    $("#thumbnailPreview").show();
                };
                reader.readAsDataURL(file);
                }
            });

            // Handle remove button
            $("#removeThumbnail").on("click", function () {
                $("#thumbnail").val(""); // clear input
                $("#thumbnailPreview img").attr("src", "");
                $("#thumbnailPreview").hide();
            });
        });
    </script>

    <!-- Subject Allocation -->
    <script>
        $(function() {
            // Add new subject row
            $(document).on('click', '.addSubject', function() {
                let newRow = `
                    <div class="row g-2 mb-2 subject-row">
                        <div class="col-md-6">
                            <select name="subject_ids[]" class="form-select" required>
                                <option value="">-- Select Subject --</option>
                                @foreach($subjects as $sub)
                                    <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <input type="number" name="subject_counts[]" class="form-control" placeholder="No. of questions" min="1" required>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-sm btn-danger removeSubject"><i class="fa fa-trash"></i></button>
                        </div>
                    </div>
                `;
                $('#subjectContainer').append(newRow);
            });

            // Remove subject row
            $(document).on('click', '.removeSubject', function() {
                $(this).closest('.subject-row').remove();
            });
        });
    </script>
@endpush
