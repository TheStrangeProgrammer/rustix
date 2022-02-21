@include('partials.left_sidebar.alt')
@include('partials.left_sidebar.faq')
@include('partials.left_sidebar.tos')

<link rel="stylesheet" type="text/css" href="{{ asset('css/partials/chat.css') }}">

<section class="left-sidebar theme-bc-2">
    <div class="d-flex chat-top">
        <span class="free-coins">claim your free coins</span>
    </div>
    @if (Auth::check())
        <chat class="flex-fill {{ Auth::user()->name }}"></chat>
    @else
        <guestchat class="flex-fill"></guestchat>
    @endif
    <div class="d-flex w-100 justify-content-evenly sidebar display-media">
        <button class="button-sidebar p-1" data-bs-toggle="modal" data-bs-target="#TOS">TOS</button>
        <button class="button-sidebar p-1" data-bs-toggle="modal" data-bs-target="#FAQ">FAQ</button>
        <button class="button-sidebar p-1" data-bs-toggle="modal" data-bs-target="#ALT">ALT</button>
    </div>
</section>


