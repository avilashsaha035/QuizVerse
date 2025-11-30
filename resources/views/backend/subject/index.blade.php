@extends('backend.layouts.app')

@push('title')
    Subject
@endpush

@push('css')
@endpush

@section('content')
    <div class="page-content-wrapper border">
        <h5 class="mb-4 text-dark">Subject</h5>
        <!-- Card -->
        <div class="card shadow-sm border rounded">
            <div class="card-header bg-success">
                <h5 class="text-white"><i class="fa-solid fa-square-plus"></i> Create Subject</h5>
            </div>

            <form action="{{ route('admin.subject.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Name <span class="fw-bold text-danger">*</span></label>
                            <input type="text" name="name" required class="form-control">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Slug <span class="fw-bold text-danger">*</span></label>
                            <input type="text" name="slug" required class="form-control">
                            @error('slug')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-light">
                    <button type="submit" class="btn btn-success"> <i class="fa-solid fa-floppy-disk"></i> Save</button>
                </div>
            </form>
        </div>


        <div class="mt-5 card shadow-sm border rounded">
            <div class="card-header bg-success">
                <h5 class="text-white"><i class="fa-solid fa-gears"></i> Manage Subjects</h5>
            </div>

            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
  {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
