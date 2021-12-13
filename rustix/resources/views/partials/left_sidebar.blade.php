
<section class="d-flex">
    @include('partials.left_sidebar.alt')
    @include('partials.left_sidebar.faq')
    @include('partials.left_sidebar.tos')

    <div class="d-flex flex-column">

        <button class="p-1">TOS</button>
        <button class="p-1">FAQ</button>
        <button class="p-1">ALT</button>

        <button class="mt-auto p-1"><i class="fas fa-arrow-left mb15"></i></button>
    </div>
    <chat></chat>
</section>
