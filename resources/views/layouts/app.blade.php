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
</head>
<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static menu-collapsed" data-open="click" data-menu="vertical-menu-modern" data-col="">

    {{-- Header --}}
        @include('layouts.navs.header')
    {{-- End header --}}

    {{-- Menu --}}
        @include('layouts.navs.aside')
    {{-- End menu --}}

    {{-- Content --}}
        <div class="app-content content">
            <div class="content-overlay"></div>
            <div class="header-navbar-shadow"></div>
            {{-- Wrapper --}}
                <div class="content-wrapper">
                    <div class="content-header row">
                    </div>

                    {{--@include('partials.breadcrumbs')--}}

                    <div class="content-body">
                        @yield('content')
                    </div>
                </div>
            {{-- End wrapper --}}
        </div>
    {{-- End content --}}

    <!-- Scripts -->
    @include('layouts.scripts')

    @yield('scripts')
</body>
</html>
