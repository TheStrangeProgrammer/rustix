<!DOCTYPE html>

<html class="h-100">
    <head>
        @include('head')
    </head>
    <body class="d-flex flex-column h-100 body">

        <head>
            @include('partials.header')
        </head>
        <div id="app" class="d-flex h-100">
            <section class="left-sidebar d-flex">
                @include('partials.left_sidebar')
            </section>
            <main class="main">
                @yield('content')
            </main>
        </div>
        @include('partials.footer')

        @include('scripts')

    </body>
</html>
