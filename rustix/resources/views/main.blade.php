<!DOCTYPE html>
<html>
    <head>
        @include('head')
    </head>

<body>
@include('header')
@include('partials.left_sidebar')

<main>
    @yield('content')
</main>
@include('footer')
@include('scripts')

</body>
</html>
