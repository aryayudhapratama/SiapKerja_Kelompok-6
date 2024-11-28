<!DOCTYPE html>
<html lang="en">

<head>
    {{-- <title>{{ $pageTitle }}</title> --}}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/sass/app.scss', 'resources/css/bootsrap.min.css', 'resources/css/style.css', 'resources/css/custom.css'])
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
</head>

<body>
    @include('layouts.nav')
    @yield('content')
    @include('layouts.foot')
    @vite(['resources/js/app.js'])
</body>

</html>