<!DOCTYPE html>

<html class="h-100">
    <head>
        @include('head')
    </head>
    <body class="h-100 body">
        <div id="app" class="d-flex flex-column h-100">
            @include('partials.header')
            <div id="sidebar-and-content" class="d-flex h-100 w-100">
                <section class="d-flex left-sidebar h-100">
                    @include('partials.left_sidebar')
                </section>
                <main class="main">
                    @yield('content')
                </main>

            </div>

            @include('partials.footer')
        </div>
        @include('scripts')

    </body>
</html>
