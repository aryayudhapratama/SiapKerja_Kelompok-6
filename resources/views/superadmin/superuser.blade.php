<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Super Users</title>
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
            <h3 class="menu-title">Super Admin</h3>
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('dashboard') }}">Dashboard</a>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('superjobs') }}">Jobs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('superapps') }}">Applicants</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ url('superusers') }}">Users</a>
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
                    <div class="page-title"><h1>Super Users</h1></div>
                    <div class="header-right">
                        <a href="{{ route('superusers.create') }}" class="btn btn-primary">Add User</a>
                    </div>
                </div>
            </header>
            <div class="content mt-3">
                <div class="col-sm-12">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <div class="alert alert-info">User  List</div>
                    <table class="table table-striped">
                        <thead>
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
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td>
                                        <a href="{{ route('superusers.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('superusers.destroy', $user->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?');">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    
        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    
    </html>