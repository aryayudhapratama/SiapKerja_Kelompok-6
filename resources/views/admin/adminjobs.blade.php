<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Optional: File CSS Custom -->
    <link rel="stylesheet" href="{{ asset('assets/scss/style.css') }}">
</head>

<body>
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-light bg-light">
            <h3 class="menu-title">Admin</h3>
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ url('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('adminjobs') }}">Jobs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('applicants') }}">Applicants</a>
                    </li>
                    <li class="nav-item">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a class="nav-link" href="{{ url('/') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
    </aside>

    <!-- Content -->
    <div class="container mt-5">
        <h2>Job Listings</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('adminjobs.create') }}" class="btn btn-primary mb-3">Create Job</a>

        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Company Name</th>
                    <th>Description</th>
                    <th>Address</th>
                    <th>Category</th>
                    <th>Picture</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jobs as $job)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $job->company_name }}</td>
                        <td>{{ $job->description }}</td>
                        <td>{{ $job->address }}</td>
                        <td>{{ $job->category }}</td>
                        <td>
                            @if($job->picture)
                                <img src="{{ asset('storage/' . $job->picture) }}" alt="Job Picture" style="width: 100px; height: auto;">
                            @else
                                No Image
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('adminjobs.edit', $job->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('adminjobs.destroy', $job->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this job?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>