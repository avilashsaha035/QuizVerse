@extends('backend.layouts.app')
@push('title')
    Exams
@endpush

@section('content')
    <div class="page-content-wrapper border">
        <h5 class="mb-4 text-dark">Questions List</h5>
        <!-- Card -->
        <div class="card shadow-sm border rounded">
            <div class="card-header bg-success">
                <a href="{{ route('admin.exams.create') }}" class="btn btn-light btn-sm float-end shadow-sm"> <i class="fa-regular fa-square-plus fa-lg"></i>Create</a>
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

