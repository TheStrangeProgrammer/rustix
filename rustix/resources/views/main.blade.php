<!DOCTYPE html>

<html class="h-100">
    <head>
        @include('head')
    </head>
    <body class="d-flex flex-column h-100">

        <head>
            @include('partials.header')
        </head>
        <div id="app" class="d-flex flex-fill">
            @include('partials.left_sidebar')

            <main>
                @yield('content')
            </main>
        </div>
        @include('partials.footer')

        @include('scripts')

    </body>
</html>
