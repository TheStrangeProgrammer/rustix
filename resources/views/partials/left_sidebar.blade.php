

<link rel="stylesheet" type="text/css" href="{{ asset('css/partials/chat.css') }}">

<section class="left-sidebar">

    @if (Auth::check())
    <div class="chat-top">
        <button id="free-coins" class="free-coins">Claim your free coins</button>
    </div>
        <chat id="chat" user="{{ Auth::user()->name }}"></chat>
    @else
    <div class="chat-top" style="background-color:red">
        <a class="free-coins"  href="{{ URL::route('login') }}" >Please Log In to claim your free coins</a>
    </div>
        <guestchat id="chat"></guestchat>
    @endif



    <div class="sidebar display-media">
        <button class="button-sidebar" data-bs-toggle="modal" data-bs-target="#TOS">TOS</button>
        <button class="button-sidebar" data-bs-toggle="modal" data-bs-target="#FAQ">FAQ</button>
        <button class="button-sidebar" data-bs-toggle="modal" data-bs-target="#ALT">ALT</button>
    </div>
</section>


@push('js')
    <script src="{{ asset('js/partials/left_sidebar.js') }}"></script>
@endpush
