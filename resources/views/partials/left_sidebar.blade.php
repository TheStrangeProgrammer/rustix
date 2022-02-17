@include('partials.left_sidebar.alt')
@include('partials.left_sidebar.faq')
@include('partials.left_sidebar.tos')

<link rel="stylesheet" type="text/css" href="{{ asset('css/partials/chat.css') }}">

<section class="d-flex flex-column left-sidebar h-100 ">
    <div class="d-flex chat-top">
        <span class="free-coins">claim your free coins</span>
    </div>
    @if (Auth::check())
        <chat class="flex-fill {{ Auth::user()->name }}"></chat>
    @else
        <guestchat class="flex-fill"></guestchat>
    @endif
    <div class="d-flex sidebar display-media">
        <button class="p-1 mt-3" data-bs-toggle="modal" data-bs-target="#TOS">TOS</button>
        <button class="p-1 mt-3" data-bs-toggle="modal" data-bs-target="#FAQ">FAQ</button>
        <button class="p-1 mt-3" data-bs-toggle="modal" data-bs-target="#ALT">ALT</button>
        <button class="mt-auto p-1"><i class="fas fa-arrow-left mb15"></i></button>
    </div>
</section>


