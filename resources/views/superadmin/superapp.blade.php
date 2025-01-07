@extends('layouts.superadmin')
<style>
.table-responsive {
    scrollbar-width: thin; 
}

.table-responsive::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

.table-responsive::-webkit-scrollbar-thumb {
    background-color: #4caf50; 
    border-radius: 4px; 
    border: 2px solid #e8f5e9;
}

.table-responsive::-webkit-scrollbar-track {
    background: #e8f5e9;
    border-radius: 4px;
}

</style>
@section('content')
<!-- Content -->
<div class="container" style="margin-top:6%">

    <div class="table-responsive">
        <table class="table table-hover table-striped align-middle">
        <thead class="table-success" style="position: sticky; top: 0; z-index: 1020;">
            <tr>
                <th style="text-align:center">No</th>
                <th style="text-align:center">Name</th>
                <th style="text-align:center">Email</th>
                <th style="text-align:center">Company</th>
                <th style="text-align:center">CV</th>
                <th style="text-align:center">Status</th>
                <th style="text-align:center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($applicants as $index => $applicant)
                <tr style="text-align:center">
                    <td style="text-align:center">{{ $index + 1 }}</td>
                    <td style="text-align:center">{{ $applicant->name }}</td>
                    <td style="text-align:center">{{ $applicant->email }}</td>
                    <td style="text-align:center">{{ $applicant->company }}</td>
                    <td>
                        <a href="{{ asset('storage/' . $applicant->cv) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-download"></i> Download CV
                        </a>
                    </td>
                    <td>
                        <span class="badge 
                            @if($applicant->status == 'pending') bg-warning 
                            @elseif($applicant->status == 'accepted') bg-success 
                            @else bg-danger 
                            @endif">
                            {{ ucfirst($applicant->status) }}
                        </span>
                    </td>
                    <td>
                        <button class="btn btn-info btn-sm view-btn" 
                            data-id="{{ $applicant->id }}" 
                            data-name="{{ $applicant->name }}" 
                            data-email="{{ $applicant->email }}" 
                            data-company="{{ $applicant->company }}" 
                            data-cv="{{ $applicant->cv }}" 
                            data-status="{{ $applicant->status }}">
                            <i class="bi bi-eye"></i> View
                        </button>

                        <button class="btn btn-warning btn-sm edit-btn" 
                            data-id="{{ $applicant->id }}" 
                            data-name="{{ $applicant->name }}" 
                            data-email="{{ $applicant->email }}" 
                            data-company="{{ $applicant->company }}" 
                            data-cv="{{ $applicant->cv }}" 
                            data-status="{{ $applicant->status }}">
                            <i class="bi bi-pencil"></i> Edit
                        </button>

                        <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $applicant->id }}">
                            <i class="bi bi-trash"></i> Delete
                        </button>
                        <form id="delete-form-{{ $applicant->id }}" action="{{ route('superapps.destroy', $applicant->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No applicants found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    </div>
</div>

<!-- View Applicant Modal -->
<div class="modal fade" id="viewApplicantModal" tabindex="-1" aria-labelledby="viewApplicantModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewApplicantModalLabel">Applicant Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Name:</strong> <span id="view-name"></span></p>
                <p><strong>Email:</strong> <span id="view-email"></span></p>
                <p><strong>Company:</strong> <span id="view-company"></span></p>
                <p><strong>Status:</strong> <span id="view-status"></span></p>
                <p><strong>CV:</strong> <a href="#" id="view-cv" target="_blank" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-download"></i> Download CV</a></p>
            </div>
        </div>
    </div>
</div>

<!-- Edit Applicant Modal -->
<div class="modal fade" id="editApplicantModal" tabindex="-1" aria-labelledby="editApplicantModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="editApplicantForm" method="POST" action="#">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editApplicantModalLabel">Edit Applicant</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit-id">
                    <div class="mb-3">
                        <label for="edit-name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="edit-name" name="name" required readonly>
                    </div>
                    <div class="mb-3">
                        <label for="edit-email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="edit-email" name="email" required readonly>
                    </div>
                    <div class="mb-3">
                        <label for="edit-company" class="form-label">Company</label>
                        <input type="text" class="form-control" id="edit-company" name="company" required readonly>
                    </div>
                    <div class="mb-3">
                        <label for="edit-status" class="form-label">Status</label>
                        <select class="form-select" id="edit-status" name="status" required>
                            <option value="pending">Pending</option>
                            <option value="accepted">Accepted</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- SweetAlert Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Handle view button
        document.querySelectorAll('.view-btn').forEach(button => {
            button.addEventListener('click', () => {
                const id = button.dataset.id;
                document.getElementById('view-name').textContent = button.dataset.name;
                document.getElementById('view-email').textContent = button.dataset.email;
                document.getElementById('view-company').textContent = button.dataset.company;
                document.getElementById('view-status').textContent = button.dataset.status;
                document.getElementById('view-cv').setAttribute('href', `/storage/${button.dataset.cv}`);
                new bootstrap.Modal(document.getElementById('viewApplicantModal')).show();
            });
        });

        // Handle edit button
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function () {
                const userId = this.dataset.id;
                const actionUrl = `/superapps/${userId}`;

                // Set the action URL for the form
                document.getElementById('editApplicantForm').action = actionUrl;
                document.getElementById('edit-id').value = button.dataset.id;
                document.getElementById('edit-name').value = button.dataset.name;
                document.getElementById('edit-email').value = button.dataset.email;
                document.getElementById('edit-company').value = button.dataset.company;
                document.getElementById('edit-status').value = button.dataset.status;
                new bootstrap.Modal(document.getElementById('editApplicantModal')).show();
            });
        });

        // Handle delete button
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
    });
</script>


@endsection
