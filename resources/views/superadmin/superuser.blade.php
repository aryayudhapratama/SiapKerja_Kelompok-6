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
<div class="container" style="margin-top:2%">
    <header id="header" class="header">
       
    </header>
    <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
    <table class="table table-hover table-striped align-middle">
        <thead class="table-success" style="position: sticky; top: 0; z-index: 1020;">
            <tr>
                <th style="text-align: center; vertical-align: middle;">ID</th>
                <th style="text-align: center; vertical-align: middle;">Name</th>
                <th style="text-align: center; vertical-align: middle;">Email</th>
                <th style="text-align: center; vertical-align: middle;">Role</th>
                <th style="text-align: center; vertical-align: middle;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td style="text-align: center;">{{ $user->id }}</td>
                    <td style="text-align: center;">{{ $user->name }}</td>
                    <td style="text-align: center;">{{ $user->email }}</td>
                    <td style="text-align: center;">{{ $user->role }}</td>
                    <td>
                        <button class="btn btn-warning btn-sm edit-btn" 
                            data-id="{{ $user->id }}" 
                            data-name="{{ $user->name }}" 
                            data-email="{{ $user->email }}" 
                            data-role="{{ $user->role }}">
                            <i class="bi bi-pencil-square"></i> Edit
                        </button>
                        
                        <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $user->id }}">
                            <i class="bi bi-trash"></i> Delete
                        </button>
                        <form id="delete-form-{{ $user->id }}" action="{{ route('superusers.destroy', $user->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-end mb-3" style="margin-top:2%">
        <button id="add-user-btn" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal">
            Add User <i class="bi bi-plus-circle"></i>
        </button>
    </div>

<!-- Add User Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('superusers.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="add-name" class="form-label">Name:</label>
                        <input type="text" id="add-name" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="add-email" class="form-label">Email:</label>
                        <input type="email" id="add-email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="add-role" class="form-label">Role:</label>
                        <select id="add-role" name="role" class="form-select" required>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                            <option value="superadmin">SuperAdmin</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="add-password" class="form-label">Password:</label>
                        <input type="password" id="add-password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="add-password_confirmation" class="form-label">Confirm Password:</label>
                        <input type="password" id="add-password_confirmation" name="password_confirmation" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add User</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editForm" action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit-id" name="id">
                    <div class="mb-3">
                        <label for="edit-name" class="form-label">Name:</label>
                        <input type="text" id="edit-name" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-email" class="form-label">Email:</label>
                        <input type="email" id="edit-email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-role" class="form-label">Role:</label>
                        <select id="edit-role" name="role" class="form-select" required>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                            <option value="superadmin">SuperAdmin</option> 
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit-password" class="form-label">New Password:</label>
                        <input type="password" id="edit-password" name="password" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="edit-password_confirmation" class="form-label">Confirm Password:</label>
                        <input type="password" id="edit-password_confirmation" name="password_confirmation" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.querySelectorAll('.edit-btn').forEach(button => {
    button.addEventListener('click', function () {
        const userId = this.dataset.id;
        const actionUrl = `/superusers/${userId}`;  // Ubah '/users' menjadi '/superusers'
        document.getElementById('editForm').action = actionUrl;
        document.getElementById('edit-id').value = this.dataset.id;
        document.getElementById('edit-name').value = this.dataset.name;
        document.getElementById('edit-email').value = this.dataset.email;
        document.getElementById('edit-role').value = this.dataset.role;

        const editModal = new bootstrap.Modal(document.getElementById('editModal'));
        editModal.show();
    });
});


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
</script>

@endsection
