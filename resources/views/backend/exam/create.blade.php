@extends('backend.layouts.app')
@section('content')
    <div class="page-content-wrapper border">
        <h5 class="mb-4 text-dark">Create Exam</h5>
        <!-- Card -->
        <div class="card shadow-sm border rounded">
            <div class="card-header bg-success">
                <a href="{{ route('admin.exams.index') }}" class="btn btn-dark btn-sm float-end"> <i class="fa-solid fa-backward"></i> Back</a>
            </div>

            <form action="{{ route('admin.exams.store') }}" method="POST">
                @csrf

                <div class="card-body">
                    <!-- Basic info -->
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" required class="form-control">
                            @error('title')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Thumbnail (URL)</label>
                            <input type="text" name="thumbnail" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Exam type <span class="text-danger">*</span></label>
                            <select name="exam_type" required class="form-select">
                            {{-- @foreach($examTypes as $type)
                                <option value="{{ $type }}">{{ strtoupper($type) }}</option>
                            @endforeach --}}
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Exam category</label>
                            <input type="text" name="exam_category" placeholder="e.g., preliminary, model_test" class="form-control">
                        </div>

                        <div class="col-12">
                            <label class="form-label">Description</label>
                            <textarea name="description" rows="3" class="form-control"></textarea>
                        </div>
                    </div>

                    <!-- Numbers and toggles -->
                    <div class="row g-3 mt-3">
                        <div class="col-md-4">
                            <label class="form-label">Language <span class="text-danger">*</span></label>
                            <input type="text" name="language" value="en" required class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Duration (minutes) <span class="text-danger">*</span></label>
                            <input type="number" name="duration" min="1" required class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Total questions</label>
                            <input type="number" name="no_of_ques" min="1" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Pass marks</label>
                            <input type="number" name="pass_marks" min="0" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Shuffle questions?</label>
                            <div class="form-check form-switch mt-2">
                            <input class="form-check-input" type="checkbox" id="is_shuffling" name="is_shuffling" value="1">
                            <label class="form-check-label" for="is_shuffling">Enable shuffle</label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Attempts allowed</label>
                            <input type="number" name="attempts_allowed" min="1" class="form-control">
                        </div>
                    </div>

                    <!-- Optional security + active -->
                    <div class="row g-3 mt-3">
                        <div class="col-md-6">
                            <label class="form-label">Access code (optional)</label>
                            <input type="text" name="access_code" placeholder="Leave blank for open access" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Active</label>
                            <div class="form-check form-switch mt-2">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" checked>
                                <label class="form-check-label" for="is_active">Visible and usable</label>
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

                    <hr class="my-4">

                    <!-- Primary subject -->
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Primary subject (optional)</label>
                            <select name="subject_id" class="form-select">
                            <option value="">-- None --</option>
                            {{-- @foreach($subjects as $sub)
                                <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                            @endforeach --}}
                            </select>
                        </div>
                    </div>

                    <!-- Subject-wise allocations -->
                    <div class="mt-3">
                    <label class="form-label">Subject-wise question allocation</label>
                    <div class="row g-3 mt-2">
                        @for($i=0; $i<5; $i++)
                        <div class="col-md-6 d-flex gap-2">
                            <select name="subject_ids[]" class="form-select">
                            <option value="">-- Subject --</option>
                            {{-- @foreach($subjects as $sub)
                                <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                            @endforeach --}}
                            </select>
                            <input type="number" name="subject_counts[]" placeholder="Question count" min="0" class="form-control">
                        </div>
                        @endfor
                    </div>
                    <small class="text-muted">Leave unused rows blank. Total questions will be auto-derived if not set.</small>
                </div>
            </form>
        </div>

        <!-- Actions -->
        <div class="card-footer bg-light">
            <button type="submit" class="btn btn-success">
            <i class="fa-solid fa-floppy-disk"></i> Save Exam
            </button>
        </div>
    </div>
@endsection
