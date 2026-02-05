@extends('backend.layouts.app')

@push('title')
    Edit
@endpush

@push('css')
<style>
    .ck-editor__editable { min-height: 250px; }
    .img-thumb { max-height: 150px; }
</style>
@endpush

@section('content')
<div class="page-content-wrapper border">
    <h5 class="mb-4 text-dark">Edit Exam</h5>

    <div class="card shadow-sm border rounded">
        <div class="card-header bg-success">
            <a href="{{ route('admin.exams.index') }}" class="btn btn-dark btn-sm float-end">
                <i class="fa-solid fa-backward"></i> Back
            </a>
        </div>

        <form action="{{ route('admin.exams.update', $exam->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card-body">
                <!-- Basic info -->
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Exam Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" value="{{ old('title', $exam->title) }}" required class="form-control">
                        @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Exam type <span class="text-danger">*</span></label>
                        <select name="exam_type" required class="form-select">
                            @php $type = old('exam_type', $exam->exam_type); @endphp
                            <option value="" {{ $type=='' ? 'selected' : '' }}>Select Type</option>
                            <option value="bcs" {{ $type=='bcs' ? 'selected' : '' }}>BCS</option>
                            <option value="bank" {{ $type=='bank' ? 'selected' : '' }}>Bank</option>
                            <option value="varsity" {{ $type=='varsity' ? 'selected' : '' }}>Varsity</option>
                            <option value="ielts" {{ $type=='ielts' ? 'selected' : '' }}>IELTS</option>
                        </select>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Thumbnail</label>
                        <input type="file" name="thumbnail" id="thumbnail" class="form-control" accept="image/*">
                        @error('thumbnail')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <!-- Current thumbnail -->
                        @if($exam->thumbnail)
                            <div id="existingThumbnail" class="mt-2">
                                <img id="existingThumbnailImg" src="{{ asset('storage/exam_thumbnails/'.$exam->thumbnail) }}" alt="Current thumbnail" class="img-thumbnail img-thumb" style="max-height:150px;">
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" id="remove_existing_thumbnail" name="remove_existing_thumbnail" value="1">
                                    <label class="form-check-label" for="remove_existing_thumbnail">Remove existing thumbnail</label>
                                </div>
                            </div>
                        @endif

                        <!-- New preview -->
                        <div id="thumbnailPreview" class="mt-2" style="{{ $exam->thumbnail ? 'display:none;' : 'display:none;' }}">
                            <img id="thumbnailPreviewImg" src="" alt="Preview" class="img-thumbnail img-thumb mb-2" style="max-height:150px;">
                            <button type="button" id="removeThumbnail" class="btn btn-sm btn-danger">
                                <i class="fa-regular fa-trash-can"></i>
                            </button>
                        </div>
                    </div>


                    <div class="col-12">
                        <label class="form-label">Description</label>
                        <textarea name="description" id="description" rows="3" class="form-control">{{ old('description', $exam->description) }}</textarea>
                    </div>
                </div>

                <!-- Numbers and toggles -->
                <div class="row g-3 mt-3">
                    <div class="col-md-4">
                        <label class="form-label">Duration (minutes) <span class="text-danger">*</span></label>
                        <input type="number" name="duration_minutes" min="1" required class="form-control"
                               value="{{ old('duration_minutes', $exam->duration_minutes) }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Total questions</label>
                        <input type="number" name="no_of_ques" min="1" class="form-control"
                               value="{{ old('no_of_ques', $exam->no_of_ques) }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Pass marks</label>
                        <input type="number" name="pass_marks" min="0" class="form-control"
                               value="{{ old('pass_marks', $exam->pass_marks) }}">
                    </div>
                </div>

                <!-- Optional security + active -->
                <div class="row g-3 mt-3">
                    <div class="col-md-3">
                        <label class="form-label">Access code (optional)</label>
                        <input type="text" name="access_code" class="form-control" value="{{ old('access_code', $exam->access_code) }}" placeholder="Leave blank for open access">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Shuffle questions?</label>
                        <div class="form-check form-switch mt-2">
                            <input class="form-check-input" type="checkbox" id="is_shuffling" name="is_shuffling" value="1" {{ old('is_shuffling', $exam->is_shuffling) ? 'checked' : '' }}>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Active</label>
                        <div class="form-check form-switch mt-2">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $exam->is_active) ? 'checked' : '' }}>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Attempts Allowed</label>
                        <input type="number" name="attempts_allowed" class="form-control" value="{{ old('attempts_allowed', $exam->attempts_allowed) }}">
                    </div>
                </div>

                <!-- Schedule -->
                <div class="row g-3 mt-3">
                    <div class="col-md-3">
                        <label class="form-label">Start date</label>
                        <input type="date" name="start_date" class="form-control"
                               value="{{ old('start_date', $exam->start_date) }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Start time</label>
                        <input type="time" name="start_time" class="form-control"
                               value="{{ old('start_time', $exam->start_time) }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">End date</label>
                        <input type="date" name="end_date" class="form-control"
                               value="{{ old('end_date', $exam->end_date) }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">End time</label>
                        <input type="time" name="end_time" class="form-control"
                               value="{{ old('end_time', $exam->end_time) }}">
                    </div>
                </div>

                <!-- Subject allocations -->
                <div class="row g-3 mt-3">
                    <div class="col-12">
                        <label class="form-label">Subjects & Question Counts</label>
                        <div id="subjectContainer">
                            @php
                                // Build existing allocations from pivot
                                $existingSubjects = $exam->subjects->map(function($s){
                                    return ['id' => $s->id, 'count' => (int)$s->pivot->question_count];
                                })->toArray();
                            @endphp

                            @if(count(old('subject_ids', array_column($existingSubjects, 'id'))) > 0)
                                @foreach(old('subject_ids', array_column($existingSubjects, 'id')) as $i => $sid)
                                    <div class="row g-2 mb-2 subject-row">
                                        <div class="col-md-6">
                                            <select name="subject_ids[]" class="form-select" required>
                                                <option value="">-- Select Subject --</option>
                                                @foreach($subjects as $sub)
                                                    <option value="{{ $sub->id }}" {{ $sid == $sub->id ? 'selected' : '' }}>
                                                        {{ $sub->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            @php
                                                $countsOld = old('subject_counts', array_column($existingSubjects, 'count'));
                                                $countVal = $countsOld[$i] ?? '';
                                            @endphp
                                            <input type="number" name="subject_counts[]" class="form-control" placeholder="No. of questions" min="1" required value="{{ $countVal }}">
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-sm btn-danger removeSubject">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <!-- Fallback empty row -->
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
                            @endif
                        </div>

                        <button type="button" class="btn btn-sm btn-primary addSubject mt-2">
                            <i class="fa fa-plus"></i> Add Subject
                        </button>
                    </div>
                </div>
            </div>

            <div class="card-footer bg-light">
                <button type="submit" class="btn btn-success">
                    <i class="fa-solid fa-floppy-disk"></i> Update Exam
                </button>
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

    <script>
        $(document).ready(function () {
            const $fileInput = $("#thumbnail");
            const $existingWrap = $("#existingThumbnail");
            const $existingImg = $("#existingThumbnailImg");
            const $previewWrap = $("#thumbnailPreview");
            const $previewImg = $("#thumbnailPreviewImg");
            const $removeBtn = $("#removeThumbnail");
            const $removeExistingCheckbox = $("#remove_existing_thumbnail");

            // If there is an existing image, show its container (already rendered by Blade)
            if ($existingImg.length && $existingImg.attr('src')) {
                $existingWrap.show();
                $previewWrap.hide();
            } else {
                $existingWrap.hide();
                $previewWrap.hide();
            }

            // When user selects a new file, show preview and hide existing image container
            $fileInput.on("change", function (e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (event) {
                        $previewImg.attr("src", event.target.result);
                        $previewWrap.show();
                        $existingWrap.hide();
                        if ($removeExistingCheckbox.length) {
                            $removeExistingCheckbox.prop('checked', false).prop('disabled', true);
                        }
                    };
                    reader.readAsDataURL(file);
                } else {
                    $previewImg.attr("src", "");
                    $previewWrap.hide();
                    if ($existingImg.length && $existingImg.attr('src')) {
                        $existingWrap.show();
                    }
                    $removeExistingCheckbox.prop('disabled', false); //re-enable
                }
            });


            // Remove new preview (clear file input)
            $removeBtn.on("click", function () {
                $fileInput.val("");
                $previewImg.attr("src", "");
                $previewWrap.hide();
                if ($existingImg.length && $existingImg.attr('src')) {
                    $existingWrap.show();
                }
            });

            // If user checks "remove existing", hide existing preview and ensure file input cleared
            $removeExistingCheckbox.on("change", function () {
                if ($(this).is(":checked")) {
                    // mark for removal; hide existing preview
                    $existingWrap.hide();
                    // clear any newly selected file as well
                    $fileInput.val("");
                    $previewImg.attr("src", "");
                    $previewWrap.hide();
                } else {
                    // if unchecked, show existing image again (unless a new file is selected)
                    if ($fileInput.val() === "" && $existingImg.length && $existingImg.attr('src')) {
                        $existingWrap.show();
                    }
                }
            });
        });
    </script>
@endpush
