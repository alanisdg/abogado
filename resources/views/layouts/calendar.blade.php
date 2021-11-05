<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') || APPBOPROC</title>

    <script>var BASE_URL = "{{ url('/') }}"</script>

    <!-- Styles -->
    @include('layouts.styles')

    @yield('styles')

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</head>
<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static menu-collapsed" data-open="click" data-menu="vertical-menu-modern" data-col="">




                        @yield('content')


    @include('layouts.scripts')

    @yield('scripts')
</body>
</html>
