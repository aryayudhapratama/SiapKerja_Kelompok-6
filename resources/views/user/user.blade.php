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
            <h3 class="menu-title">User</h3>
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ url('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('userjobs') }}">Jobs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('history') }}">History</a>
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
                    <h1>Dashboard user blm login</h1>
                </div>
            </div>
        </header>
    </div>

    <!-- Card -->
    <div class="content mt-3">
        <div class="container">
            <h2>Available Jobs</h2>
            <div class="row">
                @forelse ($jobs as $job)
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <img src="{{ asset('storage/' . $job->picture) }}" class="card-img-top" alt="{{ $job->title }}" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $job->company_name }}</h5>
                                <p class="card-text">{{ Str::limit($job->description, 100) }}</p>

                                <a href="{{ route('userjobs.show', $job->id) }}" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>No jobs available.</p>
                @endforelse
            </div>
        </div>
    </div>
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
