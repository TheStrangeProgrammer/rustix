<!DOCTYPE html>

<html>
    <head>
        @include('head')
    </head>
    <body>

        <head>
            @include('partials.header')
        </head>

        @include('partials.left_sidebar')

        <main>
            @yield('content')
        </main>

        @include('partials.footer')

        @include('scripts')

    </body>
</html>
