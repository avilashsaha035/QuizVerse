@extends('backend.layouts.app')

@push('title')
    Create Permission
@endpush

@push('css')
@endpush

@section('content')
    <div class="page-content-wrapper border">
        <h5 class="mb-4 text-dark">Create Permission</h5>
        <!-- Card -->
        <div class="card shadow-sm border rounded">
            <div class="card-header bg-success">
                <a href="{{ route('admin.permissions.index') }}" class="btn btn-dark btn-sm float-end"> <i class="fa-solid fa-backward"></i> Back</a>
            </div>

            <form action="{{ route('admin.permissions.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-label">Permission Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" required class="form-control">
                            @error('name')
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
    </div>
@endsection

@push('scripts')
@endpush
