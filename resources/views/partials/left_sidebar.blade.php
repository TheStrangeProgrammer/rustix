@include('partials.left_sidebar.alt')
@include('partials.left_sidebar.faq')
@include('partials.left_sidebar.tos')

<link rel="stylesheet" type="text/css" href="{{ asset('css/partials/chat.css') }}">

<section class="left-sidebar">
    <div class="d-flex chat-top">
        <button id="free-coins" class="free-coins">Claim your free coins</button>
    </div>
    @if (Auth::check())
        <chat class="flex-fill {{ Auth::user()->name }}"></chat>
    @else
        <guestchat class="flex-fill"></guestchat>
    @endif
    <div class="d-flex justify-content-evenly sidebar display-media">
        <button class="button-sidebar" data-bs-toggle="modal" data-bs-target="#TOS">TOS</button>
        <button class="button-sidebar" data-bs-toggle="modal" data-bs-target="#FAQ">FAQ</button>
        <button class="button-sidebar" data-bs-toggle="modal" data-bs-target="#ALT">ALT</button>
    </div>
</section>


@push('js')
    <script src="{{ asset('js/partials/left_sidebar.js') }}"></script>
@endpush
