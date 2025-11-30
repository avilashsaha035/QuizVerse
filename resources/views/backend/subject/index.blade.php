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

    <!-- Edit Modal -->
    <div class="modal fade" id="subjectEditModal" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title text-white" id="editLabel"><i class="fa-solid fa-pen-to-square"></i> Edit</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" class="row g-3" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="col-12">
                            <label class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="editName" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Slug <span class="text-danger">*</span></label>
                            <input type="text" name="slug" id="editSlug" class="form-control" required>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">
                                <i class="fa-solid fa-pen-to-square"></i> Update
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

    <script>
    $(document).on('click', '.edit-btn', function () {
        let id   = $(this).data('id');
        let name = $(this).data('name');
        let slug = $(this).data('slug');

        // Fill modal inputs
        $('#editName').val(name);
        $('#editSlug').val(slug);

        // Update form action dynamically
        $('#editForm').attr('action', '/admin/subject/' + id);
    });
    </script>

    <!-- Deletion Confirmation -->
    <script>
        $(document).ready(function () {
            $(document).on('click', '.delete-btn', function (e) {
                e.preventDefault();
                let form = $(this).closest('form');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to delete this subject!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush
