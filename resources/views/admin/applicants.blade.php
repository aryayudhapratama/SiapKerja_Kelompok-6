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
    <div id="right-panel" class="right-panel">
        <header id="header" class="header">
            <div class="header-menu">
                <div class="page-title">
                    <h1>Dashboard</h1>
                </div>
            </div>
        </header>
    </div>

    <!-- Card -->
    <div class="container mt-5">
        <h2 class="mb-4">List of All Applicants</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="alert alert-info">Applicants List</div>
        <table class="table table-striped">
            <thead>
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
                        <td>
                            <a href="{{ route('admin.applicant.edit', $applicant->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.applicant.destroy', $applicant->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
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
</body>

</html>
