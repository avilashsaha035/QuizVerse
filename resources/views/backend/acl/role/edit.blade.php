@extends('backend.layouts.app')

@push('title')
    Edit Role
@endpush

@push('css')
@endpush

@section('content')
    <div class="page-content-wrapper border">
        <h5 class="mb-4 text-dark">Edit Role</h5>
        <!-- Card -->
        <div class="card shadow-sm border rounded">
            <div class="card-header bg-success">
                <a href="{{ route('admin.roles.index') }}" class="btn btn-dark btn-sm float-end"> <i class="fa-solid fa-backward"></i> Back</a>
            </div>

            <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-label">Role Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" value="{{ old('name', $role->name) }}" required class="form-control">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                     <!-- Permissions -->
                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-label">Assign Permissions</label>
                            <div class="border rounded p-3" style="max-height:300px; overflow-y:auto;">
                                @foreach($permissions as $permission)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                            name="permissions[]" value="{{ $permission->name }}"
                                            id="perm_{{ $permission->id }}"
                                            {{ in_array($permission->name, $rolePermissions) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="perm_{{ $permission->id }}">
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            @error('permissions')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-light">
                    <button type="submit" class="btn btn-success"> <i class="fa-solid fa-pen-to-square"></i> update</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
