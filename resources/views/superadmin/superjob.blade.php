@extends('layouts.superadmin')

@section('content')
<div class="container" style="margin-top:6%">
    <div class="table-responsive">
        <table class="table table-hover table-striped align-middle">
            <thead class="table-success">
                <tr>
                    <th class="text-center">No</th>
                    <th>Company Name</th>
                    <th>ID Company</th>
                    <th>Description</th>
                    <th>Address</th>
                    <th>Category</th>
                    <th>Picture</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jobs as $job)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $job->company_name }}</td>
                        <td>{{ $job->user_id }}</td>
                        <td>{{ Str::limit($job->description, 50, '...') }}</td>
                        <td>{{ Str::limit($job->address, 30, '...') }}</td>
                        <td>{{ $job->category }}</td>
                        <td>
                            @if($job->picture)
                                <img src="{{ asset('storage/' . $job->picture) }}" alt="Job Picture" class="img-thumbnail" style="width: 80px; height: auto;">
                            @else
                                <span class="text-muted">No Image</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <button class="btn btn-info btn-sm view-btn" data-id="{{ $job->id }}" data-company-name="{{ $job->company_name }}" data-description="{{ $job->description }}" data-address="{{ $job->address }}" data-category="{{ $job->category }}" data-picture="{{ $job->picture }}">
                                <i class="bi bi-eye"></i> View
                            </button>

                            <button class="btn btn-warning btn-sm edit-btn" data-id="{{ $job->id }}" data-company-name="{{ $job->company_name }}" data-description="{{ $job->description }}" data-address="{{ $job->address }}" data-category="{{ $job->category }}" data-picture="{{ $job->picture }}">
                                <i class="bi bi-pencil-square"></i> Edit
                            </button>

                            <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $job->id }}">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                            <form id="delete-form-{{ $job->id }}" action="{{ route('superjobs.destroy', $job->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- View Job Modal -->
<div class="modal fade" id="viewJobModal" tabindex="-1" aria-labelledby="viewJobModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewJobModalLabel">Job Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Company Name:</strong> <span id="view-company-name"></span></p>
                <p><strong>Description:</strong> <span id="view-description"></span></p>
                <p><strong>Address:</strong> <span id="view-address"></span></p>
                <p><strong>Category:</strong> <span id="view-category"></span></p>
                <p><strong>Picture:</strong> <img id="view-picture" src="" alt="Job Picture" class="img-thumbnail" style="max-width: 100px; max-height: 100px;"></p>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Edit -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Job</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_company_name" class="form-label">Company Name</label>
                        <input type="text" class="form-control" id="edit_company_name" name="company_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_description" class="form-label">Description</label>
                        <textarea class="form-control" id="edit_description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit_address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="edit_address" name="address" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_category" class="form-label">Category</label>
                        <input type="text" class="form-control" id="edit_category" name="category" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_picture_preview" class="form-label">Current Picture</label><br>
                        <img id="edit_picture_preview" src="" alt="Job Picture" class="img-thumbnail" style="max-width: 100px; max-height: 100px;">
                    </div>
                    <div class="mb-3">
                        <label for="edit_picture_input" class="form-label">Upload New Picture</label>
                        <input type="file" class="form-control" id="edit_picture_input" name="picture">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Handle View Button
        document.querySelectorAll('.view-btn').forEach(button => {
            button.addEventListener('click', function () {
                const companyName = this.dataset.companyName;
                const description = this.dataset.description;
                const address = this.dataset.address;
                const category = this.dataset.category;
                const picture = this.dataset.picture;

                document.getElementById('view-company-name').textContent = companyName;
                document.getElementById('view-description').textContent = description;
                document.getElementById('view-address').textContent = address;
                document.getElementById('view-category').textContent = category;
                document.getElementById('view-picture').src = picture ? '/storage/' + picture : '';

                new bootstrap.Modal(document.getElementById('viewJobModal')).show();
            });
        });

        // Handle Delete Button
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.dataset.id;
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById(`delete-form-${id}`).submit();
                    }
                });
            });
        });

        // Handle Edit Button
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function () {
                const jobId = this.dataset.id;
                const companyName = this.dataset.companyName;
                const description = this.dataset.description;
                const address = this.dataset.address;
                const category = this.dataset.category;
                const picture = this.dataset.picture;

                // Populate modal form
                document.getElementById('edit_company_name').value = companyName;
                document.getElementById('edit_description').value = description;
                document.getElementById('edit_address').value = address;
                document.getElementById('edit_category').value = category;
                if (picture) {
                    document.getElementById('edit_picture_preview').src = `/storage/${picture}`;
                }

                // Set the form action URL for the editing job
                document.getElementById('editForm').action = `/superjobs/${jobId}`;

                // Show the modal
                const modal = new bootstrap.Modal(document.getElementById('editModal'));
                modal.show();
            });
        });
    });
</script>
@endsection
