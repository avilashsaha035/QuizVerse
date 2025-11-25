@extends('backend.layouts.app')
@push('title')
    Questions
@endpush
@section('content')

    <div class="page-content-wrapper border">
        <h5 class="mb-4 text-dark">Questions List</h5>
        <!-- Card -->
        <div class="card shadow-sm border rounded">
            <div class="card-header bg-success">
                <a href="#" class="btn btn-light btn-sm float-end shadow-sm" data-bs-toggle="modal" data-bs-target="#import"> <i class="bi bi-upload"></i> Import</a>
            </div>

            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>

    <!-- Import Modal -->
    <div class="modal fade" id="import" tabindex="-1" aria-labelledby="importLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title text-white" id="importLabel">Import Question</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form wired to controller -->
                    <form class="row g-3" action="{{ route('admin.question.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-12">
                            <label class="form-label">
                                You may upload .csv or .xlsx format only <span class="text-danger">*</span>
                            </label>
                            <input type="file" name="file" class="form-control" required>
                            @error('file')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-upload me-1"></i> Import
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
  {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
