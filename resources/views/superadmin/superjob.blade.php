@extends('layouts.superadmin')

@section('content')
<body>
  <div class="container mt-2">
    @if(session('success'))
      <script>
        // Menampilkan alert success menggunakan confirm
        setTimeout(() => {
          alert("{{ session('success') }}");
        }, 1000); // Delay for smooth rendering
      </script>
    @endif
    <div class="alert alert-success text-center fw-semibold">Applicants List</div>

    <table class="table table-striped table-bordered table-hover table-responsive">
      <thead class="table-light">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Company Name</th>
          <th scope="col">ID Company</th>
          <th scope="col">Description</th>
          <th scope="col">Address</th>
          <th scope="col">Category</th>
          <th scope="col">Picture</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($jobs as $job)
          <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $job->company_name }}</td>
            <td>{{ $job->user_id }}</td>
            <td><p style="white-space: normal; word-wrap: break-word;">{{ $job->description }}</p></td>
            <td>{{ $job->address }}</td>
            <td>{{ $job->category }}</td>
            <td>
              @if($job->picture)
                <img src="{{ asset('storage/' . $job->picture) }}" alt="Job Picture" style="width: 100px; height: auto;">
              @else
                No Image
              @endif
            </td>
            <td class="text-center">
              <a href="{{ route('superjobs.edit', $job->id) }}" class="btn btn-warning btn-sm mb-1" title="Edit">
                <i class="bi bi-pencil-square"></i> Edit
              </a>
              <form action="{{ route('superjobs.destroy', $job->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you sure you want to delete this job?');">
                  <i class="bi bi-trash"></i> Delete
                </button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</body>
@endsection