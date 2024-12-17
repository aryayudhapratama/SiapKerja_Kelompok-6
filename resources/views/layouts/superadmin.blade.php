<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', 'Super Admin')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Concert+One&family=Pacifico&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<style>
.concert-one-regular {
  font-family: "Concert One", sans-serif;
  font-weight: 400;
  font-style: normal;
}
</style>
    
</head>

<body>
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-light bg-success">
    <h3 class="menu-title concert-one-regular" style="margin-left:20px; color:white; margin-right:30px">SuperAdmin</h3>
    <div id="main-menu" class="main-menu collapse navbar-collapse">
        <ul class="nav navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-light" href="{{ url('dashboard') }}">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="{{ url('superjobs') }}">Jobs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="{{ url('superapps') }}">Applicants</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="{{ url('superusers') }}">Users</a>
            </li>
        </ul>
    </div>

    <!-- Logout Button -->
    <div class="ms-auto pe-3">
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <button type="button" class="btn btn-outline-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</button>
    </div>
</nav>
    </aside>

    <!-- Main Content -->
    <main class="py-4">
        @yield('content') <!-- Pastikan bagian ini ada -->
    </main>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


