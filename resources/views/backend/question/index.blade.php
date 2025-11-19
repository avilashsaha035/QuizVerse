@extends('backend.layouts.app')
@section('content')
    <div class="page-content-wrapper border">
        <div class="row">
            <div class="d-sm-flex justify-content-sm-end align-items-center mb-3">
                <a href="#" class="btn btn-sm btn-primary-soft mb-0" data-bs-toggle="modal" data-bs-target="#import"><i class="bi bi-upload me-2"></i>Import</a>
            </div>

            <div class="card">
                <div class="card-header">Questions List</div>
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
                        <button type="button" class="btn btn-sm btn-light mb-0 ms-auto" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form wired to controller -->
                        <form class="row text-start g-3" action="{{ route('admin.question.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="col-12">
                                <label class="form-label"> You may upload .csv or .xlsx format only <span class="text-danger">*</span></label>
                                <input type="file" name="file" class="form-control" required>
                                @error('file')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success my-0"> <i class="bi bi-upload me-1"></i>Import </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
