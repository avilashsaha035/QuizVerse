@extends('backend.layouts.app')
@section('content')
    <div class="container max-w-full mt-5 mb-5">
        <!-- Card -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
            <!-- Card header -->
            <div class="flex items-center justify-between px-6 py-4 bg-emerald-600">
                <h5 class="text-lg font-semibold text-white">Questions List</h5>
                <a href="#" class="inline-flex items-center px-4 py-2 text-sm font-medium text-black-900 bg-white rounded-lg shadow hover:bg-gray-100 transition"
                    data-bs-toggle="modal" data-bs-target="#import">
                    <i class="bi bi-upload mr-2"></i>Import
                </a>
            </div>

            <!-- Card body -->
            <div class="p-6">
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

@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
