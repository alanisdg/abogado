<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') || APPBOPROC</title>

    <script>var BASE_URL = "{{ url('/') }}"</script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>

    <!-- Styles -->
    @include('layouts.styles')

    @yield('styles')
</head>
<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static menu-collapsed" data-open="click" data-menu="vertical-menu-modern" data-col="">





    {{-- Content --}}
        <div class="app-content  " style="padding: 20px !important">
            <div class="content-overlay"></div>

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
