<!DOCTYPE html>

<html class="h-100 scroll">

<head>
    @include('head')
</head>

<body class="h-100 body  theme-tc-1 theme-bc-1 theme-fw-1">
    @if (Auth::check())
        @include('partials.header.deposit')
        @include('partials.header.withdraw')
        @include('partials.header.profile')
        @include('partials.header.referrals')
        @if (Auth::user()->role == 1 || Auth::user()->role == 2)
        @include('partials.header.admin')
        @endif
    @endif
    @include('partials.left_sidebar.alt')
    @include('partials.left_sidebar.faq')
    @include('partials.left_sidebar.tos')
    <div class="clearfix">
        <div class="spinner"></div> {{-- LOADER --}}
    </div>
    
    <div id="app" class="d-flex flex-column h-100">

        @include('partials.header')

        <div id="sidebar-and-content" class="d-flex h-100">

            @include('partials.left_sidebar')
            <button id="chat-button" class="chat-button">></button>
            <div id="overlay-loading" class="justify-content-center align-items-center">
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
    {{-- LOADER --}}
    <script>
window.addEventListener("load", function(){
    $('.clearfix').hide();
});
    </script>

</body>

</html>
