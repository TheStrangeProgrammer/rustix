<!DOCTYPE html>

<html class="h-100">

<head>
    @include('head')
</head>

<body class="h-100 body is-blurred theme-tc-1 theme-bc-1 theme-fw-1">
    <div id="app" class="d-flex flex-column h-100">
        @include('partials.header')

        <div id="sidebar-and-content" class="d-flex flex-fill">

            @include('partials.left_sidebar')

            <div id="overlay" class="justify-content-center align-items-center">
                <div class="spinner-border text-light" style="width: 10rem; height: 10rem;" role="status">
                </div>
            </div>
            <main class="main">
                @yield('content')
            </main>
        </div>
        @include('partials.footer')
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    @stack('js')

</body>

</html>
