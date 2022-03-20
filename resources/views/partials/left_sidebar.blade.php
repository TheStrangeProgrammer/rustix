

<link rel="stylesheet" type="text/css" href="{{ asset('css/partials/chat.css') }}">

<section class="left-sidebar">
    <div class="online-bar">
        <span class="faucet-span">ONLINE</span>
        <span class="online-point"></span>
        <a href="https://discord.com/">
            <img src="../assets/discord.svg" class="social-img" alt="">
        </a>
        <a href="https://twitter.com/">
            <img src="../assets/twitter.svg" class="social-img" alt="">
        </a>
        <a href="https://instagram.com/">
            <img src="../assets/instagram.svg" class="social-img" alt="">
        </a>
    </div>
    <div class="bar-under"></div>
    <div class="d-flex " style="padding: 3%">
        <div class="d-flex flex-column m-auto">
            <span class="faucet-span">RUSTIX.COM FAUCET</span>
            <span class="claim-span">Claim your free coins</span>
        </div>
        
    @if (Auth::check())
    <div class="chat-top">
        <button id="free-coins" class="free-coins">Claim</button>
    </div>
</div>
        <chat id="chat" user="{{ Auth::user()->name }}"></chat>
    @else
    <div class="chat-top" style="background-color:#F95146">
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
