
<section id="chat" class="flex between">
    @include('partials.left_sidebar.alt')
    @include('partials.left_sidebar.faq')
    @include('partials.left_sidebar.tos')

<div class="left fullh flexcol center between">
    <span class="flexcol center fullw">
        <button class="mb5 btnModal">TOS</button>
        <button class="mb5 btnModal">FAQ</button>
        <button class="btnModal">ALT</button>
    </span>
    <button id="chatToggleBTN" class="fas fa-arrow-left mb15"></button>
</div>
@include('partials.left_sidebar.chat')
</section>
