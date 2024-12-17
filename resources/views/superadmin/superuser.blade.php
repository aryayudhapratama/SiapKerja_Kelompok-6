@extends('layouts.superadmin')
@section('content')
<!-- Content -->
<div id="right-panel" class="right-panel">

    <div class="content mt-2">
        <div class="col-lg-10 mx-auto">
            @if(session('success'))
                <script>
                    // Menampilkan alert success menggunakan confirm
                    setTimeout(() => {
                        alert("{{ session('success') }}");
                    }); // Delay untuk memastikan halaman ter-render
                </script>
            @endif
            <div class="alert alert-success text-center fw-semibold">User List</div> 

            <!-- Align 'Add User' button to the right -->
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('superusers.create') }}" class="btn btn-light text-success fw-bold">
                    <i class="bi bi-plus-circle me-2"></i> Add User
                </a>
            </div>

            <div class="table-responsive rounded shadow-sm mt-2">
                <table class="table table-striped table-bordered table-hover align-middle">
                    <thead class="bg-secondary text-white text-center">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td class="text-center fw-semibold">{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td class="text-center">{{ ucfirst($user->role) }}</td>
                                <td class="text-center">
                                    <a href="{{ route('superusers.edit', $user->id) }}" class="btn btn-warning btn-sm me-1">
                                        <i class="bi bi-pencil-fill"></i> Edit
                                    </a>
                                    <form action="{{ route('superusers.destroy', $user->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?');">
                                            <i class="bi bi-trash-fill"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

@endsection
