

    @include('partials.left_sidebar.alt')
    @include('partials.left_sidebar.faq')
    @include('partials.left_sidebar.tos')

    <div class="d-flex flex-column sidebar">

        <button class="p-1 mt-3" data-bs-toggle="modal" data-bs-target="#TOS">TOS</button>
        <button class="p-1 mt-3" data-bs-toggle="modal" data-bs-target="#FAQ">FAQ</button>
        <button class="p-1 mt-3" data-bs-toggle="modal" data-bs-target="#ALT">ALT</button>

        <button class="mt-auto p-1"><i class="fas fa-arrow-left mb15"></i></button>
    </div>
    @if (Auth::check())
    <chat user="{{ Auth::user()->name }}" class="chat"></chat>
    @else
    <guestchat class="chat"></guestchat>
    @endif


