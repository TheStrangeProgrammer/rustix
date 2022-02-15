@include('partials.left_sidebar.alt')
@include('partials.left_sidebar.faq')
@include('partials.left_sidebar.tos')

<div class="d-flex flex-column sidebar display-media">

    <button class="p-1 mt-3" data-bs-toggle="modal" data-bs-target="#TOS">TOS</button>
    <button class="p-1 mt-3" data-bs-toggle="modal" data-bs-target="#FAQ">FAQ</button>
    <button class="p-1 mt-3" data-bs-toggle="modal" data-bs-target="#ALT">ALT</button>

    <button class="mt-auto p-1"><i class="fas fa-arrow-left mb15"></i></button>
</div>

<div class="d-flex flex-column flex-fill display-media">
    <div class="d-flex chat-top">
        <p class="pt-2 ps-2 fw-bold">ENG <span class="green">63 </span>ONLINE</p>

        <button class="fab fa-discord pad10 margin"></button>
        <button class="fab fa-twitter pad10 me-1 ms-2"></button>
        <button class="fab fa-instagram pad10 mx-1"></button>
    </div>

    @if (Auth::check())
     
        <chat class="flex-fill {{ Auth::user()->name }}"></chat>
       
    @else
        <guestchat class="flex-fill"></guestchat>
    @endif



</div>
