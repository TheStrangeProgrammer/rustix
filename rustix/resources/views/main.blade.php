<!DOCTYPE html>

<html class="h-100">
    <head>
        @include('head')
    </head>
    <body class="h-100 body">
        <div id="app" class="d-flex flex-column h-100">
            @include('partials.header')
            <div id="sidebar-and-content" class="d-flex flex-row-reverse h-100">

                <main class="flex-fill main">
                    @yield('content')
                </main>
                <section class="d-flex left-sidebar h-100">
                    @include('partials.left_sidebar')
                </section>
            </div>

            @include('partials.footer')
        </div>
        @include('scripts')

    </body>
</html>
