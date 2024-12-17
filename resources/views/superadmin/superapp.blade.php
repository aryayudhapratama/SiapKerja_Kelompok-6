@extends('layouts.superadmin')
@section('content')

    <!-- Content -->
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
            <div class="alert alert-success text-center fw-semibold">Applicants List</div> 
        <table class="table table-striped table-bordered table-hover table-responsive">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Company</th>
                    <th>CV</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($applicants as $index => $applicant)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $applicant->name }}</td>
                        <td>{{ $applicant->email }}</td>
                        <td>{{ $applicant->company }}</td>
                        <td>
                            <a href="{{ asset('storage/' . $applicant->cv) }}" target="_blank">Download CV</a>
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
                        <td style="text-align:center">
                            <a href="{{ route('superapps.edit', $applicant->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                            <form action="{{ route('superapps.destroy', $applicant->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"> <i class="bi bi-trash"></i> Delete</button>
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

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</body>

</html>
@endsection